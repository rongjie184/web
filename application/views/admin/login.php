<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit" />
  <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
  <title><?=$this->config->item('web_title')?> | 登录</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>style/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>style/font-awesome-4.5.0/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$cdn?>style/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=$cdn?>style/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="<?=$cdn?>style/dist/css/formValidation.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?=$cdn?>/style/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?=$cdn?>/style/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><?=$this->config->item('web_title')?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">请登录您的账号</p>

    <form action="<?=$cdn?>index.php/admin/login/checklogin" method="post" id='iForm'>
      <input type='password' style='display:none'>
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" value="<?php 
        // 匹配字母 下划线 数字
        if(preg_match('/^[\w]{5,20}$/',$_COOKIE['save_username'])){
          echo $_COOKIE['save_username'];
        }
        ?>"placeholder="请填写账号" pattern="^[a-zA-z]\w{4,20}$" data-fv-regexp-message="账号需为字母开头,5-20位的字母 数字 下划线"> 
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="请填写密码" pattern="^\w{6,20}$" data-fv-regexp-message="密码需为长度6-20位的数字或字母" >
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name='save'> 记住账号
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">登录</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?=$cdn?>style/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=$cdn?>style/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=$cdn?>style/plugins/iCheck/icheck.min.js"></script>
<!-- Form Validata -->
<script type="text/javascript" src="<?=$cdn?>style/dist/js/formValidation.js"></script>
<script type="text/javascript" src="<?=$cdn?>style/dist/js/framework/bootstrap.js"></script>
<script type="text/javascript" src="<?=$cdn?>style/dist/js/language/zh_CN.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });


$(document).ready(function() {
   $('#iForm').formValidation({
     framework: 'bootstrap',
     fields: {
        username:{
          validators: {
            notEmpty: {message: '账号不可为空'}
          }
        },
        password: {
          validators: {
            notEmpty: {message: '密码不可为空'}
          }
        }

      }
   })
})     
</script>    

</body>
</html>
