<?php
class Login extends MY_Controller {
    var $cdn;
	function Login()
	{
		parent::__construct();
	}
    /**
     * 登录表单
     * @return [type] [description]
     */
	function index()
	{
        $data['cdn'] = $this->cdn;
        $userid=$this->session->userdata('userid');
    //var_dump($this->session->userdata('session_id')); 
if($userid){
            go(Url::alias('home'));
        }else{
            $this->load->view('admin/login',$data);

            
        }
	}
}
