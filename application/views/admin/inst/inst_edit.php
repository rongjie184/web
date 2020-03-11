
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
  <title><?=$this->config->item('web_title')?> | 编辑用户</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
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
        用户管理
        <small>编辑用户</small>
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
              <h3 class="box-title">请填写基本信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
			<input type="hidden" name="instid" value="<?=$instinfo['id']?>" id="instid">
              <input type="password" style="display: none;">
              <div class="box-body">

			  <div class="form-group">
				<label for="name" class="col-sm-2 control-label">机构名称</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="name" name='name' value="<?=$instinfo['instname']?>">

                  </div>

				</div>


                <div class="form-group">
                  <label for="shortname" class="col-sm-2 control-label">简称</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="shortname" name='shortname' value="<?=$instinfo['shortname']?>">
                  </div>

                </div>

				
                <div class="form-group">
                  <label for="troops" class="col-sm-2 control-label">部队系统</label>

                  <div class="col-sm-3">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="troops" <?=$instinfo['troop_system']==1?'checked="checked"':'' ?>>是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="troops" <?=$instinfo['troop_system']==0?'checked="checked"':'' ?>>否
                    </label>

                  </div>

                </div>
                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">资质获取时间</label>
                  <div class="col-sm-2">
                   <span> <input type="text" class="datepicker" id="zizhi_time"  name='zizhi_time' style="width:180px" value="<?=date('Y-m-d',$instinfo['qualify_time'])?>"></span>
                  </div>
                </div> 
                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">隶属地区</label>

                    <div class="col-sm-2">
                        <select name="province" id="province" class="form-control">
                          <option value="">--请选择省--</option>
                          <?php foreach($shen as $val){?>
                            <option value="<?php echo $val['id']?>"<?=$instinfo['province']==$val['id']?'selected = "selected"':'' ?>><?php echo$val['name']; ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select name="city" id="city" class="form-control">
                            <option value="">--请选择市--</option>
                            <?php foreach($city as $val){?>
                            <option value="<?php echo $val['id']?>"<?=$instinfo['city']==$val['id']?'selected = "selected"':'' ?>><?php echo$val['name']; ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <select name="area" id="area" class="form-control">
                            <option value="">--请选择区域--</option>
                            <<?php foreach($area as $val){?>
                            <option value="<?php echo $val['id']?>"<?=$instinfo['area']==$val['id']?'selected = "selected"':'' ?>><?php echo$val['short_name']; ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="quyu"  name='quyu' placeholder="请输入区域" value="<?=$instinfo['address']?>">
                    </div>
                </div>
                <div class="form-group">
                  <label for="troops" class="col-sm-2 control-label">中心实验室</label>

                  <div class="col-sm-3">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="lib" <?=$instinfo['inst_lib']==1?'checked="checked"':'' ?>>有
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="lib" <?=$instinfo['inst_lib']==0?'checked="checked"':'' ?>>无
                    </label>

                  </div>

                </div>
                <!--新增字段修改区域-->
                <div>
                  <?php foreach($columns as $val){?>
                    
                         <div class="form-group">
                          <label class="col-sm-2 control-label"><?=$val['cname'] ?></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" name="columns[<?=$val['col_name']?>][]" value="<?php foreach ($col_inst as $key => $value){?><?php if($val['id']==$key){?><?=$value ?><?php }?><?php }?>">
                          </div>
                        </div>
                         <input type="hidden" class="form-control" name="columns[<?=$val['col_name']?>][]" value="<?=$val['id']?>">
                        
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
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="<?=$cdn?>/style/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=$cdn?>/style/bootstrap/js/bootstrap.min.js"></script>
<<!-- AdminLTE App -->
<script src="<?=$cdn?>/style/dist/js/app.min.js"></script>
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


$(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
    language:"zh-CN", //--语言设置
    format:"yyyy-mm-dd"  //--日期显示格式
});

$(document).ready(function(){
  $('#province').change(function(){
    cityBind();
  })
});

// $(document).ready(function(){
//   $('#city').change(function(){
//     areaBind();
//   })
// });

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
          console.log(data);
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
        uname:{
          validators: {
            notEmpty: {message: '管理员姓名不可为空'}
          }
        },
		roleid:{
          validators: {
            notEmpty: {message: '用户角色不可为空'}
			,
             callback: {
                      message: '必须选择一个角色',
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
        account:{
           validators: {
            notEmpty: {message: '用户账号不可为空'},
            remote:{
              url: '/index.php/admin/user/user_accounts_check',
              type: 'post',  
              delay:800,
			  data:{
                    uid:function(){return $('#uid').val()},
				    account:function(){return $('#account').val()}
				
               },
              message:'登录账号不合法或已存在,请更换'                    
            }
          }                 
        },
        passwd: {
          validators: {
            notEmpty: {message: '密码不可为空'}
          }
        },
        repatpass:{
          validators:{
            // notEmpty: {message: '重复密码不可为空'},
            identical:{field:'passwd',message:'两次密码输入不一致'}
          }
        }

      }
   })
})     
</script>     
</body>
</html>
