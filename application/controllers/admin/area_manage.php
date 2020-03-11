<?php
class Area_manage extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('funcmodel');

    }

    /**
     * 列表
     * @return [type] [description]
     */
    public function area_list()
    {
        $this->checkauth('area_list');
        $data['cdn'] = $this->cdn;      
        $this->load->helper('Page');
		$search     = trim($this->input->get_post('search'));
		$table     = trim($this->input->get_post('table'));
		
        $where = array();
		 if (isset($search) && $search) {
            $where['search'] = $search;
            $page_where      = 'search=' . $search;
			$data['search']   = $search;	
        }

		

		 if (isset($table) && $table) {
            $table = $table;
            $page_where      = 'table=' . $table;
			$data['table']   = $table;	
        }else{
			$table="provinces";
		}
		$count        = $this->funcmodel->count_ssq($table,$where);
		$p            = new Page($count, 20, $page_url);
		$data['page'] = $p->show(); // 分页代码
		$list         = $this->funcmodel->get_all_ssq($table,$where, $p->firstRow, $p->listRows);       
        $data['list']       = $list;
        $this->load->view($this->view_path, $data);
    }
	

	/**
     * 添加
     * @return [type] [description]
     */

    public function add_area()
    {
        $this->checkauth('add_area');
        $data['cdn'] = $this->cdn;
        $this->load->view($this->view_path, $data);
    }

	 /**
     * ajax 省市联动
     * @return [type] [description]
     */
	function get_province(){
		
		$list=$this->get_all_list('provinces',array('status'=>1),'name');
		echo json_encode($list);
	}




    /**
     * 添加-表单处理
     * @return [type] [description]
     */
    public function add_area_do()
    {
        $this->checkauth('add_area');
        $name = trim($this->input->post('name'));
		$short_name = trim($this->input->post('short_name'));
		$sort = trim($this->input->post('sort'));	
		$parent_id=trim($this->input->post('parent_id'));
		$table = trim($this->input->post('table'));
       
        $this->load->model('funcmodel');
		if($table=='city'){
			$data = array('name' => $name,'short_name'=>time(),'sort'=>$sort,'parent_id'=>$parent_id);
		}else{
			$data = array('name' => $name,'short_name'=>time(),'sort'=>$sort);
		}
       
        if (!$this->funcmodel->add($table,$data)) {
            go('/index.php/admin/area_manage/add_area', '添加失败，请重新添加', GO_ERROR);
        } else {
            go('/index.php/admin/area_manage/area_list', '添加成功', GO_SUCCESS);
        }
    }

	/**
     * 修改
     * @return [type] [description]
     */
    public function area_edit()
    {
        $this->checkauth('area_list');
        $data['cdn']     = $this->cdn;
        $id              = $this->input->get('id');
		$level= intval($this->input->get('level'));
		if($level==1){$table='provinces';}elseif($level==2){$table='city';}elseif($level==3){$table='area';}
        $info         = $this->funcmodel->get_one($table,array('id'=>$id));
        $data['info'] = $info;
		$data['table'] = $table;
		$data['list']=$this->get_all_list('provinces',array('status'=>1),'name');
        $this->load->view($this->view_path, $data);
    }

    /**
     * 修改-表单处理
     * @return [type] [description]
     */
    public function area_edit_do()
    {
        $this->checkauth('area_list');
        $id                = $this->input->post('id');
        $name              = trim($this->input->post('name'));
		$short_name = trim($this->input->post('short_name'));
		$sort = trim($this->input->post('sort'));	
		$parent_id=trim($this->input->post('parent_id'));
		$table = trim($this->input->post('table'));
		$status = trim($this->input->post('status'));
       
        $this->load->model('funcmodel');
       if($table=='city'){
			$data = array('name' => $name,'short_name'=>time(),'sort'=>$sort,'parent_id'=>$parent_id,'status'=>$status);
		}else{
			$data = array('name' => $name,'short_name'=>time(),'sort'=>$sort,'status'=>$status);
		}
		if($table=="provinces"){$level=1;}elseif($table=="city"){$level=2;}elseif($table=="area"){$level=3;}
       
        if (!$this->funcmodel->edit($table,$data,array('id'=>$id))) {
            go('/index.php/admin/area_manage/area_edit?id=' . $id.'&level='.$level, '编辑失败，请重新操作', GO_ERROR);
        } else {
            go('/index.php/admin/area_manage/area_list', '编辑成功', GO_SUCCESS);
        }
    }


	 public function change_area_status()
    {

        $this->checkauth('area_list');
        $status = (int) $this->input->get('status');
		$level = (int) $this->input->get('level');
		if($level==1){$table='provinces';}elseif($level==2){$table='city';}elseif($level==3){$table='area';}
        $id     = (int) $this->input->get('id');
        if (!$id) {
            go('/index.php/admin/area_manage/area_list', '未知记录');
        }

        $this->load->model('funcmodel');
        $info = $this->funcmodel->get_one($table,array('id'=>$id));
        if (!$info) {
            go('/index.php/admin/area_manage/area_list', '未知渠道 error:2');
        }

		 //验证 状态是否一致
        if ($status != $info['status']) {
            go('/index.php/admin/area_manage/area_list', '该类型状态信息已变更，请刷新后操作');
        }      
        // 状态变更
        if ($status) {
            $status = 0;
        } else {
            $status = 1;
        }
        $ret = $this->funcmodel->edit($table,array('status' => $status), array('id'=>$id));
        if (!$ret) {
            go('/index.php/admin/area_manage/area_list', '操作失败，请重新操作');
        } else {
            go('/index.php/admin/area_manage/area_list','操作成功',1);
        }
    }


  
	  /**
     * ajax 验证 
     * @return [type] [description]
     */
    public function name_check()
    {
        $this->load->model('funcmodel');
        $name = $this->input->post('name');
		 $table = $this->input->post('table');
        $data    = array('name' => $name);

        // newstypemodel 验证 newstypemodel
        $res = $this->funcmodel->get_one($table,$data);
		if($res['id']){
			$ret = array('valid' => false);
		}else{
			$ret = array('valid' => true);
		
		}
        echo json_encode($ret);
    }

	  /**
     * ajax 验证 是否存在-修改
     * @return [type] [description]
     */
    public function names_check()
    {
        $this->load->model('funcmodel');
        $name = $this->input->post('name');
		$id = $this->input->post('id');
		$table = $this->input->post('table');
        $data    = array('name' => $name);    
        $res = $this->funcmodel->get_one($table,$data);
		if($res['id']){
			if($res['id']==$id){$ret = array('valid' => true);}else{$ret = array('valid' => false);}
		
		}else{
			$ret = array('valid' => true);
		}
        
        echo json_encode($ret);
    }
}
