<?php
class Adminaction extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
    /**
     * 添加权限
     */
    function add_action() {
        $this->checkauth('add_action');
        $this->load->model('adminactionmodel');
		$list = $this->adminactionmodel->parentlists();
        $data['parent'] = $list;
        $data['cdn'] = $this->cdn;
		$this->load->view('admin/adminaction/action_add',$data);
    }
    /**
     * 添加权限-处理
     */
    function add_action_do() {

        $this->checkauth('add_action');

        $parent_id = intval($this->input->post('parent_id'));
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $list_show = intval($this->input->post('list_show'));
        $c = $this->input->post('c');
        $m = $this->input->post('m');
        $img = $this->input->post('img');
        $order = (int) $this->input->post('order');
		$this->load->model('adminactionmodel');
        if(!$name || !$code){
            go('/index.php/admin/adminaction/add_action/','权限名称和代码 须填写完整!');
        }
        if($this->adminactionmodel->action_exist(array('code'=>$code))){
            go('/index.php/admin/adminaction/add_action/','权限代码已存在,请更换!');
        }
        
        $data = array('pid'=>$parent_id,'code'=>$code,'name'=>$name,'show'=>$list_show,'func_c'=>$c,'func_m'=>$m,'img'=>$img,'order'=>$order);
        if(!$this->adminactionmodel->add_action($data))
        {
            go('/index.php/admin/adminaction/add_action','添加失败，请重新添加');
        }else{
          go('/index.php/admin/adminaction/action_list/','添加成功',1);
        }
    }

    /**
     * 获取权限列表
     * @return [type] [description]
     */
    function action_list() {

        $this->checkauth('action_list');
		$data['cdn'] = $this->cdn;
        $this->load->model('adminactionmodel');
        $search = trim($this->input->get_post('search'));
        $this->load->helper('Page');
        $where = array();
        if(isset($search) &&$search){
            $where['search'] = $search;
            $page_url .= '&search='.$search;
        }
        $count = $this->adminactionmodel->action_count($where);
        $p = new Page ( $count, 10 ,$page_url);
        $data['page'] = $p->show();// 分页代码
        $data['search'] = $search;
        $data['list'] = $this->adminactionmodel->get_list_page($p->firstRow,$p->listRows,$where);
		$this->load->view('admin/adminaction/action_list',$data);
    }

    /**
     * 角色权限-表单
     * @return [type] [description]
     */
    function open_user_action() {

        $this->checkauth('role_list');
		$data['cdn'] = $this->cdn;
        $id = $this->input->get('id');
        if(!$id){
            go('/index.php/admin/role/role_list','未知角色');
        }        
        $this->load->model('adminactionmodel');
        // 获取父级权限
		$list = $this->adminactionmodel->get_action(0);
        // 获取该父级下的子级权限
        foreach($list as $key=>$value){
            $list[$key]['child'] = $this->adminactionmodel->get_action($value['id']);
            foreach($list[$key]['child'] as $v){
                $child = $this->adminactionmodel->get_action($v['id']);
                foreach($child as $vc ){
                    $list[$key]['child'][] = $vc;
                }
            }
        }
        $this->load->model('rolemodel');
        $hisaction =$this->rolemodel->get_one($id);
        $actions = $hisaction['priv'];
        //$actionarr = explode(',',$actinons);
        $data['actions'] = $actions; 
        $data['id'] = $id;
        $data['list'] = $list;
		$this->load->view('admin/adminaction/change_user_action',$data);
    }

    /**
     * 用户权限 表单处理
     * @return [type] [description]
     */
    function open_user_action_do() {
        $this->checkauth('role_list');
        $actionarr = $this->input->post('code');
        $id = $this->input->post('id');
        if(!$id){
            go('/index.php/admin/role/role_list','未知角色');
        }
        $actions = implode(',',$actionarr);
        $this->load->model('rolemodel');
        $data = array('priv'=>$actions);
        $info = $this->rolemodel->edit($data,$id);
        go('/index.php/admin/role/role_list/','操作成功',1);
    }

    /**
     * 操作管理员的登录状态
     * @return [type] [description]
     */
    function change_user_status(){

        $this->checkauth('view_user_list');
        $state = (int) $this->input->get('state');
        $uid   = (int) $this->input->get('uid');
        if(!$uid){
            go('/index.php/admin/user/user_list','未知管理员');
        } 
        if($uid == $this->super_uid){
            go('/index.php/admin/user/user_list','不允许操作超级管理员');
        }
        $this->load->model('usermodel');    
        $uinfo = $this->usermodel->get_one($uid);
        if(!$uinfo){
            go('/index.php/admin/user/user_list','未知管理员 error:2');
        }
        //验证 状态是否一致
        if($state != $uinfo['state']){
            go('/index.php/admin/user/user_list','该管理员状态信息已变更，请刷新后操作');
        }
        // 状态变更
        if($state){ 
            $state = 0;
        }else{
            $state=1;
        }
        $ret = $this->usermodel->edit(array('state'=> $state),$uid);
        if(!$ret){
            go('/index.php/admin/user/user_list','操作失败，请重新操作');
        }else{
          go('/index.php/admin/user/user_list/','操作成功',1);
        }
    }

    /**
     * 权限编辑-表单
     * @return [type] [description]
     */
    function action_edit() {

        $this->checkauth('action_list');
        $action_id = intval($this->input->get('action_id'));
        if(!$action_id){
            go('/index.php/admin/adminaction/action_list/','未获取到权限id，请重试');
        }
        $this->load->model('adminactionmodel');

        $list = $this->adminactionmodel->get_action_by_id($action_id);
        if(!$list){
            go('/index.php/admin/adminaction/action_list/','未获取到权限信息，请重试');
        }
		$parentlist = $this->adminactionmodel->parentlists();

        $data['parent'] = $parentlist;

        $data['cdn'] = $this->cdn;
        $data['list'] = $list;
		$this->load->view('admin/adminaction/action_edit',$data);
    }

    /**
     * 权限编辑-表单处理
     * @return [type] [description]
     */
    function action_edit_do() {

        $this->checkauth('action_list');
        $action_id = intval($this->input->post('action_id'));
        if(!$action_id){
            go('/index.php/admin/adminaction/action_edit?action_id='.$action_id,'未获取到权限id，请重试');
        }
        $this->load->model('adminactionmodel');
        $list = $this->adminactionmodel->get_action_by_id($action_id);
        if(!$list){
            go('/index.php/admin/adminaction/action_list/','未获取到权限信息，请重试');
        } 
        $parent_id = intval($this->input->post('parent_id'));
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $list_show = intval($this->input->post('list_show'));
        $c = $this->input->post('c');
        $m = $this->input->post('m');
        $img = $this->input->post('img');
        $order = $this->input->post('order');
        if(!$name || !$code){
            go('/index.php/admin/adminaction/action_edit?action_id='.$action_id,'权限名称和代码需填写完整，请重试');
        }
        $data = array('pid'=>$parent_id,'code'=>$code,'name'=>$name,'show'=>$list_show,'func_c'=>$c,'func_m'=>$m,'img'=>$img,'order'=>$order);

        if(!$this->adminactionmodel->edit_action($data,$action_id))
        {
            go('/index.php/admin/adminaction/action_edit?action_id='.$action_id,'编辑失败，请重新编辑');
        }else{
          go('/index.php/admin/adminaction/action_list/','编辑成功',1);
        }
    }

    /**
     * ajax验证 权限代码是否存在
     * @return [type] [description]
     */
    function action_check(){
        $this->load->model('adminactionmodel');
        $code = $this->input->post('code');
        if(!preg_match('/^[a-z]\w{1,20}$/i',$code)){
            $ret = array('valid'=>false);
        }else{   
            $exist = $this->adminactionmodel->action_exist(array('code'=>$code));
            $ret = array('valid'=>true);
            if($exist){
                $ret = array('valid'=>false,'message'=>'代码标识已存在,请更换');
            }
        }
        echo json_encode($ret);     
    }



    /**
     * 给用户赋予可见机构权限
     * @return [type] [description]
     */
	function open_user_gaction() {
        $this->checkauth('view_user_list');
		$data['cdn'] = $this->cdn;
        $uid = $this->input->get('uid');
        $inst=$this->get_all_list('inst',array('status'=>1),'instname');   
        $this->load->model('usermodel');
        $hisaction =$this->usermodel->get_one(array('uid'=>$uid)); //var_dump($hisaction);
        $actions = unserialize($hisaction['inits_priv']);
        $data['actions'] = $actions;
        $data['uid'] = $uid;
        $data['list'] = $inst;
		$this->load->view('admin/adminaction/change_user_gaction',$data);
    }

     /**
     * 给用户赋予可见机构权限
     * @return [type] [description]
     */

	 function open_user_gaction_do() {

        $this->checkauth('view_user_list');
        $md =$this->input->post('tempString');
		$inits_priv =explode(',',$md);
        $inits_priv = serialize($inits_priv);
        $uid = $this->input->post('uid');
        if(!$uid){
            go('/index.php/admin/user/user_list','未知管理员');
        }
        $this->load->model('usermodel');
        $data = array('inits_priv'=>$inits_priv);
        $info = $this->usermodel->edit($data,$uid);
		 go('/index.php/admin/user/user_list/','操作成功',1);
    }


	 /**
     * 给用户赋予可见机构权限
     * @return [type] [description]
     */
	function open_user_taction() {
        $this->checkauth('view_user_list');
		$data['cdn'] = $this->cdn;
        $uid = $this->input->get('uid');
        $item=$this->get_all_list('items',array('status'=>1),'name');   
        $this->load->model('usermodel');
        $hisaction =$this->usermodel->get_one(array('uid'=>$uid)); //var_dump($hisaction);
        $actions = unserialize($hisaction['items_priv']);
        $data['actions'] = $actions;
        $data['uid'] = $uid;
        $data['list'] = $item;
		$this->load->view('admin/adminaction/change_user_taction',$data);
    }

     /**
     * 给用户赋予可见机构权限
     * @return [type] [description]
     */

	 function open_user_taction_do() {

        $this->checkauth('view_user_list');
        $md =$this->input->post('tempString');
		$items_priv =explode(',',$md);
        $items_priv = serialize($items_priv);
        $uid = $this->input->post('uid');
        if(!$uid){
            go('/index.php/admin/user/user_list','未知管理员');
        }
        $this->load->model('usermodel');
        $data = array('items_priv'=>$items_priv);
        $info = $this->usermodel->edit($data,$uid);
		 go('/index.php/admin/user/user_list/','操作成功',1);
    }






}