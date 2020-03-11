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
  <title><?=$this->config->item('web_title')?> | 修改伦理</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">
  <!--select2-->
  <link rel="stylesheet" href="<?=$cdn?>/style/plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/skins/skin-blue.min.css">

  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/formValidation.css">
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
        中心管理
        <small>修改伦理</small>
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
              <h3 class="box-title">请填写信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm' enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">机构名称</label>
                  <div class="col-sm-2">
                    <!-- <select id='instid' name='instid' class="form-control select2" style="width: 100%;">
                      <option value='0'>选择机构</option>
                      <?php
                      foreach($inst as $value){               
                      ?>
                      <option value='<?=$value['id']?>' <?=$value['id']==$member['inst_id']?'selected="selected"':''?>><?=$value['instname']?></option>
                      <?php
                      }
                      ?>
                    </select> -->
                    <input type="hidden" class="datepicker" id="eid"  name='eid' style="width:180px" value="<?=$ethic['id']?>">
                    <input type="hidden" class="datepicker" id="instid"  name='instid' style="width:180px" value="<?=$inst['id']?>">
                    <span type="text" class="datepicker" id="inst"  name='inst' style="width:180px"><?=$inst['instname'] ?></span>
                  </div>
                 
                </div>

                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">伦理接待时间</label>
                  <div class="col-sm-2">
                   <span> <input type="text" class="datepicker" id="jiedai_time"  name='jiedai_time' style="width:180px" value="<?=$ethic['reception_time']?date('Y-m-d',$ethic['reception_time']):'' ?>"></span>
                  </div>
                </div>   
               

                <!-- <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">伦理流程</label>
                  <div class="col-sm-2">
                      <span class="help-block"></span>
                      <input type="file" name="procedure" class="file" id="procedure" size="28" >
                  </div>
                  <div class="col-sm-1">
                      <input type="button" value="取消" id="reset" style="display:none;">
                  </div>
                  <div class="col-sm-2">
                    <span  class="radio-inline" id="address" name='address' ><a href="<?=$ethic['procedure']?>">点击查看原文档</a></span>
                  </div>
                </div> --> 
               
                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">递交文件要求</label>
                  <div class="col-sm-3">
                    <textarea type="text" class="form-control" id="doc_require" name='doc_require' placeholder="立项文件要求"><?=$ethic['require'] ?></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">是否必要组长单位批件上会</label>
                  <div class="col-sm-2" name="budui">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="approval" <?=$ethic['approval']=='1'?'checked=checked':'' ?>>是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="approval" <?=$ethic['approval']=='0'?'checked=checked':'' ?> >否
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">伦理会招开频率</label>
                  <div class="col-sm-1">
                    <input type="text" class="form-control" id="rate" name='rate' placeholder="频率" value="<?=$ethic['frequency'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">伦理会费（上会）</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="meeting" name='meeting' placeholder="上会" value="<?=$ethic['huifei'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">伦理会费（快审）</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="quicktrial" name='quicktrial' placeholder="快审" value="<?=$ethic['kuaishen'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">伦理会时间</label>
                  <div class="col-sm-1">
                   <span> <input type="text" class="datepicker" id="ethic_time"  name='ethic_time' style="width:100px" value="<?=date('Y-m-d',$ethic['ethic_time']) ?>"></span>
                  </div>
                </div> 
                <div class="form-group" id="add_time">
                  <label for="appid" class="col-sm-2 control-label"></label>
                  <?php foreach ($ethic['ethic_time'] as $key => $value) {?>
                      <!-- <?php if($key<10){?> -->
                        <div class="col-sm-1" id="lead<?=$key*100+$key?>"><input type="hidden"  name="time[]" value="<?=$value?>"><span type="text" class="label label-success" style="width:90px;font-size:14px"><?=$value?></span><i class="glyphicon glyphicon-minus" onclick="msDel(<?=$key*100+$key?>)"></i></div>
                      <!-- <?php }?> -->
                  <?php }?>
                </div> 
                <div class="form-group" id="add_time1">
                  <label for="appid" class="col-sm-2 control-label"></label>
                  
                </div> 

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">伦理联系人</label>
                  <div class="col-sm-2">
                    <select id='linkman' name='linkman' class="form-control select2" style="width: 100%;">
                      <option value=''>选择联系人</option>
                      <?php
                      foreach($inst_member as $value){               
                      ?>
                      <option value='<?=$value['id'].','.$value['name']?>' <?=$value['id']==$member['id']?'selected="selected"':''?>><?=$value['name']?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                 
                </div> 

                <div class="form-group" id="newlead">
                    <label for="zh_action" class="col-sm-2 control-label"></label>
                    <?php foreach ($user as $key=>$value) {?>
                      <div class="col-sm-2" id="lead<?=$key+100?>">
                        <input type="hidden"  name="lead[]" value="<?=$value['id']?>">
                        <span type="text" class="form-control"><?=$value['name']?></span><i class="glyphicon glyphicon-minus" onclick="msDel(<?=$key+100?>)"></i>
                      </div>
                    <?php }?>

                </div> 



             </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-info">修改</button>
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
<script src="<?=$cdn?>/style/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=$cdn?>/style/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=$cdn?>/style/dist/js/app.min.js"></script>
<!-- Select2 -->
<script src="<?=$cdn?>/style/plugins/select2/select2.full.min.js"></script>
<!-- Form Validata -->
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/formValidation.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/framework/bootstrap.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/language/zh_CN.js"></script>
<script src="<?=$cdn?>/style/plugins/datepicker/bootstrap-datepicker.js"></script> 
<script src="<?=$cdn?>/style/plugins/datepicker/bootstrap-datepicker.zh-CN.js"></script> 
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script type="text/javascript">
$(document).ready(function(){
  var num =0;
$(".select2").select2();
$(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
    language:"zh-CN", //--语言设置
    format:"yyyy-mm-dd"  //--日期显示格式
})


$("#ethic_time").datepicker({
    autoclose: true,
    todayHighlight: true,
    language:"zh-CN", //--语言设置
    format:"yyyy-mm-dd"  //--日期显示格式
}).on('changeDate', function (e) {
    ++num;
    var t = $('#ethic_time').val();
    var str = '<div class="col-sm-1" id="time'+num+'"><input type="hidden" name="time[]" value="'+t+'"><span type="text" class="label label-success" style="width:90px;font-size:14px">'+t+'</span><i class="glyphicon glyphicon-minus" onclick="msDelt('+num+')"></i></div>';
    
    if(num>10){
      $("#add_time1").append(str);
    }else{
      $("#add_time").append(str);
    }
  })
});


