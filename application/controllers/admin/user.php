<?php
class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

    }
    /**
     * 修改密码-表单
     * @return [type] [description]
     */
    public function edit_mypass()
    {
        $data['cdn']      = $this->cdn;
        $data['username'] = $this->session->userdata('username');
        $this->load->view('admin/user/edit_pass', $data);
    }

    /**
     * 修改密码-表单处理
     * @return [type] [description]
     */
    public function edit_mypass_do()
    {
        $newpass   = $this->input->post('newpass');
        $repatpass = $this->input->post('repatpass');
        $this->load->model('usermodel');
        if (!$newpass or !$repatpass) {
            go('/index.php/admin/user/edit_mypass/', '密码/重复密码 不可为空');
        }
        if ($newpass == $repatpass) {
            $data = array('passwd' => md5($newpass));
            $info = $this->usermodel->edit($data, $this->userid);
            go('/index.php/admin/login/login_out', '修改成功！即将重新登录', 1);
        } else {
            go('/index.php/admin/user/edit_mypass/', '请输入两次相同的密码');
        }
    }

    /**
     * 管理员列表
     * @return [type] [description]
     */
    public function user_list()
    {
        $this->checkauth('view_user_list');
        $data['cdn'] = $this->cdn;
        $this->load->model('usermodel');

        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
        $search     = trim($this->input->get_post('search'));
		//echo $search;
		$roleid     = trim($this->input->get_post('roleid'));

        if (isset($search) && $search) {
            $where['search'] = $search;
            $page_where      = 'search=' . $search;
        }

		if (isset($roleid) && $roleid) {
            $where['role_id'] = $roleid;
            $page_where      = 'roleid=' . $roleid;
        }

        $count            = $this->usermodel->count($where);
        // var_dump($count);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['search']   = $search;
		$data['roleid']   = $roleid;
        $data['where']    = $where;
        $data['userlist'] = $this->usermodel->get_all($where, $p->firstRow, $p->listRows);
		$this->load->model('rolemodel');
        $data['rlist'] = $this->rolemodel->get_all();
		$data['rolelist']=$this->get_role();
		$this->load->view('admin/user/user_list', $data);
    }

    /**
     * 添加管理员-表单
     */
    public function add_user()
    {
        $this->checkauth('add_user');
        $data['cdn'] = $this->cdn;
		$this->load->model('rolemodel');
        $data['rolelist'] = $this->rolemodel->get_all();
        $this->load->view('admin/user/user_add', $data);
    }

    /**
     * 添加管理员-表单处理
     * @return [type] [description]
     */
    public function add_user_do()
    {
        $this->checkauth('add_user');
        $uname     = trim($this->input->post('uname'));
        $account   = $this->input->post('account');
        $passwd    = $this->input->post('passwd');
		$roleid    = $this->input->post('roleid');
        $repatpass = $this->input->post('repatpass');
        $this->load->model('usermodel');
        $data = array('uname' => $uname, 'account' => $account, 'passwd' => $passwd, 'repatpass' => $repatpass,'add_time'=>time(),'last_login'=>0,'state'=>0,'role_id'=>$roleid);
        $ret  = $this->usermodel->sence_check($data, 'add');
        if (!$ret['status']) {
            go('/index.php/admin/user/add_user', $ret['err_info']);
        }
        $data['passwd'] = md5($passwd);
        unset($data['repatpass']);
        if (!$this->usermodel->add($data)) {
            go('/index.php/admin/user/add_user', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/user/user_list', '添加成功', GO_SUCCESS);
        }
    }

    /**
     * 编辑管理员-表单
     * @return [type] [description]
     */
    public function user_edit()
    {
        $this->checkauth('view_user_list');
        $data['cdn'] = $this->cdn;
        $this->load->model('usermodel');
        $uid  = $this->input->get_post('uid');
        $info = $this->usermodel->get_one($uid);
        if (!count($info)) {
            go('/index.php/admin/user/user_list/', '未获取到信息,请刷新来源页面');
        }
        $data['sinfo'] = $info;
		$this->load->model('rolemodel');
        $data['rolelist'] = $this->rolemodel->get_all();
        $this->load->view('admin/user/user_edit', $data);
    }

    /**
     * 编辑管理员-表单处理
     * @return [type] [description]
     */
    public function user_edit_do()
    {

        $this->checkauth('view_user_list');

        $uname     = $this->input->post('uname');
        $account   = $this->input->post('account');
        $passwd    = $this->input->post('passwd');
        $repatpass = $this->input->post('repatpass');
		$roleid    = $this->input->post('roleid');
        if ($passwd && $repatpass) {
            if ($passwd != $repatpass) {
                go('/index.php/main', '两次密码不一致');
            } else {
                $data = array('uname' => $uname, 'account' => $account, 'passwd' => md5($passwd),'role_id'=>$roleid);
            }
        } else {
            $data = array('uname' => $uname, 'account' => $account,'role_id'=>$roleid);
        }
        $uid = trim($this->input->get_post('uid'));
        if (!$uid) {
            go('/index.php/admin/user/user_list', '未获取到用户id，请返回重新操作');
        }
        $this->load->model('usermodel');
        $info = $this->usermodel->edit($data, $uid);
        go('/index.php/admin/user/user_list/', '修改成功！', 1);
    }

    /**
     * ajax 验证 账号是否存在
     * @return [type] [description]
     */
    public function user_account_check()
    {
        $this->load->model('usermodel');
        $account = $this->input->post('account');
        $data    = array('account' => $account);
        // usermodel 验证 account
        $res = $this->usermodel->sence_check($data, 'add');
        $ret = array('valid' => (bool) $res['status'], 'message' => $res['err_info']);
        echo json_encode($ret);
    }

	  /**
     * ajax 验证 账号是否存在-修改
     * @return [type] [description]
     */
    public function user_accounts_check()
    {
        $this->load->model('usermodel');
        $account = $this->input->post('account');
		$uid = $this->input->post('uid');
        $data    = array('account' => $account);
        // usermodel 验证 account
        $res = $this->usermodel->get_one($data);
		if($res['uid']){
			if($res['uid']==$uid){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
        
        echo json_encode($ret);
    }


}
