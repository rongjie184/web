<?php

class Institution extends MY_Controller
{
	//初始化
    public function __construct()
    {
        parent::__construct();
        // $this->output->enable_profiler(true);

    }

    /**
     * 机构列表页面-
     * @return [type] [description]
     */
    public function institution_list(){
    	$data['cdn'] = $this->cdn;
    	$tt = $this->checkauth('add_institution');
        $this->load->model('instmodel');
        $this->load->helper('Page');
       	$where      = array();
        $page_where = '';
        // 需要模糊查询的名称
        $search     = trim($this->input->get_post('search'));

        if (isset($search) && $search) {
            $where['search'] = $search;
            $where['column'] = 'instname'; 
            $page_where      = 'search=' . $search;
        }
        $where['status'] ='1';
        //查询到的总条数
        $count            = $this->instmodel->count($where);
        $p = new page($count,10,$page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
        //获取数据
       	$res = $this->instmodel->get_all($where,$table=null,$p->firstRow, $p->listRows);
       	$data['instlist'] = $res;

    	$this->load->view('admin/inst/inst_list',$data);
    }
    	//备用
    	//$sql = "select COLUMN_NAME from information_schema.COLUMNS where table_name = 'inst'"; 
       	// $result = $this->db->query($sql)->result_array();
       	// var_dump($result);
     	// $this->load->helper('phpExcel1');
     	//    $e = new Phpexcel1();

    /**
     * 添加机构-
     * @return [type] [description]
     */
    public function add_institution(){
    	$this->checkauth('add_institution');
        $this->load->model('instmodel');
        $data['shen'] = $this->instmodel->area();
        $data['cdn']      = $this->cdn;
        $where = array('table'=>'inst','status'=>1);
        $data['columns'] = $this->instmodel->get_all($where,$table='columns');
        $iwhere = array('table'=>'inst_detail','status'=>1);
        $data['office'] = $this->instmodel->get_all($iwhere,$table='columns');
        $data['area'] = $this->instmodel->get_all($where='',$table='area');
        $dwhere = array('status'=>0);
        $this->instmodel->del_table($table='columns',$dwhere);
        // var_dump($data['columns']);
    	$this->load->view('admin/inst/inst_add',$data);
    }

    /**
     * 获取三级联动区域地址-
     * @return [type] [description]
     */
    public function area_sel(){
    	$id = $_POST['id'];
    	$result = $this->get_list_byid($id);
    	echo json_encode($result);
    }

    /**
     * 添加机构信息-
     * @return [type] [description]
     */
    public function add_institution_do()
    {
    	$this->checkauth('add_institution');
    	$this->load->model('instmodel');
    	//主表内容
    	$instname   = trim($this->input->post('name'));
        $shortname = trim($this->input->post('shortname'));
        $time = strtotime($this->input->post('zizhi_time'));
        $province = $this->input->post('province');
        $city= $this->input->post('city');
        $area= $this->input->post('area');
        $quyu= $this->input->post('quyu');
        $troops=$this->input->post('troops');
        $troops = empty($troops)?0:intval($troops);
        $instw = array('instname'=>$instname);
        $is_inst = $this->instmodel->get_one($instw);
        if($is_inst){
        	go('/index.php/admin/institution/add_institution', '已有此机构', GO_ERROR);
        }

        $lib= $this->input->post('lib');
        //获取新添加的字段colunms
        $content = trim($this->input->post('columns'));
        
        if(count($content)>=1){
        	foreach($content as $key=>$val){
        		$arr[$val['1']] =$val['0'];
        	}
        }
        
        // $col_data = array('status'=>1);
        // foreach ($arr as $key => $value){	
        // 	$aid = $key;
        // 	$res = $this->instmodel->edit($col_data,$aid,$table='columns');
        // }

        $col_content = json_encode($arr);
        //详情表内容
        $office = $this->input->post('office');
        $lead = $this->input->post('lead');
        //接待数据
        $reception =$this->input->post('reception');
    	$reception_time =strtotime($this->input->post('reception_time'));
    	$user = $this->input->post('receiver');
    	$phone = $this->input->post('phone');
    	$email = $this->input->post('email');
    	$position = $this->input->post('position');
        
        $smo =$this->input->post('smo');
        $prior =$this->input->post('prior');
        $prior_list =$this->input->post('prior_list');
        $despatch =$this->input->post('despatch');
        $is_fees =$this->input->post('is_fees');
        $fees =$this->input->post('fees');
        $invoice =$this->input->post('invoice');
        $lead_hereditys =$this->input->post('lead_hereditys');
        $cost =$this->input->post('cost');
        $crc_require =$this->input->post('crc_require');
        $dpletter =$this->input->post('dpletter');
        $dcontent = $this->input->post('content');
        if(count($dcontent)>=1){
        	foreach($dcontent as $key=>$val){
        		$darr[$val['1']] =$val['0'];
        	}
        }
        $dcol_content = json_encode($darr);
        // echo $dcol_content;
        // exit;
        //中心表数据
        $data = array('instname' => $instname,'shortname'=>$shortname,'qualify_time'=>$time,'province'=>$province,'city'=>$city,'area'=>$area,'address'=>$quyu,'troop_system'=>$troops,'inst_lib'=>$lib,'content'=>$col_content,'status'=>1,'add_time'=>time());
       	//中心详情表数据
       	$data_desc = array('is_lead'=>$lead,'office_address'=>$office,'reception_time'=>$reception_time,'is_smo'=>$smo,'is_prior'=>$prior,'prior_list'=>$prior_list,'is_despatch'=>$despatch,'is_fees'=>$is_fees,'fees'=>$fees,'invoice'=>$invoice,'is_lead_heredity'=>$lead_hereditys,'cost'=>$cost,'crc_require'=>$crc_require,'is_dpletter'=>$dpletter,'add_time'=>time(),'dcontent'=>$dcol_content,'status'=>1);
        $info = $this->instmodel->add($data);
      
        //有无接待都要在接待表中添加一条
    	$arr = array('inst_id'=>$info,'is_reception'=>$reception,'datetime'=>$reception_time,'receiver'=>$user,'phone'=>$phone,'email'=>$email,'position'=>$position,'status'=>1,'add_time'=>time());
    	$jiedai = $this->instmodel->add($arr,$table='reception');
    	$data_desc['is_reception'] = $jiedai;
        
        // var_dump($jiedai);
        unset($data);
        if(!$info){
        	go('/index.php/admin/institution/add_institution', '添加失败，请重新添加', GO_ERROR);
        }else{
        	$data_desc['inst_id'] = $info;
        	$this->load->model('funcmodel');
        	$detail_info = $this->funcmodel->add($table='inst_detail',$data_desc);
        	unset($data_desc);
        }
        // // var_dump($info);
        if ($detail_info) {
        	go('/index.php/admin/institution/institution_list', '添加成功', GO_SUCCESS);
        }
    }

    /**
     * 修改机构信息-
     * @return [type] [description]
     */
    public function edit_institution()
    {
    	$this->checkauth('add_institution');
        $data['cdn'] = $this->cdn;
        $this->load->model('instmodel');
        $id  = $this->input->get_post('id');
        $inst = $this->instmodel->get_one($id);
        $data['instinfo'] = $inst;
        $data['shen'] = $this->instmodel->area();
        $data['city']=$this->instmodel->area($table='city',$inst['province']);
        $data['area'] = $this->instmodel->get_all($where='',$table='area');
        //获取机构新添加的字段
    	$iwhere = array('table'=>'inst','status'=>1);
    	$columns = $this->instmodel->get_all($iwhere,$table='columns');
    	$data['columns'] = $columns;
    	// var_dump($columns);
    	$col_inst = json_decode($inst['content'],true);
    	$data['col_inst'] = $col_inst;
        // var_dump($col_inst);
        $this->load->view('admin/inst/inst_edit', $data);
    }

    /**
     * 修改机构信息-
     * @return [type] [description]
     */
    public function edit_institution_do()
    {
    	$this->checkauth('add_institution');
    	$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$instid = $this->input->post('instid');
    	$instname   = $this->input->post('name');
        $shortname = $this->input->post('shortname');
        $time = strtotime($this->input->post('zizhi_time'));
        $province = $this->input->post('province');
        $city= $this->input->post('city');
        $area= $this->input->post('area');
        $quyu= $this->input->post('quyu');
        $troops=$this->input->post('troops');
        $lib= $this->input->post('lib');
        //新添加的字段修改操作
        $content = $this->input->post('columns');
        if(count($content)>=1){
        	foreach($content as $key=>$val){
        		$arr[$val['1']] =$val['0'];
        	}
        }
        // $col_data = array('status'=>1);
        // foreach ($arr as $key => $value){	
        // 	$aid = $key;
        // 	$res = $this->instmodel->edit($col_data,$aid,$table='columns');
        // }

        $col_content = json_encode($arr);
        //一下执行表操作
        // var_dump($col_content);
        // exit;
        $data = array('instname'=>$instname,'shortname'=>$shortname,'province'=>$province,'city'=>$city,'area'=>$area,'address'=>$quyu,'troop_system'=>$troops,'inst_lib'=>$lib,'qualify_time'=>$time,'content'=>$col_content);
        //获取修改前的数据
    	$oldData = $this->instmodel->get_one($instid);
    	$oldData = json_encode($oldData);
    	//修订的数据
    	$newData = json_encode($data);
    	$rdata = array('inst_id'=>$instid,'add_time'=>time(),'old_content'=>$oldData,'revise_content'=>$newData,'revise_man'=>$uname.','.$uid);
    	$xiuding = $this->instmodel->add($rdata,$table='inst_datarevise');
    	unset($rdata);
    	//机构修改	
        $info = $this->instmodel->edit($data,$instid);
        if($info) {
        	go('/index.php/admin/institution/institution_list', '修改成功', GO_SUCCESS);
        }else{
        	go('/index.php/admin/institution/edit_institution?id='.$instid, '修改失败，请重新修改', GO_ERROR);
        }
    }

    /**
     * 查看机构信息-
     * @return [type] [description]
     */
    public function detail_institution()
    {
    	// $add_uid=$this->session->userdata('userid');
    	// $add_uid=$this->session->userdata('uname');
    	$this->checkauth('institution_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	//机构
    	$id = intval($this->input->get('id'));
    	$info = $this->instmodel->get_one($id,$table='inst');
    	$province = $this->instmodel->area_one($info['province'],$table='provinces');
    	$city = $this->instmodel->area_one($info['city'],$table='city');
    	$area = $this->instmodel->get_one($info['area'],$table='area');
    	$info['area'] = $area['name'];
    	//获取机构中心地址
    	$info['province'] =$province['name'];
    	$info['city'] = $city['name'];
    	$data['info'] = $info;
    	//获取机构新添加的字段
    	$iwhere = array('table'=>'inst','status'=>1);
    	$columns = $this->instmodel->get_all($iwhere,$table='columns');
    	$data['columns'] = $columns;
    	$col_inst = json_decode($info['content'],true);
    	$data['col_inst'] = $col_inst;
    	// var_dump($col_inst);

    	//机构办公室
    	$dwhere = array('inst_id'=>$id,'status'=>1);
    	$info_desc = $this->instmodel->get_one($dwhere,$table='inst_detail');
    	$data['info_desc'] = $info_desc;
    	$lead_id = $info_desc['head_id'];
    	$secretary_id = explode(',',$info_desc['secretary_id']);
    	//主任负者人
    	$lead = $this->instmodel->get_one($lead_id,$table='inst_member');
    	$data['lead'] = $lead;
    	//秘书
    	$columns = 'id';
    	$secretary = $this->instmodel->get_in($table='inst_member',$secretary_id,$columns);
    	$data['secretary'] = $secretary;

    	//立项信息
    	$project = $this->instmodel->get_one($dwhere,$table='project');
    	$data['project'] = $project;
    	//伦理信息
    	$ethic = $this->instmodel->get_all($dwhere,$table='ethic');
    	$data['ethic'] = $ethic;
    	//遗传办信息
    	$heredity = $this->instmodel->get_one($dwhere,$table='heredity');
    	$data['heredity'] = $heredity;
    	//合同
    	$contract = $this->instmodel->get_one($dwhere,$table='contract');
    	$data['contract'] = $contract;
    	//关中心
    	$closeinst = $this->instmodel->get_one($dwhere,$table='inst_close');
    	$data['closeinst'] = $closeinst;
    	//一期病房
    	$first_ward = $this->instmodel->get_all($dwhere,$table='first_ward');
    	$data['first_ward'] = $first_ward;
    	// var_dump($first_ward);
    	$this->load->view('admin/inst/inst_detail',$data);
    }

    /**
     * 机构办公室信息-
     * @return [type] [description]
     */
    public function detail_inst(){
    	$this->checkauth('institution_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$id = $this->input->get('id');
    	$instid = $this->input->get('instId');
    	$where = array('inst_detail.id'=>$id);
    	$table = array('inst_detail','inst');
    	$link = 'inst_detail.inst_id=inst.id';
    	$info = $this->instmodel->join($where,$table,$link);
    	// var_dump($info);
    	$cwhere = array('table'=>'inst_detail','status'=>1);
    	$data['columns'] = $this->instmodel->get_all($cwhere,$table='columns');
    	$data['col_inst'] = json_decode($info['0']['dcontent'],true);
    	// 获取是否接待信息
    	$jiedai = $this->instmodel->get_one($info['0']['is_reception'],$table='reception');
    	$data['jiedai'] = $jiedai;
    	 // var_dump($jiedai);
    	$data['info_desc'] = $info['0'];
    	$suid = explode(',',$info['0']['secretary_id']);
    	$huid = explode(',',$info['0']['head_id']);
    	$suser = $this->instmodel->get_in($table='inst_member',$suid,$columns='id');
    	$huser = $this->instmodel->get_in($table='inst_member',$huid,$columns='id');
    	$data['secretary']=$suser;
    	$data['lead'] = $huser;

    	$this->load->view('admin/inst/instoffice_detail',$data);
    }

    /**
     * 修改机构办公室信息-
     * @return [type] [description]
     */
    public function edit_instoffice()
    {
    	$this->checkauth('add_institution');
        $data['cdn'] = $this->cdn;
        $this->load->model('instmodel');
        $finst = $this->input->get('id');
        $instId = $this->input->get('instId');
        $res = $this->instmodel->get_one($finst,$table='inst_detail');
        $inst= $this->instmodel->get_one($instId);
        $res['instname'] = $inst['instname'];
    	$data['inst'] = $res;
    	//获取机构办公室成员
    	$where = array('inst_id'=>$res['inst_id']);
    	$user = $this->instmodel->get_all($where,$table='inst_member');
    	$data['inst_member']=$user;
    	//获取是否接待
    	$rid = $res['is_reception'];
    	$jiedai = $this->instmodel->get_one($rid,$table='reception');
    	$data['jiedai'] = $jiedai;
    	//获取新字段
    	$dwhere = array('table'=>'inst_detail','status'=>1);
    	$columns = $this->instmodel->get_all($dwhere,$table='columns');
    	$data['columns'] = $columns;
    	$col_inst = json_decode($res['content'],true);
    	$data['col_inst'] = $col_inst;

        $suid = explode(',',$res['secretary_id']);
    	$huid = explode(',',$res['head_id']);
    	$suser = $this->instmodel->get_in($table='inst_member',$suid,$columns='id');
    	$huser = $this->instmodel->get_in($table='inst_member',$huid,$columns='id');
    	$data['suser'] = $suser;
    	$data['huser'] = $huser;
        // var_dump($data);
        $this->load->view('admin/inst/instoffice_edit', $data);
    }
    //修改机构办公信息
    public function edit_instoffice_do()
    {

    	$this->checkauth('add_institution');
    	$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
    	$this->load->model('instmodel');
    	$id = $this->input->post('id');
    	$instId = $this->input->post('instId');
    	$office = $this->input->post('office');
    	$is_lead = $this->input->post('is_lead');
        $lead = implode(',',array_unique($this->input->post('lead')));
        $mishu = implode(',',array_unique($this->input->post('mishu')));
        //接待的数据
        $reception =$this->input->post('reception');
        $reception_time =strtotime($this->input->post('reception_time'));
        $user = $this->input->post('receiver');
    	$phone = $this->input->post('phone');
    	$email = $this->input->post('email');
    	$position = $this->input->post('position');

        $smo =$this->input->post('smo');
        $prior =$this->input->post('prior');
        $prior_list =$this->input->post('prior_list');
        $despatch =$this->input->post('despatch');
        $is_fees =$this->input->post('is_fees');
        $fees =$this->input->post('fees');
        $invoice =$this->input->post('invoice');
        $lead_hereditys =$this->input->post('lead_hereditys');
        $cost =$this->input->post('cost');
        $crc_require =$this->input->post('crc_require');
        $dpletter =$this->input->post('dpletter');

        $dcontent = $this->input->post('columns');
        if(count($dcontent)>=1){
        	foreach($dcontent as $key=>$val){
        		$darr[$val['1']] =$val['0'];
        	}
        }
        $dcol_content = json_encode($darr);
        // var_dump($dcol_content);
        // exit;
        $data_desc = array('is_lead'=>$is_lead,'head_id'=>$lead,'secretary_id'=>$mishu,'office_address'=>$office,'reception_time'=>$reception_time,'is_smo'=>$smo,'is_prior'=>$prior,'prior_list'=>$prior_list,'is_despatch'=>$despatch,'is_fees'=>$is_fees,'fees'=>$fees,'invoice'=>$invoice,'is_lead_heredity'=>$lead_hereditys,'cost'=>$cost,'crc_require'=>$crc_require,'is_dpletter'=>$dpletter,'dcontent'=>$dcol_content);

        //接待表的数据
        $jiedai = array('inst_id'=>$instId,'is_reception'=>$reception,'datetime'=>$reception_time,'receiver'=>$user,'phone'=>$phone,'email'=>$email,'position'=>$position,'status'=>1);
    	
        //修改之前查询原来数据
        $oldDatas = $this->instmodel->get_one($id,$table='inst_detail');
    	$oldData = json_encode($oldDatas);
    	$rid = $oldDatas['is_reception'];
    	//修订的数据
    	$newData = json_encode($data_desc);
    	$rdata = array('inst_id'=>$instId,'add_time'=>time(),'old_content'=>$oldData,'revise_content'=>$newData,'revise_man'=>$uname.','.$uid,'revise_type'=>'instoffice');
    	$xiuding = $this->instmodel->add($rdata,$table='inst_datarevise');
    	// echo $xiuding;
    	// 机构详情修改
        $detail_info = $this->instmodel->edit($data_desc,$id,$table='inst_detail');
        //接待表修改
        $this->instmodel->edit($jiedai,$rid,$table='reception');
        unset($data_desc);
        unset($rdata);
        if(!$info) {
        	go('/index.php/admin/institution/detail_institution?id='.$instId, '修改成功', GO_SUCCESS);
        }else{
        	inst_go('/index.php/admin/institution/edit_instoffice?instId='.$instId.'&id='.$id , '修改失败，请重新修改', GO_ERROR);
        }

    }

    /**
     * 删除机构信息-
     * @return [type] [description]
     */
    public function change_inst_status()
    {
    	$this->checkauth('add_institution');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = $this->input->get('id');
    	$table = $this->input->get('table');
    	if(empty($table)){
    		$table= 'inst';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>0);
    	$result = $this->funcmodel->edit($table,$data,$where);
    	// var_dump($result);
    	if(!$result){
            go('/index.php/admin/institution/institution_list', '删除失败，请重新删除', GO_ERROR);
        } else {
            go('/index.php/admin/institution/institution_list', '删除成功', GO_SUCCESS);
        }
    	
    }

    /**
     * 改变状态-
     * @return [type] [description]
     */
    public function change_status()
    {
    	$this->checkauth('add_position');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = intval($this->input->get('id'));
    	$table = $this->input->get('table');
    	$status = intval($this->input->get('state'));
    	if(empty($table)){
    		$table= 'inst';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>$status);
    	$result = $this->funcmodel->edit($table,$data,$where);
    	// var_dump($result);
    	if(!$result){
            go('/index.php/admin/institution/position_list', '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/position_list', '操作成功', GO_SUCCESS);
        }
    	
    }
   

    /**
     * 添加机构人员页面-
     * @return [type] [description]
     */
    public function add_member()
    {
    	$this->checkauth('add_member');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$inst = $this->inst_name();   	
    	$data['inst']=$inst;
    	$id =intval($this->input->get('id'));
    	if(isset($id)){
    		$result = $this->instmodel->get_one($where=$id,$table='inst_member');
    		$data['member'] = $result;
    		$data['col_inst'] = json_decode($result['mcontent'],true);
    	}
    	//新增字段
    	$cwhere = array('table'=>'inst_member','status'=>1);
    	$columns = $this->instmodel->get_all($cwhere,$table='columns');
    	$data['columns'] = $columns;
    	// var_dump($columns);
    	$instId = $result['inst_id'];
    	$where = array('inst_id'=>$instId);
    	$keshi = $this->instmodel->get_all($where,$table='dept');
    	$data['dept'] = $keshi;
    	$zhiwei = $this->instmodel->get_all($where,$table='position');
    	$data['position'] = $zhiwei;
    	// var_dump($result);
    	$this->load->view('admin/inst/member_add',$data);

    }



    /**
     * 添加修改机构人员-
     * @return [type] [description]
     */
    public function add_member_do()
    {
    	$this->checkauth('add_member');
    	$uid=$this->session->userdata('userid');
    	$username=$this->session->userdata('uname');
    	$this->load->model('funcmodel');
    	$this->load->model('instmodel');
    	$id = $this->input->post('memberId');
    	$uname  = $this->input->post('uname');
    	$instid = $this->input->post('instid');
    	$age = $this->input->post('age');
    	$position = $this->input->post('position');
    	$phone = $this->input->post('phone');
    	$email = $this->input->post('email');
    	$office_address = $this->input->post('office_address');
    	$in_charge = $this->input->post('in_charge');
    	$academy = $this->input->post('academy');
    	$graduation_time = strtotime($this->input->post('graduation_time'));
    	$major = $this->input->post('major');
    	$department = $this->input->post('department');
    	$character = $this->input->post('character');
    	$interest = $this->input->post('interest');
    	$sex = $this->input->post('sex');
    	$qualification =$this->input->post('qualification');
    	$where = array('id'=>$instid);
    	$inst = $this->funcmodel->get_one($table='inst',$where);
    	$instname = $inst['instname'];
    	//新加字段
    	$mcontent = $this->input->post('columns');
        if(count($mcontent)>=1){
        	foreach($mcontent as $key=>$val){
        		$marr[$val['1']] =$val['0'];
        	}
        }
        $mcol_content = json_encode($marr);
      
    	$data = array('name'=>$uname,'inst_id'=>$instid,'inst_name'=>$instname,'age'=>$age,'position'=>$position,'phone'=>$phone,'email'=>$email,'office_address'=>$office_address,'in_charge'=>$in_charge,'academy'=>$academy,'graduation_time'=>$graduation_time,'major'=>$major,'department'=>$department,'character'=>$character,'interest'=>$interest,'sex'=>$sex,'qualification'=>$qualification,'mcontent'=>$mcol_content,'status'=>1,'add_time'=>time());

    	if(empty($id)){
    		$result = $this->funcmodel->add($table='inst_member',$data);
    		unset($data);
    		// var_dump($result);
    		if (!$result) {
            	go('/index.php/admin/institution/add_member', '添加失败，请重新添加', GO_ERROR);
	        } else {
	            go('/index.php/admin/institution/member_list', '添加成功', GO_SUCCESS);
	        }
    	}else{

    		//修改之前查询原来数据
	        $oldData = $this->instmodel->get_one($id,$table='inst_member');
	    	$oldData = json_encode($oldData);
	    	
	    	//修订的数据
	    	$newData = json_encode($data);
	    	$rdata = array('inst_id'=>$instid,'inst_name'=>$instname,'add_time'=>time(),'old_content'=>$oldData,'revise_content'=>$newData,'revise_man'=>$username.','.$uid,'revise_type'=>'inst_member');
	    	$xiuding = $this->instmodel->add($rdata,$table='inst_datarevise');
	    	unset($oldData);
	    	unset($newData);
	    	unset($$rdata);
	    	//修改机构人员
    		$where = array('id'=>$id);
    		$result = $this->funcmodel->edit($table='inst_member',$data,$where);
    		unset($data);
    		if (!$result) {
	            inst_go('/index.php/admin/institution/add_member?instId='.$instid.'&id='.$id, '修改失败，请重新修改', GO_ERROR);
	        } else {
	            go('/index.php/admin/institution/member_list', '修改成功', GO_SUCCESS);
	        }
    	}
    	// var_dump($result);
    	
    }

    /**
     * 机构人员列表-
     * @return [type] [description]
     */
    public function member_list(){
    	$this->checkauth('member_list');
    	$data['cdn']=$this->cdn;
    	$this->load->model('instmodel');
    	$this->load->helper('Page');
    	$where      = array();
        $page_where = '';
        // 需要模糊查询的名称
        $search     = trim($this->input->get_post('search'));
        if (isset($search ) && $search ) {
            $where['search'] = $search ;
            $where['column'] = 'name'; 
            $page_where      = 'search =' . $search;
        }
        $inst = $this->instmodel->get_all($id='');
        $data['inst'] = $inst;
        $inst_id = $this->input->get_post('instid');
        if(isset($inst_id) && $inst_id){
        	$where['inst_id'] = $inst_id;
        	$page_where      = 'inst_id =' . $inst_id;
        }
        // var_dump($where);
        $where['status'] = 1;
        //查询到的总条数
        $count = $this->instmodel->count($where,$table='inst_member');
        $p = new page($count,10,$page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
    	$result = $this->instmodel->get_all($where,$table='inst_member',$p->firstRow, $p->listRows);
    	$data['member'] = $result;
    	$data['typeid'] = $inst_id;
    	// var_dump($result);
    	$this->load->view('admin/inst/member_list',$data);
    }


    /**
     * 机构人员详情-
     * @return [type] [description]
     */
    public function detail_member()
    {
    	$this->checkauth('member_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = $this->input->get('id');
    	$where = array('id'=>$id);
    	$info = $this->funcmodel->get_one($table='inst_member',$where);
    	$wdept = array('id'=>$info['department']);
    	$dept = $this->funcmodel->get_one($table='dept',$wdept);
    	$wpos = array('id'=>$info['position']);
    	$position = $this->funcmodel->get_one($table='position',$wpos);
    	$data['info'] = $info;
    	$data['dept'] = $dept['name'];
    	$data['position'] = $position['name'];
    	$mwhere = array('table'=>'inst_member','status'=>1);
    	//获取新增字段
    	$columns = $this->funcmodel->get_all($table='columns',$mwhere);
    	$data['columns'] = $columns;
    	$data['col_inst'] = json_decode($info['mcontent'],true);
    	// var_dump($data);
    	$this->load->view('admin/inst/member_detail',$data);
    }


    /**
     * 改变状态-
     * @return [type] [description]
     */
    public function change_member_status()
    {
    	$this->checkauth('add_position');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = intval($this->input->get('uid'));
    	$table = $this->input->get('table');
    	$status = intval($this->input->get('state'));
    	if(empty($table)){
    		$table= 'inst_member';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>$status);
    	$result = $this->funcmodel->edit($table,$data,$where);

    	if(!$result){
            go('/index.php/admin/institution/member_list', '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/member_list', '操作成功', GO_SUCCESS);
        }
    	
    }


    /**
     * 添加科室页面-
     * @return [type] [description]
     */
    public function add_dept()
    {
    	$this->checkauth('add_dept');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$inst = $this->inst_name();   	
    	$id =intval($this->input->get('id'));
    	if(isset($id) && !empty($id)){
    		$result = $this->instmodel->get_one($where=$id,$table='dept');
    		$data['dept'] = $result;
    		$data['dept_type'] = $result['dept_type']?explode(',',$result['dept_type']):'';
    		$data['col_inst'] = json_decode($result['pcontent'],true);
    	}
    	$pwhere = array('table'=>'dept','status'=>1);
    	$columns = $this->instmodel->get_all($pwhere,$table='columns');
    	$data['columns'] = $columns;
    	$data['typelist']=$inst;
    	$data['type'] = dept_type();
    	$this->load->view('admin/inst/dept_add',$data);
    }

    /**
     * 添加科室-
     * @return [type] [description]
     */
    public function add_dept_do()
    {
    	$this->checkauth('add_dept');
    	$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$this->load->model('instmodel');
    	$id = intval($this->input->post('id'));
    	$name = trim($this->input->post('name'));
    	$inst = explode(',',$this->input->post('instid'));
    	$instId = $inst['0'];
    	$instname = $inst['1'];
    	$dept_type = array_unique($this->input->post('dept_type'));
    	$dept_type = implode(',',$dept_type);
    	$address = $this->input->post('address');
    	$purview = $this->input->post('purview');
    	//新加字段
    	$pcontent = $this->input->post('columns');
        if(count($pcontent)>=1){
        	foreach($pcontent as $key=>$val){
        		$parr[$val['1']] =$val['0'];
        	}
        }
        $pcol_content = json_encode($parr);

    	$data =array('name'=>$name,'inst_id'=>$instId,'inst_name'=>$instname,'address'=>$address,'purview'=>$purview,'add_time'=>time(),'dept_type'=>$dept_type,'pcontent'=>$pcol_content,'status'=>1);
    	// var_dump($_POST);
    	// exit();
    	if(empty($id)){
    		$result = $this->funcmodel->add($table='dept',$data);
    		if(!$result){
	            go('/index.php/admin/institution/add_dept', '添加失败，请重新添加', GO_ERROR);
	        } else {
	            go('/index.php/admin/institution/dept_list', '添加成功', GO_SUCCESS);
	        }
    	}else{

    		//修改之前查询原来数据
	        $oldData = $this->instmodel->get_one($id,$table='dept');
	    	$oldData = json_encode($oldData);
	    	//修订的数据
	    	$newData = json_encode($data);
	    	$rdata = array('inst_id'=>$instId,'inst_name'=>$instname,'add_time'=>time(),'old_content'=>$oldData,'revise_content'=>$newData,'revise_man'=>$uname.','.$uid,'revise_type'=>'dept');
	    	$xiuding = $this->instmodel->add($rdata,$table='inst_datarevise');
	    	unset($oldData);
	    	unset($newData);
	    	unset($$rdata);

    		//修改科室
    		$where = array('id'=>$id);
    		$result = $this->funcmodel->edit($table='dept',$data,$where);
    		if(!$result){
	            go('/index.php/admin/institution/add_dept?id='.$id, '修改失败，请重新添加', GO_ERROR);
	        } else {
	            go('/index.php/admin/institution/dept_list', '修改成功', GO_SUCCESS);
	        }
    	}
    	
    	
    }

    /**
     * 科室列表-
     * @return [type] [description]
     */
    public function dept_list()
    {
    	$this->checkauth('dept_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$this->load->helper('Page');
    	$inst = $this->instmodel->get_all();
    	$download = $this->input->get_post('excle');
    	$orderBy = $this->input->get_post('orderby');
    	$data['inst'] = $inst;
    	// var_dump($inst);
    	$where      = array();
        $page_where = '';
        // 需要模糊查询的名称
        $search     = trim($this->input->get_post('search'));
        if (isset($search ) && $search ) {
            $where['search'] = $search ;
            $where['column'] = 'dept.name'; 
            $page_where      = 'dept.name =' . $search;
        }
        $typeid    = trim($this->input->get_post('instid'));
        if (isset($typeid ) && $typeid ) {
        	$where['dept.inst_id'] = $typeid;
            $page_where      = 'dept.inst_id =' . $typeid;
        }
        $type = trim($this->input->get_post('type'));
        if (isset($type ) && $type ) {
            $where['search'] = $type ;
            $where['column'] = 'dept.dept_type'; 
            $page_where      = 'dept.dept_type =' . $type;
        }


        //查询到的总条数
        $count = $this->instmodel->count($where,$table='dept');
        $p = new page($count,10,$page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
        $data['typeid']   = $typeid;
        $data['type']     = $type;
        $data['where'] = json_encode($where);
    	// $result = $this->instmodel->get_all($where,$table='dept',$p->firstRow, $p->listRows);
    	$link = 'dept.inst_id=inst.id';
    	$columns = 'dept.id,dept.name,inst.instname,dept.address,dept.purview,dept.status';
    	$this->db->order_by('id',$orderBy);
    	$result = $this->instmodel->join($where,$table=array('dept','inst'),$link,$columns,$p->firstRow, $p->listRows);
    	// var_dump($result);
    	$data['deptlist'] = $result;
    	//导出excel
    	if($download){
    		// var_dump($where);
    		// $where = json_decode($this->input->get('where'),true);
    		$link = 'dept.inst_id=inst.id';
    		$columns = 'dept.id,dept.name,inst.instname,dept.address,dept.purview,dept.dept_type,dept.status';
    		$list = $this->instmodel->join($where,$table=array('dept','inst'),$link,$columns);
    		$title = array('编号','科室名称','机构名称','科室地址','治疗范围','科室分类','状态');
    		$filename = date('Y-m-d',time()).'科室列表';
    		// var_dump($result1);
    		$this->export_excel_help($title,$list,$filename);
    	}
    	$this->load->view('/admin/inst/dept_list',$data);
    }

    /**
     * 科室详情-
     * @return [type] [description]
     */
    public function detail_dept()
    {
    	$this->checkauth('dept_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$id = $this->input->get('id');
    	$info = $this->instmodel->get_one($id,$table='dept');
    	$instid = $info['inst_id'];
    	$inst = $this->instmodel->get_one($instid);
    	$data['inst'] = $inst;
    	//获取职位
    	$pwhere = array('status'=>1);
    	$position = $this->instmodel->get_all($pwhere,$table='position');
    	foreach ($position as $key => $value) {
    		$parr[$value['id']] = $value['name'];
    	}
    	$data['parr'] = $parr;
    	$where = array('dept_id'=>$id,'status'=>1);
    	$member = $this->instmodel->get_all($where,$table='dept_member');
    	$data['member'] = $member;
    	
    	$data['info'] = $info;
    	$data['dept_type'] = $info['dept_type']?explode(',',$info['dept_type']):'';
    	//新增字段
    	$columns = $this->instmodel->get_all($pwhere,$table='columns');
    	$data['columns'] = $columns;
    	$data['col_inst'] = json_decode($info['pcontent'],true);

    	$this->load->view('admin/inst/dept_detail',$data);
    }

    /**
     * 改变状态-
     * @return [type] [description]
     */
    public function change_dept_status()
    {
    	$this->checkauth('add_position');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = intval($this->input->get('id'));
    	$table = $this->input->get('table');
    	$status = intval($this->input->get('state'));
    	if(empty($table)){
    		$table= 'dept';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>$status);
    	$result = $this->funcmodel->edit($table,$data,$where);

    	if(!$result){
            go('/index.php/admin/institution/dept_list', '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/dept_list', '操作成功', GO_SUCCESS);
        }
    	
    }

    /**
     * 科室成员删除-
     * @return [type] [description]
     */
    public function change_deptmember()
    {
    	$this->checkauth('add_position');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = intval($this->input->get('id'));
    	$table = $this->input->get('table');
    	$status = intval($this->input->get('state'));
    	if(empty($table)){
    		$table= 'dept_member';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>0);
    	$result = $this->funcmodel->edit($table,$data,$where);

    	if(!$result){
            go('/index.php/admin/institution/detail_dept?id='.$id, '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_dept?id='.$id, '操作成功', GO_SUCCESS);
        }
    }



    /**
     * 添加科室成员页面pi，sub-i-
     * @return [type] [description]
     */
    public function add_deptmember()
    {
    	$this->checkauth('add_deptmember');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$inst = $this->inst_name();
    	$data['inst'] = $inst;
    	$id = intval($this->input->get('id'));
    	$dept = $this->instmodel->get_one($id,$table='dept');
    	$data['dept'] = $dept;
    	$deptuid = $this->input->get('uid');
    	$data['deptuid'] = $deptuid;
    	$uinfo = $this->instmodel->get_one($deptuid,$table='dept_member');
    	$data['member'] = $uinfo;
    	$inst_id = intval($this->input->get('instId'));
    	$where = array('inst_id'=>$inst_id,'status'=>1);
    	$postion = $this->instmodel->get_all($where,$table='position');
    	$data['postion'] = $postion;
    	// var_dump($postion);
    	//新字段
    	$pwhere = array('table'=>'dept_member','status'=>1);
    	$columns = $this->instmodel->get_all($pwhere,$table='columns');
    	$data['columns'] = $columns;
    	$data['col_inst'] = json_decode($uinfo['dmcontent'],true);
    	// var_dump($data['col_inst']);
    	$this->load->view('admin/inst/dept_addmembers',$data);
    }

    /**
     * 添加科室成员pi，sub-i-
     * @return [type] [description]
     */
    public function add_deptmember_do()
    {
    	$this->checkauth('add_deptmember');
    	// var_dump($_POST);
    	$this->load->model('funcmodel');
    	$uid = $this->input->post('uid');
    	$inst_id = $this->input->post('instid');
    	$deptid = $this->input->post('deptid');
    	$uname = $this->input->post('uname');
    	$position = $this->input->post('position');
    	$professor = $this->input->post('professor');
    	$identity = $this->input->post('identity');
    	$phone = $this->input->post('phone');
    	$email = $this->input->post('email');
    	$academy = $this->input->post('academy');
    	$graduation_time = strtotime($this->input->post('graduation_time'));
    	$major = $this->input->post('major');
    	$qualification = $this->input->post('qualification');
    	$character = $this->input->post('character');
    	$interest = $this->input->post('interest');
    	$advantage = $this->input->post('advantage');

    	//新加字段
    	$pcontent = $this->input->post('columns');
        if(count($pcontent)>=1){
        	foreach($pcontent as $key=>$val){
        		$parr[$val['1']] =$val['0'];
        	}
        }
        $pcol_content = json_encode($parr);

    	$data = array('dept_id'=>$deptid,'name'=>$uname,'position'=>$position,'professor'=>$professor,'identity'=>$identity,'phone'=>$phone,'email'=>$email,'academy'=>$academy,'graduation_time'=>$graduation_time,'major'=>$major,'qualification'=>$qualification,'character'=>$character,'interest'=>$interest,'advantage'=>$advantage,'dmcontent'=>$pcol_content,'add_time'=>time());
    	if(!$uid){
    		$result = $this->funcmodel->add($table='dept_member',$data);
    		if(!$result){
            	go('/index.php/admin/institution/add_deptmembers', '添加失败，请重新添加', GO_ERROR);
	        } else {
	            go('/index.php/admin/institution/detail_dept?id='.$deptid, '添加成功', GO_SUCCESS);
	        }

    	}else{
    		$where = array('id'=>$uid);
    		$result = $this->funcmodel->edit($table='dept_member',$data,$where);
    		if(!$result){
	            inst_go('/index.php/admin/institution/add_deptmember?uid='.$uid.'&id='.$deptid, '修改失败，请重新修改', GO_ERROR);
	        } else {
	            go('/index.php/admin/institution/detail_dept?id='.$deptid, '修改成功', GO_SUCCESS);
	        }
    	}
    	// var_dump($result);
    	
    }

    /**
     * 添加科室成员pi，sub-i-
     * @return [type] [description]
     */
    public function deptmber_detail()
    {
    	$this->load->model('instmodel');
    	$id = $this->input->get('uid');
    	$deptid = $this->input->get('id');
    	$where = array('id'=>$id,'dept_id'=>$deptid);
    	$result = $this->instmodel->get_one($where,$table='dept_member');
    	$wdept = array('id'=>$result['dept_id']);
    	$dept = $this->instmodel->get_one($wdept,$table='dept');
    	$data['deptmember'] = $result;
    	$data['dept'] = $dept['name'];
    	//获取所有的
    	$dwhere = array('status'=>1);
    	$columns = $this->instmodel->get_all($dwhere,$table='columns');
    	// var_dump($columns);
    	$data['columns'] = $columns;
    	$data['col_inst'] = json_decode($result['dmcontent'],true);
    	// var_dump($result);
    	$this->load->view('admin/inst/deptmber',$data);
    }



    /**
     * 机构职位管理-
     * @return [type] [description]
     */
    public function add_position()
    {
    	$this->checkauth('add_position');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$inst = $this->inst_name();   	
    	// var_dump($inst);
    	$data['instlist']=$inst;
    	$this->load->view('admin/inst/position_add',$data);
    }

    /**
     * 添加职位管理-
     * @return [type] [description]
     */
    public function add_position_do()
    {
    	$this->checkauth('add_position');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$inst = $this->inst_name();   	
    	$data['instlist']=$inst;
    	$name = $this->input->post('name');
    	$instid = $this->input->post('instid');

    	$wname = array('name'=>$name,'inst_id'=>$instid);
    	$is_name = $this->instmodel->get_one($wname,$table='position');
    	if($is_name){
    		go('/index.php/admin/institution/add_position', '已经有这个职位', GO_ERROR);
    	}

    	$desc = array('name'=>$name,'inst_id'=>$instid,'add_time'=>time(),'status'=>1);
    	$result = $this->instmodel->add($desc,$table='position');
    	if(!$result){
            go('/index.php/admin/institution/add_position', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/institution/position_list', '添加成功', GO_SUCCESS);
        }

    }

    /**
     * 职位列表管理-
     * @return [type] [description]
     */
    public function position_list()
    {
    	$this->checkauth('position_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$this->load->helper('Page');
       	$where      = array();
       	$where1 = array();
        $page_where = '';
        // 需要模糊查询的名称
        $search     = trim($this->input->get_post('search'));
        if (isset($search) && $search) {
            $where['search'] = $search;
            $where['column'] = 'inst.instname'; 
            $page_where      = 'search=' . $search;

            $whe['search'] =$search;
        	$whe['column'] ='instname';
        	$res = $this->instmodel->get_one($whe);
        	$where1['inst_id'] = $res['id'] ;
        }
        // var_dump($where);
        //查询到的总条数
        $count            = $this->instmodel->count($where1,$table='position');
        // var_dump($count);
        $p = new page($count,10,$page_where);
        // var_dump($p);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
        //获取数据
    	$link = 'position.inst_id=inst.id';
    	$columns = 'position.id,position.name,position.status,inst.instname';
    	$res = $this->instmodel->join($where,$table=array('position','inst'),$link,$columns,$p->firstRow, $p->listRows);
    	$data['position'] = $res;
    	// var_dump($res);
    	$this->load->view('admin/inst/position_list',$data);
    }
    /**
     * 职位修改管理-
     * @return [type] [description]
     */
    public function edit_position()
    {
    	$this->checkauth('add_position');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$id = $this->input->get('id');
    	$where = array('position.id'=>$id);
    	$link = 'position.inst_id=inst.id';
    	$columns = 'position.id,position.name,position.status,inst.instname,inst.id as instId';
    	$res = $this->instmodel->join($where,$table=array('position','inst'),$link,$columns);

    	$data['position'] = $res['0'];
    	// var_dump($res);
    	$this->load->view('admin/inst/position_edit',$data);
    }

    /**
     * 职位修改管理-
     * @return [type] [description]
     */

    public function edit_position_do()
    {
    	$this->checkauth('add_position');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$id = $this->input->post('id');
    	$name = $this->input->post('name');

    	$data = array('name'=>$name);
    	$res = $this->instmodel->edit($data,$id,$table='position');
    	if($res){
            go('/index.php/admin/institution/position_list', '修改成功', GO_SUCCESS);
        } else {
            go('/index.php/admin/institution/edit_position?id='.$id, '修改失败，请重新修改', GO_ERROR);
        }
    }

    /**
     * 一期病房表单-
     * @return [type] [description]
     */
    public function add_ward()
    {
    	$this->checkauth('add_ward');
        $data['cdn']      = $this->cdn;
        $this->load->model('instmodel');
    	$instId = $this->input->get('instId');
    	$result = $this->instmodel->get_one($instId);
    	// var_dump($result);
    	$data['inst'] = $result;
    	$where = array('inst_id'=>$instId);
    	$member = $this->instmodel->get_all($where,$table='inst_member');
    	$data['inst_member'] = $member;
    	$id = $this->input->get('id');
    	if(!empty($id)){
    		$res = $this->instmodel->get_one($id,$table='first_ward');
    		$data['info'] = $res;
    		$suid = explode(',',$res['secretary_id']);
	    	$huid = explode(',',$res['head_id']);
	    	$suser = $this->instmodel->get_in($table='inst_member',$suid,$columns='id');
	    	$huser = $this->instmodel->get_in($table='inst_member',$huid,$columns='id');
	    	$data['suser'] = $suser;
	    	$data['huser'] = $huser;
	    	$data['col_inst'] = json_decode($res['fcontent'],true);

    	}
    	$fwhere = array('table'=>'first_ward','status'=>1);
    	$columns = $this->instmodel->get_all($fwhere,$table='columns');
    	$data['columns'] = $columns;
    	// var_dump($columns);
    	$this->load->view('admin/inst/ward_add',$data);
    }

    /**
     * 添加一期病房-
     * @return [type] [description]
     */
    public function add_ward_do()
    {
    	// var_dump($_POST);
    	
    	$this->checkauth('add_ward');
    	$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
    	$this->load->model('instmodel');
    	$wardid = $this->input->post('wardid');
    	//详情表内容
        $inst = $this->input->post('instId');
        $instName = $this->input->post('instname');
        // list($id,$instname) = explode(',',$inst);
        $zizhi =strtotime($this->input->post('zizhi_time'));
        $beds = $this->input->post('beds');
        $office =$this->input->post('office');
        $smo =$this->input->post('smo');
        $prior =$this->input->post('prior');
        $prior_list =$this->input->post('prior_list');
        $despatch =$this->input->post('despatch');
        $is_fees =$this->input->post('is_fees');
        $fees =$this->input->post('fees');
        $reception =$this->input->post('reception');
        $lead = implode(',',array_unique($this->input->post('lead')));
        $mishu = implode(',',array_unique($this->input->post('mishu')));
        $reception_time = strtotime($this->input->post('reception_time'));

        //新加字段
    	$fcontent = $this->input->post('columns');
        if(count($fcontent)>=1){
        	foreach($fcontent as $key=>$val){
        		$farr[$val['1']] =$val['0'];
        	}
        }
        $fcol_content = json_encode($farr);
        // echo $fcol_content;
        // exit;
        $data = array('inst_id'=>$inst,'instname'=>$instName,'head_id'=>$lead,'secretary_id'=>$mishu,'qualify_time'=>$zizhi,'office_address'=>$office,'is_reception'=>$reception,'reception_time'=>$reception_time,'is_smo'=>$smo,'is_prior'=>$prior,'prior_list'=>$prior_list,'is_despatch'=>$despatch,'is_fees'=>$is_fees,'fees'=>$fees,'beds'=>$beds,'fcontent'=>$fcol_content,'add_time'=>time(),'status'=>1);
        if(empty($wardid)){
        	$info = $this->instmodel->add($data,$table='first_ward');
        	if(!$info){
	            go('/index.php/admin/institution/add_ward?instId='.$inst, '添加失败，请重新添加', GO_ERROR);
	        } else {
	            go('/index.php/admin/institution/detail_institution?id='.$inst, '添加成功', GO_SUCCESS);
	        }
        }else{

        	//修改之前查询原来数据
	        $oldData = $this->instmodel->get_one($wardid,$table='first_ward');
	    	$oldData = json_encode($oldData);
	    	
	    	//修订的数据
	    	$newData = json_encode($data);
	    	$rdata = array('inst_id'=>$inst,'add_time'=>time(),'old_content'=>$oldData,'revise_content'=>$newData,'revise_man'=>$uname.','.$uid,'revise_type'=>'first_ward');
	    	$xiuding = $this->instmodel->add($rdata,$table='inst_datarevise');
	    	// echo $xiuding;
	    	// 修改一期病房
        	$info = $this->instmodel->edit($data,$wardid,$table='first_ward');
        	unset($data);
        	unset($rdata);
        	if(!$info){
	            inst_go('/index.php/admin/institution/add_ward?instId='.$inst.'&id='.$wardid, '修改失败，请重新修改', GO_ERROR);
	        } else {
	            go('/index.php/admin/institution/detail_institution?id='.$inst, '修改成功', GO_SUCCESS);
	        }
        }   

    }

    /**
     * 一期病房列表-
     * @return [type] [description]
     */
    public function ward_list()
    {
    	$this->checkauth('ward_list');
    	$this->load->model('instmodel');
        $this->load->helper('Page');
        $data['cdn'] = $this->cdn;
       	$where      = array();
        $page_where = '';
        // 需要模糊查询的名称
        $search     = trim($this->input->get_post('search'));
        if (isset($search ) && $search ) {
            $where['instname'] = $search ;
            $where['search'] ='search';
            $page_where      = 'instnam =' . $search;
        }
        $where['status'] =1;
        //查询到的总条数
        $count            = $this->instmodel->count($where,$table='first_ward');
        $p = new page($count,10,$page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
        //获取数据
       	$res = $this->instmodel->get_all($where,$table='first_ward',$p->firstRow, $p->listRows);
       	$data['instlist'] = $res;
        // var_dump($res);
    	$this->load->view('admin/inst/ward_list',$data);
    }

    /**
     * 一期病房详情-
     * @return [type] [description]
     */
    public function detail_ward()
    {
    	$this->checkauth('ward_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$id = $this->input->get('id');
    	$inst = $this->input->get('instId');
    	$res = $this->instmodel->get_one($id,$table='first_ward');
    	$inst = $this->instmodel->get_one($inst);
    	$suid = explode(',',$res['secretary_id']);
    	$huid = explode(',',$res['head_id']);
    	$suser = $this->instmodel->get_in($table='inst_member',$suid,$columns='id');
    	$huser = $this->instmodel->get_in($table='inst_member',$huid,$columns='id');
    	$data['suser'] = $suser;
    	$data['huser'] = $huser;
    	$data['info'] = $res;
    	//新增字段
    	$fwhere = array('table'=>'first_ward','status'=>1);
    	$columns = $this->instmodel->get_all($fwhere,$table='columns');
    	$data['columns'] = $columns;
    	$data['col_inst'] = json_decode($res['fcontent'],true);
    	$this->load->view('admin/inst/ward_detail',$data);
    }

    //删除一期病房
    public function change_firstward_status()
    {
    	$this->checkauth('add_ward');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = $this->input->get('id');
    	$instid = $this->input->get('instId');
    	if(empty($table)){
    		$table= 'first_ward';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>0);
    	$result = $this->funcmodel->edit($table,$data,$where);
    	// var_dump($result);
    	if(!$result){
            go('/index.php/admin/institution/detail_institution?id='.$instid, '删除失败，请重新删除', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instid, '删除成功', GO_SUCCESS);
        }
    }

    /**
     * 添加机构负者人页面-
     * @return [type] [description]
     */
    public function add_lead()
    {
    	$this->checkauth('add_lead');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$instId = $this->input->get('instId');
    	$res = $this->instmodel->get_one($instId);
    	$pid = $this->input->get('id');
    	$data['pid'] = $pid;
    	$data['inst'] = $res;
    	$where = array('inst_id'=>$instId);
    	$member = $this->instmodel->get_all($where,$table='inst_member');
    	$data['inst_member'] = $member;
    	$this->load->view('admin/inst/lead_add',$data);
    }

	/**
     * 添加机构负者人-
     * @return [type] [description]
     */
    public function add_lead_do()
    {
    	var_dump($_POST);
    	$this->checkauth('add_lead');
    	$this->load->model('instmodel');
    	$lead = array();
    	$instid = $this->input->post('instId');
    	echo $instid;
    	$did = $this->input->post('did');
    	$lead = $this->input->post('leadid');
    	$mishu = $this->input->post('mishu');
    	//获取表中是否已添加过数据
    	$result = $this->instmodel->get_one($did,$table='inst_detail');

    	if($result['secretary_id']){
    		$oldms =explode(',',$result['secretary_id']);
    		$arr = array_unique(array_merge($oldms,$mishu));
    		$mishu = implode(',',$arr);
    	}else{
    		$mishu = implode(',',array_unique($mishu));
    	}
    	$data = array('head_id'=>$lead,'secretary_id'=>$mishu);
    	if($result['head_id']){
    		array_shift($data);
    	}
    	// var_dump($data);
    	$info = $this->instmodel->edit($data,$did,$table='inst_detail');
    	
    	if(!$info){
            inst_go('/index.php/admin/institution/add_lead?instId='.$instid.'&id='.$did, '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instid, '添加成功', GO_SUCCESS);
        }
    }
    /**
     * 机构负者人列表-
     * @return [type] [description]
     */
    public function lead_list()
    {
    	$this->checkauth('lead_list');
    	$id = $this->input->get('instid');
    	var_dump($id);
    	$this->load->view('admin/inst/lead_list',$data);
    }

    /**
     * 添加立项页-
     * @return [type] [description]
     */
    public function add_project()
    {
    	$this->checkauth('add_project');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	// $inst = $this->inst_name();
    	$uid = $this->input->get('id');
    	$id = $this->input->get('instId');
    	$inst = $this->instmodel->get_one($id);
    	$data['inst'] = $inst;
    	$inst_member = $this->inst_member($id);
    	$data['inst_member'] = $inst_member;
    	if($uid){
    		$where = array('id'=>$uid,'inst_id'=>$id);
    		$result = $this->instmodel->get_one($where,$table='project');
    		$uarr = explode(',',$result['charge_id']);
    		$columns = 'id';
    		//$uarr 是需要查的id
    		$user = $this->instmodel->get_in($table='inst_member',$uarr,$columns);
    		$data['col_inst'] = json_decode($result['jcontent'],true);
    	}
    	$data['project'] =$result;
    	$data['user'] = $user;
    	$pwhere = array('table'=>'project','status'=>1);
    	$content = $this->instmodel->get_all($pwhere,$table='columns');
    	$data['columns'] = $content;
    	// var_dump($data['columns']);
    	$this->load->view('admin/inst/project_add',$data);
    }

    /**
     * 机构添加立项-
     * @return [type] [description]
     */
    public function add_project_do()
    {
    	$this->checkauth('add_project');
    	$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
    	$this->load->model('instmodel');
    	$pid = $this->input->post('pid');
    	$instId = $this->input->post('instid');
    	$jiedai_time = strtotime($this->input->post('jiedai_time'));
    	$address = $this->input->post('address');
    	$url = $this->input->post('url');
    	$remark = $this->input->post('remark');
    	$doc_require = $this->input->post('doc_require');
    	$typeid = 0;
    	$lead = array_unique($this->input->post('lead'));
    	$leadstr = implode(',',$lead);
    	//获取上传的文件名
    	$procedure=$_FILES['procedure']["name"];

    	//新加字段
    	$jcontent = $this->input->post('columns');
        if(count($jcontent)>=1){
        	foreach($jcontent as $key=>$val){
        		$jarr[$val['1']] =$val['0'];
        	}
        }
        $jcol_content = json_encode($jarr);
    		
    	$data = array('inst_id'=>$instId,'type_id'=>$typeid,'reception_time'=>$jiedai_time,'address'=>$address,'charge_id'=>$leadstr,'url'=>$url,'require'=>$doc_require,'remarks'=>$remark,'jcontent'=>$jcol_content,'add_time'=>time(),'status'=>1);
    	if(empty($pid)){
    		
    		if($procedure==null||$procedure==""){
				 go('/index.php/admin/institution/add_project?instId='.$instId, '文档未上传！');
				exit;
			}
			$file=$this->upload_path('procedure','project');
    		$data['procedure'] = $file;

    		$info = $this->instmodel->add($data,$table='project');
    		if(!$info){
	            inst_go('/index.php/admin/institution/add_project?instId='.$instId.'&id='.$pid, '添加失败，请重新添加', GO_ERROR);
	        } else {
	            go('/index.php/admin/institution/detail_institution?id='.$instId, '添加成功', GO_SUCCESS);
	        }
    	}else{
    		if($procedure!=null||$procedure!=""){
				 // go('/index.php/admin/institution/add_closeinst?instId='.$id, '文档未上传！');
				// exit;
				$file=$this->upload_path('procedure','project');
				$data['procedure'] = $file;
			}

			//修改之前查询原来数据
	        $oldData = $this->instmodel->get_one($pid,$table='project');
	    	$oldData = json_encode($oldData);
	    	
	    	//修订的数据
	    	$newData = json_encode($data);
	    	$rdata = array('inst_id'=>$instId,'add_time'=>time(),'old_content'=>$oldData,'revise_content'=>$newData,'revise_man'=>$uname.','.$uid,'revise_type'=>'project');
	    	$xiuding = $this->instmodel->add($rdata,$table='inst_datarevise');
	    	// echo $xiuding;
	    	//修改立项
    		$info = $this->instmodel->edit($data,$pid,$table='project');
    		if(!$info){
	            inst_go('/index.php/admin/institution/add_project?instId='.$instId.'&id='.$pid, '添加失败，请重新添加', GO_ERROR);
	        } else {
	            go('/index.php/admin/institution/detail_institution?id='.$instId, '添加成功', GO_SUCCESS);
	        }
    	}

    	
    	
    }

    /**
     * 查看立项详情-
     * @return [type] [description]
     */
    public function detail_project()
    {
    	$this->checkauth('detail_project');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$id = $this->input->get('id');
    	$instid = $this->input->get('instId');
    	$data['instid'] = $instid;
    	$where = array('id'=>$id,'inst_id'=>$instid);
    	$result = $this->instmodel->get_one($where,$table='project');
    	$uid = explode(',',$result['charge_id']);
    	$res = $this->instmodel->get_in($table='inst_member',$uid,$columns='id');
    	// var_dump($result);
    	$data['info'] = $result;
    	$data['uid'] = $res;
    	//获取新字段
    	$pwhere = array('status'=>1);
    	$data['columns'] = $this->instmodel->get_all($pwhere,$table='columns');
    	$data['col_inst'] = json_decode($result['jcontent'],true);
    	$this->load->view('admin/inst/project_detail',$data);
    }

    /**
     * 删除立项详情-
     * @return [type] [description]
     */
    public function change_project_status()
    {
    	$this->checkauth('add_project');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = $this->input->get('id');
    	$instid = $this->input->get('instId');
    	if(empty($table)){
    		$table= 'project';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>0);
    	$result = $this->funcmodel->edit($table,$data,$where);
    	// var_dump($result);
    	if(!$result){
            go('/index.php/admin/institution/detail_institution?id='.$instid, '删除失败，请重新删除', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instid, '删除成功', GO_SUCCESS);
        }

    }

    /**
     * 机构添加伦理页-
     * @return [type] [description]
     */
    public function add_ethic()
    {
    	$this->checkauth('add_ethic');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	// $inst = $this->inst_name();
    	$uid = $this->input->get('id');
    	$id = $this->input->get('instId');
    	$inst = $this->instmodel->get_one($id);
    	$data['inst'] = $inst;
    	$inst_member = $this->inst_member($id);
    	$data['inst_member'] = $inst_member;
    	if($uid){
    		$where = array('id'=>$uid,'inst_id'=>$id);
    		$result = $this->instmodel->get_one($where,$table='project');
    	}
    	$data['project'] =$result;
    	$this->load->view('admin/inst/ethic_add',$data);
    }

    /**
     * 机构添加伦理-
     * @return [type] [description]
     */
    public function add_ethic_do()
    {
    	$this->checkauth('add_ethic');
    	$this->load->model('instmodel');
    	$instid = $this->input->post('instid');
    	$jiedai_time = strtotime($this->input->post('jiedai_time'));
    	$linkman = implode(',',array_unique($this->input->post('lead')));
    	// $doc = $this->input->post('doc');
    	$doc_require = $this->input->post('doc_require');
    	$approval = $this->input->post('approval');
    	$rate = $this->input->post('rate');
    	$meeting = $this->input->post('meeting');
    	$quicktrial = $this->input->post('quicktrial');
    	$time = $this->input->post('time');
    	$ethic_time = implode('@',$time);
    	// exit;
    	$procedure=$_FILES['procedure']["name"];
    	if($procedure==null||$procedure==""){
				 go('/index.php/admin/institution/add_ethic?instId='.$instid, '文档未上传！');
				exit;
			}
    	$file=$this->upload_path('procedure','ethic');


    	$data = array('inst_id'=>$instid,'reception_time'=>$jiedai_time,'linkman'=>$linkman,'procedure'=>$file,'require'=>$doc_require,'approval'=>$approval,'frequency'=>$rate,'huifei'=>$meeting,'kuaishen'=>$quicktrial,'ethic_time'=>$ethic_time,'add_time'=>time(),'status'=>1);
    	$result = $this->instmodel->add($data,$table='ethic');
    	// var_dump($result);
    	if(!$result){
            go('/index.php/admin/institution/add_ethic?instId='.$instid, '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instid, '添加成功', GO_SUCCESS);
        }
    }

    /**
     * 机构伦理详情-
     * @return [type] [description]
     */
    public function detail_ethic()
    {
    	$this->checkauth('detail_ethic');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$id = $this->input->get('id');
    	$instid = $this->input->get('instId');
    	$where = array('id'=>$id,'inst_id'=>$instid);
    	$result = $this->instmodel->get_one($where,$table='ethic');
    	$result['procedure'] = explode('||',$result['procedure']);
    	$result['ethic_time'] = str_replace('@',' &nbsp; &nbsp;',$result['ethic_time']);
    	$uid = explode(',',$result['linkman']);
    	$res = $this->instmodel->get_in($table='inst_member',$uid,$columns='id');
    	// var_dump($result);
    	$data['info'] = $result;
    	$data['instid'] = $instid;
    	$data['uid'] = $res;
    	$this->load->view('admin/inst/ethic_detail',$data);
    }

    /**
     * 机构伦理修改-
     * @return [type] [description]
     */
    public function edit_ethic()
    {
    	$this->checkauth('add_ethic');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	// $inst = $this->inst_name();
    	$eid = $this->input->get('id');
    	$id = $this->input->get('instId');
    	$inst = $this->instmodel->get_one($id);
    	$data['inst'] = $inst;
    	$inst_member = $this->inst_member($id);
    	$data['inst_member'] = $inst_member;
    	if($eid){
    		$where = array('id'=>$eid,'inst_id'=>$id);
    		$result = $this->instmodel->get_one($where,$table='ethic');
    		$uid = explode(',',$result['linkman']);
    		$user = $this->instmodel->get_in($table='inst_member',$uid,$columns='id');
    		$result['ethic_time'] =explode('@',$result['ethic_time']);
    	}
    	var_dump($result);
    	$data['ethic'] =$result;
    	$data['user'] = $user;
    	// var_dump($user);
    	$this->load->view('admin/inst/ethic_edit',$data);
    }

    //修改伦理
    public function edit_ethic_do()
    {
    	$this->checkauth('add_ethic');
    	$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
    	$this->load->model('instmodel');
    	$eid = $this->input->post('eid');
    	$instid = $this->input->post('instid');
    	$jiedai_time = strtotime($this->input->post('jiedai_time'));
    	$linkman = implode(',',array_unique($this->input->post('lead')));
    	$doc_require = $this->input->post('doc_require');
    	$approval = $this->input->post('approval');
    	$rate = $this->input->post('rate');
    	$meeting = $this->input->post('meeting');
    	$quicktrial = $this->input->post('quicktrial');
    	$time = $this->input->post('time');
    	$ethic_time = implode('@',$time);
    	$data = array('id'=>$eid,'reception_time'=>$jiedai_time,'linkman'=>$linkman,'require'=>$doc_require,'approval'=>$approval,'frequency'=>$rate,'huifei'=>$meeting,'kuaishen'=>$quicktrial,'ethic_time'=>$ethic_time,'add_time'=>time());

    	$procedure=$_FILES['procedure']["name"];

    	if($procedure!=null||$procedure!=""){

				$file=$this->upload_path('procedure','ethic');

	    // 			exit;
				$data['procedure'] = $file;
			}

		//修改之前查询原来数据
        $oldData = $this->instmodel->get_one($eid,$table='ethic');
    	$oldData = json_encode($oldData);
    	//修订的数据
    	$newData = json_encode($data);
    	$rdata = array('inst_id'=>$instid,'add_time'=>time(),'old_content'=>$oldData,'revise_content'=>$newData,'revise_man'=>$uname.','.$uid,'revise_type'=>'ethic');
    	$xiuding = $this->instmodel->add($rdata,$table='inst_datarevise');

    	//修改伦理
    	$result = $this->instmodel->edit($data,$eid,$table='ethic');
    	unset($data);
    	unset($rdata);
    	// var_dump($result);
    	if(!$result){
            inst_go('/index.php/admin/institution/edit_ethic?instId='.$instid.'&id='.$eid, '修改失败，请重新修改', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instid, '修改成功', GO_SUCCESS);
        }
    }
    //文件上传
    public function detail_file_do()
    {
    	$this->load->model('instmodel');
    	// var_dump($_FILES);
    	$procedure=$_FILES['procedure']["name"];
    	$id = $this->input->post('id');
    	$instId = $this->input->post('instid');
    	$ethic = $this->instmodel->get_one($id,$table='ethic');
    	$oldFile = $ethic['procedure'];

    	if($procedure!=null||$procedure!=""){
			$file=$this->upload_path('procedure','ethic');
			// var_dump($file);
			// 	exit;
			if(isset($file['error'])){
				inst_go('/index.php/admin/institution/detail_ethic?instId='.$instId.'&id='.$id, $file['error']);
			}
    		if(!$oldFile){
				$data['procedure'] = $file;
			}else{
				$data['procedure'] = $oldFile.'||'.$file;
			}
			$res = $this->instmodel->edit($data,$id,$table='ethic');
			// exit;
		}else{
			inst_go('/index.php/admin/institution/detail_ethic?instId='.$instId.'&id='.$id, '没有上传文件，请添加文件', GO_ERROR);
		}
		if(!$res){
            inst_go('/index.php/admin/institution/detail_ethic?instId='.$instId.'&id='.$id, '上传失败，请重新上传', GO_ERROR);
        } else {
            inst_go('/index.php/admin/institution/detail_ethic?instId='.$instId.'&id='.$id, '上传成功', GO_SUCCESS);
        }

    }

    /**
     * 删除伦理会-
     * @return [type] [description]
     */
    public function change_ethic_status()
    {
    	$this->checkauth('add_ethic');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = $this->input->get('id');
    	$instId = $this->input->get('instId');
    	if(empty($table)){
    		$table= 'ethic';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>0);
    	$result = $this->funcmodel->edit($table,$data,$where);
    	// var_dump($result);
    	if(!$result){
            go('/index.php/admin/institution/detail_institution?id='.$instId, '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instId, '操作成功', GO_SUCCESS);
        }
    }

    /**
     * 添加遗传办页面-
     * @return [type] [description]
     */
    public function add_heredity()
    {
    	$this->checkauth('add_heredity');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$inst = $this->input->get('instId');
    	// $res = $this->instmodel->get_one($inst_id);
    	$data['instId'] = $inst;
    	// $inst_member = $this->inst_member($id);
    	// $data['inst_member'] = $inst_member;
    	// var_dump($inst);
    	$this->load->view('admin/inst/heredity_add',$data);
    }


    /**
     * 添加遗传办-
     * @return [type] [description]
     */
    public function add_heredity_do()
    {
    	$this->checkauth('add_heredity');
    	$this->load->model('instmodel');
    	$instId = $this->input->post('instId');
    	$address = $this->input->post('address');
    	$is_lead = $this->input->post('is_lead');
    	$cost = $this->input->post('cost');
    	$number = $this->input->post('number');
    	$remarks = $this->input->post('remarks');
    	$data = array('inst_id'=>$instId,'address'=>$address,'is_lead'=>$is_lead,'cost'=>$cost,'number'=>$number,'procedure'=>$procedure,'remarks'=>$remarks,'add_time'=>time());
    	$procedure=$_FILES['procedure']["name"];
    	if($procedure==null||$procedure==""){
				 go('/index.php/admin/institution/add_heredity?instId='.$instId, '文档未上传！');
				exit;
			}
    	$file=$this->upload_path('procedure','heredity');

    	$data = array('inst_id'=>$instId,'address'=>$address,'is_lead'=>$is_lead,'cost'=>$cost,'number'=>$number,'procedure'=>$file,'remarks'=>$remarks,'add_time'=>time(),'status'=>1);

    	$result = $this->instmodel->add($data,$table='heredity');	
    	// var_dump($result);
    	if(!$result){
            go('/index.php/admin/institution/add_heredity?instId='.$instId, '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instId, '添加成功', GO_SUCCESS);
        }
    }

    /**
     * 遗传办详情-
     * @return [type] [description]
     */
    public function detail_heredity()
    {
    	$this->checkauth('detail_heredity');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$id = $this->input->get('id');
    	$instid = $this->input->get('instId');
    	$inst = $this->instmodel->get_one($instid);
    	$data['inst'] = $inst;
    	$where = array('id'=>$id,'inst_id'=>$instid);
    	$result = $this->instmodel->get_one($where,$table='heredity');
    	// var_dump($inst);
    	$data['heredity'] = $result;
    	$this->load->view('admin/inst/heredity_detail',$data);
    }

    /**
     * 修改遗传办页面-
     * @return [type] [description]
     */
    public function edit_heredity()
    {
    	$this->checkauth('add_heredity');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$inst = $this->input->get('instId');
    	$hid = $this->input->get('id');
    	$res = $this->instmodel->get_one($hid,$table='heredity');
    	$data['heredity'] = $res;
    	$data['instId'] = $inst;
    	// $inst_member = $this->inst_member($id);
    	// $data['inst_member'] = $inst_member;
    	// var_dump($res);
    	$this->load->view('admin/inst/heredity_edit',$data);
    }

    /**
     * 修改遗传办-
     * @return [type] [description]
     */
    public function edit_heredity_do()
    {
    	$this->checkauth('add_heredity');
    	$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
    	$this->load->model('instmodel');
    	$hid = $this->input->post('hid');
    	$instId = $this->input->post('instId');
    	$address = $this->input->post('address');
    	$is_lead = $this->input->post('is_lead');
    	$cost = $this->input->post('cost');
    	$number = $this->input->post('number');
    	// $procedure = $this->input->post('procedure');
    	$remarks = $this->input->post('remarks');
    	$data = array('address'=>$address,'is_lead'=>$is_lead,'cost'=>$cost,'number'=>$number,'procedure'=>$procedure,'remarks'=>$remarks,'add_time'=>time(),'status'=>1);

    	$procedure=$_FILES['procedure']["name"];
    	// var_dump($procedure);
    	if($procedure!=null||$procedure!=""){
				 // go('/index.php/admin/institution/add_closeinst?instId='.$id, '文档未上传！');
				// exit;
				$file=$this->upload_path('procedure','procedure');
				$data['procedure'] = $file;
			}

		//修改之前查询原来数据
        $oldData = $this->instmodel->get_one($hid,$table='heredity');
    	$oldData = json_encode($oldData);
    	//修订的数据
    	$newData = json_encode($data);
    	$rdata = array('inst_id'=>$instId,'add_time'=>time(),'old_content'=>$oldData,'revise_content'=>$newData,'revise_man'=>$uname.','.$uid,'revise_type'=>'heredity');
    	$xiuding = $this->instmodel->add($rdata,$table='inst_datarevise');
    	unset($data);
    	unset($rdata);
		//修改遗传办
    	$result = $this->instmodel->edit($data,$hid,$table='heredity');	
    	// var_dump($result);
    	if(!$result){
            inst_go('/index.php/admin/institution/edit_heredity?instId='.$instid.'&id='.$hid, '修改失败，请重新修改', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instId, '修改成功', GO_SUCCESS);
        }
    }

    /**
     * 删除遗传办-
     * @return [type] [description]
     */
    public function change_heredity_status()
    {
    	$this->checkauth('add_heredity');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = $this->input->get('id');
    	$instId = $this->input->get('instId');
    	if(empty($table)){
    		$table= 'heredity';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>0);
    	$result = $this->funcmodel->edit($table,$data,$where);
    	// var_dump($result);
    	if(!$result){
            go('/index.php/admin/institution/detail_institution?id='.$instId, '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instId, '操作成功', GO_SUCCESS);
        }
    }

    /**
     * 添加合同页面-
     * @return [type] [description]
     */
    public function add_contract()
    {	
    	$this->checkauth('add_contract');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$inst = $this->input->get('instId');
    	$res = $this->instmodel->get_one($inst);
    	$data['inst'] = $res;
    	$data['instId'] = $inst;
    	$inst_member = $this->inst_member($inst);
    	$data['inst_member'] = $inst_member;
    	// var_dump($inst);
    	$this->load->view('admin/inst/contract_add',$data);
    }

    /**
     * 添加合同-
     * @return [type] [description]
     */
    public function add_contract_do()
    {
    	$this->checkauth('add_contract');
    	var_dump($_POST);
    	$this->load->model('instmodel');
    	$instId = $this->input->post('instId');
    	$linkman = $this->input->post('linkman');
    	$address = $this->input->post('address');
    	$tel = $this->input->post('tel');
    	$is_contract = $this->input->post('is_contract');
    	$is_answer = $this->input->post('is_answer');
    	$contract_type = $this->input->post('contract_type');

    	$procedure=$_FILES['procedure']["name"];
    	$tel_contract=$_FILES['tel_contract']["name"];
    	if($procedure==null||$procedure==""){
				 go('/index.php/admin/institution/add_contract?instId='.$instId, '文档未上传！');
				exit;
			}
		if($tel_contract==null||$tel_contract==""){
			 go('/index.php/admin/institution/add_contract?instId='.$instId, '文档未上传！');
			exit;
		}
    	$file=$this->upload_path('procedure','contract');
    	$file1=$this->upload_path('tel_contract','contract');
    	$data = array('inst_id'=>$instId,'charge'=>$linkman,'address'=>$address,'process'=>$file,'is_templet'=>$tel,'tel_contract'=>$file1,'is_contract'=>$is_contract,'is_answer'=>$is_answer,'contract_type'=>$contract_type,'add_time'=>time(),'status'=>1);

    	$result = $this->instmodel->add($data,$table='contract');
    	if(!$result){
            go("/index.php/admin/institution/add_contract?instId=$instId", '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instId, '添加成功', GO_SUCCESS);
        }
    }
    /**
     * 查看合同页-
     * @return [type] [description]
     */
    public function detail_contract()
    {
    	$this->checkauth('detail_contract');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$inst = $this->input->get('instId');
    	$res = $this->instmodel->get_one($inst);
    	$data['inst'] = $res;
    	$cid = $this->input->get('id');
    	$table = array('contract','inst_member');
    	$link = 'contract.charge = inst_member.id';
    	$where = array('contract.inst_id'=>$inst);
    	// $columns = 'inst_member.name,inst_member.phone,inst_member.email';
    	$result = $this->instmodel->join($where,$table,$link);
    	// var_dump($result);
    	$data['contract'] = $result['0'];
    	$this->load->view('admin/inst/contract_detail',$data);
    }

    /**
     * 修改合同页-
     * @return [type] [description]
     */
    public function edit_contract()
    {
    	$this->checkauth('add_contract');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$inst = $this->input->get('instId');
    	$cid = $this->input->get('id');
    	$res = $this->instmodel->get_one($inst);
    	$data['inst'] = $res;
    	$data['instId'] = $inst;
    	$inst_member = $this->inst_member($inst);
    	$data['inst_member'] = $inst_member;
    	$contract = $this->instmodel->get_one($cid,$table='contract');
    	$data['contract'] = $contract;
    	// var_dump($contract);
    	$this->load->view('admin/inst/contract_edit',$data);
    }

    /**
     * 修改合同页-
     * @return [type] [description]
     */
    public function edit_contract_do()
    {
    	$this->checkauth('add_contract');
    	$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
    	$this->load->model('instmodel');
    	$instId = $this->input->post('instId');
    	$cid = $this->input->post('cid');
    	$linkman = $this->input->post('linkman');
    	$address = $this->input->post('address');
    	$tel = $this->input->post('tel');
    	$tel_contract = $this->input->post('tel_contract');
    	$is_contract = $this->input->post('is_contract');
    	$is_answer = $this->input->post('is_answer');
    	$contract_type = $this->input->post('contract_type');

    	$procedure=$_FILES['procedure']["name"];
    	$tel_contract=$_FILES['tel_contract']["name"];
    	$data = array('charge'=>$linkman,'address'=>$address,'is_templet'=>$tel,'is_contract'=>$is_contract,'is_answer'=>$is_answer,'contract_type'=>$contract_type,'add_time'=>time());

    	if($procedure!=null||$procedure!=""){
				 // go('/index.php/admin/institution/add_closeinst?instId='.$id, '文档未上传！');
				// exit;
				$file=$this->upload_path('procedure','contract');
				$data['process'] = $file;
			}
		if($tel_contract!=null||$tel_contract!=""){
				 // go('/index.php/admin/institution/add_closeinst?instId='.$id, '文档未上传！');
				// exit;
				$file1=$this->upload_path('tel_contract','contract');
				$data['tel_contract'] = $file1;
			}

		//修改之前查询原来数据
        $oldData = $this->instmodel->get_one($cid,$table='contract');
    	$oldData = json_encode($oldData);
    	//修订的数据
    	$newData = json_encode($data);
    	$rdata = array('inst_id'=>$instId,'add_time'=>time(),'old_content'=>$oldData,'revise_content'=>$newData,'revise_man'=>$uname.','.$uid,'revise_type'=>'contract');
    	$xiuding = $this->instmodel->add($rdata,$table='inst_datarevise');

		//合同修改
    	$result = $this->instmodel->edit($data,$cid,$table='contract');
    	unset($data);
    	unset($rdata);
    	if(!$result){
            inst_go('/index.php/admin/institution/edit_contract?instId='.$instid.'&id='.$cid, '修改失败，请重新修改', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instId, '修改成功', GO_SUCCESS);
        }
    }

    //	删除合同
    public function change_contract_status()
    {
    	$this->checkauth('add_contract');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = $this->input->get('id');
    	$instId = $this->input->get('instId');
    	if(empty($table)){
    		$table= 'contract';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>0);
    	$result = $this->funcmodel->edit($table,$data,$where);
    	// var_dump($result);
    	if(!$result){
            go('/index.php/admin/institution/detail_institution?id='.$instId, '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instId, '操作成功', GO_SUCCESS);
        }
    }

    /**
     * 添加关中心页-
     * @return [type] [description]
     */
    public function add_closeinst()
    {
    	$this->checkauth('add_closeinst');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$inst = $this->input->get('instId');
    	$res = $this->instmodel->get_one($inst);
    	$data['inst'] = $res;
    	$data['instId'] = $inst;
    	$this->load->view('admin/inst/closeinst_add',$data);
    }

    /**
     * 添加关中心-
     * @return [type] [description]
     */
    public function add_closeinst_do()
    {
    	$this->checkauth('add_closeinst');
    	$this->load->model('instmodel');
    	$require = $this->input->post('require');
    	$id = intval($this->input->post('instId'));
    	$procedure=$_FILES['procedure']["name"];
    	if($procedure==null||$procedure==""){
				 go('/index.php/admin/institution/add_closeinst?instId='.$id, '文档未上传！');
				exit;
			}
    	$file=$this->upload_path('procedure','procedure');
    	$data = array('inst_id'=>$id,'require'=>$require,'procedure'=>$file,'status'=>1,'add_time'=>time());
    	$result = $this->instmodel->add($data,$table='inst_close');
    	if(!$result){
            go("/index.php/admin/institution/add_closeinst?instId=$id", '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$id, '添加成功', GO_SUCCESS);
        }
    }

    /**
     * 查看关中心-
     * @return [type] [description]
     */
    public function detail_closeinst()
    {
    	$this->checkauth('detail_closeinst');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$inst = $this->input->get('instId');
    	$cid = $this->input->get('id');
    	$res = $this->instmodel->get_one($inst);
    	$data['inst'] = $res;
    	$result = $this->instmodel->get_one($cid,$table='inst_close');
    	// var_dump($result);
    	$data['closeinst'] = $result;
    	$this->load->view('admin/inst/closeinst_detail',$data);
    }

    /**
     * 修改关中心页-
     * @return [type] [description]
     */
    public function edit_closeinst()
    {
    	$this->checkauth('add_closeinst');
    	$this->load->model('instmodel');
    	$data['cdn'] = $this->cdn;
    	$inst = $this->input->get('instId');
    	$cid = $this->input->get('id');
    	$res = $this->instmodel->get_one($inst);
    	$data['inst'] = $res;
    	$data['instId'] = $inst;
    	$inst_member = $this->inst_member($inst);
    	$data['inst_member'] = $inst_member;
    	$inst_close = $this->instmodel->get_one($cid,$table='inst_close');
    	$data['closeinst'] = $inst_close;
    	// var_dump($contract);
    	$this->load->view('admin/inst/closeinst_edit',$data);
    }

    /**
     * 修改关中心-
     * @return [type] [description]
     */
    public function edit_closeinst_do()
    {
    	
    	$this->checkauth('add_closeinst');
    	$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
    	$this->load->model('instmodel');
    	$require = $this->input->post('require');
    	$instId = intval($this->input->post('instId'));
    	$id = $this->input->post('id');
    	$procedure=$_FILES['procedure']["name"];
    	// var_dump($procedure);
    	$data = array('require'=>$require,'status'=>1,'add_time'=>time());
    	if($procedure!=null||$procedure!=""){
				 // go('/index.php/admin/institution/add_closeinst?instId='.$id, '文档未上传！');
				// exit;
				$file=$this->upload_path('procedure','procedure');
				$data['procedure'] = $file;
			}

		//修改之前查询原来数据
        $oldData = $this->instmodel->get_one($id,$table='inst_close');
    	$oldData = json_encode($oldData);
    	//修订的数据
    	$newData = json_encode($data);
    	$rdata = array('inst_id'=>$instId,'add_time'=>time(),'old_content'=>$oldData,'revise_content'=>$newData,'revise_man'=>$uname.','.$uid,'revise_type'=>'inst_close');
    	$xiuding = $this->instmodel->add($rdata,$table='inst_datarevise');
    	unset($rdata);
		//关中心修改
    	$result = $this->instmodel->edit($data,$id,$table='inst_close');
    	if(!$result){
            inst_go('/index.php/admin/institution/edit_closeinst?instId='.$instId.'&id='.$id, '修改失败，请重新修改', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instId, '修改成功', GO_SUCCESS);
        }
    }

    //	删除关中心
    public function change_closeinst_status()
    {
    	$this->checkauth('add_closeinst');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = $this->input->get('id');
    	$instId = $this->input->get('instId');
    	if(empty($table)){
    		$table= 'inst_close';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>0);
    	$result = $this->funcmodel->edit($table,$data,$where);
    	// var_dump($result);
    	if(!$result){
            go('/index.php/admin/institution/detail_institution?id='.$instId, '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/detail_institution?id='.$instId, '操作成功', GO_SUCCESS);
        }
    }

    //机构修订页
    public function dataRevise_list()
    {
    	$this->checkauth('dataRevise_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$this->load->helper('Page');
       	$where      = array();
       	$table = array('inst_datarevise','inst');
       	$link = 'inst_datarevise.inst_id = inst.id';
       	$columns = 'inst_datarevise.id as did,inst_datarevise.revise_content,inst_datarevise.old_content,inst_datarevise.add_time,inst.instname';
        $page_where = '';
        // 需要模糊查询的名称
        $search     = trim($this->input->get_post('search'));
        if (isset($search) && $search) {
            $where['search'] = $search;
            $where['column'] = 'inst.instname'; 
            $page_where      = 'search=' . $search;
        }
        // var_dump($where);
        $where['status'] ='1';
        //查询到的总条数
        $count            = $this->instmodel->countw($where,$table,$link);
        $p = new page($count,10,$page_where);
        // var_dump($p);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search; //返回搜索框数据
        $this->db->order_by('inst_datarevise.add_time','desc');
    	$res = $this->instmodel->join($where,$table,$link,$columns,$p->firstRow, $p->listRows);
    	//对json数据进行转换
    	foreach ($res as $key => $value) {
    		$res[$key]['revise_content'] = json_decode($value['revise_content'],true);
    		$res[$key]['old_content'] =json_decode($value['old_content'],true);
    		$res[$key]['diff'] = array_diff($res[$key]['revise_content'],$res[$key]['old_content']);
    		unset($res[$key]['diff']['add_time']);
    	}
    	$data['revise'] = $res;
    	// var_dump($res);
    	$this->load->view('admin/inst/dataRevise_list',$data);
    }

    //就够修订页详情
    //
    public function detail_datarevise()
    {
    	$this->checkauth('dataRevise_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$id = $this->input->get('id');
    	$res = $this->instmodel->get_one($id,$table='inst_datarevise');
    	$res['revise_content'] = json_decode($res['revise_content'],true);
    	$res['old_content'] =json_decode($res['old_content'],true);
    	$inst = $this->instmodel->get_one($res['inst_id']);
    	$data['inst'] = $inst;
    	// var_dump($res);
    	$data['revise'] = $res;
    	$this->load->view('admin/inst/dataRevise_detail',$data);
    }

    /**
     * 审核列表-
     * @return [type] [description]
     */
    public function review_list()
    {
    	$this->checkauth('review_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');

    	$this->load->view('admin/inst/review_list',$data);
    }

    /**
     * 审核详情-
     * @return [type] [description]
     */
    public function detail_review()
    {
    	$this->checkauth('review_list');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$this->load->view('admin/inst/review_detail',$data);
    }

    /**
     * 修改添加数据字段页面-
     * @return [type] [description]
     */
    public function add_columns()
    {
    	$this->checkauth('add_columns');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$data['table']  = table();
    	$this->load->view('admin/inst/columns_add',$data);
    }

    /**
     * 修改添加数据字段-
     * @return [type] [description]
     */
    public function add_columns_do()
    {
    	$this->checkauth('add_columns');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
    	$table = $this->input->post('table');
    	$cname = trim($this->input->post('cname'));
    	$col_name = substr(md5($cname.rand(0,50)),0,4);
    	$data = array('table'=>$table,'cname'=>$cname,'status'=>1,'col_name'=>$col_name,'username'=>$uname.','.$uid,'add_time'=>time());
    	// var_dump($_POST);
    	// echo $col_name;
    	// exit;
    	$res = $this->instmodel->add($data,$table='columns');
    	if(!$res){
            go('/index.php/admin/institution/add_columns', '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/columns_list', '操作成功', GO_SUCCESS);
        }
    }

    public function columns_list()
    {
    	$this->checkauth('add_columns');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$this->load->helper('page');
    	$where      = array();
        $page_where = '';
        // 需要模糊查询的名称
        $search     = trim($this->input->get_post('search'));

        if (isset($search) && $search) {
            $where['search'] = $search;
            $where['column'] = 'cname'; 
            $page_where      = 'search=' . $search;
        }
        $where['status'] ='1';
        //查询到的总条数
        $count            = $this->instmodel->count($where);
        $p = new page($count,10,$page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;

    	$data['columns'] = $this->instmodel->get_all($where='',$table='columns',$p->firstRow, $p->listRows);
    	// var_dump($data);
    	$this->load->view('admin/inst/columns_list',$data);
    }


    public function edit_columns()
    {
    	$this->checkauth('add_columns');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$id = intval($this->input->get('id'));
    	$res = $this->instmodel->get_one($id,$table='columns');
    	$data['columns'] = $res;
    	// var_dump($res);
    	$this->load->view('admin/inst/columns_edit',$data);
    }

    public function edit_columns_do()
    {
    	$this->checkauth('add_columns');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('instmodel');
    	$id = $this->input->post('id');
    	$cname = trim($this->input->post('cname'));
    	$data = array('cname'=>$cname);
    	$res = $this->instmodel->edit($data,$id,$table='columns');
    	if(!$res){
            go('/index.php/admin/institution/edit_columns?id='.$id, '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/columns_list', '操作成功', GO_SUCCESS);
        }
    }

    /**
     * 改变状态-
     * @return [type] [description]
     */
    public function change_columns_status()
    {
    	$this->checkauth('add_position');
    	$data['cdn'] = $this->cdn;
    	$this->load->model('funcmodel');
    	$id = intval($this->input->get('id'));
    	$table = $this->input->get('table');
    	$status = intval($this->input->get('state'));
    	if(empty($table)){
    		$table= 'columns';
    	}
    	$where = array('id'=>$id);
    	$data = array('status'=>$status);
    	$result = $this->funcmodel->edit($table,$data,$where);

    	if(!$result){
            go('/index.php/admin/institution/columns_list', '操作失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/institution/columns_list', '操作成功', GO_SUCCESS);
        }
    	
    }



//一下是公用的方法----------------------------------------------------
    /**
     * 获取所有机构id,name-
     * @return [type] [description]
     */
    
    public function inst_name($id=null)
    {
    	// $this->load->model('instmodel');
    	$where = array('status'=>'1');
    	if(empty($id)){
    		$result = $this->instmodel->get_all($where);
    	}else{
    		$where['id'] = $id;
    		$result = $this->instmodel->get_one($where);
    	}
    	// return $result;
    	$inst =array();
    	foreach($result as $key=>$val){
    		$inst[$key]['id']=$val['id'];
    		$inst[$key]['instname'] =$val['instname'];
    	}
    	return $inst;
    }
    /**
     * 获取城市
     * @return [type] [description]
     */
    public function get_list_byid($id)
    {
    	$this->load->model('instmodel');
    	$where = array('parent_id'=>$id);
    	$res = $this->instmodel->get_city($where,$table='city',$order=true);
    	return $res;
    }

    /**
     * 获取所有机构成员,name-
     * @return [type] [description]
     */
    public function inst_member($id)
    {
    	$where = array('inst_id'=>$id);
    	$result = $this->instmodel->get_all($where,$table='inst_member');
    	$inst =array();
    	foreach($result as $key=>$val){
    		$inst[$key]['id']=$val['id'];
    		$inst[$key]['name'] =$val['name'];
    	}
    	return $inst;
    }

    //获取职位表
    public function position_return()
    {
    	$this->load->model('instmodel');
    	$inst = $_POST['id'];
    	$where = array('inst_id'=>$inst);
    	$result = $this->instmodel->get_all($where,$table='position');
    	// var_dump($result);
    	echo json_encode($result);
    }

    //获取机构成员member
    public function member()
    {
    	$this->load->model('instmodel');
    	$id = $_POST['id'];
    	$where = array('inst_id'=>$id);
    	$result = $this->instmodel->get_all($where,$table='inst_member');
    	echo json_encode($result);
    }

    //获取机构科室
    public function dept()
    {
    	$this->load->model('instmodel');
    	$id = $_POST['id'];
    	$item_id = $_POST['project'];
    	$where = array('inst_id'=>$id);
    	$result = $this->instmodel->get_all($where,$table='dept');
    	$data['keshi'] = $result;
    	$position = $this->instmodel->get_all($where,$table='position');
    	$data['position'] = $position;
    	$cwhere = array('items_id'=>$item_id,'inis_id'=>$id);
    	$crc_item = $this->instmodel->get_one($cwhere,$table='crc_items');
    	$uid = $crc_item['uid'];
    	$uwhere = array('crc_user.uid'=>$uid);
    	$link = 'crc_user.id=web_user.uid';
    	$crc = $this->instmodel->join($uwhere,$table=array('crc_user','web_user'),$link);
    	if(!$crc){
    		$crc['0'] = array();
    	}
    	$data['crc'] = $crc['0'];
    	echo json_encode($data);
    }

    //上传文件
    function upload_path($username,$fid){
		if (!file_exists('uploads/inst/'.$fid)){ mkdir ('uploads/inst/'.$fid, 0777);}
		$fname=$_FILES[$username]["name"];

		$type=trim($_FILES[$username]["type"]);

		//echo $type.'<br>';
			$config['upload_path'] = './uploads/inst/'.$fid.'/';
			// return $config;
			// exit();
			if(!file_exists($config['upload_path'])){
				@mkdir($config['upload_path'],0777);
				@touch($config['upload_path'].'index.html');
			}
			$config['allowed_types'] ='jpg|jpeg|gif|png|bmp|jpe|zip|rar|7z|doc|docx|xls|xlsx|pdf|';
			$config['max_size'] =1024*1024*20;
			$name_arr=explode('.',$fname);
			$filename=$name_arr[0];
			$config['file_name']= $username;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config); 
			if ( ! $this->upload->do_upload($username)){
			   $error = array('error' => $this->upload->display_errors());  
			   return  $error;
			   // go('/index.php/admin/institution/add_contract?id='.$fid, $error['error']);
			}else{
				$data = $this->upload->data();
				$filename=iconv('GB2312', 'UTF-8',  $data['file_name']);
			    $username=$this->cdn.'/uploads/inst/'.$fid.'/'.$filename;	
				$username=str_replace("////","/",$username);
				$username=str_replace("///","/",$username);
				$username=str_replace("//","/",$username);
				$username=str_replace("http:/www","http://www",$username);
				//上线后删掉
				$username=str_replace("http:/dev","http://dev",$username);
				return $username;
			}	
	}



	// 页面跳转
	function view_gourl(){
		$url = $this->input->get('url');
		$id = $this->input->get('id'); 
		$content = $this->input->get('content');
		$notice = $this->input->get('notice');
		if(!$url){
			$url = Url::alias('home');
		}
		header('Refresh:2;url='.$url.'&id='.$id);
		$data['url']=$url;
		$data['content']=urldecode($content);
		$data['notice']= $notice;
		 $data['cdn'] = $this->cdn;
		$this->load->view("/admin/gourl",$data);
	}


	//excell上传读取
	public function read_excel()
	{

       	$this->load->helper('phpExcel');
        $e = new PhpexcelRead();
        $str = $e->leading($filename='',$table='inst');
        var_dump($str);
	}


	//修改，增加字段
	public function columns()
	{
		$uid=$this->session->userdata('userid');
    	$uname=$this->session->userdata('uname');
		$this->load->model('instmodel');
		$tab = $_POST['table'];
		$val = $_POST['data'];
		$name = $_POST['name'];
		$cname = $_POST['colname'];
		$data = array('table'=>$tab,'col_name'=>$name,'cname'=>$cname,'add_time'=>time(),'username'=>$uname.','.$uid);
		$res = $this->instmodel->add($data,$table='columns');
		echo json_encode($res);
	}

	 /**
     * ajax 验证 手机号是否存在
     * @return [type] [description]
     */
    public function user_phone_check()
    {
        $this->load->model('webusermodel');
        $phone = $this->input->post('phone');
        $data    = array('phone' => $phone);
        // webusermodel 验证 account
        $res = $this->webusermodel->sence_check($data, 'add');
        $ret = array('valid' => (bool) $res['status'], 'message' => $res['err_info']);
        echo json_encode($ret);
    }


    
}