<?php
class Item_program extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('funcmodel');
		$this->load->model('itemmodel');
		$this->load->model('adminlogmodel');
		

    }

    /**
     * 添加方案
     * @return [type] [description]
     */
    public function add_program()
    {
		$this->checkauth('add_program');
        $data['cdn'] = $this->cdn;       
        $tac=$this->get_items_list();//该uid 所授权限的项目id数组	
		$list=$this->get_all_list('items',array('status'=>1),'name');
		$lis=array();
		foreach($list as $k=>$v){
			if(in_array($k,$tac)){
				$lis[$k]=$v;
			}
		
		}

		$data['list']=$lis;
		$data['drug']=$this->drug;
		$data['methods']=$this->methods;
		$data['test']=$this->get_all_list('test_type',array('status'=>1),'name');
		$data['use_type_list']=$this->get_all_list('items_pro_use_type',array('test_id'=>1),'utname');
		$data['use_type_lists']=$this->get_all_list('items_pro_use_type',array('test_id'=>2),'utname');
	    $data['tglist1']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>1,'part'=>1),'jcname');
		$data['tglist2']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>1,'part'=>2),'jcname');
		$data['tglist3']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>1,'part'=>3),'jcname');
		$data['tglist4']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>1,'part'=>4),'jcname');

		$data['smlist']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>2),'jcname');
		$data['cglist']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>3),'jcname');
		$data['xshlist']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>4),'jcname');
		$data['cslist']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>5),'jcname');
		$data['yxlist1']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>6,'part'=>1),'jcname');
		$data['yxlist2']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>6,'part'=>2),'jcname');
		$data['yxlist3']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>6,'part'=>3),'jcname');
		$data['yxlist4']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>6,'part'=>4),'jcname');

	    $data['xdlist']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>7),'jcname');
		$data['jylist']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>8),'jcname');
		$data['qtlist']=$this->get_all_list('items_inspect',array('status'=>1,'type'=>9),'jcname');



		$data['use_unit_list']=$this->get_all_list('items_pro_use_unit',array('test_id'=>1),'uuname');
		$data['use_type_lists']=$this->get_all_list('items_pro_use_unit',array('test_id'=>2),'utname');

        $this->load->view('admin/item/add_program', $data);
    }


	/**
     * ajax 根据项目id 查询项目信息
     * @return [json] json格式数据
     */
	function get_item_info(){
		$items_id=$this->input->get_post('items_id');
		$info=$this->funcmodel->get_one('items',array('status'=>1,'id'=>$items_id));
		$test=$this->get_all_list('test_type',array('status'=>1),'name');
		$drug=$this->drug;
		$info['test']=$test[$info['test_id']];
		$info['drug']=$drug[$info['drug_id']];
		$base=$this->funcmodel->get_one('items_pro_base',array('status'=>1,'id'=>$items_id));
		$pid=$base['id'];
		$meddle=$this->funcmodel->get_one('items_pro_meddle',array('pro_id'=>$pid));
		//$surgery =$this->funcmodel->get_one('items_pro_surgery',array('pro_id'=>$pid));
		//$follow =$this->funcmodel->get_one('items_pro_follow',array('pro_id'=>$pid));
		$info['base']=$base;
		$info['meddle']=$meddle;
		//$info['surgery']=$surgery;
		//$info['follow']=$follow;
		echo json_encode($info);
	}

	/**
     * ajax 根据项目id 查询方案信息
     * @return [json] json格式数据
     */
	function get_pro_info(){
		$items_id=$this->input->get_post('items_id');
		$base=$this->funcmodel->get_one('items_pro_base',array('status'=>1,'id'=>$items_id));
		$pid=$base['id'];
		$meddle=$this->funcmodel->get_one('items_pro_meddle',array('pro_id'=>$pid));
		$surgery =$this->funcmodel->get_one('items_pro_surgery',array('pro_id'=>$pid));
		$follow =$this->funcmodel->get_one('items_pro_follow',array('pro_id'=>$pid));
		$info['base']=$base;
		$info['meddle']=$meddle;
		$info['surgery']=$surgery;
		$info['follow']=$follow;
		echo json_encode($info);
	}



	/**
     * ajax 添加方案基础信息
     * @return [type] [description]
     */
	function add_base(){
		$data['items_id']=$this->input->get_post('itemsid');
		$data['name']=$this->input->get_post('name');
		$data['blind']=$this->input->get_post('blind');			
		$data['cycle']=$this->input->get_post('cycle');
		$data['cross']=$this->input->get_post('cross');
		$data['order']=$this->input->get_post('order');
		$data['meddle_type']=$this->input->get_post('meddle_type');
		if($data['meddle_type']==2){
			$data['meddle_id']=$this->input->get_post('meddle_id');		
		}
		if($data['cycle']>1){
			$data['washout_time']=$this->input->get_post('washout_time');
			$data['washout_type']=$this->input->get_post('washout_type');
	    }
		$data['use_methods']=$this->input->get_post('use_methods');
		$data['inclusion_criteria']=$this->input->get_post('inclusion_criteria');
		$data['exclusion_criteria']=$this->input->get_post('exclusion_criteria');
		$data['drug_combination']=$this->input->get_post('drug_combination');
		$data['drug_taboos']=$this->input->get_post('drug_taboos');
		$data['adverse_event']=$this->input->get_post('adverse_event');
		$id=$this->funcmodel->add('items_pro_base',$data);
		echo $id;
	}


	/**
     * ajax 添加方案干预信息-试验试剂 参比试剂 安慰剂 
     * @return [type] [description]
     */
	function add_reagent(){
		$items_id=$this->input->get_post('items_id');
		$data['pro_id']=$this->input->get_post('pro_id');
	    $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$data['pro_id']));
		if($base['id']!=$data['pro_id']){
			$res=0;
			echo json_encode($res);
			exit;
		}
		$data['tiname']=$this->input->get_post('tiname');	
		$data['use_type']=$this->input->get_post('use_type');
		$data['use_unit']=$this->input->get_post('use_unit');
		$data['type_id']=$this->input->get_post('type_id');
		$res=$this->funcmodel->add('items_pro_reagent',$data);
		if(!$res){
			$res=0;
			echo json_encode($res);
			exit;
		
		}
        $groupcode=$this->input->get_post('groupcode');
		$tigroupname=$this->input->get_post('tigroupname');

		 
		 
		if($groupcode){
				$gid=$this->funcmodel->add('items_pro_reagent_group',array('groupcode'=>$groupcode,'reagent_id'=>$res,'pro_id'=>$data['pro_id'],'type_id'=>$data['type_id']));				
		}	
		if($tigroupname){
				$gid=$this->funcmodel->add('items_pro_reagent_group',array('groupname'=>$tigroupname,'reagent_id'=>$res,'pro_id'=>$data['pro_id'],'type_id'=>$data['type_id']));				
		}	
		echo json_encode($res);
	}


	/**
     * ajax 添加方案干预信息-联合用药 
     * @return [type] [description]
     */
	function add_drugcom(){
		$items_id=$this->input->get_post('items_id');
		$pro_id=$this->input->get_post('pro_id');
	    $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		}
		$tinames=$this->input->get_post('lhtinames');	
		$use_types=$this->input->get_post('lhuse_types');
		$use_units=$this->input->get_post('lhuse_units');
		$groupnames=$this->input->get_post('lhgroupname');
		$groupcodes=$this->input->get_post('lhgroupcode');
		$type_id=3;
        $this->funcmodel->edit('items_pro_reagent',array('status'=>0),array('type_id'=>3,'pro_id'=>$pro_id));
		$this->funcmodel->edit('items_pro_reagent_group',array('status'=>0),array('type_id'=>3,'pro_id'=>$pro_id));
		foreach($tinames as $key=>$v){
			$data[$key]['tiname']=$v;
			$data[$key]['use_type']=$use_types[$key];
			$data[$key]['use_unit']=$use_units[$key];
			$data[$key]['type_id']=3; 
			$data[$key]['pro_id']=$pro_id;
			$res[$key]=$this->funcmodel->add('items_pro_reagent',$data[$key]);
			$gid[$key]=$this->funcmodel->add('items_pro_reagent_group',array('groupname'=>$groupnames[$key],'groupcode'=>$groupcodes[$key],'reagent_id'=>$res[$key],'pro_id'=>$pro_id,'type_id'=>3));
		}		
		echo json_encode(1);
	}


	/**
     * ajax 添加方案干预信息-试验分组 
     * @return [type] [description]
     */
	function add_reagents(){
		$items_id=$this->input->get_post('items_id');
		$pro_id=$this->input->get_post('pro_id');
		$group_num=$this->input->get_post('group_num');
		$fzreagent_id=$this->input->get_post('fzreagent_id');
		$fzgroupcode=$this->input->get_post('fzgroupcode');
		$fzsjreagent_id=$this->input->get_post('fzsjreagent_id');
		$fzsjnum=$this->input->get_post('fzsjnum');
	    $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		}

		if($group_num){
			$this->funcmodel->edit('items_pro_base',array('group_num'=>$group_num),array('id'=>$pro_id));
		
		}

		if($fzreagent_id&&$fzgroupcode){
			$this->funcmodel->edit('items_pro_reagent_group',array('groupcode'=>$fzgroupcode),array('reagent_id'=>$fzreagent_id,'pro_id'=>$pro_id));
		}
		$groupnames=$this->input->get_post('fzgroupnames');
		$groupcodes=$this->input->get_post('fzgroupcodes');		
	if($fzsjnum){
		for($i=0;$i<$fzsjnum;$i++){	
			$res=$this->funcmodel->add('items_pro_reagent_group',array('groupname'=>$groupnames[$i],'groupcode'=>$groupcodes[$i],'reagent_id'=>$fzsjreagent_id,'pro_id'=>$pro_id,'type_id'=>1));		
		}
	}			
		echo json_encode($res);
	}


	/**
     * ajax 添加方案干预信息-药物匹配 
     * @return [type] [description]
     */
	 function add_mates(){

		 $items_id=$this->input->get_post('items_id');
		 $pro_id=$this->input->get_post('pro_id');
		 $pp_groupnum=$this->input->get_post('pp_groupnum');
		 $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		}
		$mname=$this->input->get_post('mname');
		//$mnames=explode(',',$mname);
		foreach($mname as $m){
			$res=$this->funcmodel->add('items_pro_mate',array('mname'=>$m,'pro_id'=>$pro_id));		
		}


		if($pp_groupnum){
			$this->funcmodel->edit('items_pro_base',array('pp_groupnum'=>$pp_groupnum),array('id'=>$pro_id));
			for($i=1;$i<=$pp_groupnum;$i++){
				$k[$i]=$this->input->get_post('ppgroupnames'.$i);
					foreach($k[$i] as $ms){
						$res=$this->funcmodel->add('items_pro_mate_group',array('mname'=>$ms,'pro_id'=>$pro_id,'group_id'=>$i));		
					}
			}
		}
		

		echo json_encode($res);
	 }




	/**
     * ajax 添加方案干预信息-交叉图表 
     * @return [type] [description]
     */
	 function add_chart(){
		 $items_id=$this->input->get_post('items_id');
		 $pro_id=$this->input->get_post('pro_id');
		 $tb_jiaocha=$this->input->get_post('tb_jiaocha');
		 $tb_xulie=$this->input->get_post('tb_xulie');
		 $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		}

		if($tb_xulie&&$tb_jiaocha){
				$this->funcmodel->edit('items_pro_base',array('tb_order'=>$tb_xulie,'tb_cross'=>$tb_jiaocha),array('id'=>$pro_id));
				for($i=1;$i<=$tb_xulie;$i++){
					$xl=$this->input->get_post('yptbxl_'.$i);
					$c=$this->funcmodel->add('items_pro_chart_order',array('ordername'=>$xl,'pro_id'=>$pro_id));
					for($j=1;$j<=$tb_jiaocha;$j++){
						$jc=$this->input->get_post('yptbjc_'.$i.'_'.$j);
						$cs=$this->funcmodel->add('items_pro_chart_order_code',array('codename'=>$jc,'pro_id'=>$pro_id,'order_id'=>$c,'cross_id'=>$j));
					}
				}
		}
		echo json_encode($res);
	 }

	/**
     * ajax 添加方案干预信息-用药详情-单次用药
     * @return [type] [description]
     */
	 function add_druguse(){
		 $items_id=$this->input->get_post('items_id');
		 $pro_id=$this->input->get_post('pro_id');
		 $yp_xq_cycle=$this->input->get_post('yp_xq_cycle');
		 $yp_xqd_usetime=$this->input->get_post('yp_xqd_usetime');
		 $ypd_is_repast=$this->input->get_post('ypd_is_repast');
		 $dnot_repast_time=$this->input->get_post('dnot_repast_time');
		 $yp_xqd_usetime=$this->input->get_post('yp_xqd_usetime');
		 $d_can=$this->input->get_post('d_can');
		 $dcshijian=$this->input->get_post('dcshijian');
		 $dchmin=$this->input->get_post('dchmin');
		 $dctime1=$this->input->get_post('dctime1');
		 $dchmin2=$this->input->get_post('dchmin2');
		 $dctime2=$this->input->get_post('dctime2');
		 $dexplains=$this->input->get_post('dexplains');
		 $dtabu=$this->input->get_post('dtabu');
		 $tx_crc=$this->input->get_post('tx_crc');
		 $tx_dtime=$this->input->get_post('tx_dtime');
		 $tx_dtimeunit=$this->input->get_post('tx_dtimeunit');
		 $tx_huanzhe=$this->input->get_post('tx_huanzhe');
		 $tx_dtime1=$this->input->get_post('tx_dtime1');
		 $tx_dtimeunit1=$this->input->get_post('tx_dtimeunit1');

		 $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		 if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		 }
		  $add['pro_id']=$pro_id;
		  $add['cycle_id']=$yp_xq_cycle;
		  $add['is_repast']=$ypd_is_repast;
		  if($ypd_is_repast==2){
			  $add['pro_id']=$dnot_repast_time; 
		  }else{
			  $add['meals']=$d_can; 
			  $add['meals_timetype']=$dcshijian; 
			  $add['meals_time']=$dchmin; 
			  $add['meals_timeunit']=$dctime1; 
			  if($dcshijian==2){
				  $add['meals_endtime']=$dchmin2; 
				  $add['meals_endtimeunit']=$dctime2; 		  
			  }  
		  }
		  
		  $add['explains']=$dexplains;
		  $add['tabu']=$dtabu;
		  $add['tx_crc']=$tx_crc;
		  $add['tx_huanzhe']=$tx_huanzhe;
		  $add['tx_ctime']=$tx_dtime;
		  $add['tx_ctimeunits']=$tx_dtimeunit;
		  $add['tx_htime']=$tx_dtime1;
		  $add['tx_htimeunits']=$tx_dtimeunit1;
		 $res=$this->funcmodel->add('items_pro_meddle',$add);
		  $zqarr=$this->input->get_post('ypxq_tbdzq');
		  if(count($zqarr)){
			  for($i=0;$i<count($zqarr);$i++){
				  $adds['pro_id']=$pro_id;
				  $adds['cycle_id']=$zqarr[$i];
				  $adds['is_repast']=$ypd_is_repast;
				  if($ypd_is_repast==2){
					  $adds['pro_id']=$dnot_repast_time; 
				  }else{
					  $adds['meals']=$d_can; 
					  $adds['meals_timetype']=$dcshijian; 
					  $adds['meals_time']=$dchmin; 
					  $adds['meals_timeunit']=$dctime1; 
					  if($dcshijian==2){
						  $adds['meals_endtime']=$dchmin2; 
						  $adds['meals_endtimeunit']=$dctime2; 		  
					  }  
				  }
				  
				  $adds['explains']=$dexplains;
				  $adds['tabu']=$dtabu;
				  $adds['tx_crc']=$tx_crc;
				  $adds['tx_huanzhe']=$tx_huanzhe;
				  $adds['tx_ctime']=$tx_dtime;
				  $adds['tx_ctimeunits']=$tx_dtimeunit;
				  $adds['tx_htime']=$tx_dtime1;
				  $adds['tx_htimeunits']=$tx_dtimeunit1;
				  $res=$this->funcmodel->add('items_pro_meddle',$adds); 
			  }		  
		  }	
		echo json_encode($res);
	 }

	/** 未完
     * ajax 添加方案干预信息-用药详情-多次用药
     * @return [type] [description]
     */
	 function add_druguse_more(){
		 $items_id=$this->input->get_post('items_id');
		 $pro_id=$this->input->get_post('pro_id');
		 $yp_xqm_cycle=$this->input->get_post('yp_xqm_cycle');
		 $yp_xqm_usetime=$this->input->get_post('yp_xqm_usetime');
		 $ypd_is_law=$this->input->get_post('ypd_is_law');
		 $m_totalnum=$this->input->get_post('m_totalnum');
		 $m_drug_types=$this->input->get_post('m_drug_types');
		 $m_drug_law=$this->input->get_post('m_drug_law');
		 $m_drug_lawlnum=$this->input->get_post('m_drug_lawlnum');
		 $m_drug_lawlunit=$this->input->get_post('m_drug_lawlunit');
		 $m_frequencies=$this->input->get_post('m_frequencies');
		 $m_can=$this->input->get_post('m_can');
		 $mg_can=$this->input->get_post('mg_can');
		 $mchmin=$this->input->get_post('mchmin');
		 $mctime=$this->input->get_post('mctime');
		 $mchmin1=$this->input->get_post('mchmin1');
		 $mg_drug_lawftime=$this->input->get_post('mg_drug_lawftime');
		 $dexplains=$this->input->get_post('dexplains');
		 $m_drug_lawnum=$this->input->get_post('m_drug_lawnum');
		 $m_drug_lawunit=$this->input->get_post('m_drug_lawunit');		
		 $m_drug_lawnums=$this->input->get_post('m_drug_lawnums');
		 $m_drug_lawftime=$this->input->get_post('m_drug_lawftime');
		 $mexplains=$this->input->get_post('mexplains');
		 $mtabu=$this->input->get_post('mtabu');
		 $m_drug_timetype=$this->input->get_post('m_drug_timetype');
		 $m_drug_time=$this->input->get_post('m_drug_time');
		 $m_drug_timeunit=$this->input->get_post('m_drug_timeunit');
		 $tx_mcrc=$this->input->get_post('tx_mcrc');
		 $tx_mtime=$this->input->get_post('tx_mtime');
		 $tx_mtimeunit=$this->input->get_post('tx_mtimeunit');
		 $tx_mhuanzhe=$this->input->get_post('tx_mhuanzhe');
		 $tx_mtime1=$this->input->get_post('tx_mtime1');
		 $tx_mtimeunit1=$this->input->get_post('tx_mtimeunit1');
		 $tb_dmzhouqi=$this->input->get_post('tb_dmzhouqi');		
		  $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		 if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		 }
		 $add['pro_id']=$pro_id;
		 $add['cycle_id']=$yp_xqm_cycle;
		 $add['explains']=$mexplains;
		 $add['tabu']=$mtabu;
		 $add['tx_crc']=$tx_mcrc;
		 $add['tx_huanzhe']=$tx_mhuanzhe;
		 $add['tx_ctime']=$tx_mtime;
		 $add['tx_ctimeunits']=$tx_mtimeunit;
		 $add['tx_htime']=$tx_mtime1;
		 $add['tx_htimeunits']=$tx_mtimeunit1;
		 $add['m_totalnum']=$m_totalnum;
		 $add['is_law']=$ypd_is_law;
		 $add['drug_type']=$m_drug_types;
         //不规律用药
		 if($ypd_is_law==2){
			  $res=$this->funcmodel->add('items_pro_meddle',$add); 
			 for($k=1;$k<=$m_totalnum;$k++){
				 $m_drug_timetype=$this->input->get_post('m_drug_timetype_'.$k);
				 $m_drug_time=$this->input->get_post('m_drug_time_'.$k);
				 $m_drug_timeunit=$this->input->get_post('m_drug_timeunit_'.$k);
				 $resm=$this->funcmodel->add('items_pro_meddle_group',array('meddle_id'=>$res,'timetype'=>$m_drug_timetype,'usetime'=>$m_drug_time,'timeunit'=>$m_drug_timeunit,'group_id'=>$k));			 
			 }		
			 
			 echo json_encode($res);
			 exit;
		 }else{
			  $add['is_continue']=$m_drug_law;
			  if($m_drug_law==1){//连续用药
				   $add['day_first_time']=$mg_drug_lawftime;
				   $add['law_series_time']=$m_drug_lawlnum;
				   $add['law_series_fre']=$m_frequencies;
				   if($m_frequencies==4){
					   $m_can=4;				   
				   }
				   $add['m_can']=$m_can;				   				  
				   if($m_can==1||$m_can==3){
					    $add['law_series_meal_time']=$mchmin;
						$add['law_series_meal_timeunit']=$mctime; 
				   }
				   if($m_can==4){
					    $add['law_series_gap']=$mg_can;
						if($mg_can==1){
							 $add['law_series_gap_time']=$mchmin1;
						}
				   }
				    $res=$this->funcmodel->add('items_pro_meddle',$add);	  
			  
			  }else{//间隔用药
				   $add['day_first_time']=$m_drug_lawftime;
				   $add['law_gap_time']=$m_drug_lawnum;
				   $add['law_gap_timeunit']=$m_drug_lawunit;
				   $add['law_gap_num']=$m_drug_lawnums;
				   $res=$this->funcmodel->add('items_pro_meddle',$add);	  
				 
			  }
			    echo json_encode($res);
				exit;		 
		 }

		  if(count($tb_dmzhouqi)){
			 foreach($tb_dmzhouqi as $ks){
				 $adds['pro_id']=$pro_id;
				 $adds['cycle_id']=$ks;
				 $adds['explains']=$mexplains;
				 $adds['tabu']=$mtabu;
				 $adds['tx_crc']=$tx_mcrc;
				 $adds['tx_huanzhe']=$tx_mhuanzhe;
				 $adds['tx_ctime']=$tx_mtime;
				 $adds['tx_ctimeunits']=$tx_mtimeunit;
				 $adds['tx_htime']=$tx_mtime1;
				 $adds['tx_htimeunits']=$tx_mtimeunit1;
				 $adds['m_totalnum']=$m_totalnum;
				 $adds['is_law']=$ypd_is_law;
				 $adds['drug_type']=$m_drug_types;
				 //不规律用药
				 if($ypd_is_law==2){
					  $ress=$this->funcmodel->add('items_pro_meddle',$adds); 
					 for($ks=1;$ks<=$m_totalnum;$ks++){
						 $m_drug_timetype=$this->input->get_post('m_drug_timetype_'.$ks);
						 $m_drug_time=$this->input->get_post('m_drug_time_'.$ks);
						 $m_drug_timeunit=$this->input->get_post('m_drug_timeunit_'.$ks);
						 $resm=$this->funcmodel->add('items_pro_meddle_group',array('meddle_id'=>$ress,'timetype'=>$m_drug_timetype,'usetime'=>$m_drug_time,'timeunit'=>$m_drug_timeunit,'group_id'=>$ks));			 
					 }		 
				 }else{
					  $adds['is_continue']=$m_drug_law;
					  if($m_drug_law==1){//连续用药
						   $adds['day_first_time']=$mg_drug_lawftime;
						   $adds['law_series_time']=$m_drug_lawlnum;
						   $adds['law_series_fre']=$m_frequencies;
						   if($m_frequencies==4){
							   $m_can=4;				   
						   }
						   $adds['m_can']=$m_can;				   				  
						   if($m_can==1||$m_can==3){
								$adds['law_series_meal_time']=$mchmin;
								$adds['law_series_meal_timeunit']=$mctime; 
						   }
						   if($m_can==4){
								$adds['law_series_gap']=$mg_can;
								if($mg_can==1){
									 $adds['law_series_gap_time']=$mchmin1;
								}
						   }
							$ress=$this->funcmodel->add('items_pro_meddle',$adds);	  					  
					  }else{//间隔用药
						   $adds['day_first_time']=$m_drug_lawftime;
						   $adds['law_gap_time']=$m_drug_lawnum;
						   $adds['law_gap_timeunit']=$m_drug_lawunit;
						   $adds['law_gap_num']=$m_drug_lawnums;
						   $ress=$this->funcmodel->add('items_pro_meddle',$adds);	  						 
					  } 
				 }
			 
			 }
		 }
	 }
	/**
     * ajax 添加方案干预信息-采血
     * @return [type] [description]
     */
	 function add_blood(){
		 $items_id=$this->input->get_post('items_id');
		 $pro_id=$this->input->get_post('pro_id');
		 $yp_cx_cycle=$this->input->get_post('yp_cx_cycle');
		 $yp_cx_drug=$this->input->get_post('yp_cx_drug');
		 $yp_cx_qh=$this->input->get_post('yp_cx_qh');
		 $yp_cx_time=$this->input->get_post('yp_cx_time');
		 $yp_cx_ttype=$this->input->get_post('yp_cx_ttype');
		 $yp_cx_dis=$this->input->get_post('yp_cx_dis');
		 $yp_cx_mcrc=$this->input->get_post('yp_cx_mcrc');
		 $yp_cx_mtime=$this->input->get_post('yp_cx_mtime');
		 $yp_cx_mtimeunit=$this->input->get_post('yp_cx_mtimeunit');
		 $yp_cx_mhuanzhe=$this->input->get_post('yp_cx_mhuanzhe');
		 $yp_cx_mtime1=$this->input->get_post('yp_cx_mtime1');
		 $yp_cx_mtimeunit1=$this->input->get_post('yp_cx_mtimeunit1');


		 $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		 if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		 }

		  if($yp_cx_ttype==1){
			 $cx_time=$yp_cx_time;
		 }elseif($yp_cx_ttype==2){
			 $cx_time=$yp_cx_time*60; 
		 }
		 $add=array('pro_id'=>$pro_id,'cx_cycle'=>$yp_cx_cycle,'cx_drug'=>$yp_cx_drug,'cx_qh'=>$yp_cx_qh,'cx_time'=>$cx_time,'cx_dis'=>$yp_cx_dis,'cx_tx_crc'=>$yp_cx_mcrc,'cx_tx_huanzhe'=>$yp_cx_mhuanzhe,'cx_tx_ctime'=>$yp_cx_mtime,'cx_tx_ctimeunits'=>$yp_cx_mtimeunit,'cx_tx_htime'=>$yp_cx_mtime1,'cx_tx_htimeunits'=>$yp_cx_mtimeunit1);
		$res=$this->funcmodel->add('items_pro_blood',$add);


		echo json_encode($res);
	 }


	 /**
     * ajax 添加方案干预信息-检查
     * @return [type] [description]
     */
	 function add_inspects(){
		 $items_id=$this->input->get_post('items_id');
		 $pro_id=$this->input->get_post('pro_id');
		 $yp_jc_cycle=$this->input->get_post('yp_jc_cycle');
		 $yp_jc_drug=$this->input->get_post('yp_jc_drug');
		 $yp_jc_qh=$this->input->get_post('yp_jc_qh');
		 $yp_jc_time=$this->input->get_post('yp_jc_time');
		 $yp_jc_ttype=$this->input->get_post('yp_jc_ttype');
		 $yp_jc_dis=$this->input->get_post('yp_jc_dis');
		 $yp_jc_mcrc=$this->input->get_post('yp_jc_mcrc');
		 $yp_jc_mtime=$this->input->get_post('yp_jc_mtime');
		 $yp_jc_mtimeunit=$this->input->get_post('yp_jc_mtimeunit');
		 $yp_jc_mhuanzhe=$this->input->get_post('yp_jc_mhuanzhe');
		 $yp_jc_mtime1=$this->input->get_post('yp_jc_mtime1');
		 $yp_jc_mtimeunit1=$this->input->get_post('yp_jc_mtimeunit1');
		 $yp_jc_tg=$this->input->get_post('tg');
		 $yp_jc_sm=$this->input->get_post('sm');
		 $yp_jc_cg=$this->input->get_post('cg');
		 $yp_jc_xsh=$this->input->get_post('xsh');
		 $yp_jc_cs=$this->input->get_post('cs');
		 $yp_jc_yx=$this->input->get_post('yx');
		 $yp_jc_xd=$this->input->get_post('xd');
		 $yp_jc_jy=$this->input->get_post('jy');
		 $yp_jc_qt=$this->input->get_post('qt');
		
		 $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		 if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		 }

		  if($yp_jc_ttype==1){
			 $jc_time=$yp_jc_time;
		 }elseif($yp_jc_ttype==2){
			 $jc_time=$yp_jc_time*60; 
		 } 
		 $add=array('pro_id'=>$pro_id,'jc_cycle'=>$yp_jc_cycle,'jc_drug'=>$yp_jc_drug,'jc_qh'=>$yp_jc_qh,'jc_time'=>$jc_time,'jc_dis'=>$yp_jc_dis,'jc_tx_crc'=>$yp_jc_mcrc,'jc_tx_huanzhe'=>$yp_jc_mhuanzhe,'jc_tx_ctime'=>$yp_jc_mtime,'jc_tx_ctimeunits'=>$yp_jc_mtimeunit,'jc_tx_htime'=>$yp_jc_mtime1,'jc_tx_htimeunits'=>$yp_jc_mtimeunit1);
		$res=$this->funcmodel->add('items_pro_inspect',$add);
		 foreach($yp_jc_tg as $tg){
			 $res1=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$tg,'type'=>1,'surgery_id'=>$res));
		 }
		  foreach($yp_jc_sm as $sm){
			 $res2=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$sm,'type'=>1,'surgery_id'=>$res));
		 }
		  foreach($yp_jc_cg as $cg){
			 $res3=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$cg,'type'=>1,'surgery_id'=>$res));
		 }
		  foreach($yp_jc_xsh as $xsh){
			 $res4=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$xsh,'type'=>1,'surgery_id'=>$res));
		 }
		  foreach($yp_jc_cs as $cs){
			 $res5=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$cs,'type'=>1,'surgery_id'=>$res));
		 }
		  foreach($yp_jc_yx as $yx){
			 $res6=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$yx,'type'=>1,'surgery_id'=>$res));
		 }
		   foreach($yp_jc_xd as $xd){
			 $res7=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$xd,'type'=>1,'surgery_id'=>$res));
		 }

		  foreach($yp_jc_jy as $jy){
			 $res8=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$jy,'type'=>1,'surgery_id'=>$res));
		 }
		  foreach($yp_jc_qt as $qt){
			 $res9=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$qt,'type'=>1,'surgery_id'=>$res));
		 }

		echo json_encode($res);
	 }

	  /**
     * ajax 添加方案手术模块
     * @return [type] [description]
     */
	 function add_surgery(){
		 $items_id=$this->input->get_post('items_id');
		 $pro_id=$this->input->get_post('pro_id');
		 $add['pro_id']=$this->input->get_post('pro_id');
		 $add['surgery_time']=$this->input->get_post('surgery_time');
		 $add['surgery_notes']=$this->input->get_post('surgery_notes');
		 $add['ss_mcrc']=$this->input->get_post('ss_mcrc');
		 $add['ss_mtime']=$this->input->get_post('ss_mtime');
		 $add['ss_mtimeunit']=$this->input->get_post('ss_mtimeunit');
		 $add['ss_mhuanzhe']=$this->input->get_post('ss_mhuanzhe');
		 $add['ss_mtime1']=$this->input->get_post('ss_mtime1');
		 $add['ss_mtimeunit1']=$this->input->get_post('ss_mtimeunit1');
		 $add['assess_time']=$this->input->get_post('assess_time');
		 $add['assess_type']=$this->input->get_post('assess_type');
		 $add['assess_dis']=$this->input->get_post('assess_dis');
		 $add['assess_notes']=$this->input->get_post('assess_notes');
		 $add['ss_amcrc']=$this->input->get_post('ss_amcrc');
		 $add['ss_aqian']=$this->input->get_post('ss_aqian');
		 $add['ss_atime']=$this->input->get_post('ss_atime');
		 $add['ss_amtimeunit']=$this->input->get_post('ss_amtimeunit');
		 $add['ss_amtimeunits']=$this->input->get_post('ss_amtimeunits');
		 $add['ss_amhuanzhe']=$this->input->get_post('ss_amhuanzhe');
		 $add['ss_aqians']=$this->input->get_post('ss_aqians');
		 $add['ss_amtime1']=$this->input->get_post('ss_amtime1');
		 $add['ss_amtimeunit1']=$this->input->get_post('ss_amtimeunit1');
		 $add['ss_amtimeunit1s']=$this->input->get_post('ss_amtimeunit1s');
		 $add['ss_cqians']=$this->input->get_post('ss_cqians');
		 $add['ss_cmtime1']=$this->input->get_post('ss_cmtime1');
		 $add['ss_cmtimeunit1']=$this->input->get_post('ss_cmtimeunit1');
	     $add['ss_jc_dis']=$this->input->get_post('ss_jc_dis');
		 $add['ss_jc_mcrc']=$this->input->get_post('ss_jc_mcrc');
		 $add['ss_jc_mtime']=$this->input->get_post('ss_jc_mtime');
		 $add['ss_jc_mtimeunit']=$this->input->get_post('ss_jc_mtimeunit');
		 $add['ss_jc_mhuanzhe']=$this->input->get_post('ss_jc_mhuanzhe');
		 $add['ss_jc_mtime1']=$this->input->get_post('ss_jc_mtime1');
		 $add['ss_jc_mtimeunit1']=$this->input->get_post('ss_jc_mtimeunit1');
		 $ss_jc_tg=$this->input->get_post('sstg');
		 $ss_jc_sm=$this->input->get_post('sssm');
		 $ss_jc_cg=$this->input->get_post('sscg');
		 $ss_jc_xsh=$this->input->get_post('ssxsh');
		 $ss_jc_cs=$this->input->get_post('sscs');
		 $ss_jc_yx=$this->input->get_post('ssyx');
		 $ss_jc_xd=$this->input->get_post('ssxd');
		 $ss_jc_jy=$this->input->get_post('ssjy');
		 $ss_jc_qt=$this->input->get_post('ssqt');
		
		 $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		 if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		 }
		
		$res=$this->funcmodel->add('items_pro_surgery',$add);
		 foreach($ss_jc_tg as $tg){
			 $res1=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$tg,'type'=>2,'surgery_id'=>$res));
		 }
		  foreach($ss_jc_sm as $sm){
			 $res2=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$sm,'type'=>2,'surgery_id'=>$res));
		 }
		  foreach($ss_jc_cg as $cg){
			 $res3=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$cg,'type'=>2,'surgery_id'=>$res));
		 }
		  foreach($ss_jc_xsh as $xsh){
			 $res4=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$xsh,'type'=>2,'surgery_id'=>$res));
		 }
		  foreach($ss_jc_cs as $cs){
			 $res5=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$cs,'type'=>2,'surgery_id'=>$res));
		 }
		  foreach($ss_jc_yx as $yx){
			 $res6=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$yx,'type'=>2,'surgery_id'=>$res));
		 }
		   foreach($ss_jc_xd as $xd){
			 $res7=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$xd,'type'=>2,'surgery_id'=>$res));
		 }

		  foreach($ss_jc_jy as $jy){
			 $res8=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$jy,'type'=>2,'surgery_id'=>$res));
		 }
		  foreach($ss_jc_qt as $qt){
			 $res9=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$qt,'type'=>2,'surgery_id'=>$res));
		 }

		echo json_encode($res);
	 }

	   /**
     * ajax 添加方案随访模块-随访内容
     * @return [type] [description]
     */
	 function add_follow(){
		 $items_id=$this->input->get_post('items_id');
		 $pro_id=$this->input->get_post('pro_id');
		 $add['pro_id']=$this->input->get_post('pro_id');
		 $add['follow_count']=$this->input->get_post('follow_count');
		 $add['follow_way']=$this->input->get_post('follow_way');
		 $add['follow_detail']=$this->input->get_post('follow_detail');
		 $add['follow_notes']=$this->input->get_post('follow_notes');
		 $add['follow_diss']=$this->input->get_post('follow_diss');
		 $add['sf_jc_mcrc']=$this->input->get_post('sf_jc_mcrc');
		 $add['sf_jc_mtime']=$this->input->get_post('sf_jc_mtime');
		 $add['sf_jc_mtimeunit']=$this->input->get_post('sf_jc_mtimeunit');
		 $add['sf_jc_mhuanzhe']=$this->input->get_post('sf_jc_mhuanzhe');
		 $add['sf_jc_mtime1']=$this->input->get_post('sf_jc_mtime1');
		 $add['sf_jc_mtimeunit1']=$this->input->get_post('sf_jc_mtimeunit1');
		
		 $sf_jc_tg=$this->input->get_post('sftg');
		 $sf_jc_sm=$this->input->get_post('sfsm');
		 $sf_jc_cg=$this->input->get_post('sfcg');
		 $sf_jc_xsh=$this->input->get_post('sfxsh');
		 $sf_jc_cs=$this->input->get_post('sfcs');
		 $sf_jc_yx=$this->input->get_post('sfyx');
		 $sf_jc_xd=$this->input->get_post('sfxd');
		 $sf_jc_jy=$this->input->get_post('sfjy');
		 $sf_jc_qt=$this->input->get_post('sfqt');
		
		 $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		 if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		 }
		
		$res=$this->funcmodel->add('items_pro_follow',$add);
		 foreach($sf_jc_tg as $tg){
			 $res1=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$tg,'type'=>3,'surgery_id'=>$res));
		 }
		  foreach($sf_jc_sm as $sm){
			 $res2=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$sm,'type'=>3,'surgery_id'=>$res));
		 }
		  foreach($sf_jc_cg as $cg){
			 $res3=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$cg,'type'=>3,'surgery_id'=>$res));
		 }
		  foreach($sf_jc_xsh as $xsh){
			 $res4=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$xsh,'type'=>3,'surgery_id'=>$res));
		 }
		  foreach($sf_jc_cs as $cs){
			 $res5=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$cs,'type'=>3,'surgery_id'=>$res));
		 }
		  foreach($sf_jc_yx as $yx){
			 $res6=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$yx,'type'=>3,'surgery_id'=>$res));
		 }
		   foreach($sf_jc_xd as $xd){
			 $res7=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$xd,'type'=>3,'surgery_id'=>$res));
		 }

		  foreach($sf_jc_jy as $jy){
			 $res8=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$jy,'type'=>3,'surgery_id'=>$res));
		 }
		  foreach($sf_jc_qt as $qt){
			 $res9=$this->funcmodel->add('items_pro_ins',array('pro_id'=>$pro_id,'inspect_id'=>$qt,'type'=>3,'surgery_id'=>$res));
		 }
		echo json_encode($res);
	 }

	    /**
     * ajax 添加方案随访模块-随访设置
     * @return [type] [description]
     */
	 function add_follow_base(){
		 $items_id=$this->input->get_post('items_id');
		 $pro_id=$this->input->get_post('pro_id');
		 $add['follow_basetime']=$this->input->get_post('follow_basetime');
		 $add['follow_time']=$this->input->get_post('follow_time');
		 $add['follow_times']=$this->input->get_post('follow_times');
		 $add['follow_type']=$this->input->get_post('follow_type');
		 $add['follow_falt']=$this->input->get_post('follow_falt');
		 $add['follow_ftime']=$this->input->get_post('follow_ftime');
		 $add['follow_ftype']=$this->input->get_post('follow_ftype');
		 $add['follow_num_type']=$this->input->get_post('follow_num_type');
		 $add['follow_num']=$this->input->get_post('follow_num');
		 $add['follow_num_up']=$this->input->get_post('follow_num_up');

		 $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		 if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		 }
		
		$res=$this->funcmodel->edit('items_pro_base',$add,array('id'=>$pro_id));
	
		echo json_encode($res);
	 }

	 	/**
     * ajax 添加方案干预信息-器械干预措施 
     * @return [type] [description]
     */
	 function add_qxchart(){
		 $items_id=$this->input->get_post('items_id');
		 $pro_id=$this->input->get_post('pro_id');
		 $tb_jiaocha=$this->input->get_post('tb_jiaochas');
		 $tb_xulie=$this->input->get_post('tb_xulies');
		  $qx_xqm_cycle=$this->input->get_post('qx_xqm_cycle');
		  $qx_xqm_usetime=$this->input->get_post('qx_xqm_usetime');
		  $qxm_totalnum=$this->input->get_post('qxm_totalnum');
		  $qx_tb_dis=$this->input->get_post('qx_tb_dis');
		  $qx_tb_tabu=$this->input->get_post('qx_tb_tabu');
		  $qx_tb_mcrc=$this->input->get_post('qx_tb_mcrc');
		  $qx_tb_mtime=$this->input->get_post('qx_tb_mtime');
		  $qx_tb_mtimeunit=$this->input->get_post('qx_tb_mtimeunit');
		  $qx_tb_mhuanzhe=$this->input->get_post('qx_tb_mhuanzhe');
		  $qx_tb_mtime1=$this->input->get_post('qx_tb_mtime1');
		  $qx_tb_mtimeunit1=$this->input->get_post('qx_tb_mtimeunit1');
		 $base=$this->funcmodel->get_one('items_pro_base',array('items_id'=>$items_id,'id'=>$pro_id));
		if($base['id']!=$pro_id){
			$res=0;
			echo json_encode($res);
			exit;
		}
		$add=array('pro_id'=>$pro_id,'cycle_id'=>$qx_xqm_cycle,'m_totalnum'=>$qxm_totalnum,'explains'=>$qx_tb_dis,'tabu'=>$qx_tb_tabu,'tx_crc'=>$qx_tb_mcrc,'tx_huanzhe'=>$qx_tb_mhuanzhe,'tx_ctime'=>$qx_tb_mtime,'tx_ctimeunits'=>$qx_tb_mtimeunit,'tx_htime'=>$qx_tb_mtime1,'tx_htimeunits'=>$qx_tb_mtimeunit1);
		$resxq=$this->funcmodel->add('items_pro_meddle',$add);
		if($resxq){
			for($i=1;$i<=$qxm_totalnum;$i++){
				$m_qx_timetype=$this->input->get_post('m_qx_timetype_'.$i);
			    $m_qx_time=$this->input->get_post('m_qx_time_'.$i);
			    $m_qx_timeunit=$this->input->get_post('m_qx_timeunit_'.$i);
			    $ms_qx_time=$this->input->get_post('ms_qx_time_'.$i);
			    $ms_qx_timeunit=$this->input->get_post('ms_qx_timeunit_'.$i);
				$rem=$this->funcmodel->add('items_pro_meddle_group',array('meddle_id'=>$resxq,'timetype'=>$m_qx_timetype,'usetime'=>$m_qx_time,'timeunit'=>$m_qx_timeunit,'usetimes'=>$ms_qx_time,'timesunit'=>$ms_qx_timeunit,'group_id'=>$i));
			}		
		}


		if($tb_xulie&&$tb_jiaocha){
				$this->funcmodel->edit('items_pro_base',array('tb_order'=>$tb_xulie,'tb_cross'=>$tb_jiaocha),array('id'=>$pro_id));
				for($i=1;$i<=$tb_xulie;$i++){
					$xl=$this->input->get_post('qxtbxl_'.$i);
					$c=$this->funcmodel->add('items_pro_chart_order',array('ordername'=>$xl,'pro_id'=>$pro_id));
					for($j=1;$j<=$tb_jiaocha;$j++){
						$jc=$this->input->get_post('qxtbjc_'.$i.'_'.$j);
						$cs=$this->funcmodel->add('items_pro_chart_order_code',array('codename'=>$jc,'pro_id'=>$pro_id,'order_id'=>$c,'cross_id'=>$j));
					}
				}
		}
		echo json_encode($res);
	 }

    /**
	**方案审核功能列表
	**/
	 function program_check(){
		$this->checkauth('program_check');
        $data['cdn'] = $this->cdn;   	
        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
		$where['status']=0;
		$test_id     = trim($this->input->get_post('test_id'));
		$meddle_type     = intval($this->input->get_post('meddle_type'));
		$use_methods     = intval($this->input->get_post('use_methods'));
		if (isset($test_id) && $test_id) {
            $where['test_id'] = $test_id;
            $page_where      = 'test_id=' . $test_id;
        }
        if (isset($meddle_type) && $meddle_type) {
            $where['meddle_type'] = $meddle_type;
            $page_where      = 'meddle_type=' . $meddle_type;
        }
		 if (isset($use_methods) && $use_methods) {
            $where['use_methods'] = $use_methods;
            $page_where      = 'use_methods=' . $use_methods;
        }
        $count            = $this->funcmodel->count_pro_check($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['test_id']   = $test_id;
		$data['meddle_type']   = $meddle_type;
		$data['use_methods']   = $use_methods;
        $data['where']    = $where;	
        $data['list'] = $this->funcmodel->get_all_pro_check($where, $p->firstRow, $p->listRows);
        $this->load->view('admin/item/pro_checklist', $data);
	 
	 }
	  /**
   *批量审核
   **/
	function program_check_ok(){
		  $this->checkauth('program_check');
          $md =$this->input->post('tempString');
		  $ids =explode(',',$md);		 
		  $this->funcmodel->edit_wherein('items_pro_base',array('status'=>1),$ids);		 
		  $log=array('userid'=>$this->session->userdata('userid'),'type'=>'program_check','result'=>'方案审核','record_id'=>0,'add_time'=>time(),'content'=> json_encode($ids),'title'=>'' ,'urls'=>'');
		  $logid=$this->adminlogmodel->add($log);		 
		  go('/index.php/admin/item_program/program_check/', '操作成功', GO_SUCCESS);
	}








} 
