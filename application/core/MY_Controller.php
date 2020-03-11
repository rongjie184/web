<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Controller extends CI_Controller
{
    // 当前登录用户id
    public $userid;
    // cdn style目录地址
    public $cdn;
    // 不验证权限 的act
    public $priv_nocheck = array('edit_mypass,news_info');
    // 用户权限
    public $login_user_action;
    //系统参数设置  取自sysconfig 表
    public $sysconfig;
    //超级管理员ID
    public $super_uid = 1;
    // 当前 c/m
    public $class;
    public $method;

    public function __construct()
    {

        error_reporting(1);
        parent::__construct();

        //设置cdn
        $this->cdn = $this->config->item('base_url');
        $configcdn = $this->config->item('cdn');
		$drug = $this->config->item('drug');
		$this->drug = $drug;
		$methods = $this->config->item('methods');
		$this->methods = $methods;

        if (!$configcdn) {
            $this->cdn = $configcdn;
        }

        $this->load->helper('func');
        $this->load->library('url');
		$this->load->library('session');
        $this->inits();
    }
    /**
     * 初始化操作
	 * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800
     * @return [type] [description]
     */
    public function inits()
    {
        $c = strtolower($this->router->fetch_class());
        $m = strtolower($this->router->fetch_method());
        // echo $c .'=======cccc====<br>';
        $nocheck_login = array('login', 'checklogin', 'login_out', 'view_gourl');
        // 检查登录,获取左侧列表树
        if (!in_array($c, $nocheck_login)) {
            $this->checkLogin();
            $this->page_left_tree();
        }
        // 设置当前class/method
        $this->class  = $c;
        $this->method = $m;
        // 获取系统参数
        $this->get_sysconfig();
        // 替换config 中web_title
        $this->config->set_item('web_title', $this->sysconfig->title);
        // 组合 当前的 uri
        $path = implode('/', $this->uri->segments);
        // 默认模板地址
        $this->view_path = $path;
        // 默认表单提交地址
        $this->form_action = "/index.php/{$path}_do"; 
    }
    /**
     * 加载sysconfig 系统参数表 获取参数
	 * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800
     * @return [type] [description]
     */
    public function get_sysconfig()
    {
        $this->load->model('sysconfigmodel');
        $sysconfig       = $this->sysconfigmodel->get_all();
        $this->sysconfig = (object) $this->sysconfig;
        foreach ($sysconfig as $value) {
            if ($value['skey']) {
                $sval = $value['sval'];
                if(strpos($sval,'|')!==false){
                    $_tmp1 = explode('|',$sval);
                    foreach($_tmp1 as $val){
                        $_tmp2 = explode(':',$val);
                        $new_arr[$_tmp2[0]]=$_tmp2[1];
                    }
                    $this->sysconfig->$value['skey']=$new_arr;
                }else{
                    $this->sysconfig->$value['skey'] = $sval;
                }
            }
        }
    }
    /**
     * 用户登录状态验证
	 * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800
     */
    public function checkLogin()
    {     
        $this->userid = $this->session->userdata('userid');
        if (!$this->userid) {
            js_go('/index.php/login');
        }
    }
    /**
     * 权限验证
	 * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800
     */
    public function checkauth($act, $url = '/index.php/main')
    {
        $this->load->model('actionmodel');
        $action_p = $this->actionmodel->get_action_by_arr(array('code' => $act));
        //标记当前左侧功能树
        $this->left_pid = $action_p['pid'];
        $this->left_id  = $action_p['id'];
        // 如果当前$act 不需验证权限则直接返回
        if (in_array($act, $this->priv_nocheck)) {
            return true;
        }
        if (!in_array($act, $this->login_user_action)) {
            go($url, '您没有操作权限，亲');
        }
    }

	/**
     * 左侧功能树
     * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800
      
     * @return      [array]                              [结果集]
     */


    public function page_left_tree()
    {
        $list = array();
        $this->load->model('actionmodel');
        $this->load->model('adminactionmodel');
        $roleinfo = $this->actionmodel->get_priv($this->userid);
        $privs    = array_unique(explode(',', $roleinfo));
        $list     = $this->adminactionmodel->get_showlist(0);
        foreach ($list as $key => $value) {
            $list[$key]['child'] = $this->adminactionmodel->get_showlist($value['id']);
        }
        $this->login_user_action = $privs;
        $this->page_left_list    = $list;
    }

/**
     * 记录日志
     * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800
      
     * @return      [array]                              [结果集]
     */
   
    public function admin_log($data){

        $record_id = $data['record_id'];
        $type = $data['type'];
        $result = $data['result'];
        $content = (string) $data['content'];

        if($type){
            $this->load->model('adminlogmodel');
            $this->adminlogmodel->add(
                array(
                    'userid'=>$this->userid,
                    'type'=>$type,
                    'result'=>$result,
                    'record_id'=>$record_id,
                    'add_time'=>time(),
                    'content'=>$content
                )
            );
        }

    }

/**
     * 是否存在该文件
     * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800
      
     * @return      [array]                              [结果集]
     */
	
	function searchfile($path,$file){
	$file_array=array(); //存放文件名数组
	$folder_array=array(); //存放目录名数组
	$all_array=array(); //存放全部路径的数组
	if(is_dir($path)){  //检查文件目录是否存在
		echo $_file;
		$H = @ opendir($path); 
		while(false !== ($_file=readdir($H))){
			//检索目录
			if(is_dir($path."/".$_file) && $_file != "." && $_file!=".." && $_file!=="Thumbs.db"){
				if(eregi('/'.$file,'/'.$_file)){
					array_push($folder_array,$path."/".$_file);
				}
				searchfile($path."/".$_file,$file);
			//检索文件
			}elseif(is_file($path."/".$_file) && $_file!="." && $_file!=".." && $_file!=="Thumbs.db"){
				//$_file = auto_charset($_file,'utf-8','gbk');
				if(eregi('/'.$file,'/'.$_file)){
					array_push($file_array,$path."/".$_file);
					return 'yes'; //文件存在
				}
			}
		}
		closedir($H);
		return 'no'; //不存在
	}elseif(is_file($path)){

		if(eregi($file,$path)){
			return 'yes'; //文件存在
		} else {
			return 'no'; //文件不存在
		}
	}else{
		return 'no'; //文件不存在
	}
}
 /**
     * 查询后台角色
     * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800      
     * @return      [array]                              [结果集]
     */
function get_role() {
        $new_channel_list = array();	
		$this->load->model('rolemodel');
        $channel_list = $this->rolemodel->get_all();
        foreach($channel_list as $value){
            $new_channel_list[$value['id']] = $value['rolename'];
        }
        return $new_channel_list;
    }
 /**
     * 查询前台角色
     * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800      
     * @return      [array]                              [结果集]
     */
function get_wrole() {
        $new_channel_lists = array();	
		$this->load->model('webrolemodel');
        $channel_lists = $this->webrolemodel->get_all();

        foreach($channel_lists as $value){
            $new_channel_lists[$value['id']] = $value['rolename'];
        }
        return $new_channel_lists;
    }
	 /**
     * 查询省市区结果
     * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800
      
     * @return      [array]                              [结果集]
     */
function get_areas() {
        $new_area_lists = array();	
		$this->load->model('areamodel');
        $area_lists = $this->areamodel->get_all();
        foreach($area_lists as $value){
			$new_area_lists[$value['level']][$value['id']]=$value;          
        }
        return $new_area_lists;
    }

	 /**
     * 根据选中id 当前等级level 查询省市区结果
     * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800
     * @param       [array]                   $id    [当前选中id]
     * @param       [array]                   $level     [当前选中等级]   
     * @return      [array]                              [结果集]
     */


	function get_area_byid($id,$level) {
        $new_area_lists = array();	
		$this->load->model('areamodel');
        if($level==1){
			$l=$this->areamodel->get_all(array('parent_id'=>$id,'level'=>2));
			foreach($l as $value){
				$id3=$value['id'];
				$new_area_lists[$id][$id3] = $value['name'];
				$l3=$this->areamodel->get_all(array('parent_id'=>$id3,'level'=>3));
				foreach($l3 as $value3){
					$id4=$value3['id'];
					$new_area_lists[$id3][$id4] = $value3['name'];
					$l4=$this->areamodel->get_all(array('parent_id'=>$id4,'level'=>4));
					foreach($l4 as $value4){
						$id5=$value4['id'];
						$new_area_lists[$id4][$id5] = $value4['name'];
					}
				}
			}
		}
		if($level==2){
			$l3=$this->areamodel->get_all(array('parent_id'=>$id,'level'=>3));
				foreach($l3 as $value3){
					$id4=$value3['id'];
					$new_area_lists[$id][$id4] = $value3['name'];
					$l4=$this->areamodel->get_all(array('parent_id'=>$id4,'level'=>4));
					foreach($l4 as $value4){
						$id5=$value4['id'];
						$new_area_lists[$id4][$id5] = $value4['name'];
					}
				}
		}
		if($level==3){
			$l4=$this->areamodel->get_all(array('parent_id'=>$id,'level'=>4));
			foreach($l4 as $value4){
				$id5=$value4['id'];
				$new_area_lists[$id][$id5] = $value4['name'];
			}		
		}
		return $new_area_lists;
    }

 /**
     * 随机数生成
     * @wangrongjie
     * @DateTime    2018-05-31T10:33:34+0800
      
     * @return      [array]                              [结果集]
     */

function great_rand($type,$num){
	$str = '1234567890abcdefghijklmnopqrstuvwxyz';
	$numstr = '1234567890';
	if($type=="num"){
		$temp_str=$numstr;
	}else{
		$temp_str=$str;
	}
	$endnum=strlen($temp_str);
	$t1="";
	for($i=0;$i<$num;$i++){
		$j=rand(0,($endnum-1));
		$t1 .= $temp_str[$j];
	}
	return $t1;
}


 /**
     * 导出excel
     * @wangrongjie
     * @DateTime    2016-10-21T10:33:34+0800
     * @param       [array]                   $title    [第一行的标题]
     * @param       [array]                   $list     [导出的数据集合]
     * @param       [string]                  $filename [导出文件名]
     * @return      [type]                              [description]
     */
  function export_excel_help($title,$list,$filename)
    {

        if(!is_array($title)){
            return '';
        }

        if(!is_array($list)){
            return '';
        }

        if(!strlen($filename)){
            return '';
        }

        $this->load->library('PHPExcel');
        require APPPATH.'libraries/PHPExcel/Writer/Excel5.php';
        $objPHPExcel = new PHPExcel();
		$objPHPExcel->getSheet();
		$objPHPExcel->getActiveSheet()->getStyle('C2:C100')->getAlignment()->setWrapText(true);
		
        $pColumn=0;
        $pRow = 1;

        foreach($title as $value){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($pColumn,$pRow,$value);
            $pColumn++;
        }

        foreach($list as $data){
            $pRow++;
            $pColumn = 0;            
            foreach($data as $value){
				
                $objPHPExcel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($pColumn,$pRow,$value);
				$objPHPExcel->getActiveSheet()->getStyle($pColumn)->getAlignment()->setWrapText(true);  
                $pColumn++;
            }
        }

        ob_end_clean() ;
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$filename.'.xls');
        header('Cache-Control: max-age=0');
        $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter->save('php://output');
        exit;
    }

	 /**
	**上传zip压缩包解压缩到指定目录
	**$username 压缩包文件  $folers 目标文件夹 $url 上传失败跳转的url
	**
	**/
	function upload_paths($username,$folers,$url){
		if (!file_exists('uploads/'.$folers)){ mkdir ('uploads/'.$folers, 0777);}
		$fname=$_FILES[$username]["name"];
		$type=trim($_FILES[$username]["type"]);
			$config['upload_path'] = './uploads/'.$folers.'/';
			if(!file_exists($config['upload_path'])){
				@mkdir($config['upload_path'],0777);
				@touch($config['upload_path'].'index.html');
			}
			$config['allowed_types'] ='|zip';
			$config['max_size'] =1024*1024*20;
			$name_arr=explode('.',$fname);
			$filename=$name_arr[0];
			$config['file_name']= iconv("UTF-8","GB2312//IGNORE",$filename);//$username;
			$this->load->library('upload', $config);
			$this->upload->initialize($config); 
			if ( ! $this->upload->do_upload($username)){
			   $error = array('error' => $this->upload->display_errors());  
			   go($url, $error['error']);
			}else{
				$data = $this->upload->data();
				$filename=iconv('GB2312', 'UTF-8',  $data['file_name']);
			    $username='/uploads/'.$folers.'/'.$filename;
				return $username;
			}	
	}




   /**
   **$file 要解压缩的 压缩包 文件   $folers 解压缩文件到 该 文件夹内 
   **
   **/
	function readzipfile($file = '',$folers) {//解压缩文件
		//$file=$_SERVER['DOCUMENT_ROOT']."/uploads/resume/2.zip";
		// create object
		$zip = new ZipArchive() ;
		// open archive
		if ($zip->open($file) !== TRUE) {
		die ('Could not open archive');
		}
		$destination=$_SERVER['DOCUMENT_ROOT']."/uploads/".$folers."/";
		// extract contents to destination directory
		$zip->extractTo($destination);
		// close archive
		$zip->close();
		return $destination;    
    }



   /**
     * bootstrap 时间插件 daterangepicker 时间范围接收显示
     * @wangrongjie
     * @DateTime    2016-10-21T10:33:34+0800
     * @param       [string]                   $date    [时间范围字符串]
     * @return      [array]                    $data     [返回的数据集合]
     */
	function get_dates($date){
		if ($date) {
			$n = preg_match('/^(\d{4})-(\d{2})-(\d{2}).+(\d{4})-(\d{2})-(\d{2})$/', $date, $match);
			if (count($match) != 7) {
				go(Url::alias('order_count'), '时间错误!', GO_ERROR);
			}
			$start_date = implode('-', array($match[1], $match[2], $match[3]));
			$end_date   = implode('-', array($match[4], $match[5], $match[6]));
		} else {
			$today      = date('Y-m-d');
			$start_date = date('Y-m-d', time() - 6 * 24 * 3600);
			$end_date   = $today;
			$date       = "{$start_date} - {$end_date}";
		}
		$data['date']       = $date;
		$data['start_date'] = $start_date;
		$data['end_date']   = $end_date;

		return $data;
	
	
	}

	 /**
     * $table  表名
     * @wangrongjie
     * @DateTime    2018-06-07T10:33:34+0800
     * @return      [array]                    $new_pro_lists     [返回的数据集合]
     */
	function get_all_list($table,$where,$name){
		$new_pro_lists = array();	
		$this->load->model('funcmodel');
		$pro_list=$this->funcmodel->get_all($table,$where);
		foreach($pro_list as $value){
				$id=$value['id'];
				$new_pro_lists[$id] = $value[$name];
			}
		return $new_pro_lists;	
	}


	 /**
     * $table  表名 $where 查询条件 names 查询结果字段数组
     * @wangrongjie
     * @DateTime    2018-06-11T10:33:34+0800
     * @return      [array]                    $new_lists     [返回的数据集合]
     */
	function get_all_lists($table,$where,$names){
		$new_lists = array();	
		$this->load->model('funcmodel');
		$pros_list=$this->funcmodel->get_all($table,$where);
		foreach($pros_list as $value){
				$id=$value['id'];
				foreach($names as $v)
				$new_lists[$id][$v] = $value[$v];
			}
		return $new_lists;	
	}



	/**
     * $id  省级 id 根据省级id获取该省下所有城市列表
     * @wangrongjie
     * @DateTime    2018-06-07T10:33:34+0800
     * @return      [array]                    $new_city_lists     [返回的数据集合]
     */
	function get_city_byid($id){
		$new_city_lists = array();	
		$this->load->model('funcmodel');
		$city_list=$this->funcmodel->get_all('city',array('status'=>1,'parent_id'=>$id));
		foreach($city_list as $value){
				$ids=$value['id'];
				$new_city_lists[$ids] = $value['name'];
			}
		return $new_city_lists;	
	}

	/**
     * 定义crc 前端角色id 数组
     * @wangrongjie
     * @DateTime    2018-06-07T10:33:34+0800
     * @return      [array]                    $new_city_lists     [返回的数据集合]
     */
	function get_crc_rolelist(){
		return array(1,3);
	}

	/**
     * 定义用户可见的机构id数组
     * @wangrongjie
     * @DateTime    2018-06-07T10:33:34+0800
     * @return      [array]                    $new_city_lists     [返回的数据集合]
     */
	function get_inist_list(){
		 $this->userid = $this->session->userdata('userid');		  
         $this->load->model('usermodel');
         $hisaction =$this->usermodel->get_one(array('uid'=>$this->userid));
         $actions = unserialize($hisaction['inits_priv']);
		 return $actions;	
	}


	/**
     * 定义用户可见的项目id数组
     * @wangrongjie
     * @DateTime    2018-06-07T10:33:34+0800
     * @return      [array]                    $new_city_lists     [返回的数据集合]
     */
	function get_items_list(){
		 $this->userid = $this->session->userdata('userid');
         $this->load->model('usermodel');
         $hisaction =$this->usermodel->get_one(array('uid'=>$this->userid));
         $actions = unserialize($hisaction['items_priv']);
		 return $actions;
	}








	
}
