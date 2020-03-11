<?php
class Item_manage extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('funcmodel');
		$this->load->model('itemmodel');
		$this->load->model('adminlogmodel');
		

    }

    /**
     * 项目列表
     * @return [type] [description]
     */
    public function item_list()
    {
		$this->checkauth('item_list');
        $data['cdn'] = $this->cdn;       
        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
        $search     = trim($this->input->get_post('search'));
		$sponsor_company     = intval($this->input->get_post('sponsor_company'));
		$progress_id     = intval($this->input->get_post('progress_id'));
		$inis_num     = intval($this->input->get_post('inis_num'));
        $leader_dept     = intval($this->input->get_post('leader_dept'));
		$drug_id     = intval($this->input->get_post('drug_id'));
		$orderby     = trim($this->input->get_post('orderby'));
		$status     = trim($this->input->get_post('status'));
		$excle     = intval($this->input->get_post('excle'));
        if (isset($search) && $search) {
            $where['search'] = $search;
            $page_where      = 'search=' . $search;
			$data['search']   = $search;
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

		if (isset($inis_num) && $inis_num) {
            $where['inis_num'] = $inis_num;
            $page_where      = 'inis_num=' . $inis_num;
			$data['inis_num']   = $inis_num;
        }
		if (isset($status) && $status) {
            $where['status'] = $status;
            $page_where      = 'status=' . $status;
			$data['status']   = $status;
        }

		if (isset($leader_dept) && $leader_dept) {
            $where['leader_dept'] = $leader_dept;
            $page_where      = 'leader_dept=' . $leader_dept;
			$data['leader_dept']   = $leader_dept;
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
				for($i=1;$i<$count;$i++){

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
				$filename =date('Y-m-d',time()).'项目列表';
				$this->export_excel_help($title,$export_list,$filename);
				exit;
			}
		

        $this->load->view('admin/item/item_list', $data);
    }

	 /**
     * 项目审核列表
     * @return [type] [description]
     */
    public function item_check()
    {
		$this->checkauth('item_check');
        $data['cdn'] = $this->cdn;       
        $this->load->helper('Page');
        $where      = array();
		$where['status']=3;
        $page_where = '';
        $search     = trim($this->input->get_post('search'));
		$sponsor_company     = intval($this->input->get_post('sponsor_company'));
		$progress_id     = intval($this->input->get_post('progress_id'));
		$inis_num     = intval($this->input->get_post('inis_num'));
        $leader_dept     = intval($this->input->get_post('leader_dept'));
		$drug_id     = intval($this->input->get_post('drug_id'));
		$orderby     = trim($this->input->get_post('orderby'));
		$excle     = intval($this->input->get_post('excle'));
        if (isset($search) && $search) {
            $where['search'] = $search;
            $page_where      = 'search=' . $search;
			$data['search']   = $search;
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

		if (isset($inis_num) && $inis_num) {
            $where['inis_num'] = $inis_num;
            $page_where      = 'inis_num=' . $inis_num;
			$data['inis_num']   = $inis_num;
        }
		

		if (isset($leader_dept) && $leader_dept) {
            $where['leader_dept'] = $leader_dept;
            $page_where      = 'leader_dept=' . $leader_dept;
			$data['leader_dept']   = $leader_dept;
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
		$this->load->model('itemmodel');
        $count            = $this->itemmodel->count($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码		
        $ls = $this->itemmodel->get_all($where, $p->firstRow, $p->listRows,$orderby);
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
				for($i=1;$i<$count;$i++){

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
				$filename =date('Y-m-d',time()).'项目待审核列表';
				$this->export_excel_help($title,$export_list,$filename);
				exit;
			}

        $this->load->view('admin/item/item_check', $data);
    }

	 /**
   *批量审核
   **/
	function item_check_ok(){
		  $this->checkauth('item_check');
          $md =$this->input->post('tempString');
		  $ids =explode(',',$md);
		 
		  $this->itemmodel->edit_wherein(array('status'=>1),$ids);
			 
		  $log=array('userid'=>$this->session->userdata('userid'),'type'=>'item_check','result'=>'项目审核','record_id'=>0,'add_time'=>time(),'content'=> json_encode($ids),'title'=>'' ,'urls'=>'');
		  $logid=$this->adminlogmodel->add($log);
		 
		  go('/index.php/admin/item_manage/item_check/', '操作成功', GO_SUCCESS);

	}

	 /**
   *批量关闭
   **/
	function item_check_close(){
		  $this->checkauth('item_list');
          $md =$this->input->post('tempString');
		  $ids =explode(',',$md);		 
		  $this->itemmodel->edit_wherein(array('status'=>2),$ids);	 
		  $log=array('userid'=>$this->session->userdata('userid'),'type'=>'item_list','result'=>'项目关闭','record_id'=>0,'add_time'=>time(),'content'=> json_encode($ids),'title'=>'' ,'urls'=>'');
		  $logid=$this->adminlogmodel->add($log);		 
		  go('/index.php/admin/item_manage/item_list/', '操作成功', GO_SUCCESS);

	}





	/**
     * 添加项目
     * @return [type] [description]
     */
    public function add_item()
    {
		$this->checkauth('add_item');
        $data['cdn'] = $this->cdn; 
		$data['sponsor']=$this->get_all_list('sponsor_company',array('status'=>1),'sname');
		$data['cro']=$this->get_all_list('cro_company',array('status'=>1),'crname');
		$data['smo']=$this->get_all_list('crc_company',array('status'=>1),'cname');
		$data['inis']=$this->get_all_list('inst',array('status'=>1),'shortname');
		$data['dept']=$this->get_all_list('dept',array('status'=>1),'name');
		$data['test']=$this->get_all_list('test_type',array('status'=>1),'name');
		$data['field']=$this->get_all_list('field',array('status'=>1),'name');
		$data['drugtype']=$this->get_all_list('drug_type',array('status'=>1),'name');
		$data['classify']=$this->get_all_list('class_type',array('status'=>1,'drug_id'=>1),'name');
		$data['progress']=$this->get_all_list('item_plan',array('status'=>1),'name');
		$data['drug']=$this->drug;
		//$data['methods']=$this->methods;

        $this->load->view('admin/item/add_item', $data);
    }

	/**
     * ajax 科室 机构联动
     * @return [type] [description]
     */
	function get_dept(){
		$leader_inis=$this->input->get_post('leader_inis');
		$list=$this->get_all_list('dept',array('status'=>1,'inst_id'=>$leader_inis),'name');
		echo json_encode($list);
	}

	/**
     * ajax 试验类型 试验分类联动
     * @return [type] [description]
     */
	function get_drug(){
		$test_id=$this->input->get_post('test_id');
		$list=$this->get_all_list('drug_type',array('status'=>1,'test_id'=>$test_id),'name');
		echo json_encode($list);
	}

	/**
     * ajax 药品种类 药品分类联动
     * @return [type] [description]
     */
	function get_classi(){
		$drug_id=$this->input->get_post('drug_id');
		$list=$this->get_all_list('class_type',array('status'=>1,'drug_id'=>$drug_id),'name');
		echo json_encode($list);
	}


	/** 
	*添加申办方
	*wangrongjie	
	**/

	function add_sponsor(){		
	    $sponsor = $this->input->get_post("sponsor");
		$this->load->model('funcmodel');
		$info=$this->funcmodel->get_one('sponsor_company',array('snames'=>$sponsor));
		if($info['id']){
			$id=0;
		}else{
			$id=$this->funcmodel->add('sponsor_company',array('sname'=>$sponsor,'add_time'=>time()));
		}
		echo json_encode($id);					
	}
	/** 
	*添加cro
	*wangrongjie	
	**/

	function add_cro(){		
	    $cro = $this->input->get_post("cro");
		$this->load->model('funcmodel');
		$info=$this->funcmodel->get_one('cro_company',array('crnames'=>$cro));
		if($info['id']){
			$id=0;
		}else{
			$id=$this->funcmodel->add('cro_company',array('crname'=>$cro,'add_time'=>time()));
		}
		echo json_encode($id);		
				
	}
	/** 
	*添加smo
	*wangrongjie	
	**/

	function add_smo(){		
	    $smo = $this->input->get_post("smo");
		$this->load->model('funcmodel');
		$info=$this->funcmodel->get_one('crc_company',array('cnames'=>$smo));
		if($info['id']){
			$id=0;
		}else{
			$id=$this->funcmodel->add('crc_company',array('cname'=>$smo,'add_time'=>time()));
		}
		echo json_encode($id);		
				
	}

	/** 
	*添加领域
	*wangrongjie	
	**/

	function add_field(){		
	    $field = $this->input->get_post("field");
		$this->load->model('funcmodel');
		$info=$this->funcmodel->get_one('field',array('name'=>$field));
		if($info['id']){
			$id=0;
		}else{
			$id=$this->funcmodel->add('field',array('name'=>$field,'add_time'=>time()));
		}
		echo json_encode($id);		
				
	}


	/** 
	*中心数量和所选select数量判断
	*wangrongjie	
	**/

	function inis_check(){		
	    $inis_num = $this->input->get_post("inis_num");
		$inis_id = $this->input->get_post("inis_id");
		if($inis_num==count($inis_id)){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
        echo json_encode($ret);				
	}

	/** 
	*中心数量和所选select数量判断
	*wangrongjie	
	**/

	function inisn_check(){		
	    $inis_num = $this->input->get_post("inis_num");	
		$inis_id = $this->input->get_post("inis_id");
		if($inis_id==null||$inis_id=='null'){
			$ret = array('valid' => true);
			echo json_encode($ret);	exit;
		}
		$array=explode(',',$inis_id);
		if($inis_num==count($array)){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
        echo json_encode($ret);				
	}



    /**
     * 添加-表单处理
     * @return [type] [description]
     */
    public function add_item_do()
    {
        $this->checkauth('add_item');
        $data['name']   = $this->input->post('name');
		$data['shortname']   = $this->input->post('shortname');
		$data['is_linkstart']   = $this->input->post('is_linkstart');
		$item_number     = trim($this->input->post('item_number'));
		$data['sponsor_company']    = $this->input->post('sponsor_company');
		if($data['is_linkstart']){
			$data['item_number']=$item_number;
			$data['exte_number']='';
		}else{
			$data['item_number']='';
			$len=32-17-strlen($data['sponsor_company']);
			$data['exte_number']='WS-'.$data['sponsor_company'].date('YmdHis').$this->great_rand('string',$len);
		}
		$data['cro_company']    = serialize($this->input->post('cro_company'));
		$data['smo_company']    = serialize($this->input->post('smo_company'));
		$data['inis_num']    = $this->input->post('inis_num');
		$data['field_id']    = intval($this->input->post('field_id'));
		$data['inis_id']    = serialize($this->input->post('inis_id'));
		
		if($data['inis_num']==1){
			$data['leader_inis']    = $this->input->post('inis_id')[0];
		
		}else{
			$data['leader_inis']    = $this->input->post('leader_inis');
		}
		$data['test_id']    = $this->input->post('test_id');
		$data['drug_id']    = $this->input->post('drug_id');
		$data['leader_dept']    = $this->input->post('leader_dept');
		//$data['methods_id']    = $this->input->post('methods_id');
		$data['dtype_id']    = $this->input->post('dtype_id');
		$data['classify_id']    = $this->input->post('classify_id');
		$data['indications']    = $this->input->post('indications');
		$data['plan_num']    = $this->input->post('plan_num');
		$data['real_num']    = $this->input->post('real_num');
		$data['add_time']    = time();
		$data['start_time']    =$this->input->post('start_time');
		$id=$this->itemmodel->add($data);
        if (!$id) {
            go('/index.php/admin/item_manage/add_item', '添加失败，请重新添加', GO_ERROR);
        } else {
			
			foreach($this->input->post('inis_id') as $val){
				$c=$this->funcmodel->add('items_inits',array('items_id'=>$id,'inis_id'=>$val,'add_time'=>time()));
			}

			foreach($this->input->post('smo_company') as $val){
				$c=$this->funcmodel->add('item_smo',array('items_id'=>$id,'smo_id'=>$val,'add_time'=>time()));
			}

			foreach($this->input->post('cro_company') as $val){
				$c=$this->funcmodel->add('item_cro',array('items_id'=>$id,'cro_id'=>$val,'add_time'=>time()));
			}



            go('/index.php/admin/item_manage/item_list', '添加成功', GO_SUCCESS);
        }
    }

	 /**
     * 编辑项目-表单
     * @return [type] [description]
     */
    public function item_edit()
    {
        $this->checkauth('item_list');
        $data['cdn'] = $this->cdn;
        $this->load->model('itemmodel');
        $id  = $this->input->get_post('id');
		$view  = $this->input->get_post('view');
        $info = $this->itemmodel->get_one($id);

        if (!count($info)) {
            go('/index.php/admin/item_manage/item_list/', '未获取到信息,请刷新来源页面');
        }
        $data['info'] = $info;
		$data['sponsor']=$this->get_all_list('sponsor_company',array('status'=>1),'sname');		
		$data['cro']=$this->get_all_list('cro_company',array('status'=>1),'crname');
		$data['smo']=$this->get_all_list('crc_company',array('status'=>1),'cname');
		$data['inis']=$this->get_all_list('inst',array('status'=>1),'shortname');
		$data['dept']=$this->get_all_list('dept',array('status'=>1),'name');
		$data['test']=$this->get_all_list('test_type',array('status'=>1),'name');
		$data['field']=$this->get_all_list('field',array('status'=>1),'name');
		$data['drugtype']=$this->get_all_list('drug_type',array('status'=>1),'name');
		$data['classify']=$this->get_all_list('class_type',array('status'=>1,'drug_id'=>1),'name');
		$data['progress']=$this->get_all_list('item_plan',array('status'=>1),'name');
		$data['drug']=$this->drug;
		//$data['methods']=$this->methods;
		$data['view']=$view;
		
        $this->load->view('admin/item/item_edit', $data);
    }

    /**
     * 编辑项目-表单处理
     * @return [type] [description]
     */
    public function item_edit_do()
    {

        $this->checkauth('item_list');
        $data['name']   = $this->input->post('name');
		$view  = $this->input->post('view');
		$id   = $this->input->post('id');
		
		$data['shortname']   = $this->input->post('shortname');
		$data['is_linkstart']   = $this->input->post('is_linkstart');
		$item_number     = trim($this->input->post('item_number'));
		$data['sponsor_company']    = $this->input->post('sponsor_company');
		if($data['is_linkstart']){
			$data['item_number']=$item_number;
			$data['exte_number']='';
		}else{
			$data['item_number']='';
			$len=32-17-strlen($data['sponsor_company']);
			$data['exte_number']='WS-'.$data['sponsor_company'].date('YmdHis').$this->great_rand('string',$len);
		}
		$data['cro_company']    = serialize($this->input->post('cro_company'));
		$data['smo_company']    = serialize($this->input->post('smo_company'));
		$data['inis_num']    = $this->input->post('inis_num');
		$data['field_id']    = intval($this->input->post('field_id'));
		$data['inis_id']    = serialize($this->input->post('inis_id'));
		
		if($data['inis_num']==1){
			$data['leader_inis']    = $this->input->post('inis_id')[0];
		
		}else{
			$data['leader_inis']    = $this->input->post('leader_inis');
		}
		$data['test_id']    = $this->input->post('test_id');
		$data['drug_id']    = $this->input->post('drug_id');
		$data['leader_dept']    = $this->input->post('leader_dept');
		//$data['methods_id']    = $this->input->post('methods_id');
		$data['dtype_id']    = $this->input->post('dtype_id');
		$data['classify_id']    = $this->input->post('classify_id');
		$data['indications']    = $this->input->post('indications');
		$data['plan_num']    = $this->input->post('plan_num');
		$data['real_num']    = $this->input->post('real_num');
		$data['start_time']    =$this->input->post('start_time');


		 if (!$this->itemmodel->edit($data,$id)) {
            go('/index.php/admin/item_manage/item_edit?id='.$id.'&view='.$view, '修改失败', GO_ERROR);
        } else {

             $list=$this->get_all_list('items_inits',array('items_id'=>$id,'status'=>1),'inis_id');

			  $list1=$this->get_all_list('item_cro',array('items_id'=>$id,'status'=>1),'cro_id');


			   $list2=$this->get_all_list('item_smo',array('items_id'=>$id,'status'=>1),'smo_id');


			 $zx=$this->input->post('inis_id');
			 $zx1=$this->input->post('cro_company');
			 $zx2=$this->input->post('smo_company');
			 foreach($list as $val){
				if(in_array($val,$zx)){
				
				}else{
					$cs=$this->funcmodel->edit('items_inits',array('status'=>2,'out_time'=>time()),array('items_id'=>$id));
				}	
			}
			foreach($zx as $val){
				if(in_array($val,$list)){
				
				}else{
					$c=$this->funcmodel->add('items_inits',array('items_id'=>$id,'inis_id'=>$val,'add_time'=>time()));
				}				
			}

			 foreach($list1 as $val1){
				if(in_array($val1,$zx1)){
				
				}else{
					$cs1=$this->funcmodel->edit('item_cro',array('status'=>2,'out_time'=>time()),array('items_id'=>$id));
				}	
			}
			foreach($zx1 as $val1){
				if(in_array($val1,$list1)){
				
				}else{
					$c1=$this->funcmodel->add('item_cro',array('items_id'=>$id,'inis_id'=>$val1,'add_time'=>time()));
				}				
			}


			 foreach($list2 as $val2){
				if(in_array($val2,$zx2)){
				
				}else{
					$cs2=$this->funcmodel->edit('item_smo',array('status'=>2,'out_time'=>time()),array('items_id'=>$id));
				}	
			}
			foreach($zx2 as $val2){
				if(in_array($val2,$list2)){
				
				}else{
					$c2=$this->funcmodel->add('item_smo',array('items_id'=>$id,'inis_id'=>$val2,'add_time'=>time()));
				}				
			}
           go('/index.php/admin/item_manage/item_'.$view.'/', '修改成功！', 1);
        }
     
    }


		 /**
     * 查看项目-表单
     * @return [type] [description]
     */
    public function item_info()
    {
        $this->checkauth('item_list');
        $data['cdn'] = $this->cdn;
        $this->load->model('itemmodel');
        $id  = $this->input->get_post('id');
        $info = $this->itemmodel->get_one($id);
        if (!count($info)) {
            go('/index.php/admin/item_manage/item_list/', '未获取到信息,请刷新来源页面');
        }
        $data['info'] = $info;
		$deptid=$info['leader_dept'];
		$data['pi']=$this->get_all_lists('dept_member',array('dept_id'=>$deptid,'identity'=>'pi'),array('name','phone','email'));
		$data['sub']=$this->get_all_lists('dept_member',array('dept_id'=>$deptid,'identity'=>'sub-i'),array('name','phone','email'));

		$data['sponsor']=$this->get_all_lists('sponsor_company',array(),array('sname','pm','pm_phone'));
		
		$data['cro']=$this->get_all_lists('cro_company',array(),array('crname','pm','pm_phone'));
		$data['smo']=$this->get_all_list('crc_company',array(),array('cname','pm','pm_phone'));
		$data['inis']=$this->get_all_list('inst',array(),'shortname');
		$data['dept']=$this->get_all_list('dept',array(),'name');
		$data['test']=$this->get_all_list('test_type',array(),'name');
		$data['field']=$this->get_all_list('field',array(),'name');
		$data['drugtype']=$this->get_all_list('drug_type',array(),'name');
		$data['classify']=$this->get_all_list('class_type',array('drug_id'=>1),'name');
		$data['progress']=$this->get_all_list('item_plan',array(),'name');
		$data['drug']=$this->drug;
		//$data['methods']=$this->methods;
        $this->load->view('admin/item/item_info', $data);
    }

    //查看项目机构列表 
	function get_ck_list(){
		$this->checkauth('item_info'); 
	
		$id  = trim($this->input->get_post('id'));	
		$data['pid']=$id;
		$view = trim($this->input->get_post('view'));
	    $excle = trim($this->input->get_post('excle'));
		$info = $this->itemmodel->get_one($id);
		$qtjg=$info['leader_inis'];
		$progress=$this->get_all_list('item_plan',array(),'name');
		$province=$this->get_all_list('provinces',array(),'name');
		$city=$this->get_all_list('city',array(),'name');
		$crc=$this->get_all_lists('crc_company',array(),array('cname','pm','pm_phone'));
		$cro=$this->get_all_lists('cro_company',array(),array('cra_name','cra_phone'));
		$inst=$this->get_all_lists('inst',array(),array('instname','province','city'));
		$jg=unserialize($info['inis_id']);//机构id数组
		$jg_list=array();
		$this->load->model('crcmodel');
		foreach($jg as $val){
			$is_qt='';
			if($qtjg==$val){$is_qt='是';}else{$is_qt='否';}
			$jg_list[$val]['is_qt']=$is_qt;
			$jg_list[$val]['itemname']=$info['name'];
			$jg_list[$val]['item_number']=$info['item_number'];
			$jg_list[$val]['exte_number']=$info['exte_number'];
			$jg_list[$val]['progress']=$progress[$info['progress_id']];
			$jg_list[$val]['plan_num']=$info['plan_num'];
			$jg_list[$val]['real_num']=$info['real_num'];
			$jg_list[$val]['instname']=$inst[$val]['instname'];
			$jg_list[$val]['province']=$province[$inst[$val]['province']];
			$jg_list[$val]['city']=$city[$inst[$val]['city']];
			$uids=array();
			$uid=0;
			$user=array();
			$cros=array();
			$deptid=array();
			$uids=$this->funcmodel->get_one('crc_items',array('type'=>1,'status'=>1,'inis_id'=>$val,'items_id'=>$id));
			$cros=$this->funcmodel->get_one('item_cro_inis',array('status'=>1,'inis_id'=>$val,'items_id'=>$id));
			$uid=$uids['uid'];
			if($uid){$user=$this->crcmodel->get_one($uid);}
			$jg_list[$val]['crcname']=$user['uname'];
			$jg_list[$val]['crc_company']=$crc[$user['company_id']]['cname'];
			$jg_list[$val]['crc_pm']=$crc[$user['company_id']]['pm'];
			$jg_list[$val]['crc_pm_phone']=$crc[$user['company_id']]['pm_phone'];
			$jg_list[$val]['cra_name']=$cro[$cros['cro_id']]['cra_name'];
			$jg_list[$val]['cra_phone']=$cro[$cros['cro_id']]['cra_phone'];
			$jg_list[$val]['dept']=$this->get_all_list('dept',array('inst_id'=>$val,'status'=>1),'name');

			$deptid=$this->get_all_list('dept',array('inst_id'=>$val,'status'=>1),'id');
            $dept=array();
			foreach($deptid as $v){
				$jg_list[$val][$v]['pi']=$this->get_all_list('dept_member',array('dept_id'=>$v,'identity'=>'pi'),'name');
				$jg_list[$val][$v]['pi-phone']=$this->get_all_list('dept_member',array('dept_id'=>$v,'identity'=>'pi'),'phone');
				$jg_list[$val][$v]['pi-email']=$this->get_all_list('dept_member',array('dept_id'=>$v,'identity'=>'pi'),'email');
				$jg_list[$val][$v]['pi-position']=$this->get_all_list('dept_member',array('dept_id'=>$v,'identity'=>'pi'),'position');
				$jg_list[$val][$v]['sub']=$this->get_all_list('dept_member',array('dept_id'=>$v,'identity'=>'sub-i'),'name');
				$jg_list[$val][$v]['sub-phone']=$this->get_all_list('dept_member',array('dept_id'=>$v,'identity'=>'sub-i'),'phone');
				$jg_list[$val][$v]['sub-email']=$this->get_all_list('dept_member',array('dept_id'=>$v,'identity'=>'sub-i'),'email');
				$jg_list[$val][$v]['sub-position']=$this->get_all_list('dept_member',array('dept_id'=>$v,'identity'=>'sub-i'),'position');
			
			}

			
		}

			if($excle ==1){
				$excle_list=array_values($jg_list);
				$title=array('项目全称','项目编号','机构名称','省','市','是否牵头','科室名称','PI职务','PI姓名','PI电话','PI邮箱','SUB-I职务','SUB-I姓名','SUB-I电话','SUB-I邮箱','项目进度','计划入组人数','实际入组人数','CRC姓名','CRC所属公司','CRC所属公司PM姓名-I','CRC所属公司PM电话','CRA姓名','CRA电话');
				$export_list= array();
				$count = count($excle_list);
				for($i=1;$i<=$count;$i++){
					 $j=$i-1;
					$detp='';	
					foreach($excle_list[$j]['dept'] as $dv){
						$detp.=$dv."\r\n";
						$pi='';
						$pi_position='';
						$pi_phone='';
						$pi_email='';
						$sub='';
						$sub_position='';
						$sub_phone='';
						$sub_email='';

						foreach($excle_list[$j][$dv]['pi'] as $piv){
							$pi.=$piv."\r\n";
						}
						$pi.="_____________";
						foreach($jg_list[$j][$dv]['pi-position'] as $ppiv){
							$pi_position.=$ppiv."\r\n";
						}
						$pi_position.="_____________";
						foreach($excle_list[$j][$dv]['pi-phone'] as $ppoiv){
							$pi_phone.=$ppoiv."\r\n";
						}
						$pi_phone.="_____________";
						foreach($excle_list[$j][$dv]['pi-email'] as $peiv){
							$pi_email.=$peiv."\r\n";
						}
						$pi_email.="_____________";
						foreach($excle_list[$j][$dv]['sub'] as $siv){
							$sub.=$siv."\r\n";
						}
						$sub.="_____________";
						foreach($excle_list[$j][$dv]['sub-position'] as $spiv){
							$sub_position.=$spiv."\r\n";
						}
						$sub_position.="_____________";
						foreach($excle_list[$j][$dv]['sub-phone'] as $sppiv){
							$sub_phone.=$sppiv."\r\n";
						}
						$sub_phone.="_____________";
						foreach($excle_list[$j][$dv]['sub-email'] as $seiv){
							$sub_email.=$seiv."\r\n";
						}
						$sub_email.="_____________";
					}
                  
                   
					$export_list[$i][] = $excle_list[$j]['itemname'];	
					$export_list[$i][] = $excle_list[$j]['item_number'].$jg_list[$j]['exte_number'];	
					$export_list[$i][] = $excle_list[$j]['instname'];	
					$export_list[$i][] = $excle_list[$j]['province'];	
					$export_list[$i][] = $excle_list[$j]['city'];	
					$export_list[$i][] = $excle_list[$j]['is_qt'];	
					$export_list[$i][] = $detp;	
					$export_list[$i][] = $pi;	
					$export_list[$i][] = $pi_position;	
					$export_list[$i][] = $pi_phone;	
					$export_list[$i][] = $pi_email;	
					$export_list[$i][] = $sub;	
					$export_list[$i][] = $sub_position;	
					$export_list[$i][] = $sub_phone;	
					$export_list[$i][] = $sub_email;
					$export_list[$i][] = $excle_list[$j]['progress'];
					$export_list[$i][] = $excle_list[$j]['plan_num'];
					$export_list[$i][] = $excle_list[$j]['real_num'];
					$export_list[$i][] = $excle_list[$j]['crcname'];
					$export_list[$i][] = $excle_list[$j]['crc_company'];
					$export_list[$i][] = $excle_list[$j]['crc_pm'];
					$export_list[$i][] = $excle_list[$j]['crc_pm_phone'];
					$export_list[$i][] = $excle_list[$j]['cra_name'];
					$export_list[$i][] = $excle_list[$j]['cra_phone'];
				}

					$filename =date('Y-m-d',time()).$info['itemname'].'-项目合作中心表';
					$this->export_excel_help($title,$export_list,$filename);
					exit;

				
			}


		
		$data['list']=$jg_list;
		$data['cdn'] = $this->cdn;
		$this->load->view('admin/item/item_'.$view, $data);
	}


	  /**
     * ajax 验证 组别是否存在
     * @return [type] [description]
     */
    public function item_name_check()
    {
        $this->load->model('funcmodel');
        $name = $this->input->post('name');
        $data    = array('name' => $name);

        // newstypemodel 验证 newstypemodel
        $res = $this->funcmodel->get_one('items',$data);
		if($res['id']){
			$ret = array('valid' => false);
		}else{
			$ret = array('valid' => true);
		
		}
        echo json_encode($ret);
    }

	 /**
     * ajax 验证 项目编号是否存在
     * @return [type] [description]
     */
    public function check_number()
    {
        $this->load->model('funcmodel');
        $item_number = $this->input->post('item_number');
        $data    = array('item_number' => $item_number);
        $res = $this->funcmodel->get_one('items',$data);
		if($res['id']){
			$ret = array('valid' => false);
		}else{
			$ret = array('valid' => true);
		
		}
        echo json_encode($ret);
    }


	  /**
     * ajax 验证 组名是否存在-修改
     * @return [type] [description]
     */
    public function item_names_check()
    {
        $this->load->model('funcmodel');
        $name = $this->input->post('name');
		$id = $this->input->post('id');
        $data    = array('name' => $name);    
        $res = $this->funcmodel->get_one('items',$data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
        
        echo json_encode($ret);
    }
    /**
	**CRA对项目下合作机构的管理
	**/
	function item_cra_list(){

		$this->checkauth('item_cra_list');
        $data['cdn'] = $this->cdn;       
        $this->load->helper('Page');
		 $where      = array();
        $page_where = '';
        $cranames     = trim($this->input->get_post('cranames'));
	
        if (isset($cranames) && $cranames) {
            $where['cranames'] = $cranames;
            $page_where      = 'cranames=' . $cranames;
        }
		$this->load->model('funcmodel');
        $count            = $this->funcmodel->count('cro_company',$where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['cranames']   = $cranames;
        $data['crolist'] = $this->funcmodel->get_all('cro_company',$where, $p->firstRow, $p->listRows);
		$iac=$this->get_inist_list();//该uid 所授权限的机构id数组
		$tac=$this->get_items_list();//该uid 所授权限的项目id数组
		$item=$this->get_all_list('items',array('status'=>1),'name');
		$inst=$this->get_all_list('inst',array('status'=>1),'instname');
		$inist=array();
		$items=array();
		foreach($inst as $key=>$val){
			if(in_array($key,$iac)){
				$inist[$key]=$val;
			}
		}
		foreach($item as $key1=>$val1){
			if(in_array($key1,$tac)){
				$items[$key1]=$val1;
			}
		}
		$data['items']=$items;
		$data['inist']=$inist;
        $this->load->view('admin/item/cro_lists', $data);


	
	}


	 /**
   *CRC 人员管理  某项目 机构 人员列表
   **/
   function cro_lists_check(){
	    $this->checkauth('item_cra_list');
        $data['cdn'] = $this->cdn;       
        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
        $items_id     = intval($this->input->get_post('items_id'));
		$inits_id     = intval($this->input->get_post('inits_id'));
		$id     = trim($this->input->get_post('id'));
		if($id){
			$ids=explode('_',$id);
			$items_id     = $ids[0];
		    $inits_id     = $ids[1];
		}

		$cranames     = trim($this->input->get_post('cranames'));
	
        if (isset($cranames) && $cranames) {
            $where['cranames'] = $cranames;
            $page_where      = 'cranames=' . $cranames;
        }

       

	
        $where=array('items_id'=>$items_id,'inits_id'=>$inits_id);
		$this->load->model('funcmodel');
        $count            = $this->funcmodel->count_gt($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['inits_id']   = $inits_id;
		$data['items_id']   = $items_id;
		$data['check']   = 1;
		$data['cranames']   = $cranames;
        $data['crclist'] = $this->funcmodel->get_all_gt($where, $p->firstRow, $p->listRows);
		$iac=$this->get_inist_list();//该uid 所授权限的机构id数组
		$tac=$this->get_items_list();//该uid 所授权限的项目id数组
		$item=$this->get_all_list('items',array('status'=>1),'name');
		$inst=$this->get_all_list('inst',array('status'=>1),'instname');
		$inist=array();
		$items=array();
		foreach($inst as $key=>$val){
			if(in_array($key,$iac)){
				$inist[$key]=$val;
			}
		}
		foreach($item as $key1=>$val1){
			if(in_array($key1,$tac)){
				$items[$key1]=$val1;
			}
		}
		$data['items']=$items;
		$data['inist']=$inist;
        $this->load->view('admin/item/cro_lists', $data);
   }


    /**
     * ajax 项目机构联动
     * @return [type] [description]
     */
	function get_iteminst(){
		$items_id=$this->input->get_post('items_id');
		$one=$this->funcmodel->get_one('items',array('id'=>$items_id));
		$list=unserialize($one['inis_id']);
		$lists=$this->get_all_list('inst',array('status'=>1),'instname');
		$idarr=array();
		foreach($list as $key=>$val){
			if(array_key_exists($val,$lists)){
				$idarr[$val]=$lists[$val];			
			}
		
		}
		echo json_encode($idarr);
	}


	/**
     * 加入某项目的某机构
     * @return [type] [description]
     */
	function cro_lists_enter(){
		$this->checkauth('item_cra_list');
		$items_id=$this->input->get_post('items_id');
		$inits_id=$this->input->get_post('inits_id');
		$id=$this->input->get_post('id');
		
           //一个项目 一个机构只有cro人员 
		   $where=array('inis_id'=>$inits_id,'items_id'=>$items_id,'status'=>1);
		   $info=$this->funcmodel->get_all('crc_items',$where);
		   if(count($info)){
			   if(count($info)>1){
				   go('/index.php/admin/item_manage/item_cra_list/', '操作失败');
				   exit;
			   
			   }else{
				   if($info[0]['cro_id']!=$id){
					   go('/index.php/admin/item_manage/item_cro_inis/', '操作失败');
				        exit;
				   }			   
			   }
		   }
		   $add=array('inis_id'=>$inits_id,'items_id'=>$items_id,'cro_id'=>$id,'add_time'=>time());
		   $rs=$this->funcmodel->add('item_cro_inis',$add);
		   if($rs){
			    go('/index.php/admin/item_manage/item_cro_inis/', '操作成功', GO_SUCCESS);
		   }else{
			    go('/index.php/admin/item_manage/item_cro_inis/', '操作失败');
		   }
		 


		  
	}


	/**
     * 退出某项目的某机构
     * @return [type] [description]
     */
	function cro_lists_out(){
		$this->checkauth('item_cra_list');
		$items_id=$this->input->get_post('items_id');
		$inits_id=$this->input->get_post('inits_id');
		$check=$this->input->get_post('check');
        
		   $id=$this->input->get_post('id');
		    $where=array('inis_id'=>$inits_id,'items_id'=>$items_id,'cro_id'=>$id,'status'=>1);
			 $edit=array('status'=>0,'out_time'=>time());
			 $rs=$this->funcmodel->edit('item_cro_inis',$edit,$where);

		  if($check){
			  $url='/index.php/admin/item_manage/cro_lists_check?id='.$items_id.'_'.$inits_id;	
		  }else{
			  $url='/index.php/admin/item_manage/item_cro_inis/';		
		  }

		  if($rs){
			  go($url, '操作成功', GO_SUCCESS);		  
		  }else{
			  go($url, '操作失败');
		  }

	}










}
