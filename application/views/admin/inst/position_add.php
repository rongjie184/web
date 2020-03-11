
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
  <title><?=$this->config->item('web_title')?> | 添加机构职位</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">
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
        机构管理
        <small><?=$position['id']?'修改职位':'添加职位'?></small>
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
              <input type="password" style="display: none;">
              <input type="hidden" class="form-control" id="memberId"  name='memberId' placeholder="年龄" value="<?=$member['id']?>" >
              <div class="box-body">

			  
                <div class="form-group">
                  <label for="uname" class="col-sm-2 control-label">选择所属机构</label>
                  <div class="col-sm-2">
                    <select id='instid' name='instid' class="form-control select2" style="width: 100%;">
                                <option value='0'>选择机构</option>
                              
                                <?php
                                foreach($instlist as $value){
                                  $opt = '';
                                  if($typeid == $value['id']){
                                    $opt = 'selected';
                                  }
                                ?>
                                <option <?=$opt?> value='<?=$value['id']?>' <?=$value['id'] ==$dept['inst_id']?'selected="selected"':''?>><?=$value['instname']?> </option>
                                <?php
                                }
                                ?>
                    </select>
                  </div>

                </div>

                <div class="form-group" id="all" hidden>
                <label for="roleid" class="col-sm-2 control-label">该机构的已有的职位</label>
                          <div class="col-sm-2">
                            <div class="form-control" style="width:300px;height:100px" id="zhiwei">主任,副主任</div>
                          </div>

                </div>


                <div class="form-group">
                <label for="roleid" class="col-sm-2 control-label">职位名称</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" id="name" name='name' placeholder="请输入职位名称" value="<?=$position['name']?>">
                          </div>

                </div>


              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-info"><?=$position['id']?'修改':'添加'?></button>
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
<!-- Select2 -->
<script src="<?=$cdn?>/style/plugins/select2/select2.full.min.js"></script>
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

$(document).ready(function() {

   $(".select2").select2();

   $("#instid").change(function(){
      var inst = $('#instid option:selected').val();
      if(inst==0){
          $('#all').hide();
      }else{
         $('#all').show();
         position();
      } 

   })


   function position(){
    var inst = $('#instid option:selected').val();
    var str = '';
    $.ajax({
        type: "POST",
        url: "<?php echo $cdn?>index.php/admin/institution/position_return",
        data: { "id": inst, "level":1},
        dataType: "JSON",
        async: false,
        success: function (data) {
          // console.log(data);
            //从服务器获取数据进行绑定
            $.each(data, function (i, item) {
                // console.log(item['name']);
                // console.log(i);
               str += item['name'] +',';
            })
            //将数据添加到省份这个下拉框里面
            // $("#city").append(str);
            $('#zhiwei').html(str);
        },
        error: function () { alert("Error"); }
    })
}


   $('#iForm').formValidation({
     framework: 'bootstrap',
     // Feedback icons
     icon: {
         valid: 'glyphicon glyphicon-ok',
         invalid: 'glyphicon glyphicon-remove',
         validating: 'glyphicon glyphicon-refresh'
     }, 
     fields: {
        name:{
          validators: {
            notEmpty: {message: '职位名称不可为空'}
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
              url: '/index.php/admin/user/user_account_check',
              type: 'post',  
              delay:800,
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
