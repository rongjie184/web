<?php
class Gourl extends MY_Controller{

	function __construct(){
		parent::__construct();
	}

	// 页面跳转
	function view_gourl(){
		$url = $this->input->get('url');
		$content = $this->input->get('content');
		$notice = $this->input->get('notice');
		if(!$url){
			$url = Url::alias('home');
		}
		header('Refresh:2;url='.$url);
		$data['url']=$url;
		$data['content']=urldecode($content);
		$data['notice']= $notice;
		 $data['cdn'] = $this->cdn;
		$this->load->view("/admin/gourl",$data);
	}
}
?>