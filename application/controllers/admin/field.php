<?php
class Field extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('funcmodel');
	
    }

	
		/**
     * 申办方公司列表
     * @return [type] [description]
     */
    public function field_list()
    {
		$this->checkauth('field_list');
        $data['cdn'] = $this->cdn;   	
        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
        $sname     = trim($this->input->get_post('sname'));
        if (isset($sname) && $sname) {
            $where['snames'] = $sname;
            $page_where      = 'sname=' . $sname;
        }
        $count            = $this->funcmodel->count('field',$where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['sname']   = $sname;
        $data['where']    = $where;
        $data['fieldlist'] = $this->funcmodel->get_all('field',$where, $p->firstRow, $p->listRows);
        $this->load->view('admin/field/field_list', $data);
    }

	 /**
     * 添加申办方公司-表单
     */
    public function add_field()
    {
        $this->checkauth('add_field');
        $data['cdn'] = $this->cdn;
        $this->load->view('admin/field/add_field', $data);
    }

	 /**
     * 添加申办方公司-表单处理
     * @return [type] [description]
     */
    public function add_field_do()
    {
        $this->checkauth('add_field');
        $name = trim($this->input->post('name'));
		$desc = trim($this->input->post('desc'));  
		
        $this->load->model('funcmodel');
        $data = array('name' => name,'desc' => $desc,'add_time'=>time());
       
        if (!$this->funcmodel->add('field',$data)) {
            go('/index.php/admin/field/add_field', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/field/field_list', '添加成功', GO_SUCCESS);
        }
    }


	/**
     * 修改申办方公司
     * @return [type] [description]
     */
    public function field_edit()
    {
        $this->checkauth('field_list');
        $data['cdn']     = $this->cdn;
        $id              = $this->input->get('id');
        $field         = $this->funcmodel->get_one('field',array('id'=>$id));
        $data['field'] = $field;
        $this->load->view($this->view_path, $data);
    }

    /**
     * 修改分申办方-表单处理
     * @return [type] [description]
     */
    public function field_edit_do()
    {
        $this->checkauth('field_list');
        $id                = $this->input->post('id');
        $name              = trim($this->input->post('name'));
		$desc = trim($this->input->post('desc'));
		$status              = intval($this->input->post('status'));
		
       
        $this->load->model('funcmodel');
        $data = array('sname' => $sname,'desc' => $desc,'status'=>$status,'add_time'=>time());
       
        if (!$this->funcmodel->edit('field',$data, array('id'=>$id))) {
            go('/index.php/admin/field/field_edit?id=' . $id, '编辑失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/field/field_list', '编辑成功', GO_SUCCESS);
        }
    }
    public function change_field_status()
    {

        $this->checkauth('field_list');
        $status = (int) $this->input->get('status');
        $id     = (int) $this->input->get('id');
        if (!$id) {
            go('/index.php/admin/field/field_list', '未知记录');
        }

        $this->load->model('funcmodel');
        $info = $this->funcmodel->get_one('field',array('id'=>$id));
        if (!$info) {
            go('/index.php/admin/field/field_list', '未知渠道 error:2');
        }
        //验证 状态是否一致
        if ($status != $info['status']) {
            go('/index.php/admin/field/field_list', '该类型状态信息已变更，请刷新后操作');
        }

       
        // 状态变更
        if ($status) {
            $status = 0;
        } else {
            $status = 1;
        }
        $ret = $this->funcmodel->edit('field',array('status' => $status), array('id'=>$id));
        if (!$ret) {
            go('/index.php/admin/field/field_list', '操作失败，请重新操作');
        } else {
            go('/index.php/admin/field/field_list/');
        }
    }


	  /**
     * ajax 验证 申办方是否存在
     * @return [type] [description]
     */
    public function field_name_check()
    {
        $this->load->model('funcmodel');
        $sname = $this->input->post('sname');
        $data    = array('sname' => $sname);

        // newstypemodel 验证 newstypemodel
        $res = $this->funcmodel->get_one('field',$data);
		if($res['id']){
			$ret = array('valid' => false);
		}else{
			$ret = array('valid' => true);
		
		}
        echo json_encode($ret);
    }

	  /**
     * ajax 验证 申办方公司是否存在-修改
     * @return [type] [description]
     */
    public function field_names_check()
    {
        $this->load->model('funcmodel');
        $sname = $this->input->post('sname');
		$id = $this->input->post('id');
        $data    = array('sname' => $sname);    
        $res = $this->funcmodel->get_one('field',$data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
        
        echo json_encode($ret);
    }




}
