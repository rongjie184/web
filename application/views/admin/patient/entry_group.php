<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit" />
  <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
  <title><?=$this->config->item('web_title')?> | 患者入组</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
  <!-- select2 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/plugins/select2/select2.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?=$cdn?>/style/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/skins/_all-skins.min.css">

   <link rel="stylesheet" href="<?=$cdn?>/style/plugins/daterangepicker/daterangepicker.css">
   <!--添加时间控件 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/plugins/datepicker/datepicker3.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?=$cdn?>/style/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?=$cdn?>/style/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <?php $this->load->view('common/header');?>
  <!-- Left side column. contains the logo and sidebar -->

  <?php $this->load->view('common/aside-left');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        患者管理
        <small>患者入组</small>
      </h1>

<!--  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">请填写入组信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">

                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">入组时间</label>
                  <div class="col-sm-2">
                   <span> <input type="text" class="datepicker" id="time"  name='time' style="width:180px"></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">患者姓名</label>
                  <div class="col-sm-2">
                    <span type="text" class="form-control" id="name"  name='name' ><?=$user['uname']?></span>
                    <input type="hidden" class="form-control" id="uid"  name='uid' value="<?=$user['uid']?>">
                  </div>
                 
                </div>


                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">患者随机号</label>
                  <div class="col-sm-2">
                   <span> <input type="text" class="form-control" id="random"  name='random' value="<?=$dept['address']?>"></span>
                  </div>
                </div>   

                <div class="form-group">
                  <label for="uname" class="col-sm-2 control-label">组别</label>
                  <div class="col-sm-2">
                      <select id='group' name='group' class="form-control select2" style="width: 100%;">
                                <option value=''>选择组别</option>
                              
                                <?php
                                foreach($group as $value){
                                  $opt = '';
                                  if($typeid == $value['id']){
                                    $opt = 'selected';
                                  }
                                ?>
                                <option <?=$opt?> value='<?=$value?>'><?=$value?> </option>
                                <?php
                                }
                                ?>
                      </select>
         
                  </div>
                  <div class="col-sm-1">
                      <label id="but_sponsor"> <button type="button" class="btn btn-info" onclick="add_sponsor()">+</button></label>
                  </div>
                  <div class="col-sm-4" style="display:none;" id="sponsors">
                               <input type="text" id="sponsor"  name='sponsor' style="width:180px">
                       <button type="button" class="btn btn-info" onclick="add_sponsors()">添加
                       <button type="button" class="btn btn-info" onclick="res_sponsors()">取消</button>
                  </div>
                  


                </div>
                

             </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-info"><?=$dept['id']?'修改':'添加'?></button>
                  </div>
                </div>
              </div>

              <!-- /.box-footer -->
            </form>            

          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->

      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('common/footer.php');?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<?php $this->load->helper('url'); ?>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->


<!-- jQuery 2.2.3 -->
<script src="<?=$cdn?>/style/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=$cdn?>/style/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=$cdn?>/style/dist/js/app.min.js"></script>

<!-- Select2 -->
<script src="<?=$cdn?>/style/plugins/select2/select2.full.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?=$cdn?>/style/plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="<?=$cdn?>/style/plugins/fastclick/fastclick.js"></script>

<!-- Form Validata -->
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/formValidation.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/framework/bootstrap.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/language/zh_CN.js"></script>
<script src="<?=$cdn?>/style/plugins/datepicker/bootstrap-datepicker.js"></script> 
<script src="<?=$cdn?>/style/plugins/datepicker/bootstrap-datepicker.zh-CN.js"></script> 

<!-- bootstrap-datetimepicker.min.js
bootstrap-datetimepicker.zh-CN.js 
bootstrap-datetimepicker.min.css  -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script type="text/javascript">



 $(function () {

  $(".select2").select2();

  $(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
    language:"zh-CN", //--语言设置
    format:"yyyy-mm-dd "  //--日期显示格式
  });
 });

$(function(){
  $('.datepicker').change(function(){
    var d=new Date(),str='';
    str +=d.getHours()+':';
    str +=d.getMinutes()+':';
    str +=d.getSeconds(); 
  $('.datepicker').val($('.datepicker').val()+ str);
 // // if(tt){
 //  console.log(11);
 // // }
})
})  

// $(document).ready(function(){
//   $('#dept_type').change(function(){
//     deptType();
//   })
// });

// var num = 0;
// function deptType(){
//    // var provice = $("#mishuid option:selected").val();
//    var lead = $('#dept_type').val();
//     //判断省份这个下拉框选中的值是否为空
//     if (lead == "") {
//         return;
//     }
//     // var larr = lead.split(',');
//     // console.log(lead);
//      // $(this).val(num);
//     var length = $('#newlead1 input').length; 
//     ++num;
//     var str = '<div class="col-sm-1" id="mishu'+num+'" ><input type="hidden" name="dept_type[]" value="'+lead+'"><span type="text" class=" radio-inline label label-default" >'+lead+'</span><i class="glyphicon glyphicon-remove" onclick="msDel1('+num+')" ></i></div>';
//     // console.log(str);
//     if(length >4){
//       alert('最多添加5个');
//       return ;
//     }
//     $("#newlead1").append(str);
//    // <i class="glyphicon glyphicon-minus radio-inline" >删除</i> 
   
// }

function msDel1(num1){
    $('#mishu'+num1).remove();
    // console.log(id);
}

 function add_sponsor(){
   $("#sponsors").show();
   $("#but_sponsor").hide();
 }

 function res_sponsors(){
   $("#sponsors").hide();
   $("#but_sponsor").show();
 }

//添加组别
function add_sponsors(){

    var sponsor=$("#sponsor").val();
    $.ajax({
         type:"post",
         url: "/index.php/admin/patient/add_group",
         dataType:"json",
         data:"sponsor="+sponsor,
         success: function(data){ 
          console.log(data);
           if(data=="no"){
            alert('添加组别失败');
           }else{
             $("#group").append("<option value='' selected='selected'>"+sponsor+"</option>"); //为Select追加一个Option(下拉项)
             $("#sponsors").hide();
             $("#but_sponsor").show();
             
           }          
         }
       });
  
 }

 //    
$(document).ready(function() {
   $('#iForm').formValidation({
     framework: 'bootstrap',

     // Feedback icons
     icon: {
         valid: 'glyphicon glyphicon-ok',
         invalid: 'glyphicon glyphicon-remove',
         validating: 'glyphicon glyphicon-refresh'
     }, 

     fields: {

        random:{
          validators: {
            notEmpty: {message: '随机号不可为空'}
          }
        },
        instid:{
          validators: {
            notEmpty: {message: '随机号不可为空'},
             callback: {
                      message: '必须选择一个中心机构',
                      callback: function(value, validator) {

                            if (value == 0) {
                                 return false;
                            }else {
                                 return true;
                            }
                        }
                    }
          }
        }    

      }
   })
})     
</script>        
</body>
</html>