$(document).ready(function(){
  $('#linkman').change(function(){
    leadBind();
  })
});

var num = 0;
function leadBind(){
   // var provice = $("#mishuid option:selected").val();
   var lead = $('#linkman').val();
    //判断省份这个下拉框选中的值是否为空
    if (lead == "") {
        return;
    }
    var larr = lead.split(',');
     // $(this).val(num);
    var length = $('#newlead input').length; 
    ++num;
    var str = '<div class="col-sm-2" id="lead'+num+'"><input type="hidden"  name="lead[]" value="'+larr[0]+'"><span type="text" class="form-control">'+larr[1]+'</span><i class="glyphicon glyphicon-minus" onclick="msDel('+num+')"></i></div>';
    if(length >4){
      alert('最多添加5个');
      return ;
    }
    $("#newlead").append(str);
   // <i class="glyphicon glyphicon-minus radio-inline" >删除</i> 
   
}


function msDel(num1){
    $('#lead'+num1).remove();
    // console.log(id);
}

function msDelt(num1){
  $('#time'+num1).remove();
}


$(document).ready(function() {
  $("#procedure").change(function(){

    if(document.getElementById("procedure").value!=""){
      document.getElementById("reset").style="display:block";               
    }
  })
    $("#reset").click(function(){
      document.getElementById("procedure").value=""; 
      document.getElementById("reset").style="display:none";  
  })

})


$(function(){
  $('#ethic_time').change(function(){

   // var provice = $("#mishuid option:selected").val();
   var ethic = $('#ethic_time').val();
    //判断省份这个下拉框选中的值是否为空
    if (ethic == "") {
        return;
    }

    var str = '<div class="col-sm-2" id="lead'+num+'"><input type="hidden"  name="lead[]" value="'+ethic+'"><span type="text" class="form-control">'+ethic+'</span><i class="glyphicon glyphicon-minus" onclick="msDel('+num+')"></i></div>';

    // $("#add_time").append(str);
   // <i class="glyphicon glyphicon-minus radio-inline" >删除</i> 

  })

})





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

        // name:{
        //   validators: {
        //     notEmpty: {message: '机构名称不可为空'}
        //   }
        // },
        code:{
           validators: {
            notEmpty: {message: '代码标识不可为空'},
            remote:{
              url: '/index.php/admin/adminaction/action_check',
              type: 'POST',  
              delay:800,
              message:'代码标识不合法,请更换'                    
            }
          }                 
        }    

      }
   })
})     
</script>        
</body>
</html>


