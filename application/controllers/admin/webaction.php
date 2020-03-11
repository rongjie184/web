<?php
class Webaction extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}
    /**
     * 添加权限
     */
    function add_waction() {
        $this->checkauth('add_waction');
        $this->load->model('webactionmodel');
		$list = $this->webactionmodel->parentlists();
        $data['parent'] = $list;
        $data['cdn'] = $this->cdn;
		$this->load->view('admin/webaction/action_add',$data);
    }
    /**
     * 添加权限-处理
     */
    function add_waction_do() {

        $this->checkauth('add_waction');

        $parent_id = intval($this->input->post('parent_id'));
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $list_show = 0;
        $c = $this->input->post('c');
        $m = $this->input->post('m');
        $this->load->model('webactionmodel');
        $order = (int) $this->input->post('order');
        if(!$name || !$code){
            go('/index.php/admin/webaction/add_waction/','权限名称和代码 须填写完整!');
        }
        if($this->webactionmodel->action_exist(array('code'=>$code))){
            go('/index.php/admin/webaction/add_waction/','权限代码已存在,请更换!');
        }
       
        $data = array('pid'=>$parent_id,'code'=>$code,'name'=>$name,'show'=>$list_show,'func_c'=>$c,'func_m'=>$m,'order'=>$order);
        if(!$this->webactionmodel->add_action($data))
        {
            go('/index.php/admin/webaction/add_waction','添加失败，请重新添加');
        }else{
          go('/index.php/admin/webaction/waction_list/','添加成功',1);
        }
    }

    /**
     * 获取权限列表
     * @return [type] [description]
     */
    function waction_list() {

        $this->checkauth('waction_list');
		$data['cdn'] = $this->cdn;
        $this->load->model('webactionmodel');
        $search = trim($this->input->get_post('search'));
        $this->load->helper('Page');
        $where = array();
        if(isset($search) &&$search){
            $where['search'] = $search;
            $page_url .= '&search='.$search;
        }
        $count = $this->webactionmodel->action_count($where);
        $p = new Page ( $count, 10 ,$page_url);
        $data['page'] = $p->show();// 分页代码
        $data['search'] = $search;
        $data['list'] = $this->webactionmodel->get_list_page($p->firstRow,$p->listRows,$where);
		$this->load->view('admin/webaction/action_list',$data);
    }

    /**
     * 角色权限-表单
     * @return [type] [description]
     */
    function open_user_waction() {

        $this->checkauth('wrole_list');
		$data['cdn'] = $this->cdn;
        $id = $this->input->get('id');
        if(!$id){
            go('/index.php/admin/web_role/wrole_list','未知角色');
        }        
        $this->load->model('webactionmodel');
        // 获取父级权限
		$list = $this->webactionmodel->get_action(0);
        // 获取该父级下的子级权限
        foreach($list as $key=>$value){
            $list[$key]['child'] = $this->webactionmodel->get_action($value['id']);
            foreach($list[$key]['child'] as $v){
                $child = $this->webactionmodel->get_action($v['id']);
                foreach($child as $vc ){
                    $list[$key]['child'][] = $vc;
                }
            }
        }
        $this->load->model('webrolemodel');
        $hisaction =$this->webrolemodel->get_one($id);
        $actions = $hisaction['priv'];
        //$actionarr = explode(',',$actinons);
        $data['actions'] = $actions; 
        $data['id'] = $id;
        $data['list'] = $list;
		$this->load->view('admin/webaction/change_user_action',$data);
    }

    /**
     * 用户权限 表单处理
     * @return [type] [description]
     */
    function open_user_waction_do() {
        $this->checkauth('wrole_list');
        $actionarr = $this->input->post('code');
        $id = $this->input->post('id');
        if(!$id){
            go('/index.php/admin/web_role/wrole_list','未知角色');
        }
        $actions = implode(',',$actionarr);
        $this->load->model('webrolemodel');
        $data = array('priv'=>$actions);
        $info = $this->webrolemodel->edit($data,$id);
        go('/index.php/admin/web_role/wrole_list/','操作成功',1);
    }

    /**
     * 操作管理员的登录状态
     * @return [type] [description]
     */
    function change_wuser_status(){

        $this->checkauth('wuser_list');
        $state = (int) $this->input->get('state');
        $uid   = (int) $this->input->get('uid');
        if(!$uid){
            go('/index.php/admin/web_user/wuser_list','未知管理员');
        } 
        if($uid == $this->super_uid){
            go('/index.php/admin/web_user/wuser_list','不允许操作超级管理员');
        }
        $this->load->model('webusermodel');    
        $uinfo = $this->webusermodel->get_one($uid);
        if(!$uinfo){
            go('/index.php/admin/web_user/wuser_list','未知管理员 error:2');
        }
        //验证 状态是否一致
        if($state != $uinfo['state']){
            go('/index.php/admin/web_user/wuser_list','该管理员状态信息已变更，请刷新后操作');
        }
        // 状态变更
        if($state){ 
            $state = 0;
        }else{
            $state=1;
        }
        $ret = $this->webusermodel->edit(array('state'=> $state),$uid);
        if(!$ret){
            go('/index.php/admin/web_user/wuser_list','操作失败，请重新操作');
        }else{
          go('/index.php/admin/web_user/wuser_list/','操作成功',1);
        }
    }

    /**
     * 权限编辑-表单
     * @return [type] [description]
     */
    function waction_edit() {

        $this->checkauth('waction_list');
        $action_id = intval($this->input->get('action_id'));
        if(!$action_id){
            go('/index.php/admin/webaction/waction_list/','未获取到权限id，请重试');
        }
        $this->load->model('webactionmodel');

        $list = $this->webactionmodel->get_action_by_id($action_id);
        if(!$list){
            go('/index.php/admin/webaction/waction_list/','未获取到权限信息，请重试');
        }
		$parentlist = $this->webactionmodel->parentlists();

        $data['parent'] = $parentlist;

        $data['cdn'] = $this->cdn;
        $data['list'] = $list;
		$this->load->view('admin/webaction/action_edit',$data);
    }

    /**
     * 权限编辑-表单处理
     * @return [type] [description]
     */
    function waction_edit_do() {

        $this->checkauth('waction_list');
        $action_id = intval($this->input->post('action_id'));
        if(!$action_id){
            go('/index.php/admin/webaction/waction_edit?action_id='.$action_id,'未获取到权限id，请重试');
        }
        $this->load->model('webactionmodel');
        $list = $this->webactionmodel->get_action_by_id($action_id);
        if(!$list){
            go('/index.php/admin/webaction/waction_list/','未获取到权限信息，请重试');
        } 
        $parent_id = intval($this->input->post('parent_id'));
        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $list_show =0;
        $c = $this->input->post('c');
        $m = $this->input->post('m');
     
        $order = $this->input->post('order');
        if(!$name || !$code){
            go('/index.php/admin/webaction/waction_edit?action_id='.$action_id,'权限名称和代码需填写完整，请重试');
        }
        $data = array('pid'=>$parent_id,'code'=>$code,'name'=>$name,'show'=>$list_show,'func_c'=>$c,'func_m'=>$m,'order'=>$order);

        if(!$this->webactionmodel->edit_action($data,$action_id))
        {
            go('/index.php/admin/webaction/waction_edit?action_id='.$action_id,'编辑失败，请重新编辑');
        }else{
          go('/index.php/admin/webaction/waction_list/','编辑成功',1);
        }
    }

    /**
     * ajax验证 权限代码是否存在
     * @return [type] [description]
     */
    function waction_check(){
        $this->load->model('webactionmodel');
        $code = $this->input->post('code');
        if(!preg_match('/^[a-z]\w{1,20}$/i',$code)){
            $ret = array('valid'=>false);
        }else{   
            $exist = $this->webactionmodel->action_exist(array('code'=>$code));
            $ret = array('valid'=>true);
            if($exist){
                $ret = array('valid'=>false,'message'=>'代码标识已存在,请更换');
            }
        }
        echo json_encode($ret);     
    }
}