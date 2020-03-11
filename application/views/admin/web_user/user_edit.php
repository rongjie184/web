
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
			<input type="hidden" name="uid" value="<?=$sinfo['uid']?>" id="uid">
           
              <div class="box-body">

			  <div class="form-group">
				<label for="roleid" class="col-sm-2 control-label">用户角色</label>
                  <div class="col-sm-3">
                   <select id='roleid' name='roleid' class="form-control select2" style="width: 100%;">
						  <option value='0'>选择角色</option>
						  <?php
							foreach($rolelist as $value){
								 $opt = '';
								if($sinfo['role_id']=$value['id']){ $opt = 'selected';}
						  ?>
						  <option <?=$opt?> value='<?=$value['id']?>' ><?=$value['rolename']?></option>
						  <?php
							}
						  ?>
						</select>
                  </div>

				</div>


                <div class="form-group">
                  <label for="uname" class="col-sm-2 control-label">用户姓名</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="uname" name='uname' value="<?=$sinfo['uname']?>">
                  </div>

                </div>

				
                <div class="form-group">
                  <label for="account" class="col-sm-2 control-label">登录账号</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="account"  name='account' value="<?=$sinfo['account']?>" >
                  </div>

                </div>

				 <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">登录邮箱</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="email"  name='email' value="<?=$sinfo['email']?>" >
                  </div>

                </div>


				 <div class="form-group">
                  <label for="phone" class="col-sm-2 control-label">登录手机号</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="phone"  name='phone' value="<?=$sinfo['phone']?>">
                  </div>

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
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<script type="text/javascript">
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
              url: '/index.php/admin/web_user/user_accounts_check',
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
		email:{
           validators: {
            notEmpty: {message: '用户账号不可为空'},
            remote:{
              url: '/index.php/admin/web_user/user_emails_check',
              type: 'post',  
              delay:800,
			  data:{
                    uid:function(){return $('#uid').val()},
				    email:function(){return $('#email').val()}
				
               },
              message:'登录邮箱不合法或已存在,请更换'                    
            }
          }                 
        },
		phone:{
           validators: {
            notEmpty: {message: '用户账号不可为空'},
            remote:{
              url: '/index.php/admin/web_user/user_phones_check',
              type: 'post',  
              delay:800,
			  data:{
                    uid:function(){return $('#uid').val()},
				    phone:function(){return $('#phone').val()}
				
               },
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
