<?php
class Main extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

    /**
     * 系统首页
     * @return [type] [description]
     */
	function index()
	{ 
      
		$data['cdn'] = $this->cdn;
        $uid=$this->session->userdata('userid');
        if($uid ){
            $this->load->view('admin/main',$data);
        }else{
            header('Location:/index.php/login');
        }
    }




}




