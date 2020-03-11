<?php
class Statistic_manage extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('funcmodel');
		$this->load->model('itemmodel');
		$this->load->model('adminlogmodel');
		

    }

    /**
     * 项目统计
     * @return [type] [description]
     */
    public function item_statistic()
    {
		$this->checkauth('item_statistic');
        $data['cdn'] = $this->cdn;       
        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
		$date = $this->input->post('date');
		$data_arr=$this->get_dates($date);
		$page_where = 'date='.$data_arr['date'];
		
		$where['start_timestamp'] = $data_arr['start_date'];
		$where['end_timestamp']   = date('Y-m-d',strtotime($data_arr['end_date'])+24 * 3600);
		
        $indications     = trim($this->input->get_post('indications'));
		$sponsor_company     = intval($this->input->get_post('sponsor_company'));
		$progress_id     = intval($this->input->get_post('progress_id'));
		$cro_id     = intval($this->input->get_post('cro_id'));
		$smo_id     = intval($this->input->get_post('smo_id'));
		$drug_id     = intval($this->input->get_post('drug_id'));
		$orderby     = trim($this->input->get_post('orderby'));
		$excle     = intval($this->input->get_post('excle'));
        if (isset($indications) && $indications) {
            $where['indications'] = $indications;
            $page_where      = 'indications=' . $indications;
			$data['indications']   = $indications;
        }
		if (isset($sponsor_company) && $sponsor_company) {
            $where['sponsor_company'] = $sponsor_company;
            $page_where      = 'sponsor_company=' . $sponsor_company;
			$data['sponsor_company']   = $sponsor_company;
        }

		if (isset($progress_id) && $progress_id) {
            $where['progress_id'] = $progress_id;
            $page_where      = 'progress_id=' . $progress_id;
			$data['progress_id']   = $progress_id;
        }

		if (isset($cro_id) && $cro_id) {
            $where['cro_id'] = $cro_id;
            $page_where      = 'cro_id=' . $cro_id;
			$data['cro_id']   = $cro_id;
        }


		if (isset($smo_id) && $smo_id) {
            $where['smo_id'] = $smo_id;
            $page_where      = 'smo_id=' . $smo_id;
			$data['smo_id']   = $smo_id;
        }

		if (isset($drug_id) && $drug_id) {
            $where['drug_id'] = $drug_id;
            $page_where      = 'drug_id=' . $drug_id;
			$data['drug_id']   = $drug_id;
        }

		if (isset($orderby) && $orderby) {
            $orderby = $orderby;
            $page_where      = 'orderby=' . $orderby;
			$data['orderby']   = $orderby;
        }else{
			$orderby = 'desc';
		}

		$data['date'] = $data_arr['date'];
		$data['start_date'] = $data_arr['start_date'];
		$data['end_date'] = $data_arr['end_date'];

		
		$this->load->model('itemmodel');
        $count            = $this->itemmodel->count($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码		
        $ls= $this->itemmodel->get_all($where, $p->firstRow, $p->listRows,$orderby);	
        $tac=$this->get_items_list();//该uid 所授权限的项目id数组
		$lis=array();
		foreach($ls as $key=>$v){
			if(in_array($v['id'],$tac)){
				$lis[$key]=$ls[$key];
			}
		}
		$data['list']=$lis;
		$data['sponsor']=$this->get_all_list('sponsor_company',array('status'=>1),'sname');
		$data['sponsors']=$this->get_all_lists('sponsor_company',array(),array('sname','pm','pm_phone'));
		$data['inis']=$this->get_all_list('inst',array('status'=>1),'shortname');
		$data['inis1']=$this->get_all_list('inst',array(),'instname');
		$data['dept']=$this->get_all_list('dept',array('status'=>1),'name');
		$data['depts']=$this->get_all_list('dept',array(),'name');
		$data['drug']=$this->drug;
		$data['smo']=$this->get_all_list('crc_company',array('status'=>1),'cname');
		$data['cros']=$this->get_all_list('cro_company',array('status'=>1),'crname');
		$data['cro']=$this->get_all_lists('cro_company',array(),array('crname','pm','pm_phone'));
		$data['progress']=$this->get_all_list('item_plan',array('status'=>1),'name');
		$data['field']=$this->get_all_list('field',array('status'=>1),'name');
		$data['test']=$this->get_all_list('test_type',array('status'=>1),'name');
		$data['drugtype']=$this->get_all_list('drug_type',array('status'=>1),'name');
		$data['classify']=$this->get_all_list('class_type',array('status'=>1,'drug_id'=>1),'name');
		
		//导出到excle表中所需数据
		$list1=$this->itemmodel->get_all_excle($where,$orderby);
		$list=array();
		foreach($list1 as $key1=>$v1){
			if(in_array($v1['id'],$tac)){
				$list[$key1]=$list1[$key1];
			}
		}
		if($excle ==1){
			
				$title=array('项目全称','项目编号','外司编号','SMO公司','项目合作机构列表','试验分期','试验用品类型','试验用品名称','适用症','所属领域','申办公司','申办方PM','申办方PM电话','CRO公司','CRO公司PM','CRO公司PM电话','组长机构','组长科室','组长单位PI','PI联系方式','组长单位SUB-I','SUB-I联系方式','启动时间','项目进度','计划入组','实际入组','首例入组时间','首例入组机构');
				$export_list= array();
				$count = count($list);
				for($i=1;$i<=$count;$i++){
                    $j=$i-1;
                    $deptid='';$piarr=array();$subarr=array();
					$deptid=$list[$j]['leader_dept'];
					$piarr=$this->get_all_lists('dept_member',array('dept_id'=>$deptid,'identity'=>'pi'),array('name','phone','email'));
					$subarr=$this->get_all_lists('dept_member',array('dept_id'=>$deptid,'identity'=>'sub-i'),array('name','phone','email'));

					$smos=array();$smo='';
					$inis=array();$iniss='';
					$cros=array();$crname='';$crpm='';$crpmp='';
					$pi='';
					$pil='';
					$sub='';
					$subl='';
					foreach($piarr as $v){
						$pi.=$v['name']."\r\n";
						$pil.=$v['phone'].$v['email']."\r\n";
					}
					foreach($subarr as $vd){
						$sub.=$vd['name']."\r\n";
						$subl.=$vd['phone'].$vd['email']."\r\n";
					}
					$sub.="--------\r\n";
					$subl.="--------\r\n";
					$pi.="--------\r\n";
					$pil.="--------\r\n";
					$smos=unserialize($list[$j]['smo_company']);
					$cros=unserialize($list[$j]['cro_company']);
					$inis=unserialize($list[$j]['inis_id']);
					foreach($smos as $val){
						$smo.=$data['smo'][$val]."\r\n";
					}
					foreach($inis as $vals){
						$iniss.=$data['inis'][$vals]."\r\n";
					}

					foreach($cros as $valss){
						$crname.=$data['cro'][$valss]['crname']."\r\n";
						$crpm.=$data['cro'][$valss]['pm']."\r\n";
						$crpmp.=$data['cro'][$valss]['pm_phone']."\r\n";
					}

					$export_list[$i][] = $list[$j]['name'];
					$export_list[$i][] = $list[$j]['item_number'];
					$export_list[$i][] = $list[$j]['exte_number'];
					$export_list[$i][] = $smo;
					$export_list[$i][] = $iniss;
					$export_list[$i][] = $data['drug'][$list[$j]['drug_id']];
					$export_list[$i][] = $data['test'][$list[$j]['test_id']];
					$export_list[$i][] = $data['drugtype'][$list[$j]['dtype_id']].$data['classify'][$list[$j]['classify_id']];
					$export_list[$i][] = $list[$j]['indications'];
					$export_list[$i][] = $data['field'][$list[$j]['field_id']];
					$export_list[$i][] = $data['sponsors'][$list[$j]['sponsor_company']]['sname'];
					$export_list[$i][] = $data['sponsors'][$list[$j]['sponsor_company']]['pm'];
					$export_list[$i][] = $data['sponsors'][$list[$j]['sponsor_company']]['pm_phone'];

					$export_list[$i][] = $crname;
					$export_list[$i][] = $crpm;
					$export_list[$i][] = $crpmp;
					$export_list[$i][] = $data['inis1'][$list[$j]['leader_inis']];
					$export_list[$i][] = $data['depts'][$list[$j]['leader_dept']];
                    $export_list[$i][] =$pi;
					$export_list[$i][] =$pil;
					$export_list[$i][] =$sub;
					$export_list[$i][] =$subl; 
					$export_list[$i][] = $list[$j]['start_time'];
					$export_list[$i][] = $data['progress'][$list[$j]['progress_id']];
					$export_list[$i][] = $list[$j]['plan_num'];
					$export_list[$i][] = $list[$j]['real_num'];
					$export_list[$i][] = $list[$j]['first_time'];
					$export_list[$i][] = $data['inis1'][$list[$j]['first_inis']];	
				}
				$filename =date('Y-m-d',time()).'-项目统计表';
				$this->export_excel_help($title,$export_list,$filename);
				exit;
			}
		
        $this->load->view('admin/statistic/item_statistic', $data);
    }

	  /**
     * CRC统计
     * @return [type] [description]
     */
    public function crc_statistic()
    {
		$this->checkauth('crc_statistic');
        $data['cdn'] = $this->cdn;       
        $this->load->helper('Page');
        $where['crc']      = 1;
        $page_where = '';
        $work_year     = trim($this->input->get_post('work_year'));
		$company_id     = trim($this->input->get_post('company_id'));
		$area_id     = trim($this->input->get_post('area_id'));
		$city_id     = trim($this->input->get_post('city_id'));
		$province_id     = trim($this->input->get_post('province_id'));
		$field_id     = intval($this->input->get_post('field_id'));
		$drug_id     = intval($this->input->get_post('drug_id'));
		$items_id     = trim($this->input->get_post('items_id'));
		$inis_id     = trim($this->input->get_post('inis_id'));
		$orderby     = trim($this->input->get_post('orderby'));
		$excle     = intval($this->input->get_post('excle'));
        $where_items=''; 

       if (isset($company_id) && $company_id) {
            $where['company_id'] = $company_id;
            $page_where      = 'company_id=' . $company_id;
			$data['company_id']   = $company_id;	
        }
		if (isset($province_id) && $province_id) {
            $where['province_id'] = $province_id;
            $page_where      = 'province_id=' . $province_id;
			$data['province_id']   = $province_id;	
        }
		if (isset($city_id) && $city_id) {
            $where['city_id'] = $city_id;
            $page_where      = 'city_id=' . $city_id;
			$data['city_id']   = $city_id;	
        }
		if (isset($area_id) && $area_id) {
            $where['area_id'] = $area_id;
            $page_where      = 'area_id=' . $area_id;
			$data['area_id']   = $area_id;	
        }
		if (isset($drug_id) && $drug_id) {
            $where['drug_id'] = $drug_id;
            $page_where      = 'drug_id=' . $drug_id;
			$data['drug_id']   = $drug_id;
        }

		if (isset($work_year) && $work_year) {
            $where['work_year'] = $work_year;
            $page_where      = 'work_year=' . $work_year;
			$data['work_year']   = $work_year;
        }


		if (isset($items_id) && $items_id) {
            $where['items_id'] = $items_id;
            $page_where      = 'items_id=' . $items_id;
			$data['items_id']   = $items_id;
        }


		if (isset($inis_id) && $inis_id) {
            $where['inis_id'] = $inis_id;
            $page_where      = 'inis_id=' . $inis_id;
			$data['inis_id']   = $inis_id;
        }

		if (isset($field_id) && $field_id) {
            $where['field_id'] = $field_id;
            $page_where      = 'field_id=' . $field_id;
			$data['field_id']   = $field_id;
        }


		if (isset($orderby) && $orderby) {
            $orderby = $orderby;
            $page_where      = 'orderby=' . $orderby;
			$data['orderby']   = $orderby;
        }else{
			$orderby = 'desc';
		}

		$items=$this->get_all_list('items',array('status'=>1),'shortname');
        $tac=$this->get_items_list();//该uid 所授权限的项目id数组
		$lis=array();
		foreach($items as $key=>$v){
			if(in_array($key,$tac)){
				$lis[$key]=$v;
			}
		}

		$data['items']=$lis;
		$data['inis']=$this->get_all_list('inst',array('status'=>1),'shortname');
		$data['province']=$this->get_all_list('provinces',array('status'=>1),'name');
		$data['city']=$this->get_all_list('city',array('status'=>1),'name');
		$data['area']=$this->get_all_list('area',array('status'=>1),'name');
		$data['company']=$this->get_all_list('crc_company',array('status'=>1),'cname');		
		$data['drug']=$this->drug;
		$data['field']=$this->get_all_list('field',array('status'=>1),'name');

		$data['sex'] = array('1'=>'男','2'=>'女');	
        $data['group']=$this->get_all_list('crc_group',array(),'gname');



		if(($field_id>0)&&($drug_id==0)){
			$item_arr=array();
			$item_arr=$this->get_all_list('items',array('status'=>1,'field_id'=>$field_id),'id');
			if(count($item_arr)){
				if($items_id){
					$where['items']=$itmes_id;
				}else{
					foreach($item_arr as $va){
					$where_items.=$va.',';
					}
					$where['items']=substr($where_items, 0, -1);
				}
				
			}else{
				$where['null']=1;	
			}
		}

		if(($field_id==0)&&($drug_id>0)){
			$item_arr=array();
			$item_arr=$this->get_all_list('items',array('status'=>1,'drug_id'=>$drug_id),'id');
			if(count($item_arr)){
				if($items_id){
					$where['items']=$itmes_id;
				}else{
					foreach($item_arr as $va){
					$where_items.=$va.',';
					}
					$where['items']=substr($where_items, 0, -1);
				}
				
			}else{
				$where['null']=1;	
			}
		}


		if(($field_id>0)&&($drug_id>0)){
			$item_arr=array();
			$item_arr=$this->get_all_list('items',array('status'=>1,'drug_id'=>$drug_id,'field_id'=>$field_id),'id');
			if(count($item_arr)){
				if($items_id){
					$where['items']=$itmes_id;
				}else{
					foreach($item_arr as $va){
					$where_items.=$va.',';
					}
					$where['items']=substr($where_items, 0, -1);
				}
				
			}else{
				$where['null']=1;	
			}
		
		
		}

		$this->load->model('crcmodel');
        $count            = $this->crcmodel->count_tj($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码		
        $data['list']= $this->crcmodel->get_all_tj($where, $p->firstRow, $p->listRows,$orderby);
		//导出到excle表中所需数据
		$list=$this->crcmodel->get_all_excle($where,$orderby);
		$itemlist=$this->get_all_list('items',array(),'name');
		$inislist=$this->get_all_list('inst',array(),'instname');
		$newlist=$this->get_all_list('news',array(),'title');
		if($excle ==1){
			
				$title=array('CRC姓名','性别','出生日期','所属公司','省','市','区域','组别','工作年限','项目列表','所在机构列表','主管患者数量','发表文章列表','关注文章列表','关注机构列表');
				$export_list= array();
				$count = count($list);
				for($i=1;$i<=$count;$i++){
					$j=$i-1;
						$item_arr=array();
						$itemarr='';
						 $item_arr=$this->get_all_list('crc_items',array('status'=>1,'type'=>1,'uid'=>$list[$j]['uid']),'items_id');
							foreach($item_arr as $iv){
							$itemarr.=$itemlist[$iv]."\r\n";
						}

						$inis_arr=array();
						$inisarr='';
						$inis_arr=$this->get_all_list('crc_items',array('status'=>1,'type'=>1,'uid'=>$list[$j]['uid']),'inis_id');
							foreach($inis_arr as $inv){
							$inisarr.=$inislist[$inv]."\r\n";
						}

						$ainis_arr=array();
						$ainisarr='';
						$ainis_arr=$this->get_all_list('crc_items',array('status'=>1,'type'=>2,'uid'=>$list[$j]['uid']),'inis_id');
							foreach($ainis_arr as $ainv){
							$ainisarr.=$inislist[$ainv]."\r\n";
						}

						$pnew_arr=array();
						$pnewarr='';
						$pnew_arr=$this->get_all_list('crc_news',array('type'=>1,'uid'=>$list[$j]['uid']),'news_id');
							foreach($pnew_arr as $pv){
							$pnewarr.=$newlist[$pv]."\r\n";
						}

						$anew_arr=array();
						$anewarr='';
						$anew_arr=$this->get_all_list('crc_news',array('type'=>2,'uid'=>$list[$j]['uid']),'news_id');
							foreach($anew_arr as $av){
							$anewarr.=$newlist[$av]."\r\n";
						}
						$export_list[$i][] = $list[$j]['uname'];
						$export_list[$i][] = $data['sex'][$list[$j]['sex']];
						$export_list[$i][] = $list[$j]['birthday'];
						$export_list[$i][] = $data['company'][$list[$j]['company_id']];
						$export_list[$i][] = $data['province'][$list[$j]['province_id']];
						$export_list[$i][] = $data['city'][$list[$j]['city_id']];
						$export_list[$i][] = $data['area'][$list[$j]['area_id']];
						$export_list[$i][] = $data['group'][$list[$j]['group_id']];
						$export_list[$i][] = $list[$j]['work_year'];
						$export_list[$i][] = $itemarr;
						$export_list[$i][] = $inisarr;
						$export_list[$i][] = $list[$j]['sufferer_num'];
						$export_list[$i][] = $pnewarr;
						$export_list[$i][] = $anewarr;
						$export_list[$i][] = $ainisarr;
				}
				$filename =date('Y-m-d',time()).'-CRC统计表';
				$this->export_excel_help($title,$export_list,$filename);
				exit;
			}
		
        $this->load->view('admin/statistic/crc_statistic', $data);
    }

    /**
     * 机构统计
     * @return [type] [description]
     */
    public function inst_statistic()
    {
    	$this->checkauth('inst_statistic');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$this->load->helper('page');
    	$area = $this->instmodel->get_all($where='',$table='area');
    	$data['area'] = $area;
    	$where = '';
    	$page_where = '';
    	$link = 'inst.id = dept.inst_id';
    	$search = trim($this->input->get_post('search'));
    	$area = $this->input->get_post('area_id');
    	$orderby = $this->input->get_post('orderby');
    	$excel = $this->input->get_post('excle');

    	$table=array('inst','dept');
    	if(isset($search) && $search){
    		$where['search'] = $search;
    		$where['column'] = 'dept.name';
    		$page_where = 'dept.name='.$search;
    	}
    	if(isset($area)&&$area){
    		$where['inst.area'] = $area;
    		$page_where = 'inst.area='.$area;
    	}

    	//查询到的总条数
        $count            = $this->instmodel->countw($where,$table,$link);
        $p = new page($count,10,$page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
        $data['type']     = $area;  
        $columns = 'inst.id,inst.instname,inst.shortname,inst.qualify_time,inst.troop_system,provinces.name as pname,area.name as aname,inst.status';
        $this->db->order_by('inst.id',$orderby);
        $this->db->group_by('inst.id');
        $table1 = array('inst','dept','provinces','area');
        $link1 = array('inst.id = dept.inst_id','inst.province = provinces.id','inst.area = area.id');
    	// $inst = $this->instmodel->join($where,$table,$link,$columns,$p->firstRow, $p->listRows);
    	$inst = $this->instmodel->join_s($where,$table1,$link1,$columns,$p->firstRow, $p->listRows);
    	$data['inst'] = $inst;

    	//获取机构接待人信息
    	$jwhere = array('status'=>1);
    	$jiedai = $this->instmodel->get_all($jwhere,$table='reception');
    	foreach ($jiedai as $key => $value) {
    		$reception[$value['id']][] = $value['receiver'];
    		$reception[$value['id']][] = $value['phone'];
    	}

    	// var_dump($reception);
    	if($excel==1){
    		$title = array('机构名称','隶属省份','隶属城市','部队系统','隶属区域','资格获取时间','机构主任姓名','主任电话','主任邮箱','主任办公室地址','机构秘书姓名','秘书电话','秘书邮箱','是否公开接待','机构公开接待时间','接待人','接待人电话','是否自组SMO团队','是否优选','优选单位名单','是否可以接收联斯达外派CRC','是否收CRC管理费','CRC管理费额度','发票税率','是否可牵头遗传办','收费额度','对CRC的要求','是否需要派遣函');
    		$table =array('inst','inst_detail','dept');
    		// $link  = ',';
    		$link  = array('inst.id =inst_detail.inst_id','inst.id = dept.inst_id');
    		$this->db->group_by('inst.id');
    		$excel = $this->instmodel->join_tj($where,$table,$link);	
    		$count = count($excel);
    		for($i=0;$i<$count;$i++){
    			$mname = '';
				$mphone ='';
				$memail ='';
    			$arr[$i][] = $excel[$i]['instname'];
    			$province = $this->instmodel->area_one($excel[$i]['province'],$table='provinces');
    			$arr[$i][] = $province['name'];
    			
    			$city = $this->instmodel->area_one($excel[$i]['city'],$table='city');
    			$arr[$i][] = $city['name'];
    			$arr[$i][] = $excel[$i]['troop_system']?'是':'否';
    			$area = $this->instmodel->area_one($excel[$i]['area'],$table='area');
    			$arr[$i][] = $area['name'];
    			$arr[$i][] = date('Y-m-d',$excel[$i]['qualify_time']);
    			//获取主任信息
    			$zhuren = $this->instmodel->get_one($excel[$i]['head_id'],$table='inst_member');
    			$arr[$i][] = $zhuren['name'];
    			$arr[$i][] = $zhuren['phone'];
    			$arr[$i][] = $zhuren['email'];
    			$arr[$i][] = $zhuren['office_address'];
    			//获取秘书信息
    			$mwhere = explode(',',$excel[$i]['secretary_id']);
    			$columns = 'id';
    			$mishu = $this->instmodel->get_in($table='inst_member',$mwhere,$columns);
    			foreach ($mishu as $key => $value) {
    				$mname .= $value['name']."\r\n";
    				$mphone .= $value['phone']."\r\n";
    				$memail .= $value['email']."\r\n";
    			}
    			$arr[$i][] = $mname;
    			$arr[$i][] = $mphone;
    			$arr[$i][] = $memail;
    			$arr[$i][] = $excel[$i]['is_reception']?'是':'否';
    			$arr[$i][] = date('Y-m-d',$excel[$i]['reception_time']);
    			$arr[$i][] = $reception[$excel[$i]['is_reception']]['0'];
    			$arr[$i][] = $reception[$excel[$i]['is_reception']]['1'];
    			$arr[$i][] = $excel[$i]['is_smo']?'是':'否';
    			$arr[$i][] = $excel[$i]['is_prior']?'是':'否';
    			$arr[$i][] = $excel[$i]['prior_list'];
    			$arr[$i][] = $excel[$i]['is_despatch']?'是':'否';
    			$arr[$i][] = $excel[$i]['is_fees']?'是':'否';
    			$arr[$i][] = $excel[$i]['fees'];
    			$arr[$i][] = $excel[$i]['invoice'];
    			$arr[$i][] = $excel[$i]['is_lead_heredity']?'是':'否';
    			$arr[$i][] = $excel[$i]['cost'];
    			$arr[$i][] = $excel[$i]['crc_require'];
    			$arr[$i][] = $excel[$i]['is_dpletter']?'是':'否';
    		}

    		// var_dump($arr);
    		$export_list = $arr;
    		$filename =date('Y-m-d',time()).'-机构统计表';
			$this->export_excel_help($title,$export_list,$filename);
			unset($excel);
			unset($arr);
			exit;
    	}
    	if($excel==2){

    		$title = array('机构名称','立项接待时间','立项办公室地址','立项负者人','联系电话','邮箱','立项文件要求','立项备注说明','伦理接待时间','伦理联系人','伦理联系电话','伦理联系邮箱','是否必需要组长单位批件上会','伦理会招开频率','伦理会费（上会）','伦理会费（快审）','伦理会时间','合同负责人','合同办公室地址','合同负责人电话','合同负责人邮箱','是否使用医院模板','是否可在遗传办批准前签署合同','CRC合同是否需要答署','合同类型','遗传办地址','是否可牵头','牵头费','可牵头次数','遗传办备注');
    		$table =array('inst','dept','project','ethic');
    		$link  = array('inst.id = dept.inst_id','inst.id =project.inst_id','inst.id = ethic.inst_id');
    		$columns = 'inst.instname,inst.id,project.reception_time as ptime,project.address,project.charge_id,project.require,project.remarks,ethic.reception_time as etime,ethic.linkman,ethic.approval,ethic.frequency,ethic.huifei,ethic.kuaishen,ethic.ethic_time';
    		
    		$this->db->group_by('inst.id');
    		$excelDesc = $this->instmodel->join_s($where,$table,$link,$columns);	
    		$count = count($excelDesc);
    		echo $count;

    		//获取所有的合同信息
    		$hwhere = array('status'=>1);
    		$hetong = $this->instmodel->get_all($hwhere,$table='contract');
    		foreach ($hetong as $key => $value) {
    			$contract[$value['inst_id']]['charge'] = $value['charge'];
    			$contract[$value['inst_id']]['address'] = $value['address'];
    			$contract[$value['inst_id']]['is_templet'] = $value['is_templet'];
    			$contract[$value['inst_id']]['is_contract'] = $value['is_contract'];
    			$contract[$value['inst_id']]['is_answer'] = $value['is_answer'];
    			$contract[$value['inst_id']]['contract_type'] = $value['contract_type'];

    		}

    		// 获取所有遗传办信息
    		$ywhere = array('status'=>1);
    		$yichuan = $this->instmodel->get_all($ywhere,$table='heredity');
    		foreach ($yichuan as $key => $value) {
    			$heredity[$value['inst_id']]['address'] = $value['address'];
    			$heredity[$value['inst_id']]['is_lead'] = $value['is_lead'];
    			$heredity[$value['inst_id']]['cost'] = $value['cost'];
    			$heredity[$value['inst_id']]['number'] = $value['number'];
    			$heredity[$value['inst_id']]['remarks'] = $value['remarks'];

    		}

    		//获取所有的中心人员信息
    		
    		for($i=0;$i<$count;$i++){
    			$lxfzr = '';
    			$lxphone = '';
    			$lxemail ='';
    			$llfzr = '';
    			$llphone = '';
    			$llemail ='';
    			$desc[$i][] = $excelDesc[$i]['instname'];
    			$desc[$i][] = date('Y-m-d',$excelDesc[$i]['ptime']);
    			$desc[$i][] = $excelDesc[$i]['address'];
    			//获取立项负责人信息
    			$fwhere = explode(',',$excelDesc[$i]['charge_id']);
    			$columns = 'id';
    			$fuzeren = $this->instmodel->get_in($table='inst_member',$fwhere,$columns);
    			foreach ($fuzeren as $key => $value) {
    				$lxfzr .= $value['name']."\r\n";
    				$lxphone .= $value['phone']."\r\n";
    				$lxemail .= $value['email']."\r\n";
    			}

    			//获取伦理负责人信息
    			$fwhere = explode(',',$excelDesc[$i]['linkman']);
    			$columns = 'id';
    			$fuzeren = $this->instmodel->get_in($table='inst_member',$fwhere,$columns);
    			// var_dump($fuzeren);
    			foreach ($fuzeren as $key => $value) {
    				$llfzr .= $value['name']."\r\n";
    				$llphone .= $value['phone']."\r\n";
    				$llemail .= $value['email']."\r\n";
    			}

    			$desc[$i][] = $lxfzr;
    			$desc[$i][] = $lxphone;
    			$desc[$i][] = $lxemail;
    			$desc[$i][] = $excelDesc[$i]['require'];
    			$desc[$i][] = $excelDesc[$i]['remarks'];
    			$desc[$i][] = date('Y-m-d',$excelDesc[$i]['etime']);

    			$desc[$i][] = $llfzr;
    			$desc[$i][] = $llphone;
    			$desc[$i][] = $llemail;
    			$desc[$i][] = $excelDesc[$i]['approval']?'是':'否';
    			$desc[$i][] = $excelDesc[$i]['frequency'];
    			$desc[$i][] = $excelDesc[$i]['huifei'];
    			$desc[$i][] = $excelDesc[$i]['kuaishen'];
    			$desc[$i][] = str_replace('@',' ',$excelDesc[$i]['ethic_time']);
    			$cfzr = $this->instmodel->get_one($contract[$excelDesc[$i]['id']]['charge'],$table='inst_member');
    			$desc[$i][] = $cfzr['name'];
    			$desc[$i][] = $cfzr['phone'];
    			$desc[$i][] = $cfzr['email'];
    			$desc[$i][] = $contract[$excelDesc[$i]['id']]['address'];
    			$desc[$i][] = $contract[$excelDesc[$i]['id']]['is_templet']?'是':'否';
    			$desc[$i][] = $contract[$excelDesc[$i]['id']]['is_contract']?'是':'否';
    			$desc[$i][] = $contract[$excelDesc[$i]['id']]['is_answer']?'是':'否';
    			$desc[$i][] = $contract[$excelDesc[$i]['id']]['contract_type'];

    			$desc[$i][] = $heredity[$excelDesc[$i]['id']]['address'];
    			$desc[$i][] = $heredity[$excelDesc[$i]['id']]['is_lead']?'是':'否';
    			$desc[$i][] = $heredity[$excelDesc[$i]['id']]['cost'];
    			$desc[$i][] = $heredity[$excelDesc[$i]['id']]['number'];
    			$desc[$i][] = $heredity[$excelDesc[$i]['id']]['remarks'];

    		}
    		// var_dump($desc);
    		$export_list = $desc;
    		$filename =date('Y-m-d',time()).'-机构详情统计表';
			$this->export_excel_help($title,$export_list,$filename);
			unset($desc);
			unset($excelDesc);
			exit;
    	}
    	// var_dump($desc);

    	$this->load->view('admin/statistic/inst_statistic',$data);
    }

    /**
     * 患者统计
     * @return [type] [description]
     */
    public function patient_statistic()
    {
    	$this->checkauth('patient_statistic');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$this->load->helper('page');
    	$sheng = array();
    	$province = $this->instmodel->get_all($where='',$table='provinces');
    	$data['province'] = $province;		
    	foreach ($province as $key => $value) {
    		$sheng[$value['id']] = $value['name'];
    	}
    	$data['sheng'] = $sheng;
    	$chengshi = array();
    	$cheng = $this->instmodel->get_all($where='',$table='city');
    	foreach ($cheng as $key => $value) {
    		$chengshi[$value['id']]=$value['name'];
    	}
    	$data['chengshi'] = $chengshi;
    	$xiangmu = array();
    	$items = $this->instmodel->get_all($where='',$table='items');
    	$data['items'] = $items;

    	foreach ($items as $key => $value) {
    		$xiangmu[$value['id']] = $value['name'];
    	}
    	$data['xiangmu'] = $xiangmu;
    	$jianduan = array();
    	$itemplan = $this->instmodel->get_all($where='',$table='item_plan');
    	$data['itemplan'] = $itemplan;
    	foreach ($itemplan as $key => $value) {
    		$jianduan[$value['id']] = $value['name'];
    	}
  
    	$jigou = array();
    	$inst = $this->instmodel->get_all($where='',$table='inst');
    	$data['inst'] = $inst;
    	foreach ($inst as $key => $value) {
    		$jigou[$value['id']] = $value['instname'];
    	}
    	$data['jigou'] = $jigou;
    	$field = $this->instmodel->get_all($where='',$table='field');
    	$data['field'] = $field;

    	$dept = $this->instmodel->get_all($where='',$table='dept');
    	foreach ($dept as $key => $value) {
    		$dept[$value['id']] = $value['name'];
    	}
    	$data['dept'] = $dept;
    	
    	$search = trim($this->input->get_post('search'));
    	$orderby = $this->input->get_post('orderby');
    	$excel = $this->input->get_post('excle');
    	$province_id = $this->input->get_post('province_id');
    	$city = $this->input->get_post('city_id');
    	$items_id = $this->input->get_post('items_id');
    	$item_jd = $this->input->get_post('itemsjd_id');
    	$inis_id = $this->input->get_post('inis_id');
    	$field_id = $this->input->get_post('field_id');

    	$carea = $this->instmodel->get_all($where=array('parent_id'=>$province_id),$table='city');
    	$data['city'] = $carea;

    	//分页显示及条件
    	$where = '';
    	$page_where = '';
    	$link = array('patient.user_id = web_user.uid','patient.itemid = items.id');
    	$table=array('patient','web_user','items');
    	//判断适应症
    	if(isset($search) && $search){
    		$where['search'] = $search;
    		$where['column'] = 'items.indications';
    		$page_where = 'dept.name='.$search;
    	}
    	//判断 患者省，市
    	if(isset($province_id)&&$province_id){
    		$where['patient.province'] = $province_id;
    		$page_where = 'patient.province='.$province_id;
    		if(isset($city)&&$city){
    			$where['patient.city'] = $city;
    			$page_where = 'patient.city='.$city;
    		}
    	}
    	//判断项目 和项目进度
    	if(isset($items_id) && $items_id){
    		$where['patient.itemid'] = $items_id;
    		$page_where = 'patient.itemid='.$items_id;
    		if(isset($item_jd) && $item_jd){
    				$where['items.progress_id'] = $item_jd;
    		}
    	}else{
    		if(isset($item_jd) && $item_jd){
    			$where['items.progress_id'] =$item_jd;
    			$page_where = 'items.progress_id='.$item_jd;
    		}
    	}
    	// var_dump($res);
    	//判断机构
    	if(isset($inis_id)&&$inis_id){
    		$where['patient.inst_id'] = $inis_id;
    		$page_where = 'patient.inst_id='.$inis_id;	
    	}
    	//判断所属领域
    	if(isset($field_id)&&$field_id){
    		$where['items.field_id'] = $field_id;
    		$page_where = 'items.field_id='.$field_id;	
    	}


    	$where['web_user.state']=0;
    	//查询到的总条数
    	$this->db->group_by('patient.id');
    	$w = 'patient.id';
        $count            = $this->instmodel->count_p($where,$table,$link,$w);
        // exit;
        $p = new page($count,10,$page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
        $data['parea']     = $province_id;  
        $data['carea']		=$city;
        $data['items_id']  = $items_id;
        $data['itemjd']		=$item_jd;
        $data['inis_id']  = $inis_id;
        $data['field_id']  = $field_id;

        $columns = 'web_user.uid,web_user.uname,patient.sex,patient.birth,patient.inst_id,patient.province,patient.city,patient.itemid,patient.dept,patient.id,patient.crc';
        $this->db->order_by('patient.id',$orderby);
    	$user = $this->instmodel->join_tj($where,$table,$link,$columns,$p->firstRow, $p->listRows);
    	// var_dump($user);
    	//获取crc名称及所属公司
    	$ctable= array('crc_user','web_user','cro_company');
    	$clink =array('crc_user.uid=web_user.uid','crc_user.company_id=cro_company.id');
    	$crc_columns = 'crc_user.uid,web_user.uname,cro_company.crname';
    	$crc_all = $this->instmodel->join_tj($crcwhere='',$ctable,$clink,$crc_columns);
    	foreach ($crc_all as $key => $value) {
    		$crcall[$value['uid']][] = $value['uname'];
    		$crcall[$value['uid']][] = $value['crname'];
    	}
    	$data['crcall'] = $crcall;
    	$data['user'] = $user;


    	if($excel==1){

    		//导出
    		$title = array('用户ID','患者姓名','性别','出生年月','省','市','诊断','项目','项目阶段','机构','科室','主管CRC','CRC所属公司','关注的资讯');
    		$this->db->order_by('patient.id',$orderby);

    		$columns = 'patient.user_id,web_user.uname,patient.sex,patient.birth,patient.province,patient.city,patient.diagnosis,patient.itemid,items.progress_id,patient.inst_id,patient.dept,patient.crc';
    		$excel_user = $this->instmodel->join_tj($where,$table,$link,$columns);
    		// echo $this->db->last_query();
    		$count = count($user);
    		
    		for($i=0;$i<$count;$i++){
    			$gzzx ='';
    			$excel_user[$i]['sex'] = $user[$i]['sex']==1?'男':'女';
    			$excel_userexcel_user[$i]['birth'] = card_to_birth($user[$i]['birth']);
    			$excel_user[$i]['province'] = $sheng[$user[$i]['province']];
    			$excel_user[$i]['city'] = $chengshi[$user[$i]['city']];
    			$excel_user[$i]['itemid'] = $xiangmu[$user[$i]['itemid']];
    			$excel_user[$i]['progress_id'] = $jianduan[$user[$i]['progress_id']];
    			$excel_user[$i]['inst_id'] = $jigou[$user[$i]['inst_id']];
    			$excel_user[$i]['dept'] = $dept[$user[$i]['dept']];
    			$excel_user[$i]['crc'] = $crcall[$user[$i]['crc']]['0'];
    			$excel_user[$i]['crcgs'] = $crcall[$user[$i]['crc']]['1'];
    			$zxarr = $this->instmodel->get_all($zx=array('uid'=>$excel_user[$i]['user_id']),$table='f_information');
    			foreach ($zxarr as $key => $value) {
    				$gzzx.=$value['infoname']."\r\n"; 
    			}
    			$excel_user[$i]['zx'] = $gzzx;
    			// var_dump($zxarr);

    		}
    		$export_list = $excel_user;
    		$filename =date('Y-m-d',time()).'-患者统计表';
			$this->export_excel_help($title,$export_list,$filename);
			exit;
    	}
    	$this->load->view('admin/statistic/pat_statistic',$data);	
    }

}
