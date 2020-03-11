<?php
class Cro_company extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('funcmodel');
	
    }

	
	/**
     * cro公司列表
     * @return [type] [description]
     */
    public function cro_list()
    {
		$this->checkauth('cro_list');
        $data['cdn'] = $this->cdn;   	
        $this->load->helper('Page');
        $where      = array();
        $page_where = '';
        $crname     = trim($this->input->get_post('crname'));
        if (isset($crname) && $crname) {
            $where['crnames'] = $crname;
            $page_where      = 'crname=' . $crname;
        }
        $count            = $this->funcmodel->count('cro_company',$where);
        $p                = new Page($count, 10, $page_where);
        $data['page']     = $p->show(); // 分页代码
        $data['crname']   = $crname;
        $data['where']    = $where;
        $data['crolist'] = $this->funcmodel->get_all('cro_company',$where, $p->firstRow, $p->listRows);
        $this->load->view('admin/cro_company/cro_list', $data);
    }

	 /**
     * 添加CRo所属公司-表单
     */
    public function add_cro()
    {
        $this->checkauth('add_cro');
        $data['cdn'] = $this->cdn;
        $this->load->view('admin/cro_company/add_cro', $data);
    }

	 /**
     * 添加CRC所属公司-表单处理
     * @return [type] [description]
     */
    public function add_cro_do()
    {
        $this->checkauth('add_cro');
        $crname = trim($this->input->post('crname'));
		$desc = trim($this->input->post('desc')); 
		$pm = trim($this->input->post('pm')); 
		$pm_phone = trim($this->input->post('pm_phone')); 
		$cra_name = trim($this->input->post('cra_name')); 
		$cra_phone = trim($this->input->post('cra_phone')); 
        $this->load->model('funcmodel');
        $data = array('crname' => $crname,'desc' => $desc,'add_time'=>time(),'pm' => $pm,'pm_phone' => $pm_phone,'cra_name'=>$cra_name,'cra_phone'=>$cra_phone);
       
        if (!$this->funcmodel->add('cro_company',$data)) {
            go('/index.php/admin/cro_company/add_cro', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/cro_company/cro_list', '添加成功', GO_SUCCESS);
        }
    }


	/**
     * 修改所属公司
     * @return [type] [description]
     */
    public function cro_edit()
    {
        $this->checkauth('cro_list');
        $data['cdn']     = $this->cdn;
        $id              = $this->input->get('id');
        $cro         = $this->funcmodel->get_one('cro_company',array('id'=>$id));
        $data['cro'] = $cro;
        $this->load->view($this->view_path, $data);
    }

    /**
     * 修改分类-表单处理
     * @return [type] [description]
     */
    public function cro_edit_do()
    {
        $this->checkauth('cro_list');
        $id                = $this->input->post('id');
        $crname              = trim($this->input->post('crname'));
		$desc = trim($this->input->post('desc'));
		$status              = intval($this->input->post('status'));
        $pm = trim($this->input->post('pm')); 
		$pm_phone = trim($this->input->post('pm_phone')); 
		$cra_name = trim($this->input->post('cra_name')); 
		$cra_phone = trim($this->input->post('cra_phone')); 
        $this->load->model('funcmodel');
        $data = array('crname' => $crname,'desc' => $desc,'status'=>$status,'add_time'=>time(),'pm' => $pm,'pm_phone' => $pm_phone,'cra_name'=>$cra_name,'cra_phone'=>$cra_phone);
       
        if (!$this->funcmodel->edit('cro_company',$data, array('id'=>$id))) {
            go('/index.php/admin/cro_company/cro_edit?id=' . $id, '编辑失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/cro_company/cro_list', '编辑成功', GO_SUCCESS);
        }
    }
    public function change_cro_status()
    {

        $this->checkauth('cro_list');
        $status = (int) $this->input->get('status');
        $id     = (int) $this->input->get('id');
        if (!$id) {
            go('/index.php/admin/cro_company/cro_list', '未知记录');
        }

        $this->load->model('funcmodel');
        $info = $this->funcmodel->get_one('cro_company',array('id'=>$id));
        if (!$info) {
            go('/index.php/admin/cro_company/cro_list', '未知渠道 error:2');
        }
        //验证 状态是否一致
        if ($status != $info['status']) {
            go('/index.php/admin/cro_company/cro_list', '该类型状态信息已变更，请刷新后操作');
        }

       
        // 状态变更
        if ($status) {
            $status = 0;
        } else {
            $status = 1;
        }
        $ret = $this->funcmodel->edit('cro_company',array('status' => $status), array('id'=>$id));
        if (!$ret) {
            go('/index.php/admin/cro_company/cro_list', '操作失败，请重新操作');
        } else {
            go('/index.php/admin/cro_company/cro_list/');
        }
    }


	  /**
     * ajax 验证 所属公司是否存在
     * @return [type] [description]
     */
    public function cro_name_check()
    {
        $this->load->model('funcmodel');
        $crname = $this->input->post('crname');
        $data    = array('crname' => $crname);

        // newstypemodel 验证 newstypemodel
        $res = $this->funcmodel->get_one('cro_company',$data);
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
    public function cro_names_check()
    {
        $this->load->model('funcmodel');
        $crname = $this->input->post('crname');
		$id = $this->input->post('id');
        $data    = array('crname' => $crname);    
        $res = $this->funcmodel->get_one('cro_company',$data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
        
        echo json_encode($ret);
    }




}
