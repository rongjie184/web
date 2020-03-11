<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Model Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Model {

	/**
	 * Constructor
	 *
	 * @access public
	 */
	function __construct()
	{
		log_message('debug', "Model Class Initialized");
	}

	/**
	 * __get
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string
	 * @access private
	 */
	function __get($key)
	{
		$CI =& get_instance();
		return $CI->$key;
	}

    public function sence_check($data, $sence='')
    {
        $status   = 1;
        $err_info = '';

        // 场景设置检测
        $sence_check = 0;
        if (isset($this->sences[$sence])) {
            $sence_check = 1;
        }
        // echo $sence.' sence check '.$sence_check;echo "<br>";

        foreach ($data as $field => $value) {
            $detail     = $this->fields[$field];
            $field_name = $detail['show'];
            // 正则匹配
            if (isset($detail['pattern'])) {
                // echo $field.' check pattern';echo "<br>";
                $match = preg_match($detail['pattern'], $value);
                if (!$match) {
                    $status    = 0;
                    $err_check = 'pattern';
                    $err_info  = $field_name . $detail['pattern_notice'];
                    break;
                }
            }
            // 最大长度限制
            if(isset($detail['maxlength'])){
                $length = iconv_strlen($value,'utf-8');
                if($length>$detail['maxlength']){
                    $status    = 0;
                    $err_check = 'maxlength';
                    $err_info  = $field_name . '最大长度为'.$detail['maxlength'];
                }
            }

            // 是否 场景 验证
            if(!$sence_check){
                continue;
            }
            // 场景是否检查该字段
            $rules = $this->sences[$sence];
            if (!isset($rules[$field])) {
                continue;
            }
            $rule_list = $rules[$field];

            foreach ($rule_list as $rule_type) {
                // echo $field.' check '.$rule_type;echo "<br>";
                // 重复检测
                if ($rule_type == 'unique') {
                    $num = $this->count(array($field => $value));
                    if ($num) {
                        $status    = 0;
                        $err_check = 'unique';
                        $err_info  = "{$field_name}已存在";
                        break;
                    }
                }
                // 等于某项
                if ($rule_type == 'equal') {
                    $equal_field      = $detail['equal'];
                    $equal_field_name = $this->fields[$equal_field]['show'];
                    if ($data[$field] != $data[$equal_field]) {
                        $status    = 0;
                        $err_check = 'equal';
                        $err_info  = "{$field_name}与{$equal_field_name}不一致";
                        break;
                    }
                }
                // 回调函数
                if ($rule_type == 'callback') {
                    $method_name = $field . '_validate';
                    if (method_exists(__CLASS__, $method_name)) {
                        $res = call_user_func(array(__CLASS__, $method_name), $value);
                        if (!$res['status']) {
                            $status    = 0;
                            $err_check = 'callback';
                            $err_info  = $res['err_info'];
                        }
                    }
                }
                // 检查不可为空
                if($rule_type == 'not_null'){
                    if(!$rule_type){
                        $status    = 0;
                        $err_check = 'not_null';
                        $err_info  = "{$field_name}不可为空!";                        
                    }
                }
            }
        }

        $ret = array(
            'status'    => $status,
            'err_check' => $err_check,
            'err_info'  => $err_info,
        );
        return $ret;
    }	
}
// END Model Class

/* End of file Model.php */
/* Location: ./system/core/Model.php */