<?php
	class WebModel extends CI_Model{

        function __construct()
        {
            parent::__construct();
        }

        // 获取用户权限
        function get_priv($uid){

            if($uid){

                if($uid == $this->super_uid){

                    $array = array();
                    $list = $this->db->select('code')->get('web_priv')->result_array();

                    foreach($list as $value){
                        $array[] = $value['code'];
                    }  

                    $open_action = implode(',',$array);

                }else{

                    $query = $this->db->get_where('web_user', array('uid'=>$uid));
                    $login_user_action = $query->row_array();
                    $roleid=$login_user_action['role_id'];
					$querys = $this->db->get_where('web_roles', array('id'=>$roleid));
                    $role_action = $querys->row_array();
                    $open_action = $role_action['priv'];
                }    
                // 登录状态下 被限制登录后 无权限
                $state = $login_user_action['state'];
                if($state){
                    return '';
                }
            }   
            // 用户默认权限 
            if($open_action){
                $open_action .= ',';
            }

            $open_action .= 'edit_wmypass';
           
            return $open_action;
        }

        function get_action_by_arr($arr) {

            return $this->db->select()->where($arr)->get('web_priv')->row_array();
        }
	}

?>