<?php
class News extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('newsmodel');
		$this->load->model('adminlogmodel');

    }

    /**
     * 资讯列表
     * @return [type] [description]
     */
    public function news_list()
    {
        $this->checkauth('news_list');

        $data['cdn'] = $this->cdn;
        $search        = trim($this->input->get_post('search'));
		$status        = trim($this->input->get_post('status'));
		$typeid        = intval($this->input->get_post('typeid'));
		$date = $this->input->post('date');
		$data_arr=$this->get_dates($date);
        $this->load->helper('Page');
        $where = array();
        //var_dump($data_arr);
		$page_url .= '&date='.$data_arr['date'];
		$where['start_timestamp'] = strtotime($data_arr['start_date']);
		$where['end_timestamp']   = strtotime($data_arr['end_date'])+24 * 3600;


	    //$where['status'] = 1;
        if (isset($search) && $search) {
            $where['search'] = $search;
            $page_url .= '&search=' . $search;
        }
		
         
		 if(isset($status) && $status) {
			$where['status'] = $status;
			$page_url .= '&status=' . $status;
		}
		if (isset($typeid) && $typeid) {
            $where['typeid'] = $typeid;
            $page_url .= '&typeid=' . $typeid;
        }
        $count        = $this->newsmodel->count($where);
        $p            = new Page($count, 20, $page_url);
        $data['page'] = $p->show(); // 分页代码
        $data['search'] = $search;
		$data['date'] = $data_arr['date'];
		$data['start_date'] = $data_arr['start_date'];
		$data['end_date'] = $data_arr['end_date'];
		$data['status'] = $status;
		$data['typeid'] = $typeid;
        $list         = $this->newsmodel->get_all($where, $p->firstRow, $p->listRows);
        $data['list']       = $list;

		$this->load->model('newstypemodel');
		$data['typelist'] = $this->newstypemodel->get_all();
        $this->load->view($this->view_path, $data);
    }

	  /**
     * 资讯审核列表
     * @return [type] [description]
     */

    public function news_check()
    {
        $this->checkauth('news_check');

        $data['cdn'] = $this->cdn;
        $search        = trim($this->input->get_post('search'));
		$date = $this->input->post('date');
		$data_arr=$this->get_dates($date);
		$where['status'] = 0;
        $this->load->helper('Page');
		$page_url .= '&date='.$data_arr['date'];
		$where['start_timestamp'] = strtotime($data_arr['start_date']);
		$where['end_timestamp']   = strtotime($data_arr['end_date'])+24 * 3600;
        if (isset($search) && $search) {
            $where['search'] = $search;
            $page_url .= '&search=' . $search;
        }

		if (isset($typeid) && $typeid) {
            $where['typeid'] = $typeid;
            $page_url .= '&typeid=' . $typeid;
        }
        $count        = $this->newsmodel->count($where);
        $p            = new Page($count, 20, $page_url);
        $data['page'] = $p->show(); // 分页代码
        $data['search'] = $search;
		$data['typeid'] = $typeid;
		$data['date'] = $data_arr['date'];
		$data['start_date'] = $data_arr['start_date'];
		$data['end_date'] = $data_arr['end_date'];
        $list         = $this->newsmodel->get_all($where, $p->firstRow, $p->listRows);
        $data['list']       = $list;

		$this->load->model('newstypemodel');
		$data['typelist'] = $this->newstypemodel->get_all();
        $this->load->view($this->view_path, $data);
    }



	 /**
     * 资讯详情页
     * @return [type] [description]
     */

    public function news_view()
    {
        $this->checkauth('news_list');
        $id                   = $this->input->get('id');
        $news_info         = $this->newsmodel->get_one($id);
        $data['news'] = $news_info;
		$data['cdn'] = $this->cdn;
        $this->load->view($this->view_path, $data);
    }

	 /**
     * 资讯详情页预览
     * @return [type] [description]
     */

    public function news_info()
    {
        $id                   = $this->input->get('id');
        $news_info         = $this->newsmodel->get_one($id);
        $data['news'] = $news_info;
		$data['cdn'] = $this->cdn;
        $this->load->view($this->view_path, $data);
    }


	/**
     * 资讯添加页
     * @return [type] [description]
     */
    public function news_add()
    {
        $this->checkauth('news_add');
        $data['cdn'] = $this->cdn;
		$this->load->model('newstypemodel');
		 $data['typelist'] = $this->newstypemodel->get_all();
        $this->load->view($this->view_path, $data);
    }

    /**
     * 资讯添加-表单处理
     * @return [resource] [description]
     */
    public function news_add_do()
    {
        $this->checkauth('news_add');
        $title              = trim($this->input->post('title'));
		$order_num              = intval($this->input->post('order_num'));
		$author              = trim($this->input->post('author'));
		$describe              = trim($this->input->post('describe'));
		$ftitle              = trim($this->input->post('ftitle'));
		$typeid              = intval($this->input->post('typeid'));
		$add_uid=$this->session->userdata('userid');
		$this->load->model('usermodel');
        $roleinfo = $this->usermodel->get_one(array('uid'=>$add_uid));
		if($roleinfo['role_id']==2){
			 //go('/index.php/main', '您没有权限', GO_ERROR);
			$status=0;
			$add_checker='';		
		}else{
			$status=1;
			$add_checker=$add_uid;
		}
        $titpic=$_FILES['titpic']["name"];
        $data = array('title' => $title,'order_num' => $order_num,'add_time'=>time(),'describe'=>$describe,'ftitle'=>$ftitle,'status'=>$status,'add_uid'=>$add_uid,'add_checker'=>$add_checker,'author'=>$author,'typeid'=>$typeid);
		$mid=$this->newsmodel->add($data);
        if (!$mid) {
            go('/index.php/admin/news/news_add', '添加失败，请重新添加', GO_ERROR);
        } else {

		
			if($titpic==null||$titpic==""){
				 go('/index.php/admin/news/news_edit?id='.$mid, '资源图片未上传！');
				exit;
			}
			
			$datas['titpic']=$this->upload_path('titpic',$mid);
			
			if (!$this->newsmodel->edit($datas, $mid)) {
				go('/index.php/admin/news/news_edit?id=' . $mid, '添加失败，请重新操作', GO_ERROR);
			} else {

				$log=array('userid'=>$add_uid,'type'=>'news_add','result'=>'增加新资讯','record_id'=>$mid,'add_time'=>time(),'content'=>$describe,'title'=>$title ,'urls'=>$datas['titpic']);
				$logid=$this->adminlogmodel->add($log);
                $this->load->model('funcmodel');
				/*
				//向crc_news 和crc_user 表中插入 修改记录
				$crc_arr=$this->get_crc_rolelist();//判断是否是crc 
				if(in_array($roleinfo['role_id'],$crc_arr)){//crc发表文章
					$add=array('uid'=>$add_uid,'news_id'=>$mid,'add_time'=>time(),'type'=>1);
					$cwid=$this->funcmodel->add('crc_news',$add);
					$cinfo=$this->funcmodel->get_one('crc_user',array('uid'=>$add_uid));
					$pubnum=$cinfo['publish_news_num']+1;
					$cedit=$this->funcmodel->edit('crc_user',array('publish_news_num'=>$pubnum),array('uid'=>$add_uid));
				}
				*/

					$add=array('uid'=>$add_uid,'news_id'=>$mid,'add_time'=>time(),'type'=>1);
					$cwid=$this->funcmodel->add('admin_news',$add);

				go('/index.php/admin/news/news_list', '添加成功', GO_SUCCESS);
			}
        }
    }

	/**
     * 资讯修改页
     * @return [type] [description]
     */
    public function news_edit()
    {
        $this->checkauth('news_list');
        $data['cdn']     = $this->cdn;
        $id              = $this->input->get('id');
        $news         = $this->newsmodel->get_one($id);
        $data['news'] = $news;
		$this->load->model('newstypemodel');
		 $data['typelist'] = $this->newstypemodel->get_all();
        $this->load->view($this->view_path, $data);
    }

    /**
     * 资讯修改-表单处理
     * @return [resource] [description]
     */
    public function news_edit_do()
    {
        $this->checkauth('news_list');
        $id                = $this->input->post('id');
        $data['title']             = trim($this->input->post('title'));
		$data['order_num']              = intval($this->input->post('order_num'));
		$data['describe']              = trim($this->input->post('describe'));
		$data['ftitle']              = trim($this->input->post('ftitle'));
		$data['typeid']              = intval($this->input->post('typeid'));
		$data['author']              = trim($this->input->post('author'));
		$add_uid=$this->session->userdata('userid');
		$this->load->model('usermodel');
        $roleinfo = $this->usermodel->get_one(array('uid'=>$add_uid));
		if($roleinfo['role_id']==2){
			$status=0;
			$add_checker='';		
		}else{
			$status=1;
			$add_checker=$add_uid;
		}
		$titpic=$_FILES['titpic']["name"];
		if($titpic){
			$data['titpic']=$this->upload_path('titpic',$id);	
		}
 
 	
		$data['add_uid']=$add_uid;
		$data['add_checker']=$add_checker;
		$data['status']=$status;
		$data['add_time']=time();
        $ret  = $this->newsmodel->sence_check($data, 'edit');
        if (!$ret['status']) {
            go('/index.php/admin/news/news_edit?id=' . $id, $ret['err_info']);
        }
        if (!$this->newsmodel->edit($data, $id)) {
            go('/index.php/admin/news/news_edit?id=' . $id, '编辑失败，请重新操作', GO_ERROR);
        } else {
			$log=array('userid'=>$this->session->userdata('userid'),'type'=>'news_edit','result'=>'编辑资讯','record_id'=>$id,'add_time'=>time(),'content'=>$describe,'title'=>$title ,'urls'=>$data['titpic']);
			$logid=$this->adminlogmodel->add($log);
            go('/index.php/admin/news/news_list', '编辑成功', GO_SUCCESS);
        }
    }
    public function change_status()
    {

        $this->checkauth('news_list');
        $status = (int) $this->input->get('status');
        $id     = (int) $this->input->get('id');
        if (!$id) {
            go('/index.php/admin/news/news_list', '未知记录');
        }
        $info = $this->newsmodel->get_one($id);
        if (!$info) {
            go('/index.php/admin/news/news_list', '未知渠道 error:2');
        }
        //验证 状态是否一致
        if ($status != $info['status']) {
            go('/index.php/admin/news/news_list', '该类型状态信息已变更，请刷新后操作');
        }

       
        // 状态变更
        if ($status) {
            $status = 2;
        } else {
            $status = 1;
        }
        $ret = $this->newsmodel->edit(array('status' => $status), $id);
        if (!$ret) {
            go('/index.php/admin/news/news_list', '操作失败，请重新操作');
        } else {
			$log=array('userid'=>$this->session->userdata('userid'),'type'=>'news_edit_status_'.$status,'result'=>'编辑资讯状态','record_id'=>$id,'add_time'=>time(),'content'=>$info['describe'],'title'=>$info['rname'] ,'urls'=>$info['titpic']);
			$logid=$this->adminlogmodel->add($log);
            go('/index.php/admin/news/news_list/');
        }
    }

   /**
   *批量下架资讯
   **/
	function del(){
		  $this->checkauth('news_list');
          $md =$this->input->post('tempString');
		  $ids =explode(',',$md);
		 
		  $this->newsmodel->edit_wherein(array('status'=>2),$ids);
			 
		  $log=array('userid'=>$this->session->userdata('userid'),'type'=>'news_del','result'=>'资讯下架','record_id'=>0,'add_time'=>time(),'content'=> json_encode($ids),'title'=>'' ,'urls'=>'');
		  $logid=$this->adminlogmodel->add($log);
		 
		   go('/index.php/admin/news/news_list/', '操作成功', GO_SUCCESS);

	}


	 /**
   *批量审核资讯
   **/
	function pass(){
		  $this->checkauth('news_check');
          $md =$this->input->post('tempString');
		  $ids =explode(',',$md);
		 
		  $this->newsmodel->edit_wherein(array('status'=>1),$ids);
			 
		  $log=array('userid'=>$this->session->userdata('userid'),'type'=>'news_del','result'=>'资讯审核','record_id'=>0,'add_time'=>time(),'content'=> json_encode($ids),'title'=>'' ,'urls'=>'');
		  $logid=$this->adminlogmodel->add($log);
		 
		  go('/index.php/admin/news/news_list/', '操作成功', GO_SUCCESS);

	}


	  


	function upload_path($username,$fid){
		if (!file_exists('uploads/news/'.$fid)){ mkdir ('uploads/news/'.$fid, 0777);}
		$fname=$_FILES[$username]["name"];
		$type=trim($_FILES[$username]["type"]);
		//echo $type.'<br>';
			$config['upload_path'] = './uploads/news/'.$fid.'/';
			if(!file_exists($config['upload_path'])){
				@mkdir($config['upload_path'],0777);
				@touch($config['upload_path'].'index.html');
			}
			$config['allowed_types'] ='jpg|jpeg|gif|png|bmp|jpe|zip|rar|7z';
			$config['max_size'] =1024*1024*20;
			$name_arr=explode('.',$fname);
			$filename=$name_arr[0];
			$config['file_name']= $username;
			$this->load->library('upload', $config);
			$this->upload->initialize($config); 
			if ( ! $this->upload->do_upload($username)){
			   $error = array('error' => $this->upload->display_errors());  
			  // echo $error['error'];
			   go('/index.php/admin/news/news_edit?id='.$fid, $error['error']);
			}else{
				$data = $this->upload->data();
				$filename=iconv('GB2312', 'UTF-8',  $data['file_name']);
			    $username=$this->cdn.'/uploads/news/'.$fid.'/'.$filename;	
				$username=str_replace("////","/",$username);
				$username=str_replace("///","/",$username);
				$username=str_replace("//","/",$username);
				$username=str_replace("http:/www","http://www",$username);
				return $username;
			}	
	}



}
