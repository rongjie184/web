<?php
class Work_manage extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('funcmodel');

    }

    /**
     * 工作内容列表
     * @return [type] [description]
     */
    public function work_list()
    {
        $this->checkauth('work_list');

        $data['cdn'] = $this->cdn;
        $wname        = trim($this->input->get_post('wname'));
		$type        = trim($this->input->get_post('type'));
		
        $this->load->helper('Page');
        // $where['del'] = 0;
        $where = array();
        if (isset($wname) && $wname) {
            $where['wnames'] = $wname;
            $page_url .= '&wname=' . $wname;
        }
		 if (isset($type) && $type) {
            $where['type'] = $type;
            $page_url .= '&type=' . $type;
        }

		

        $count        = $this->funcmodel->count('crc_work',$where);
        $p            = new Page($count, 20, $page_url);
        $data['page'] = $p->show(); // 分页代码
        $data['wname'] = $wname;
        $list         = $this->funcmodel->get_all('crc_work',$where, $p->firstRow, $p->listRows);
        $data['list']       = $list;
        $this->load->view($this->view_path, $data);
    }
	

	/**
     * 添加工作内容
     * @return [type] [description]
     */

    public function add_work()
    {
        $this->checkauth('add_work');
        $data['cdn'] = $this->cdn;
        $this->load->view($this->view_path, $data);
    }

    /**
     * 添加工作内容-表单处理
     * @return [type] [description]
     */
    public function add_work_do()
    {
        $this->checkauth('add_work');
        $wname = trim($this->input->post('wname'));
		$type = trim($this->input->post('type'));
		$desc = trim($this->input->post('desc'));
       
        $this->load->model('funcmodel');
        $data = array('wname' => $wname,'desc' => $desc,'add_time'=>time(),'type'=>$type);
       
        if (!$this->funcmodel->add('crc_work',$data)) {
            go('/index.php/admin/work_manage/add_work', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/work_manage/work_list', '添加成功', GO_SUCCESS);
        }
    }

	/**
     * 修改工作内容
     * @return [type] [description]
     */
    public function work_edit()
    {
        $this->checkauth('work_list');
        $data['cdn']     = $this->cdn;
        $id              = $this->input->get('id');
        $type         = $this->funcmodel->get_one('crc_work',array('id'=>$id));
        $data['work'] = $type;
        $this->load->view($this->view_path, $data);
    }

    /**
     * 修改分类-表单处理
     * @return [type] [description]
     */
    public function work_edit_do()
    {
        $this->checkauth('work_list');
        $id                = $this->input->post('id');
        $wname              = trim($this->input->post('wname'));
		$desc = trim($this->input->post('desc'));
		$type              = intval($this->input->post('type'));
		$status              = intval($this->input->post('status'));
       
        $this->load->model('funcmodel');
        $data = array('wname' => $wname,'desc' => $desc,'type'=>$type,'add_time'=>time(),'status'=>$status);
       
        if (!$this->funcmodel->edit('crc_work',$data,array('id'=>$id))) {
            go('/index.php/admin/work_manage/work_edit?id=' . $id, '编辑失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/work_manage/work_list', '编辑成功', GO_SUCCESS);
        }
    }


	 public function change_work_status()
    {

        $this->checkauth('work_list');
        $status = (int) $this->input->get('status');
        $id     = (int) $this->input->get('id');
        if (!$id) {
            go('/index.php/admin/work_manage/work_list', '未知记录');
        }

        $this->load->model('funcmodel');
        $info = $this->funcmodel->get_one('crc_work',array('id'=>$id));
        if (!$info) {
            go('/index.php/admin/work_manage/work_list', '未知渠道 error:2');
        }

		 //验证 状态是否一致
        if ($status != $info['status']) {
            go('/index.php/admin/work_manage/work_list', '该类型状态信息已变更，请刷新后操作');
        }      
        // 状态变更
        if ($status) {
            $status = 0;
        } else {
            $status = 1;
        }
        $ret = $this->funcmodel->edit('crc_work',array('status' => $status), array('id'=>$id));
        if (!$ret) {
            go('/index.php/admin/work_manage/work_list', '操作失败，请重新操作');
        } else {
            go('/index.php/admin/work_manage/work_list','操作成功',1);
        }
    }


  
	  /**
     * ajax 验证 资讯分类是否存在
     * @return [type] [description]
     */
    public function wname_check()
    {
        $this->load->model('funcmodel');
        $wname = $this->input->post('wname');
        $data    = array('wname' => $wname);

        // newstypemodel 验证 newstypemodel
        $res = $this->funcmodel->get_one('crc_work',$data);
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
    public function wnames_check()
    {
        $this->load->model('funcmodel');
        $wname = $this->input->post('wname');
		$id = $this->input->post('id');
        $data    = array('wname' => $wname);    
        $res = $this->funcmodel->get_one('crc_work',$data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
        
        echo json_encode($ret);
    }
}
