<?php
class Role extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

    }
   
    /**
     * 角色列表
     * @return [type] [description]
     */
    public function role_list()
    {
        $this->checkauth('role_list');
        $data['cdn'] = $this->cdn;
        $this->load->model('rolemodel');
        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
        $rolename     = trim($this->input->get_post('rolename'));

        if (isset($rolename) && $rolename) {
            $where['rolename'] = $rolename;
            $page_where      = 'rolename=' . $rolename;
        }
        $count            = $this->rolemodel->count($where);
        // echo $count;
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['rolename']   = $rolename;
        $data['where']    = $where;
        $data['rolelist'] = $this->rolemodel->get_all($where, $p->firstRow, $p->listRows);
        $this->load->view('admin/role/role_list', $data);
    }

    /**
     * 添加角色-表单
     */
    public function add_role()
    {
        $this->checkauth('add_role');
        $data['cdn'] = $this->cdn;
        $this->load->view('admin/role/role_add', $data);
    }

    /**
     * 添加管理员-表单处理
     * @return [type] [description]
     */
    public function add_role_do()
    {
        $this->checkauth('add_role');
        $rolename     = trim($this->input->post('rolename'));
       
        $this->load->model('rolemodel');
        $data = array('rolename' => $rolename,'add_time'=>time(),'priv'=>'');
        $ret  = $this->rolemodel->sence_check($data, 'add');
        // var_dump($ret);
        if (!$this->rolemodel->add($data)) {
            go('/index.php/admin/role/add_role', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/role/role_list', '添加成功', GO_SUCCESS);
        }
    }

    /**
     * 编辑角色-表单
     * @return [type] [description]
     */
    public function role_edit()
    {
        $this->checkauth('role_list');
        $data['cdn'] = $this->cdn;
        $this->load->model('rolemodel');
        $id  = $this->input->get_post('id');
        $info = $this->rolemodel->get_one($id);
        if (!count($info)) {
            go('/index.php/admin/role/role_list/', '未获取到信息,请刷新来源页面');
        }
        $data['sinfo'] = $info;
        $this->load->view('admin/role/role_edit', $data);
    }

    /**
     * 编辑角色-表单处理
     * @return [type] [description]
     */
    public function role_edit_do()
    {

        $this->checkauth('role_list');

        $rolename     = $this->input->post('rolename');
       
        $data = array('rolename' => $rolename);
        
        $id = trim($this->input->get_post('id'));
        if (!$id) {
            go('/index.php/admin/role/role_list', '未获取角色id，请返回重新操作');
        }
        $this->load->model('rolemodel');
        $info = $this->rolemodel->edit($data, $id);
        go('/index.php/admin/role/role_list/', '修改成功！', 1);
    }

    /**
     * ajax 验证 账号是否存在
     * @return [type] [description]
     */
    public function role_name_check()
    {
        $this->load->model('rolemodel');
        $rolename = $this->input->post('rolename');
        $data    = array('rolename' => $rolename);
        // rolemodel 验证 rolename
        $res = $this->rolemodel->get_one($data);
		if($res['id']){
			$ret = array('valid' => false);
		}else{
			$ret = array('valid' => true);
		
		}
       
        echo json_encode($ret);
    }

	 /**
     * ajax 验证 账号是否存在
     * @return [type] [description]
     */
    public function role_names_check()
    {
        $this->load->model('rolemodel');
        $rolename = $this->input->post('rolename');
		$id = $this->input->post('id');
        $data    = array('rolename' => $rolename);    
        $res = $this->rolemodel->get_one($data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
		echo json_encode($ret);


    }


}
