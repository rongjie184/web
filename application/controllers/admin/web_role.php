<?php
class Web_role extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

    }
   
    /**
     * 角色列表
     * @return [type] [description]
     */
    public function wrole_list()
    {
        $this->checkauth('wrole_list');
        $data['cdn'] = $this->cdn;
        $this->load->model('webrolemodel');
        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
        $rolename     = trim($this->input->get_post('rolename'));

        if (isset($rolename) && $rolename) {
            $where['rolename'] = $rolename;
            $page_where      = 'rolename=' . $rolename;
        }
        $count            = $this->webrolemodel->count($where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['rolename']   = $rolename;
        $data['where']    = $where;
        $data['rolelist'] = $this->webrolemodel->get_all($where, $p->firstRow, $p->listRows);
        $this->load->view('admin/web_role/role_list', $data);
    }

    /**
     * 添加角色-表单
     */
    public function add_wrole()
    {
        $this->checkauth('add_wrole');
        $data['cdn'] = $this->cdn;
        $this->load->view('admin/web_role/role_add', $data);
    }

    /**
     * 添加管理员-表单处理
     * @return [type] [description]
     */
    public function add_wrole_do()
    {
        $this->checkauth('add_wrole');
        $rolename     = trim($this->input->post('rolename'));
       
        $this->load->model('webrolemodel');
        $data = array('rolename' => $rolename,'add_time'=>time(),'priv'=>'');
        $ret  = $this->webrolemodel->sence_check($data, 'add');
      
        if (!$this->webrolemodel->add($data)) {
            go('/index.php/admin/web_role/add_wrole', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/web_role/wrole_list', '添加成功', GO_SUCCESS);
        }
    }

    /**
     * 编辑角色-表单
     * @return [type] [description]
     */
    public function wrole_edit()
    {
        $this->checkauth('wrole_list');
        $data['cdn'] = $this->cdn;
        $this->load->model('webrolemodel');
        $id  = $this->input->get_post('id');
        $info = $this->webrolemodel->get_one($id);
        if (!count($info)) {
            go('/index.php/admin/web_role/wrole_list/', '未获取到信息,请刷新来源页面');
        }
        $data['sinfo'] = $info;
        $this->load->view('admin/web_role/role_edit', $data);
    }

    /**
     * 编辑角色-表单处理
     * @return [type] [description]
     */
    public function wrole_edit_do()
    {

        $this->checkauth('wrole_list');

        $rolename     = $this->input->post('rolename');
       
        $data = array('rolename' => $rolename);
        
        $id = trim($this->input->get_post('id'));
        if (!$id) {
            go('/index.php/admin/web_role/wrole_list', '未获取角色id，请返回重新操作');
        }
        $this->load->model('webrolemodel');
        $info = $this->webrolemodel->edit($data, $id);
        go('/index.php/admin/web_role/wrole_list/', '修改成功！', 1);
    }

    /**
     * ajax 验证 账号是否存在
     * @return [type] [description]
     */
    public function role_name_check()
    {
        $this->load->model('webrolemodel');
        $rolename = $this->input->post('rolename');
        $data    = array('rolename' => $rolename);
        // webrolemodel 验证 rolename
        $res = $this->webrolemodel->get_one($data);
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
        $this->load->model('webrolemodel');
        $rolename = $this->input->post('rolename');
		$id = $this->input->post('id');
        $data    = array('rolename' => $rolename);    
        $res = $this->webrolemodel->get_one($data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
		echo json_encode($ret);


    }


}
