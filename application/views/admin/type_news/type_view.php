
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
  <title><?=$this->config->item('web_title')?> | 资讯分类详情</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=$cdn?>/style/ionicons-2.0.1/css/ionicons.min.css">
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
        资讯分类设置
        <small>资讯分类详情</small>
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
              <h3 class="box-title">资讯分类详细信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" >
              <div class="box-body col-sm-offset-1 ">

                <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">资讯分类名称：</label>
                  <div class="col-sm-4">
					           <p class="form-control-static"><?=$type_info['name']?></p>
                  </div>
                </div>

				  <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">描述：</label>
                  <div class="col-sm-4">
					           <p class="form-control-static"><?=$type_info['desc']?></p>
                  </div>
                </div>

                <!--<div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">排序：</label>
                  <div class="col-sm-4">
                     <p class="form-control-static"><?=$type_info['order_num']?></p>
                  </div>
                </div>  
				-->
				 <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">状态：</label>
                  <div class="col-sm-4">
                     <p class="form-control-static">
					  <?php if($type_info['status']==0){?>
                      <span class="label label-default">停用</span>
                      <?php }else{?>
                      <span class="label label-success">正常</span>
                      <?php }?> 
					 </p>
                  </div>
                </div>  
               
               
             </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-2">
					<a class="btn btn-info btn-block" href="/index.php/admin/type_news/type_list" role="button">返回</a>
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
<!-- AdminLTE App -->
<script src="<?=$cdn?>/style/dist/js/app.min.js"></script>
<!-- Form Validata -->
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/formValidation.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/framework/bootstrap.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/language/zh_CN.js"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

</body>
</html>


