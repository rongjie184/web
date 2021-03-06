<?php if (!defined('BASEPATH')) {
    exit('No go script access allowed');
}

class Login extends MY_Controller
{

    public function __construct()
    {
        error_reporting(-1);
        parent::__construct();
    }

    /**
     * 用户登录表单-处理 以及登陆后的session记录
     * @return [type] [description]
     */
    public function checklogin()
    {
        if ($this->session->userdata('userid')) {
            go('/index.php/main');
        }
        $username = trim($this->input->post('username'));
        $password = $this->input->post('password');
        $save =  $this->input->post('save');
        // 字段验证
        $this->load->model('usermodel');
        $data = array('account'=>$username, 'passwd'=>$password);

        $ret = $this->usermodel->sence_check($data);
        if(!$ret['status']){
            go(Url::alias('login'),$ret['err_info']);
        }
        $data['passwd'] = md5($password);
        $userinfo = $this->usermodel->get_one($data);
	
        // 获取用户信息
        $uid             = $userinfo['uid']; 
		//echo $uid;
        if (!$uid) {
            js_go('/index.php/login', '用户名或密码错误');
        } else {
            if ($userinfo['state'] == USER_FORBIDDEN) {
                js_go('/index.php/login', '用户限制登录!');
            }
            if ($save=='on') {
                setcookie('save_username', $username, time() + 34 * 24 * 3600, '/');
            }
            $last_login_time = $userinfo['last_login_time'];
            $uname           = $userinfo['uname'];            
            $this->usermodel->edit(array('last_login' => time()),$uid);
            $_SESSION['userid']          = $uid;
            $_SESSION['uname']           = $uname;
            $_SESSION['username']        = $username;
            $_SESSION['last_login_time'] = $last_login_time;
            $this->session->set_userdata($_SESSION);	
			//var_dump($this->session->set_userdata);
			//header('Location:/index.php/main');
            go(Url::alias('home'));
        }
    }
    /**
     * 处理用户登出
     * @return [type] [description]
     */
    public function login_out()
    {
        //清空SESSION值
        $_SESSION = array();
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 36000, '/');
        }
        $this->session->sess_destroy(); //销毁session
        echo "<script> window.location.href='/index.php/login'</script>";
        exit;
    }

}
