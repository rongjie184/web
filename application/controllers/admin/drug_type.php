<?php
class Drug_type extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('funcmodel');

    }

    /**
     * 类型列表
     * @return [type] [description]
     */
    public function drug_list()
    {
        $this->checkauth('drug_list');

        $data['cdn'] = $this->cdn;
        $names        = trim($this->input->get_post('name'));

        $this->load->helper('Page');
        // $where['del'] = 0;
        $where = array();
        if (isset($names) && $names) {
            $where['names'] = $names;
            $page_url .= '&name=' . $names;
        }
        $count        = $this->funcmodel->count('drug_type',$where);
        $p            = new Page($count, 20, $page_url);
        $data['page'] = $p->show(); // 分页代码
        $data['name'] = $names;
        $list         = $this->funcmodel->get_all('drug_type',$where, $p->firstRow, $p->listRows);
        $data['list']       = $list;
        $this->load->view($this->view_path, $data);
    }
	
	/**
     * 添加类型
     * @return [type] [description]
     */

    public function add_drug()
    {
        $this->checkauth('add_drug');
        $data['cdn'] = $this->cdn;
		$data['test']=$this->get_all_list('test_type',array('status'=>1),'name');
        $this->load->view($this->view_path, $data);
    }

    /**
     * 添加类型-表单处理
     * @return [type] [description]
     */
    public function add_drug_do()
    {
        $this->checkauth('add_drug');
        $name = trim($this->input->post('name'));
		$desc = trim($this->input->post('desc'));
		$test_id              = trim($this->input->post('test_id'));
       
        $this->load->model('funcmodel');
        $data = array('name' => $name,'desc' => $desc,'test_id' => $test_id,'add_time'=>time());
       
        if (!$this->funcmodel->add('drug_type',$data)) {
            go('/index.php/admin/drug_type/add_drug', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/drug_type/drug_list', '添加成功', GO_SUCCESS);
        }
    }

	/**
     * 修改分类
     * @return [type] [description]
     */
    public function drug_edit()
    {
        $this->checkauth('drug_list');
        $data['cdn']     = $this->cdn;
        $id              = $this->input->get('id');
        $type         = $this->funcmodel->get_one('drug_type',array('id'=>$id));
        $data['type'] = $type;
		$data['test']=$this->get_all_list('test_type',array('status'=>1),'name');
        $this->load->view($this->view_path, $data);
    }

    /**
     * 修改分类-表单处理
     * @return [type] [description]
     */
    public function drug_edit_do()
    {
        $this->checkauth('drug_list');
        $id                = $this->input->post('id');
        $name              = trim($this->input->post('name'));
		$test_id              = trim($this->input->post('test_id'));
		$desc = trim($this->input->post('desc'));
		$status              = intval($this->input->post('status'));
       
        $this->load->model('funcmodel');
        $data = array('name' => $name,'desc' => $desc,'test_id' => $test_id,'status'=>$status,'add_time'=>time());
       
        if (!$this->funcmodel->edit('drug_type',$data, array('id'=>$id))) {
            go('/index.php/admin/drug_type/drug_edit?id=' . $id, '编辑失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/drug_type/drug_list', '编辑成功', GO_SUCCESS);
        }
    }
    public function change_status()
    {

        $this->checkauth('drug_list');
        $status = (int) $this->input->get('status');
        $id     = (int) $this->input->get('id');
        if (!$id) {
            go('/index.php/admin/drug_type/drug_list', '未知记录');
        }

        $this->load->model('funcmodel');
        $info = $this->funcmodel->get_one('drug_type',array('id'=>$id));
        if (!$info) {
            go('/index.php/admin/drug_type/drug_list', '未知渠道 error:2');
        }
        //验证 状态是否一致
        if ($status != $info['status']) {
            go('/index.php/admin/drug_type/drug_list', '该类型状态信息已变更，请刷新后操作');
        }

       
        // 状态变更
        if ($status) {
            $status = 0;
        } else {
            $status = 1;
        }
        $ret = $this->funcmodel->edit('drug_type',array('status' => $status),array('id'=>$id));
        if (!$ret) {
            go('/index.php/admin/drug_type/drug_list', '操作失败，请重新操作');
        } else {
            go('/index.php/admin/drug_type/drug_list');
        }
    }


	  /**
     * ajax 验证 资讯分类是否存在
     * @return [type] [description]
     */
    public function type_name_check()
    {
        $this->load->model('funcmodel');
        $name = $this->input->post('name');
        $data    = array('name' => $name);

        // funcmodel 验证 funcmodel
        $res = $this->funcmodel->get_one('drug_type',$data);
		if($res['id']){
			$ret = array('valid' => false);
		}else{
			$ret = array('valid' => true);
		
		}
        echo json_encode($ret);
    }

	  /**
     * ajax 验证 资讯分类是否存在-修改
     * @return [type] [description]
     */
    public function type_names_check()
    {
        $this->load->model('funcmodel');
        $name = $this->input->post('name');
		$id = $this->input->post('id');
        $data    = array('name' => $name);    
        $res = $this->funcmodel->get_one('drug_type',$data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
        
        echo json_encode($ret);
    }
}
