<?php
class Crc_manage extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('webusermodel');
		$this->load->model('crcmodel');
		$this->load->model('funcmodel');
		$this->load->model('crcresumesmodel');
    }

	/**
     * crc组别列表
     * @return [type] [description]
     */
    public function crc_group()
    {
		$this->checkauth('crc_group');
        $data['cdn'] = $this->cdn;   	
        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
        $gname     = trim($this->input->get_post('gname'));
		$area_id     = intval($this->input->get_post('area_id'));
        if (isset($gname) && $gname) {
            $where['gnames'] = $gname;
            $page_where      = 'gname=' . $gname;
        }
		 if (isset($area_id) && $area_id) {
            $where['area_id'] = $area_id;
            $page_where      = 'area_id=' . $area_id;
        }

        $count            = $this->funcmodel->count('crc_group',$where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['gname']   = $gname;
		$data['area_id']   = $area_id;
        $data['where']    = $where;
		$data['area']=$this->get_all_list('area',array('status'=>1),'name');
        $data['grouplist'] = $this->funcmodel->get_all('crc_group',$where, $p->firstRow, $p->listRows);
        $this->load->view('admin/crc_manage/crc_group', $data);
    }

	 /**
     * 添加CRC组别-表单
     */
    public function add_group()
    {
        $this->checkauth('crc_group');
        $data['cdn'] = $this->cdn;
		$data['area']=$this->get_all_list('area',array('status'=>1),'name');
        $this->load->view('admin/crc_manage/add_group', $data);
    }

	 /**
     * 添加CRC组别-表单处理
     * @return [type] [description]
     */
    public function add_group_do()
    {
        $this->checkauth('crc_group');
        $gname = trim($this->input->post('gname'));
		$desc = trim($this->input->post('desc')); 
		$area_id = intval($this->input->post('area_id')); 
        $this->load->model('funcmodel');
        $data = array('gname' => $gname,'desc' => $desc,'area_id'=>$area_id,'add_time'=>time());
       
        if (!$this->funcmodel->add('crc_group',$data)) {
            go('/index.php/admin/crc_manage/add_group', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/crc_manage/crc_group', '添加成功', GO_SUCCESS);
        }
    }


	/**
     * 修改组别
     * @return [type] [description]
     */
    public function group_edit()
    {
        $this->checkauth('crc_group');
        $data['cdn']     = $this->cdn;
        $id              = $this->input->get('id');
        $group         = $this->funcmodel->get_one('crc_group',array('id'=>$id));
        $data['group'] = $group;
		$data['area']=$this->get_all_list('area',array('status'=>1),'name');
        $this->load->view($this->view_path, $data);
    }

    /**
     * 修改分类-表单处理
     * @return [type] [description]
     */
    public function group_edit_do()
    {
        $this->checkauth('crc_group');
        $id                = $this->input->post('id');
        $gname              = trim($this->input->post('gname'));
		$desc = trim($this->input->post('desc'));
		$area_id = intval($this->input->post('area_id'));
		$status              = intval($this->input->post('status'));
       
        $this->load->model('funcmodel');
        $data = array('gname' => $gname,'desc' => $desc,'status'=>$status,'area_id'=>$area_id,'add_time'=>time());
       
        if (!$this->funcmodel->edit('crc_group',$data, array('id'=>$id))) {
            go('/index.php/admin/crc_manage/group_edit?id=' . $id, '编辑失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/crc_manage/crc_group', '编辑成功', GO_SUCCESS);
        }
    }
    public function change_group_status()
    {

        $this->checkauth('crc_group');
        $status = (int) $this->input->get('status');
        $id     = (int) $this->input->get('id');
        if (!$id) {
            go('/index.php/admin/crc_manage/crc_group', '未知记录');
        }

        $this->load->model('funcmodel');
        $info = $this->funcmodel->get_one('crc_group',array('id'=>$id));
        if (!$info) {
            go('/index.php/admin/crc_manage/crc_group', '未知渠道 error:2');
        }
        //验证 状态是否一致
        if ($status != $info['status']) {
            go('/index.php/admin/crc_manage/crc_group', '该类型状态信息已变更，请刷新后操作');
        }

       
        // 状态变更
        if ($status) {
            $status = 0;
        } else {
            $status = 1;
        }
        $ret = $this->funcmodel->edit('crc_group',array('status' => $status), array('id'=>$id));
        if (!$ret) {
            go('/index.php/admin/crc_manage/crc_group', '操作失败，请重新操作');
        } else {
            go('/index.php/admin/crc_manage/crc_group/');
        }
    }


	  /**
     * ajax 验证 组别是否存在
     * @return [type] [description]
     */
    public function group_name_check()
    {
        $this->load->model('funcmodel');
        $gname = $this->input->post('gname');
        $data    = array('gname' => $gname);

        // newstypemodel 验证 newstypemodel
        $res = $this->funcmodel->get_one('crc_group',$data);
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
    public function group_names_check()
    {
        $this->load->model('funcmodel');
        $gname = $this->input->post('gname');
		$id = $this->input->post('id');
        $data    = array('gname' => $gname);    
        $res = $this->funcmodel->get_one('crc_group',$data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
        
        echo json_encode($ret);
    }



		/**
     * crc所属公司列表
     * @return [type] [description]
     */
    public function crc_company()
    {
		$this->checkauth('crc_company');
        $data['cdn'] = $this->cdn;   	
        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
        $cname     = trim($this->input->get_post('cname'));
        if (isset($cname) && $cname) {
            $where['cnames'] = $cname;
            $page_where      = 'cname=' . $cname;
        }
        $count            = $this->funcmodel->count('crc_company',$where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['cname']   = $cname;
        $data['where']    = $where;
        $data['companylist'] = $this->funcmodel->get_all('crc_company',$where, $p->firstRow, $p->listRows);
        $this->load->view('admin/crc_manage/crc_company', $data);
    }

	 /**
     * 添加CRC所属公司-表单
     */
    public function add_company()
    {
        $this->checkauth('crc_company');
        $data['cdn'] = $this->cdn;
        $this->load->view('admin/crc_manage/add_company', $data);
    }

	 /**
     * 添加CRC所属公司-表单处理
     * @return [type] [description]
     */
    public function add_company_do()
    {
        $this->checkauth('crc_company');
        $cname = trim($this->input->post('cname'));
		$desc = trim($this->input->post('desc'));   
        $this->load->model('funcmodel');
        $data = array('cname' => $cname,'desc' => $desc,'add_time'=>time());
       
        if (!$this->funcmodel->add('crc_company',$data)) {
            go('/index.php/admin/crc_manage/add_company', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/crc_manage/crc_company', '添加成功', GO_SUCCESS);
        }
    }


	/**
     * 修改所属公司
     * @return [type] [description]
     */
    public function company_edit()
    {
        $this->checkauth('crc_company');
        $data['cdn']     = $this->cdn;
        $id              = $this->input->get('id');
        $company         = $this->funcmodel->get_one('crc_company',array('id'=>$id));
        $data['company'] = $company;
        $this->load->view($this->view_path, $data);
    }

    /**
     * 修改分类-表单处理
     * @return [type] [description]
     */
    public function company_edit_do()
    {
        $this->checkauth('crc_company');
        $id                = $this->input->post('id');
        $cname              = trim($this->input->post('cname'));
		$desc = trim($this->input->post('desc'));
		$status              = intval($this->input->post('status'));
       
        $this->load->model('funcmodel');
        $data = array('cname' => $cname,'desc' => $desc,'status'=>$status,'add_time'=>time());
       
        if (!$this->funcmodel->edit('crc_company',$data, array('id'=>$id))) {
            go('/index.php/admin/crc_manage/company_edit?id=' . $id, '编辑失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/crc_manage/crc_company', '编辑成功', GO_SUCCESS);
        }
    }
    public function change_company_status()
    {

        $this->checkauth('crc_company');
        $status = (int) $this->input->get('status');
        $id     = (int) $this->input->get('id');
        if (!$id) {
            go('/index.php/admin/crc_manage/crc_company', '未知记录');
        }

        $this->load->model('funcmodel');
        $info = $this->funcmodel->get_one('crc_company',array('id'=>$id));
        if (!$info) {
            go('/index.php/admin/crc_manage/crc_company', '未知渠道 error:2');
        }
        //验证 状态是否一致
        if ($status != $info['status']) {
            go('/index.php/admin/crc_manage/crc_company', '该类型状态信息已变更，请刷新后操作');
        }

       
        // 状态变更
        if ($status) {
            $status = 0;
        } else {
            $status = 1;
        }
        $ret = $this->funcmodel->edit('crc_company',array('status' => $status), array('id'=>$id));
        if (!$ret) {
            go('/index.php/admin/crc_manage/crc_company', '操作失败，请重新操作');
        } else {
            go('/index.php/admin/crc_manage/crc_company/');
        }
    }


	  /**
     * ajax 验证 所属公司是否存在
     * @return [type] [description]
     */
    public function company_name_check()
    {
        $this->load->model('funcmodel');
        $cname = $this->input->post('cname');
        $data    = array('cname' => $cname);

        // newstypemodel 验证 newstypemodel
        $res = $this->funcmodel->get_one('crc_company',$data);
		if($res['id']){
			$ret = array('valid' => false);
		}else{
			$ret = array('valid' => true);
		
		}
        echo json_encode($ret);
    }

	  /**
     * ajax 验证 所属公司是否存在-修改
     * @return [type] [description]
     */
    public function company_names_check()
    {
        $this->load->model('funcmodel');
        $cname = $this->input->post('cname');
		$id = $this->input->post('id');
        $data    = array('cname' => $cname);    
        $res = $this->funcmodel->get_one('crc_company',$data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
        
        echo json_encode($ret);
    }








   
    /**
     * crc基本信息列表
     * @return [type] [description]
     */
    public function crc_list()
    {
		$this->checkauth('crc_list');
        $data['cdn'] = $this->cdn;       
        $this->load->helper('Page');
        $where['crc']      = 1;
        $page_where = '';
        $search     = trim($this->input->get_post('search'));
		$roleid     = trim($this->input->get_post('roleid'));

        if (isset($search) && $search) {
            $where['search'] = $search;
            $page_where      = 'search=' . $search;
        }
		if (isset($roleid) && $roleid) {
            $where['role_id'] = $roleid;
            $page_where      = 'roleid=' . $roleid;
        }
		$this->load->model('webusermodel');
        $count            = $this->webusermodel->count($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
		$this->load->model('webrolemodel');
        $data['rlist'] = $this->webrolemodel->get_all();
		$data['rolelist']=$this->get_wrole();
        $data['crclist'] = $this->webusermodel->get_all($where, $p->firstRow, $p->listRows);
        $this->load->view('admin/crc_manage/crc_list', $data);
    }

    /**
     * 添加CRC-表单
     */
    public function add_crc()
    {
        $this->checkauth('crc_list');
        $data['cdn'] = $this->cdn;
		$this->load->model('webrolemodel');
        $data['rolelist'] = $this->webrolemodel->get_all();
        $this->load->view('admin/crc_manage/add_crc', $data);
    }

    /**
     * 添加CRC-表单处理
     * @return [type] [description]
     */
    public function add_crc_do()
    {
        $this->checkauth('crc_list');
        $uname     = trim($this->input->post('uname'));
        $account   = $this->input->post('account');
		$email   = $this->input->post('email');
		$phone   = $this->input->post('phone');
        $passwd    = substr($phone,-6);
		$roleid    = $this->input->post('roleid');
        $this->load->model('webusermodel');
        $data = array('uname' => $uname, 'account' => $account, 'passwd' => $passwd, 'add_time'=>time(),'last_login'=>0,'state'=>0,'role_id'=>$roleid,'email'=>$email,'phone'=>$phone);
        $ret  = $this->webusermodel->sence_check($data, 'add');
        if (!$ret['status']) {
            go('/index.php/admin/crc_manage/add_crc', $ret['err_info']);
        }
        $data['passwd'] = md5($passwd);
       
        if (!$this->webusermodel->add($data)) {
            go('/index.php/admin/crc_manage/add_crc', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/crc_manage/crc_list', '添加成功', GO_SUCCESS);
        }
    }

	 /**
     * 编辑crc基本信息-表单
     * @return [type] [description]
     */
    public function crc_edit()
    {
        $this->checkauth('crc_list');
        $data['cdn'] = $this->cdn;
        $this->load->model('webusermodel');
        $uid  = $this->input->get_post('uid');
        $info = $this->webusermodel->get_one($uid);
        if (!count($info)) {
            go('/index.php/admin/crc_manage/crc_list/', '未获取到信息,请刷新来源页面');
        }
        $data['sinfo'] = $info;
		$this->load->model('webrolemodel');
        $data['rolelist'] = $this->webrolemodel->get_all();
        $this->load->view('admin/crc_manage/crc_edit', $data);
    }

    /**
     * 编辑crc基本信息-表单处理
     * @return [type] [description]
     */
    public function crc_edit_do()
    {

        $this->checkauth('crc_list');

        $uname     = $this->input->post('uname');
        $account   = $this->input->post('account');
		$email   = $this->input->post('email');
		$phone   = $this->input->post('phone');
        $passwd    = substr($phone,-6);
		$roleid    = $this->input->post('roleid');
      
        $data = array('uname' => $uname, 'account' => $account, 'passwd' => md5($passwd),'role_id'=>$roleid,'email'=>$email,'phone'=>$phone);
          
        $uid = trim($this->input->get_post('uid'));
        if (!$uid) {
            go('/index.php/admin/crc_manage/crc_list', '未获取到用户id，请返回重新操作');
        }
        $this->load->model('webusermodel');
        $info = $this->webusermodel->edit($data, $uid);
        go('/index.php/admin/crc_manage/crc_list/', '修改成功！', 1);
    }



	/**
     * 操作crc的登录状态
     * @return [type] [description]
     */
    function change_crc_status(){

        $this->checkauth('crc_list');
        $state = (int) $this->input->get('state');
        $uid   = (int) $this->input->get('uid');
        if(!$uid){
            go('/index.php/admin/crc_manage/crc_list','未知crc');
        } 
        if($uid == $this->super_uid){
            go('/index.php/admin/crc_manage/crc_list','不允许操作超级管理员');
        }
        $this->load->model('webusermodel');    
        $uinfo = $this->webusermodel->get_one($uid);
        if(!$uinfo){
            go('/index.php/admin/crc_manage/crc_list','未知crc error:2');
        }
        //验证 状态是否一致
        if($state != $uinfo['state']){
            go('/index.php/admin/crc_manage/crc_list','该crc状态信息已变更，请刷新后操作');
        }
        // 状态变更
        if($state){ 
            $state = 0;
        }else{
            $state=1;
        }
        $ret = $this->webusermodel->edit(array('state'=> $state),$uid);
        if(!$ret){
            go('/index.php/admin/crc_manage/crc_list','操作失败，请重新操作');
        }else{
          go('/index.php/admin/crc_manage/crc_list/','操作成功',1);
        }
    }



	 /**
     * crc相关信息列表
     * @return [type] [description]
     */
    public function crc_flist()
    {
		$this->checkauth('crc_flist');
        $data['cdn'] = $this->cdn;    
        $this->load->helper('Page');
        $where['crc']      = 1;
        $page_where = '';
        $search     = trim($this->input->get_post('search'));
		$roleid     = trim($this->input->get_post('roleid'));
		$company_id     = trim($this->input->get_post('company_id'));
		$sex_id     = trim($this->input->get_post('sex_id'));
		$group_id     = trim($this->input->get_post('group_id'));
		$area_id     = trim($this->input->get_post('area_id'));
		$city_id     = trim($this->input->get_post('city_id'));
		$province_id     = trim($this->input->get_post('province_id'));




        if (isset($search) && $search) {
            $where['search'] = $search;
            $page_where      = 'search=' . $search;
			 $data['search']   = $search;	
        }
		if (isset($roleid) && $roleid) {
            $where['role_id'] = $roleid;
            $page_where      = 'roleid=' . $roleid;
			$data['roleid']   = $roleid;	
        }
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
		if (isset($group_id) && $group_id) {
            $where['group_id'] = $group_id;
            $page_where      = 'group_id=' . $group_id;
			$data['group_id']   = $group_id;	
        }
		if (isset($sex_id) && $sex_id) {
            $where['sex_id'] = $sex_id;
            $page_where      = 'sex_id=' . $sex_id;
			$data['sex_id']   = $sex_id;	
        }


		$this->load->model('webrolemodel');
		$this->load->model('crcmodel');
        $count            = $this->crcmodel->count($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
       
		$data['rlist'] = $this->webrolemodel->get_all();
		$data['sex'] = array('1'=>'男','2'=>'女');	
        $data['group']=$this->get_all_list('crc_group',array('status'=>1),'gname');
		$data['province']=$this->get_all_list('provinces',array('status'=>1),'name');
		$data['city']=$this->get_all_list('city',array('status'=>1),'name');
		$data['area']=$this->get_all_list('area',array('status'=>1),'name');
		$data['company']=$this->get_all_list('crc_company',array('status'=>1),'cname');		
        $data['crclist'] = $this->crcmodel->get_all($where, $p->firstRow, $p->listRows);
        $this->load->view('admin/crc_manage/crc_flist', $data);
    }

	 /**
     * crc相关信息详情页
     * @return [type] [description]
     */
    public function crc_finfo()
    {
		$this->checkauth('crc_flist');               
        $uid     = trim($this->input->get_post('uid'));		
		$this->load->model('crcmodel');
       
		$data=$this->get_crcgg($uid);
		$data['cdn'] = $this->cdn; 
		$data['crcinfo'] = $this->crcmodel->get_one($uid);
        $this->load->view('admin/crc_manage/crc_finfo', $data);
    }
	 /**
     * ajax 详情查看  
     * @return [type] [description]
     */
	function get_list(){
		$table=$this->input->get_post('table');
		$uid  = intval($this->input->get_post('uid'));	
		$type = intval($this->input->get_post('type'));
		if($uid){$where['uid']=$uid;}
		if($type){$where['type']=$type;}
		$this->load->model('funcmodel');
		$list=$this->funcmodel->get_all($table,$where);
		$arr=array();
		if(count($list)>0){$arr['status']=1;}else{$arr['status']=0;}
		
		if($table=='crc_items'){
			$info='';

			$item=$this->get_all_list('items',array('status'=>1),'shortname');		
			foreach($list as $val){
				$info.='<li>'.$item[$val['items_id']].'</li>';		
			}		
		}elseif($table=='crc_inits'){
			$info='';
			$inst=$this->get_all_list('inst',array('status'=>1),'shortname');		
			foreach($list as $val){
				$info.='<li>'.$inst[$val['inits_id']].'</li>';		
			}		
		}elseif($table=='crc_news'){
			$info='';
			if($type==1){
				$news=$this->get_all_lists('news',array('status'=>1),array('title','add_time','attention_num','like_num'));	
                 $info.= '<li>文章标题-发表时间-关注数量-点赞数量</li>';
				foreach($list as $val){
				$info.='<li><a href="/index.php/admin/news/news_view?id='.$val['news_id'].'">'.$news[$val['news_id']]['title'].'</a>-'.date('Y-m-d H:i:s',$news[$val['news_id']]['add_time']).'-'.$news[$val['news_id']]['attention_num'].'-'.$news[$val['news_id']]['like_num'].'</li>';		
			}	




			}elseif($type==2){
				$news=$this->get_all_lists('news',array('status'=>1),array('title','add_time','attention_num','like_num','author','reward_num'));	
			}
					
				
		}
		 $arr['info']=$info;
         echo json_encode($arr);die;
	}


	 /**
     * 详情页 各个 查看按钮操作 
     * @return [type] [description]
     */
	function get_ck_list(){
		$this->checkauth('crc_flist'); 
		$table=$this->input->get_post('table');
		$uid  = intval($this->input->get_post('uid'));	
		$excle  = intval($this->input->get_post('excle'));	
		$type = intval($this->input->get_post('type'));
		$view = trim($this->input->get_post('view'));
		$typeid = trim($this->input->get_post('typeid'));
		$title = trim($this->input->get_post('title'));
        $smo_company = trim($this->input->get_post('smo_company'));
		$itemname = trim($this->input->get_post('itemname'));
		$inisname = trim($this->input->get_post('inisname'));
		$this->load->model('funcmodel');
		$this->load->helper('Page');
		$page_where = '';
        $where=array();
		if($uid){
			$where['uid']=$uid;
			$page_where      = 'uid=' . $uid;
		}

		if($typeid){
			$where['typeid']=$typeid;
			$page_where      = 'typeid=' . $typeid;
			$data['typeid']=$typeid;
		}

		if($title){
			$where['title']=$title;
			$page_where      = 'title=' . $title;
			$data['title']=$title;
		}

		if($smo_company){
			$where['smo_company']=$smo_company;
			$page_where      = 'smo_company=' . $smo_company;
			$data['smo_company']=$smo_company;
		}

		if($itemname){
			$where['itemname']=$itemname;
			$page_where      = 'itemname=' . $itemname;
			$data['itemname']=$itemname;
		}

		if($inisname){
			$where['inisname']=$inisname;
			$page_where      = 'inisname=' . $inisname;
			$data['inisname']=$inisname;
		}



		if($type){
			$where['type']=$type;
			$page_where      = 'type=' . $type;
		}
		$count            = $this->funcmodel->count_gl($table,$where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
		$list=$this->funcmodel->get_all_gl($table,$where, $p->firstRow, $p->listRows);
		if($table=='crc_inits'){
			$pi=array();
			$sub=array();
			$keyan=array();
			foreach($list as $key=>$val){
				$list[$key]['pi']=$this->get_all_list('dept_member',array('dept_id'=>$val['section_id'],'identity'=>'pi'),'name');
				$list[$key]['pi-phone']=$this->get_all_list('dept_member',array('dept_id'=>$val['section_id'],'identity'=>'pi'),'phone');
				$list[$key]['pi-email']=$this->get_all_list('dept_member',array('dept_id'=>$val['section_id'],'identity'=>'pi'),'email');

				$list[$key]['sub']=$this->get_all_list('dept_member',array('dept_id'=>$val['section_id'],'identity'=>'sub-i'),'name');
				$list[$key]['sub-phone']=$this->get_all_list('dept_member',array('dept_id'=>$val['section_id'],'identity'=>'sub-i'),'phone');
				$list[$key]['sub-email']=$this->get_all_list('dept_member',array('dept_id'=>$val['section_id'],'identity'=>'sub-i'),'email');

				$list[$key]['keyan']=$this->get_all_list('dept_member',array('dept_id'=>$val['section_id'],'identity'=>'科研护士'),'name');
				$list[$key]['keyan-phone']=$this->get_all_list('dept_member',array('dept_id'=>$val['section_id'],'identity'=>'科研护士'),'phone');
				$list[$key]['keyan-email']=$this->get_all_list('dept_member',array('dept_id'=>$val['section_id'],'identity'=>'科研护士'),'email');	
			}
		}
		$data['cdn'] = $this->cdn; 
		$data['list'] = $list;
		$this->load->model('newstypemodel'); 
		$data['typelist'] = $this->newstypemodel->get_all();
		$this->load->model('funcmodel');
		$data['smolist'] = $this->funcmodel->get_all('crc_company');
        $data['company']=$this->get_all_list('crc_company',array(),'cname');
		$data['inst']=$this->get_all_list('inst',array(),'instname');
		$data['progress']=$this->get_all_list('item_plan',array(),'name');
		$data['item']=$this->get_all_lists('items',array(),array('name','item_number','exte_number','sponsor_company','progress_id','plan_num','real_num'));
		$data['dept']=$this->get_all_list('dept',array(),'name');
		$data['sponsor']=$this->get_all_list('sponsor_company',array(),'sname');	
		$data['smo']=$this->get_all_list('crc_company',array(),'cname');
		$data['uid']=$uid;
		$data['table']=$table;
		$data['type']=$type;
		$data['view']=$view;


		if($excle==1){

				$lists=$this->funcmodel->get_all_gl($table,$where);
				if($table=='crc_inits'){
					$pis=array();
					$subs=array();
					$keyans=array();
					foreach($lists as $keys=>$vals){
						$lists[$keys]['pi']=$this->get_all_list('dept_member',array('dept_id'=>$vals['section_id'],'identity'=>'pi'),'name');
						$lists[$keys]['pi-phone']=$this->get_all_list('dept_member',array('dept_id'=>$vals['section_id'],'identity'=>'pi'),'phone');
						$lists[$keys]['pi-email']=$this->get_all_list('dept_member',array('dept_id'=>$vals['section_id'],'identity'=>'pi'),'email');

						$lists[$keys]['sub']=$this->get_all_list('dept_member',array('dept_id'=>$vals['section_id'],'identity'=>'sub-i'),'name');
						$lists[$keys]['sub-phone']=$this->get_all_list('dept_member',array('dept_id'=>$vals['section_id'],'identity'=>'sub-i'),'phone');
						$lists[$keys]['sub-email']=$this->get_all_list('dept_member',array('dept_id'=>$vals['section_id'],'identity'=>'sub-i'),'email');

						$lists[$keys]['keyan']=$this->get_all_list('dept_member',array('dept_id'=>$vals['section_id'],'identity'=>'科研护士'),'name');
						$lists[$keys]['keyan-phone']=$this->get_all_list('dept_member',array('dept_id'=>$vals['section_id'],'identity'=>'科研护士'),'phone');
						$lists[$keys]['keyan-email']=$this->get_all_list('dept_member',array('dept_id'=>$vals['section_id'],'identity'=>'科研护士'),'email');	
					}
				}
  
			   if($view=='ckitem'){
				   	$title=array('项目全称','项目编号','外司编号','申办方','SMO公司','机构名称','项目接手时间','项目交出时间','项目进度','计划入组人数','实际入组人数');
					$export_list= array();
					$count = count($lists);
					$smo='';
					for($i=1;$i<=$count;$i++){
						 $j=$i-1;
						 $smolist=unserialize($lists[$j]['smo_company']);
						 foreach($smolist as $vs){
						 $smo.=$data['smo'][$vs]."\r\n";
						 
						 }
						
						 $export_list[$i][] = $lists[$j]['name'];	
						 $export_list[$i][] = $lists[$j]['item_number'];	
						 $export_list[$i][] = $lists[$j]['exte_number'];	
						 $export_list[$i][] = $data['sponsor'][$lists[$j]['sponsor_company']];	
						 $export_list[$i][] = $smo;	
						 $export_list[$i][] = $data['inst'][$lists[$j]['inis_id']];	
						 $export_list[$i][] = date('Y-m-d H:i:s',$lists[$j]['enter_time']);	
						 $export_list[$i][] = date('Y-m-d H:i:s',$lists[$j]['out_time']);	
						 $export_list[$i][] = $data['progress'][$lists[$j]['progress_id']];	
						 $export_list[$i][] = $lists[$j]['plan_num'];	
						 $export_list[$i][] = $lists[$j]['real_num'];	
						
					}
				   $filename =date('Y-m-d',time()).'CRC-加入项目列表'; 
			   }else{

				   	$title=array('机构名称','项目全称','项目编号','外司编号','申办方','项目进度','计划入组人数','实际入组人数','科室','PI','PI联系电话','PI邮箱','SUB-I','SUB-I联系电话','SUB-I邮箱','科研护士','科研护士联系电话','科研护士邮箱');
					$export_list= array();
					$count = count($lists);
					for($i=1;$i<=$count;$i++){
						 $j=$i-1;
						 $pi='';
						 $pi_phone='';
						 $pi_email='';
						 $sub='';
						 $sub_phone='';
						 $sub_email='';
						 $keyan='';
						 $keyan_phone='';
						 $keyan_email='';
						 foreach($lists[$j]['pi'] as $piv){
							$pi.=$piv."\r\n";
						 }
						 foreach($lists[$j]['pi-phone'] as $ppiv){
							$pi_phone.=$ppiv."\r\n";
						 }
						 foreach($lists[$j]['pi-email'] as $peiv){
							$pi_email.=$peiv."\r\n";
						 }
						  foreach($lists[$j]['sub'] as $siv){
							$sub.=$siv."\r\n";
						 }
						 foreach($lists[$j]['sub-phone'] as $spiv){
							$sub_phone.=$spiv."\r\n";
						 }
						 foreach($lists[$j]['sub-email'] as $seiv){
							$sub_email.=$seiv."\r\n";
						 }


						foreach($lists[$j]['keyan'] as $kiv){
							$keyan.=$kiv."\r\n";
						 }
						 foreach($lists[$j]['keyan-phone'] as $kpiv){
							$keyan_phone.=$kpiv."\r\n";
						 }
						 foreach($lists[$j]['keyan-email'] as $keiv){
							$keyan_email.=$keiv."\r\n";
						 }
                       
						  $export_list[$i][] = $lists[$j]['instname'];	
						  $export_list[$i][] = $data['item'][$lists[$j]['items_id']]['name'];	
						  $export_list[$i][] = $data['item'][$lists[$j]['items_id']]['item_number'];	
						  $export_list[$i][] = $data['item'][$lists[$j]['items_id']]['exte_number'];	
                          $export_list[$i][] = $data['sponsor'][$data['item'][$lists[$j]['items_id']]['sponsor_company']];	
						  $export_list[$i][] = $data['progress'][$data['item'][$lists[$j]['items_id']]['progress_id']];	
						  $export_list[$i][] = $data['item'][$lists[$j]['items_id']]['plan_num'];	
						  $export_list[$i][] = $data['item'][$lists[$j]['items_id']]['real_num'];	
						  $export_list[$i][] = $data['dept'][$lists[$j]['section_id']];	
						  $export_list[$i][] = $pi;	
						  $export_list[$i][] = $pi_phone;	
						  $export_list[$i][] = $pi_email;	
						  $export_list[$i][] = $sub;	
						  $export_list[$i][] = $sub_phone;	
						  $export_list[$i][] = $sub_email;	
						  $export_list[$i][] = $keyan;	
						  $export_list[$i][] = $keyan_phone;	
						  $export_list[$i][] = $keyan_email;	
						 
					}
				    if($view=='ckainis'){
					   $filename =date('Y-m-d',time()).'CRC-关注机构列表';  
				   }elseif($view=='ckinis'){
					   $filename =date('Y-m-d',time()).'CRC-加入机构列表'; 
				   }
			   
			   }
				$this->export_excel_help($title,$export_list,$filename);
				exit;
		
		}



        $this->load->view('admin/crc_manage/crc_'.$view, $data);
	}

	 /**
     * ajax 省市联动
     * @return [type] [description]
     */
	function get_city(){
		$province_id=$this->input->get_post('province_id');
		$list=$this->get_city_byid($province_id);
		echo json_encode($list);
	}

	 /**
     * ajax 区别组联动
     * @return [type] [description]
     */
	function get_group(){
		$area_id=$this->input->get_post('area_id');
		$list=$this->get_all_list('crc_group',array('status'=>1,'area_id'=>$area_id),'gname');
		echo json_encode($list);
	}


	 /**
     * 公共调用方法
     * @return [type] [description]
     */
	function get_crcgg($uid){
		$this->load->model('funcmodel');
		$data['items']=$this->funcmodel->get_all('crc_items',array('uid'=>$uid,'status'=>1));
		$data['inits']=$this->funcmodel->get_all('crc_inits',array('uid'=>$uid,'type'=>1,'status'=>1));
		$data['publish_news']=$this->funcmodel->get_all('crc_news',array('uid'=>$uid,'type'=>1));
		$data['attention_news']=$this->funcmodel->get_all('crc_news',array('uid'=>$uid,'type'=>2));
		$data['attention_inst']=$this->funcmodel->get_all('crc_inits',array('uid'=>$uid,'type'=>2,'status'=>1));
		$data['rewards']=$this->funcmodel->get_all('crc_rewards',array('uid'=>$uid)); 
		$data['sex'] = array('1'=>'男','2'=>'女');	
        $data['group']=$this->get_all_list('crc_group',array('status'=>1),'gname');
		$data['province']=$this->get_all_list('provinces',array('status'=>1),'name');
		$data['city']=$this->get_all_list('city',array('status'=>1),'name');
		$data['area']=$this->get_all_list('area',array('status'=>1),'name');
		$data['company']=$this->get_all_list('crc_company',array('status'=>1),'cname');	
		$data['item']=$this->get_all_list('items',array('status'=>1),'shortname');
		$data['news']=$this->get_all_list('news',array('status'=>1),'title');
		$data['inst']=$this->get_all_list('inst',array('status'=>1),'shortname');
		return $data;
	}




	/**
     * crc相关信息详编辑
     * @return [type] [description]
     */
    public function crc_fedit()
    {
		$this->checkauth('crc_flist');            
        $uid     = trim($this->input->get_post('uid'));		
		$this->load->model('crcmodel');	
		$data=$this->get_crcgg($uid);
        $data['cdn'] = $this->cdn;     
        $data['crcinfo'] = $this->crcmodel->get_one($uid);
        $this->load->view('admin/crc_manage/crc_fedit', $data);
    }


	/**
     * crc相关信息详编辑处理
     * @return [type] [description]
     */
    public function crc_fedit_do()
    {
		$this->checkauth('crc_flist');
        $data['cdn'] = $this->cdn;           
        $uid     = trim($this->input->get_post('uid'));	
		$edit['uid']=$uid;
		$edit['sex']=intval($this->input->get_post('sex'));
		$edit['birthday']=trim($this->input->get_post('birthday'));
		$edit['company_id']=intval($this->input->get_post('company_id'));
		$edit['province_id']=intval($this->input->get_post('province_id'));
		$edit['city_id']=intval($this->input->get_post('city_id'));
		$edit['area_id']=intval($this->input->get_post('area_id'));
		$edit['group_id']=intval($this->input->get_post('group_id'));
		$edit['work_year']=intval($this->input->get_post('work_year'));
		$edit['sufferer_num']=intval($this->input->get_post('sufferer_num'));

		$this->load->model('funcmodel');
		$info=$this->funcmodel->get_one('crc_user',array('uid'=>$uid));
		if($info['id']){
			 $ret = $this->crcmodel->edit($edit,$info['id']);		
		}else{
			 $ret = $this->crcmodel->add($edit);
		}
        if(!$ret){
            go('/index.php/admin/crc_manage/crc_flist','操作失败，请重新操作');
        }else{
          go('/index.php/admin/crc_manage/crc_flist/','操作成功',1);
        }	
    }

    /**
     * crc简历管理
     * @return [type] [description]
     */
	function crc_resumes(){
		$this->checkauth('crc_resumes');
        $data['cdn'] = $this->cdn; 
		$this->load->helper('Page');
        $page_where = '';
        $uid     = trim($this->input->get_post('uid'));
		$search     = trim($this->input->get_post('search'));
		$company_id     = trim($this->input->get_post('company_id'));
		$sex_id     = trim($this->input->get_post('sex_id'));
		$work_year     = trim($this->input->get_post('work_year'));
		if (isset($uid) && $uid) {
            $where['uid'] = $uid;
            $page_where      = 'uid=' . $uid;
			$data['uid']   = $uid;	
        }
		if (isset($search) && $search) {
            $where['search'] = $search;
            $page_where      = 'search=' . $search;
			$data['search']   = $search;	
        }
		if (isset($company_id) && $company_id) {
            $where['company_id'] = $company_id;
            $page_where      = 'company_id=' . $company_id;
			$data['company_id']   = $company_id;	
        }
		if (isset($work_year) && $work_year) {
            $where['work_year'] = $work_year;
            $page_where      = 'work_year=' . $work_year;
			$data['work_year']   = $work_year;	
        }
		
		if (isset($sex_id) && $sex_id) {
            $where['sex_id'] = $sex_id;
            $page_where      = 'sex_id=' . $sex_id;
			$data['sex_id']   = $sex_id;	
        }
		$this->load->model('crcresumesmodel');
        $count            = $this->crcresumesmodel->count($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
		$data['sex'] = array('1'=>'男','2'=>'女');	
		$data['company']=$this->get_all_list('crc_company',array('status'=>1),'cname');	
        $data['resumeslist'] = $this->crcresumesmodel->get_all($where, $p->firstRow, $p->listRows);
        $this->load->view('admin/crc_manage/crc_resumes', $data);
	}

	/**
     * crc简历管理-简历详情
     * @return [type] [description]
     */
	function crc_rinfo(){
		
		$this->checkauth('crc_resumes');
        $data['cdn'] = $this->cdn; 	
		$uid     = intval($this->input->get_post('uid'));
	    $this->load->model('crcresumesmodel');
		$this->load->model('crcmodel');
		$data['crcinfo']=$this->crcmodel->get_one($uid);
		$list=$this->crcresumesmodel->get_rs_all(array('uid'=>$uid,'status'=>1));
		$rlist=array();
		foreach($list as $val){
			if($val['type']==1){
				$rlist['trains'][$val['id']]['content']=$val['content'];
				$rlist['trains'][$val['id']]['jxname']=$val['jxname'];
				$rlist['trains'][$val['id']]['start_time']=$val['start_time'];
				$rlist['trains'][$val['id']]['end_time']=$val['end_time'];
				$rlist['trains'][$val['id']]['postname']=$val['postname'];



			}elseif($val['type']==2){
				$rlist['school'][$val['id']]['content']=$val['content'];
				$rlist['school'][$val['id']]['jxname']=$val['jxname'];
				$rlist['school'][$val['id']]['start_time']=$val['start_time'];
				$rlist['school'][$val['id']]['end_time']=$val['end_time'];
				$rlist['school'][$val['id']]['postname']=$val['postname'];
				$rlist['school'][$val['id']]['dename']=$val['dename'];

			
			}elseif($val['type']==3){
				$rlist['work'][$val['id']]['content']=$val['content'];
				$rlist['work'][$val['id']]['jxname']=$val['jxname'];
				$rlist['work'][$val['id']]['start_time']=$val['start_time'];
				$rlist['work'][$val['id']]['end_time']=$val['end_time'];
				$rlist['work'][$val['id']]['postname']=$val['postname'];
				$rlist['work'][$val['id']]['dename']=$val['dename'];	
			}		
		}
		$data['rlist']=$rlist;
		$data['sex'] = array('1'=>'男','2'=>'女');
		$data['company']=$this->get_all_list('crc_company',array('status'=>1),'cname');
		$this->load->view('admin/crc_manage/crc_rinfo', $data);
	}


	/**
     * crc简历管理-简历修改
     * @return [type] [description]
     */
	function crc_redit(){
		$this->checkauth('crc_resumes');
        $data['cdn'] = $this->cdn; 	
		$uid     = intval($this->input->get_post('uid'));
	    $this->load->model('crcresumesmodel');
		$this->load->model('crcmodel');
		$data['crcinfo']=$this->crcmodel->get_one($uid);
		$list=$this->crcresumesmodel->get_rs_all(array('uid'=>$uid,'status'=>1));
		$rlist=array();
		foreach($list as $val){
			if($val['type']==1){
				$rlist['trains'][$val['id']]['content']=$val['content'];
				$rlist['trains'][$val['id']]['jxname']=$val['jxname'];
				$rlist['trains'][$val['id']]['start_time']=$val['start_time'];
				$rlist['trains'][$val['id']]['end_time']=$val['end_time'];
				$rlist['trains'][$val['id']]['postname']=$val['postname'];



			}elseif($val['type']==2){
				$rlist['school'][$val['id']]['content']=$val['content'];
				$rlist['school'][$val['id']]['jxname']=$val['jxname'];
				$rlist['school'][$val['id']]['start_time']=$val['start_time'];
				$rlist['school'][$val['id']]['end_time']=$val['end_time'];
				$rlist['school'][$val['id']]['postname']=$val['postname'];
				$rlist['school'][$val['id']]['dename']=$val['dename'];

			
			}elseif($val['type']==3){
				$rlist['work'][$val['id']]['content']=$val['content'];
				$rlist['work'][$val['id']]['jxname']=$val['jxname'];
				$rlist['work'][$val['id']]['start_time']=$val['start_time'];
				$rlist['work'][$val['id']]['end_time']=$val['end_time'];
				$rlist['work'][$val['id']]['postname']=$val['postname'];
				$rlist['work'][$val['id']]['dename']=$val['dename'];	
			}		
		}
		$data['rlist']=$rlist;
		$data['uid']=$uid;
		$data['sex'] = array('1'=>'男','2'=>'女');
		$data['company']=$this->get_all_list('crc_company',array('status'=>1),'cname');
		$this->load->view('admin/crc_manage/crc_redit', $data);
	}
   /** 
	*crc 简历 删除 某条记录操作
	*wangrongjie	
	**/

	function del_resumes(){		
	    $id = $this->input->get_post("id");
		$this->load->model('crcresumesmodel');
		$this->crcresumesmodel->edit(array('status'=>0),$id);
		//$this->crcresumesmodel->del(array('id'=>$id));		
	    $msg='删除记录成功';
		echo json_encode($msg);		
				
	}

	/** 
	*crc 简历修改某条已有记录
	*wangrongjie	
	**/

	function crc_resumes_edit(){		
	    $id = $this->input->get_post("id");
		$data['cdn'] = $this->cdn; 
		$this->load->model('crcresumesmodel');
		$data['info']=$this->crcresumesmodel->get_one(array('id'=>$id));
		if($data['info']['type']==1){
			$data['jxname']='培训机构';
			$data['postname']='培训课程';
			$data['content']='培训内容';
		}elseif($data['info']['type']==2){
			$data['jxname']='学校名称';
			$data['postname']='专业';
			$data['dename']='学历';
			$data['content']='在校经历';
		}elseif($data['info']['type']==3){
			$data['jxname']='公司名称';
			$data['postname']='职位';
			$data['dename']='部门';
			$data['content']='工作内容';
		}
		$this->load->view('admin/crc_manage/crc_resumes_edit', $data);
						
	}

	/** 
	*crc 简历修改某条已有记录
	*wangrongjie	
	**/

	function crc_resumes_edit_do(){
		$id=$this->input->get_post("id");
		$uid=$this->input->get_post("uid");
		$data['jxname']=$this->input->get_post("jxname");
		$data['postname']=$this->input->get_post("postname");
		$data['dename']=$this->input->get_post("dename");
		$data['content']=$this->input->get_post("content");
		$data['start_time']=date('Y-m-d H:i:s',strtotime(trim($this->input->get_post("start_time"))));
		$data['end_time']=date('Y-m-d H:i:s',strtotime(trim($this->input->get_post("end_time"))));
		$this->load->model('crcresumesmodel');
		$res=$this->crcresumesmodel->edit($data,$id);
		if($res){
			 go('/index.php/admin/crc_manage/crc_redit?uid='.$uid,'操作成功',1);
		
		}else{
			 go('/index.php/admin/crc_manage/crc_redit?uid='.$uid,'操作失败');
		
		}




	}

    /** 
	*crc 简历修改替添加 某条记录 type 1-trains  2-school  3-work
	*wangrongjie	
	**/
	function add_crc_resumes(){
		$type = $this->input->get_post("type");
		$uid = $this->input->get_post("uid");

		if($type==1){
			$data['jxname']='培训机构';
			$data['postname']='培训课程';
			$data['content']='培训内容';
		}elseif($type==2){
			$data['jxname']='学校名称';
			$data['postname']='专业';
			$data['dename']='学历';
			$data['content']='在校经历';
		}elseif($type==3){
			$data['jxname']='公司名称';
			$data['postname']='职位';
			$data['dename']='部门';
			$data['content']='工作内容';
		}
		$data['type']=$type;
		$data['uid']=$uid;
		$this->load->view('admin/crc_manage/add_crc_resumes', $data);
	
	}


	/** 
	*crc 简历添加某条记录
	*wangrongjie	
	**/

	function add_crc_resumes_do(){
		
		$uid=$this->input->get_post("uid");
		$data['type']=$this->input->get_post("type");
		$data['jxname']=$this->input->get_post("jxname");
		$data['postname']=$this->input->get_post("postname");
		$data['dename']=$this->input->get_post("dename");
		$data['content']=$this->input->get_post("content");
		$data['start_time']=date('Y-m-d H:i:s',strtotime(trim($this->input->get_post("start_time"))));
		$data['end_time']=date('Y-m-d H:i:s',strtotime(trim($this->input->get_post("end_time"))));
		$data['uid']=$uid;
		$data['add_time']=time();
		$this->load->model('crcresumesmodel');
		$res=$this->crcresumesmodel->add($data);
		if($res){
			 go('/index.php/admin/crc_manage/crc_redit?uid='.$uid,'操作成功',1);
		
		}else{
			 go('/index.php/admin/crc_manage/crc_redit?uid='.$uid,'操作失败');
		
		}




	}







	/**
     * crc简历管理-简历修改执行
     * @return [type] [description]
     */
	function crc_redit_do(){
		$this->checkauth('crc_resumes');
        $data['cdn'] = $this->cdn; 
		$uid     = intval($this->input->get_post('uuid'));
		$phone     = trim($this->input->get_post('phone'));
		$email     = trim($this->input->get_post('email'));
		$company_id     = intval($this->input->get_post('company_id'));
		$work_year     = intval($this->input->get_post('work_year'));
		$resumes_status     = intval($this->input->get_post('resumes_status'));

		$doc_address1=$_FILES['doc_address']["name"];
		if($doc_address1){
			$doc_address=$this->upload_path('doc_address',$uid);	
		}
		$this->load->model('funcmodel');
		$res=$this->funcmodel->edit('web_user',array('phone'=>$phone,'email'=>$email),array('uid'=>$uid));
		$ret=$this->funcmodel->edit('crc_user',array('company_id'=>$company_id,'work_year'=>$work_year,'resumes_status'=>$resumes_status,'doc_address'=>$doc_address),array('uid'=>$uid));	
		
		go('/index.php/admin/crc_manage/crc_resumes','操作成功',1);
	}



	/**
   *批量更改简历状态为保密
   **/
	function crc_resumes_bm(){
		  $this->checkauth('crc_resumes');
          $md =$this->input->post('tempString');
		  $ids =explode(',',$md);
		  for($i=0;$i<count($ids);$i++){
			  $info = $this->funcmodel->edit('crc_user',array('resumes_status'=>2),array('uid'=>$ids[$i]));
			  
		  }
		   go('/index.php/admin/crc_manage/crc_resumes/', '操作成功', GO_SUCCESS);

	}

	/**
   *批量更改简历状态为公开
   **/
	function crc_resumes_gk(){
		  $this->checkauth('crc_resumes');
          $md =$this->input->post('tempString');
		  $ids =explode(',',$md);
		  for($i=0;$i<count($ids);$i++){
			  $info = $this->funcmodel->edit('crc_user',array('resumes_status'=>1),array('uid'=>$ids[$i]));
			  
		  }
		   go('/index.php/admin/crc_manage/crc_resumes/', '操作成功', GO_SUCCESS);

	}



	   /**
   *批量下载资源
   **/
	function download(){
		  $this->checkauth('crc_resumes');
          $md =$this->input->get('md');
		  if($md){
		      $info = $this->crcmodel->get_one($md);
			  $adderss=$info['doc_address'];
			  if($adderss!=null||$adderss!=''){
				  $fp=fopen($adderss,'r'); //打开文件
				  $us= explode("/",$info['doc_address']);
				  header('Content-Type:text/html;charset=utf-8');
				  header('Content-disposition:attachment;filename='.$us[count($us)-1]);
				  $filesize = filesize($adderss);
				  readfile($adderss);
				  header('Content-length:'.$filesize);
				  fclose($adderss);
			  
			  }
			  
		  }

	}


   /**
   *批量上传资源
   **/
	function crc_resumes_upload(){
		 $this->checkauth('crc_resumes');
		 $data['cdn']     = $this->cdn;
		 $this->load->view($this->view_path, $data);	
    }

	 /**
   *批量上传资源_执行
   **/
	function crc_resumes_upload_do(){
		 $this->checkauth('crc_resumes');
		 $doc_address1=$_FILES['doc_address']["name"];
		 if($doc_address1){
			$doc_address=$this->upload_paths('doc_address','resumes','/index.php/admin/crc_manage/crc_resumes_upload');	
		 }else{
			 go('/index.php/admin/crc_manage/crc_resumes_upload/', '请上传zip文件'); 
		 }

		 $filename=$_SERVER['DOCUMENT_ROOT'].$doc_address;
		 $destination=$this->readzipfile($filename,'resume');//解压缩
               
		$filesnames = scandir($destination);
		$con_arr='失败简历为：';
		$i=0;$j=0;

		foreach ($filesnames as $name) {
			
			if($name=='.'||$name=='..'){
			}else{//遍历文件夹内word文档 读取进库
				
				//$name=iconv("gb2312","UTF-8//IGNORE",$name);
				$file=$destination."/".$name;
				$username=$this->cdn.'/uploads/resume/'.$name;	
				$username=str_replace("////","/",$username);
				$username=str_replace("///","/",$username);
				$username=str_replace("//","/",$username);
				$username=str_replace("http:/www","http://www",$username);
				$fnamew= explode("_",$name);
				$uid=$fnamew[0];//uid
				//$fname=$fnamew[2];//简历doc名称
				$res=$this->funcmodel->edit('crc_user',array('doc_address'=>$username),array('uid'=>$uid));
				if($res){$i++;}else{$j++;$con_arr.=$name.'<br>';}
			}
		}

		 go('/index.php/admin/crc_manage/crc_resumes_upload/', '成功上传'.$i.'份简历，失败'.$j.'份'.$con_arr,1);	 
    }

	 /**
   *上传word 文档
   **/
	function upload_path($username,$fid){
		if (!file_exists('uploads/resumes/'.$fid)){ mkdir ('uploads/resumes/'.$fid, 0777);}
		$fname=$_FILES[$username]["name"];
		$type=trim($_FILES[$username]["type"]);
		//echo $type.'<br>';
			$config['upload_path'] = './uploads/resumes/'.$fid.'/';
			if(!file_exists($config['upload_path'])){
				@mkdir($config['upload_path'],0777);
				@touch($config['upload_path'].'index.html');
			}
			$config['allowed_types'] ='doc|docx';
			$config['max_size'] =1024*1024*20;
			$name_arr=explode('.',$fname);
			$filename=$name_arr[0];
			$config['file_name']= iconv("UTF-8","GB2312//IGNORE",$filename);//$username;
			$this->load->library('upload', $config);
			$this->upload->initialize($config); 
			if ( ! $this->upload->do_upload($username)){
			   $error = array('error' => $this->upload->display_errors());  
			   go('/index.php/admin/crc_manage/crc_redit?uid='.$fid, $error['error']);
			}else{
				$data = $this->upload->data();
				$filename=iconv('GB2312', 'UTF-8',  $data['file_name']);
			    $username=$this->cdn.'/uploads/resumes/'.$fid.'/'.$filename;	
				$username=str_replace("////","/",$username);
				$username=str_replace("///","/",$username);
				$username=str_replace("//","/",$username);
				$username=str_replace("http:/www","http://www",$username);
				return $username;
			}	
	}


   /**
   *CRC 人员管理  全部人员管理  crc加入机构 推出机构 加入项目 退出项目 等管理
   **/
   function crc_lists(){
	    $this->checkauth('crc_lists');
        $data['cdn'] = $this->cdn;       
        $this->load->helper('Page');
        $where['crc']      = 1;
        $page_where = '';
        $search     = trim($this->input->get_post('search'));
	
        if (isset($search) && $search) {
            $where['search'] = $search;
            $page_where      = 'search=' . $search;
        }
		$this->load->model('webusermodel');
        $count            = $this->webusermodel->count($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
        $data['crclist'] = $this->webusermodel->get_all($where, $p->firstRow, $p->listRows);
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
        $this->load->view('admin/crc_manage/crc_lists', $data);
   }

   /**
   *CRC 人员管理  某项目 机构 人员列表
   **/
   function crc_lists_check(){
	    $this->checkauth('crc_lists');
        $data['cdn'] = $this->cdn;       
        $this->load->helper('Page');
        $where['crc']      = 1;
        $page_where = '';
        $items_id     = intval($this->input->get_post('items_id'));
		$inits_id     = intval($this->input->get_post('inits_id'));
		$id     = trim($this->input->get_post('id'));
		if($id){
			$ids=explode('_',$id);
			$items_id     = $ids[0];
		    $inits_id     = $ids[1];
		}

		$search     = trim($this->input->get_post('search'));
	
        if (isset($search) && $search) {
            $where['search'] = $search;
            $page_where      = 'search=' . $search;
        }

       

	
        $where=array('items_id'=>$items_id,'inits_id'=>$inits_id);
		$this->load->model('webusermodel');
        $count            = $this->webusermodel->count_gt($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['inits_id']   = $inits_id;
		$data['items_id']   = $items_id;
		$data['check']   = 1;
		$data['search']   = $search;
        $data['crclist'] = $this->webusermodel->get_all_gt($where, $p->firstRow, $p->listRows);
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
        $this->load->view('admin/crc_manage/crc_lists', $data);
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
	function crc_lists_enter(){
		$this->checkauth('crc_lists');
		$items_id=$this->input->get_post('items_id');
		$inits_id=$this->input->get_post('inits_id');
		$uid=$this->input->get_post('uid');
		/*
          $md =$this->input->post('tempString');
		  $ids =explode(',',$md);
		  for($i=0;$i<count($ids);$i++){	  
			  $add=array('inis_id'=>$inits_id,'items_id'=>$items_id,'uid'=>$ids[$i],'type'=>1,'add_time'=>time());
			  $rs=$this->funcmodel->add('crc_items',$add);
		  }
		  */
           //一个项目 一个机构只有crc人员 
		   $where=array('inis_id'=>$inits_id,'items_id'=>$items_id,'status'=>1,'type'=>1);
		   $info=$this->funcmodel->get_all('crc_items',$where);
		   if(count($info)){
			   if(count($info)>1){
				   go('/index.php/admin/crc_manage/crc_lists/', '操作失败');
				   exit;
			   
			   }else{
				   if($info[0]['uid']!=$uid){
					   go('/index.php/admin/crc_manage/crc_lists/', '操作失败');
				        exit;
				   }			   
			   }
		   }
		   $add=array('inis_id'=>$inits_id,'items_id'=>$items_id,'uid'=>$uid,'type'=>1,'add_time'=>time());
		   $rs=$this->funcmodel->add('crc_items',$add);
		   if($rs){
			    go('/index.php/admin/crc_manage/crc_lists/', '操作成功', GO_SUCCESS);
		   }else{
			    go('/index.php/admin/crc_manage/crc_lists/', '操作失败');
		   }
		 


		  
	}


	/**
     * 退出某项目的某机构
     * @return [type] [description]
     */
	function crc_lists_out(){
		$this->checkauth('crc_lists');
		$items_id=$this->input->get_post('items_id');
		$inits_id=$this->input->get_post('inits_id');
		$check=$this->input->get_post('check');
         /* $md =$this->input->post('tempString');
		  $ids =explode(',',$md);
		  for($i=0;$i<count($ids);$i++){	  
			  $where=array('inis_id'=>$inits_id,'items_id'=>$items_id,'uid'=>$ids[$i],'type'=>1,'status'=>1);
			  $edit=array('status'=>0,'out_time'=>time());
			  $rs=$this->funcmodel->edit('crc_items',$edit,$where);
		  }
		  */
		   $uid=$this->input->get_post('uid');
		    $where=array('inis_id'=>$inits_id,'items_id'=>$items_id,'uid'=>$uid,'type'=>1,'status'=>1);
			 $edit=array('status'=>0,'out_time'=>time());
			 $rs=$this->funcmodel->edit('crc_items',$edit,$where);

		  if($check){
			  $url='/index.php/admin/crc_manage/crc_lists_check?id='.$items_id.'_'.$inits_id;	
		  }else{
			  $url='/index.php/admin/crc_manage/crc_lists/';		
		  }

		  if($rs){
			  go($url, '操作成功', GO_SUCCESS);		  
		  }else{
			  go($url, '操作失败');
		  }

	}

}
