<?php
class Item_plan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('funcmodel');

    }

    /**
     * 项目进度列表
     * @return [type] [description]
     */
    public function plan_list()
    {
        $this->checkauth('plan_list');

        $data['cdn'] = $this->cdn;
        $name        = trim($this->input->get_post('name'));

        $this->load->helper('Page');
        // $where['del'] = 0;
        $where = array();
        if (isset($name) && $name) {
            $where['pnames'] = $name;
            $page_url .= '&name=' . $name;
        }
		
        $count        = $this->funcmodel->count('item_plan',$where);
        $p            = new Page($count, 20, $page_url);
        $data['page'] = $p->show(); // 分页代码
        $data['name'] = $name;
        $list         = $this->funcmodel->get_all('item_plan',$where, $p->firstRow, $p->listRows);
        $data['list']       = $list;
        $this->load->view($this->view_path, $data);
    }
	

	/**
     * 添加项目进度
     * @return [type] [description]
     */

    public function add_plan()
    {
        $this->checkauth('plan_list');
        $data['cdn'] = $this->cdn;
        $this->load->view($this->view_path, $data);
    }

    /**
     * 添加工作内容-表单处理
     * @return [type] [description]
     */
    public function add_plan_do()
    {
        $this->checkauth('plan_list');
        $name = trim($this->input->post('name'));
		$order_num = trim($this->input->post('order_num'));
		
        $this->load->model('funcmodel');
        $data = array('name' => $name,'order_num' => $order_num,'add_time'=>time());
       
        if (!$this->funcmodel->add('item_plan',$data)) {
            go('/index.php/admin/item_plan/add_plan', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/item_plan/plan_list', '添加成功', GO_SUCCESS);
        }
    }

	/**
     * 修改项目进度
     * @return [type] [description]
     */
    public function plan_edit()
    {
        $this->checkauth('plan_list');
        $data['cdn']     = $this->cdn;
        $id              = $this->input->get('id');
        $type         = $this->funcmodel->get_one('item_plan',array('id'=>$id));
        $data['plan'] = $type;
        $this->load->view($this->view_path, $data);
    }

    /**
     * 修改项目进度-表单处理
     * @return [type] [description]
     */
    public function plan_edit_do()
    {
        $this->checkauth('plan_list');
        $id                = $this->input->post('id');
        $name              = trim($this->input->post('name'));
		$order_num = trim($this->input->post('order_num'));
		$status              = intval($this->input->post('status'));
       
        $this->load->model('funcmodel');
        $data = array('name' => $name,'order_num' => $order_num,'status'=>$status,'add_time'=>time());
       
        if (!$this->funcmodel->edit('item_plan',$data,array('id'=>$id))) {
            go('/index.php/admin/item_plan/plan_edit?id=' . $id, '编辑失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/item_plan/plan_list', '编辑成功', GO_SUCCESS);
        }
    }
  
	  /**
     * ajax 验证 资讯分类是否存在
     * @return [type] [description]
     */
    public function pname_check()
    {
        $this->load->model('funcmodel');
        $name = $this->input->post('name');
        $data    = array('name' => $name);

        // newstypemodel 验证 newstypemodel
        $res = $this->funcmodel->get_one('item_plan',$data);
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
    public function pnames_check()
    {
        $this->load->model('funcmodel');
        $name = $this->input->post('name');
		$id = $this->input->post('id');
        $data    = array('name' => $name);    
        $res = $this->funcmodel->get_one('item_plan',$data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
        
        echo json_encode($ret);
    }


	 public function change_status()
    {

        $this->checkauth('plan_list');
        $status = (int) $this->input->get('status');
        $id     = (int) $this->input->get('id');
        if (!$id) {
            go('/index.php/admin/item_plan/plan_list', '未知记录');
        }

        $this->load->model('funcmodel');
        $info = $this->funcmodel->get_one('item_plan',array('id'=>$id));
        if (!$info) {
            go('/index.php/admin/item_plan/plan_list', '未知渠道 error:2');
        }
       
        $ret = $this->funcmodel->edit('item_plan',array('status' => $status), array('id'=>$id));
        if (!$ret) {
            go('/index.php/admin/item_plan/plan_list', '操作失败，请重新操作');
        } else {
            go('/index.php/admin/item_plan/plan_list/','操作成功',1);
        }
    }



}
