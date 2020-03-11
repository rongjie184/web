<?php

define('GO_SUCCESS', 1); // 跳转成功type
define('GO_ERROR', 0); // 跳转 警告type

define('USER_FORBIDDEN', 1); // 用户限制登录

define('CHANNEL_SUCCESS',2);//渠道扣款成功
define('CP_SUCCESS',2);     //厂商通知成功
define('CP_FAIL',3);        //厂商通知失败

define('ORDER_FIX_TYPE',2);  //订单修复 类型

define('COMPANY_SHENHE',1); // 厂商审核
define('PAID_CONFIRM',2);  // 提款确认 
define('PAID_MONEY',3);  // 付款

//页面跳转函数
function go($url, $content = "", $notice = 0)
{
    if ($content) {
        $content = urlencode($content);
        $page    = "/index.php/admin/gourl/view_gourl";
        $query   = "?url={$url}&content={$content}&notice={$notice}";
        header("Location:{$page}{$query}");
    } else {
        header("Location:{$url}");
    }
    exit;
}

// js 跳转
function js_go($url, $content = '')
{
    header("Content-Type:text/html;charset=utf-8");
    echo "<script type='text/javascript'>";
    if ($content) {
        echo "alert('{$content}');";
    }
    echo "window.location.href='" . $url . "';";
    echo "</script>";
    exit;
}


// 生成随机字符
function get_random($length = 6)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $str   = "";
    for ($i = 0; $i < $length; $i++) {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // $str .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
        // 第二种是取字符数组 $chars 的任意元素
        $str .= $chars[mt_rand(0, strlen($chars) - 1)];
    }
    return $str;
}


function array_sort_plan($a,$b){
    if($a['time'] == $b['time']){
        return 0;
    }
    return $a['time']>$b['time']?1:-1;
}

/**
 * 导出excel
 * @wanglindong
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
    $CI = & get_instance();
    $CI->load->library('PHPExcel');
    require APPPATH.'libraries/PHPExcel/Writer/Excel5.php';
    $objPHPExcel = new PHPExcel();

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

function double_2($n){

    return sprintf('%0.02f',$n);
}

//学历转换
function xueli($num){
    $xueli = array('未知','博士','硕士','本科','专科');
    return $xueli[$num];
}
//inst页面跳转函数
function inst_go($url, $content = "", $notice = 0)
{
    if ($content) {
        $content = urlencode($content);
        $page    = "/index.php/admin/institution/view_gourl";
        $query   = "?url={$url}&content={$content}&notice={$notice}";
        // echo $page,$query;
        header("Location:{$page}{$query}");
    } else {
        header("Location:{$url}");
    }
    exit;
}

//身份证转换出生日期，年龄
function card_to_birth($card,$type=null){
    if(empty($card)) return '';
    $date=strtotime(substr($card,6,8));
    if(!$type){        
        return date('Y-m-d',$date);
    }
    $today=strtotime('today');
    $diff=floor(($today-$date)/86400/365);
    //如果超过了出身月份加1
    $age=strtotime(substr($card,6,8).' +'.$diff.'years')>$today?($diff+1):$diff;
    return $age; 
}

//所有表单列表
function table(){
    $table = array('inst'=>'中心','inst_detail'=>'机构办公室','inst_member'=>'中心成员','first_ward'=>'一期病房','dept'=>'科室','dept_member'=>'科室成员','project'=>'立项');
    return $table;
}

//科室分类
function dept_type(){
    $dept_type = array('肿瘤科','内科','外科','消化科','皮肤科');
    return $dept_type;
}

//检测手机格式
// function phone_check(){
    
// }
