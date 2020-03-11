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
  <title><?=$this->config->item('web_title')?> | 添加详细信息</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
  <!-- select2 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/plugins/select2/select2.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">

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
        患者管理
        <small>添加患者信息</small>
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
              <h3 class="box-title">请填写患者信息：</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">选择患者</label>
                  <div class="col-sm-2">
                    <select id='patid' name='patid' class="form-control select2" style="width: 100%;">
                      <option value="">选择患者</option>
                      <?php
                      foreach($puser as $value){               
                      ?>
                      <option value="<?=$value['uid']?>"><?=$value['uname'].'-'.$value['phone']?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  
                </div>

                 <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">性别</label>
                  <div class="col-sm-2" name="budui">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="sex">男
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="sex" >女
                    </label>
                  </div>
                </div>  

                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">患者筛选号</label>
                  <div class="col-sm-2">
                   <span> <input type="text" class="form-control" id="select_num"  name='select_num' ></span>
                  </div>
                </div> 

               

                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">身份证号</label>
                  <div class="col-sm-2">
                   <span> <input type="text" class="form-control" id="birth"  name='birth' style="width:280px"></span>
                  </div>
                </div>   

                <div class="form-group">
                    <label for="appid" class="col-sm-2 control-label">居住地区</label>
                    <div class="col-sm-2">
                        <select name="province" id="province" class="form-control">
                          <option value="">--请选择省--</option>
                          <?php foreach($shen as $val){?>
                            <option value="<?php echo $val['id']?>"><?php echo$val['short_name']; ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select name="city" id="city" class="form-control">
                            <option value="">--请选择市--</option>
                        </select>
                    </div>
                    
                </div>

                <div class="form-group" id="zhenduan">
                  <label for="c" class="col-sm-2 control-label">诊断</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="diagnosis" name='diagnosis[]' placeholder="诊断0-20字">
                  </div>

                  <label class="col-sm-1 control-label " id="diag"><span><i class="glyphicon glyphicon-plus" ></i></span>继续添加</label>  
                    
                </div>

                <div id ="newtable">
                  <!--动态添加的-->
                </div>

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">选择项目</label>
                  <div class="col-sm-2">
                    <select id='items' name='items' class="form-control select2" style="width: 100%;">
                      <option value=''>选择项目</option>
                      <?php
                      foreach($items as $value){               
                      ?>
                      <option value='<?=$value['id']?>' ><?=$value['shortname']?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  
                </div>
                <div id="inst_dept" style="display:none">
                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">选择机构</label>
                  <div class="col-sm-2">
                    <select id='inst' name='inst' class="form-control select2" style="width: 100%;">
                      <option value=''>选择机构</option>
                      <?php
                      foreach($inst as $value){
                      ?>
                      <option value='<?=$value['id']?>' <?=$value['id']==$member['inst_id']?'selected="selected"':''?>><?=$value['instname']?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                  
                </div>

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">选择科室</label>
                  <div class="col-sm-2">
                    <select id='dept' name='dept' class="form-control select2" style="width: 100%;">
                      <option value=''>选择科室</option>
                     
                    </select>
                  </div>
                  
                </div>
                </div>

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">主管CRC</label>
                  <div class="col-sm-2">
                      <span> <input type="text" class="form-control" id="crc"  name='crc' style="width:180px"></span>
                      <input type="hidden" class="form-control" id="crcid"  name='crcid' style="width:180px" value="">
                  </div>

                </div>

                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">家属姓名</label>
                  <div class="col-sm-2">
                   <span> <input type="text" class="form-control" id="family"  name='family' ></span>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">关系</label>
                  <div class="col-sm-2">
                   <span> <input type="text" class="form-control" id="relation"  name='relation' ></span>
                  </div>
                </div> 
                
                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">家庭联系方式</label>
                  <div class="col-sm-2">
                   <span> <input type="text" class="form-control" id="family_phone"  name='family_phone' ></span>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">微信号</label>
                  <div class="col-sm-2">
                   <span> <input type="text" class="form-control" id="wechat"  name='wechat' ></span>
                  </div>
                </div> 


             </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-info">添加</button>
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
  
  $(".datepicker").datepicker({
      autoclose: true,
      todayHighlight: true,
      language:"zh-CN", //--语言设置
      format:"yyyy-mm-dd"  //--日期显示格式
  });
})

$(document).ready(function(){
    var zhi = $("#items option:selected").val();
    if(zhi){
      $("#inst_dept").show();
    }

})

$(document).ready(function(){
  $('#province').change(function(){
    cityBind();
  })
});

$(document).ready(function(){
  $('#city').change(function(){
    areaBind();
  })
});

function cityBind(){
   // var provice = $("#Province option:selected").val();
   var provice = $('#province').val();
    //判断省份这个下拉框选中的值是否为空
    if (provice == "") {
        return;
    }
    // console.log(url);
    $("#city").html('<option value="">--请选择市--</option>');
    var str = '';
    $.ajax({
        type: "POST",
        url: "<?php echo $cdn?>index.php/admin/institution/area_sel",
        data: { "id": provice, "level":1},
        dataType: "JSON",
        async: false,
        success: function (data) {
          // console.log(data);
            //从服务器获取数据进行绑定
            $.each(data, function (i, item) {
                // console.log(i);
                str += "<option value=" + item['id']+ ">" + item['name'] + "</option>";
            })
            //将数据添加到省份这个下拉框里面
            $("#city").append(str);
        },
        error: function () { alert("Error"); }
    })
}


function areaBind(){
   // var provice = $("#Province option:selected").val();
   var area = $('#city').val();
    //判断省份这个下拉框选中的值是否为空
    if (area == "") {
        return;
    }
    // console.log(url);
    $("#area").html('<option value="">--请选择区域--</option>');
    var str = '';
    $.ajax({
        type: "POST",
        url: "<?php echo $cdn?>index.php/admin/institution/area_sel",
        data: { "id": area, "level":2},
        dataType: "JSON",
        async: false,
        success: function (data) {
          // console.log(data);
            //从服务器获取数据进行绑定
            $.each(data, function (i, item) {
                // console.log(i);
                str += "<option value=" + i+ ">" + item + "</option>";
            })
            //将数据添加到省份这个下拉框里面
            $("#area").append(str);
        },
        error: function () { alert("Error"); }
    })
    
}

//增加诊断
$(function(){
  $("#diag").click(function(){
        diag();    
  })
})

//增加弹窗
var num = 0;
function diag(){

    num++;
    var i = '<i class="glyphicon glyphicon-minus " onclick="msDel('+num+')"></i>';
    var str = '<div class="form-group" id="new'+num+'"><label class="col-sm-2 control-label"></label><div class="col-sm-4 "><input type="text" class="form-control" name="diagnosis[]" id="diagnosis'+num+'" value="" >';
    var str1 = str + i + '</div></div>';
    var length = $('#newtable input').length;
    console.log(length);
    if(length>8){
      alert('以达上线，不可添加');
      return ;
    }
    $("#newtable").append(str1);
  
}

function msDel(num1){
    $('#new'+num1).remove();
    // console.log(id);
}


$(document).ready(function(){
  $('#inst').change(function(){
    seldept();
  })
});

function seldept(){

   var provice = $('#inst').val();
    //判断省份这个下拉框选中的值是否为空
    if (provice == "") {
        return;
    }
    var project = $('#items').val();
    //console.log(project);
    $("#dept").html('<option value="">--请选择科室--</option>');
    var str = '';
    $.ajax({
        type: "POST",
        url: "<?php echo $cdn?>index.php/admin/institution/dept",
        data: { "id": provice, "level":1, "project":project},
        dataType: "JSON",
        async: false,
        success: function (data) {
          console.log(data);
            //从服务器获取数据进行绑定
            $.each(data['keshi'], function (i,item) {
                 //console.log(item);
                str += "<option value=" + item['id']+ ">" + item['name'] + "</option>";
            })
            //将数据添加到省份这个下拉框里面
            $("#dept").append(str);
            $('#crc').val(data['crc']['uname']);
            $('#crcid').val(data['crc']['uid']);
            //console.log('data["crc"]');
        },
        error: function () { alert("Error"); }
    })

}


$(document).ready(function(){
  $('#items').change(function(){
      items();
  })
})

function items()
{
  var provice = $('#items').val();
  if(provice){
    $('#inst_dept').show();
  }else{
    $('#inst_dept').hide();
  }
  
}


$(document).ready(function() {
  $(".select2").select2();
   $('#iForm').formValidation({
     framework: 'bootstrap',

     // Feedback icons
     icon: {
         valid: 'glyphicon glyphicon-ok',
         invalid: 'glyphicon glyphicon-remove',
         validating: 'glyphicon glyphicon-refresh'
     }, 

    fields: {
        uname:{
          validators: {
            notEmpty: {message: '请选择患者'}
          }
        },
    patid:{
          validators: {
            notEmpty: {message: '请选择患者'},
             callback: {
                      message: '必须选择一个患者',
                      callback: function(value, validator) {

                            if (value == 0) {
                                 return false;
                            }else {
                                 return true;
                            }
                        }
                    }
          }
        },
        select_num:{
           validators: {
            notEmpty: {message: '筛选号不可为空'},
            // remote:{
            //   url: '',
            //   type: 'post',  
            //   delay:800,
            //   message:'请更换,筛选号'                    
            // }
          }                 
        },
    phone:{
           validators: {
            notEmpty: {message: '用户手机号不可为空'},
            remote:{
              url: '/index.php/admin/web_user/user_phone_check',
              type: 'post',  
              delay:800,
              message:'登录手机号不合法或已存在,请更换'                    
            }
          }                 
        }

      }
   })
})     
</script>        
</body>
</html>


