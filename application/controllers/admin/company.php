<?php
class Company extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('funcmodel');
	
    }

	
		/**
     * crc所属公司列表
     * @return [type] [description]
     */
    public function smo_company()
    {
		$this->checkauth('smo_company');
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
        $this->load->view('admin/company/crc_company', $data);
    }

	 /**
     * 添加CRC所属公司-表单
     */
    public function add_company()
    {
        $this->checkauth('add_company');
        $data['cdn'] = $this->cdn;
        $this->load->view('admin/company/add_company', $data);
    }

	 /**
     * 添加CRC所属公司-表单处理
     * @return [type] [description]
     */
    public function add_company_do()
    {
        $this->checkauth('add_company');
        $cname = trim($this->input->post('cname'));
		$desc = trim($this->input->post('desc')); 
		$pm = trim($this->input->post('pm')); 
		$pm_phone = trim($this->input->post('pm_phone')); 
        $this->load->model('funcmodel');
        $data = array('cname' => $cname,'desc' => $desc,'add_time'=>time(),'pm' => $pm,'pm_phone' => $pm_phone);
       
        if (!$this->funcmodel->add('crc_company',$data)) {
            go('/index.php/admin/company/add_company', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/company/smo_company', '添加成功', GO_SUCCESS);
        }
    }


	/**
     * 修改所属公司
     * @return [type] [description]
     */
    public function company_edit()
    {
        $this->checkauth('smo_company');
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
        $this->checkauth('smo_company');
        $id                = $this->input->post('id');
        $cname              = trim($this->input->post('cname'));
		$desc = trim($this->input->post('desc'));
		$status              = intval($this->input->post('status'));
		$pm = trim($this->input->post('pm')); 
		$pm_phone = trim($this->input->post('pm_phone')); 
       
        $this->load->model('funcmodel');
        $data = array('cname' => $cname,'desc' => $desc,'status'=>$status,'add_time'=>time(),'pm' => $pm,'pm_phone' => $pm_phone);
       
        if (!$this->funcmodel->edit('crc_company',$data, array('id'=>$id))) {
            go('/index.php/admin/company/company_edit?id=' . $id, '编辑失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/company/smo_company', '编辑成功', GO_SUCCESS);
        }
    }
    public function change_company_status()
    {

        $this->checkauth('smo_company');
        $status = (int) $this->input->get('status');
        $id     = (int) $this->input->get('id');
        if (!$id) {
            go('/index.php/admin/company/smo_company', '未知记录');
        }

        $this->load->model('funcmodel');
        $info = $this->funcmodel->get_one('crc_company',array('id'=>$id));
        if (!$info) {
            go('/index.php/admin/company/smo_company', '未知渠道 error:2');
        }
        //验证 状态是否一致
        if ($status != $info['status']) {
            go('/index.php/admin/company/smo_company', '该类型状态信息已变更，请刷新后操作');
        }

       
        // 状态变更
        if ($status) {
            $status = 0;
        } else {
            $status = 1;
        }
        $ret = $this->funcmodel->edit('crc_company',array('status' => $status), array('id'=>$id));
        if (!$ret) {
            go('/index.php/admin/company/smo_company', '操作失败，请重新操作');
        } else {
            go('/index.php/admin/company/smo_company/');
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




}
