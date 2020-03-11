
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
  <title><?=$this->config->item('web_title')?> | 项目合作中心列表</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">

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
        项目管理
        <small>项目合作中心列表</small>
      </h1>

<!--  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">

        <div class="col-xs-12">
          <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
              <form method='post' action='' id="form" name="dbform">
			      <input type="hidden" name="excle" id="excle" >
				        <input type="hidden" name="id" id="id" value="<?=$pid?>">
						   <input type="hidden" name="view" id="view" value="ckinis">
              <table id="example1" class="table table-bordered table-striped">
			
                <thead>
                 <tr>
			  	<td><button type="button" class="btn btn-info btn-flat" id="down">下载</td>
				</tr>
                <tr>
                  <th>项目名称</th>
                  <th>项目编号</th>				
				  <th>机构名称</th>
				  <th>省</th>
				  <th>市</th>
				  <th>是否牵头</th>
				  <th><table class="table table-bordered table-striped">
				  <tr>
					<td>科室名称</td>
					<td>PI职务</td>
					<td>PI姓名</td>
					<td>PI电话</td>
					<td>PI邮箱</td>
					<td>SUB-I职务</td>
					<td>SUB-I姓名</td>
					<td>SUB-I电话</td>
					<td>SUB-I邮箱</td>
				  </tr>
				  </table></th>
                  <th>项目进度</th>
				  <th>计划入组人数</th>
				  <th>实际入组人数</th>
				  <th>CRC姓名</th>
				  <th>CRC所属公司</th>
				  <th>CRC所属公司PM姓名</th>
				  <th>CRC所属公司PM电话</th>
				  <th>CRA姓名</th>
				  <th>CRA电话</th>

                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($list as $value){
                    //print_r($value);
                  ?>
                  <tr>
                    <td><?=$value['itemname']?></td>
                    <td><?=$value['item_number'].$value['exte_number']?></td>
					<td><?=$value['instname']?></td>
					<td><?=$value['province']?></td>
					<td><?=$value['city']?></td>
					<td><?=$value['is_qt']?></td>
					<td>
					<table class="table table-bordered table-striped">
					<?php foreach($value['dept'] as $val){?>


				  <tr>
					<td><?=$val?></td>

					<td>
					<table class="table table-bordered table-striped">
					<?php foreach($value[$val]['pi'] as $v){?>
					<tr><td><?=$v?></td></tr>
					<?php }?></table></td>
					<td><table class="table table-bordered table-striped">
					<?php foreach($value[$val]['pi-position'] as $v){?>
					<tr><td><?=$v?></td></tr>
					<?php }?></table></td> 
					<td><table class="table table-bordered table-striped">
					<?php foreach($value[$val]['pi-phone'] as $v){?>
					<tr><td><?=$v?></td></tr>
					<?php }?></table></td>
					<td><table class="table table-bordered table-striped">
					<?php foreach($value[$val]['pi-email'] as $v){?>
					<tr><td><?=$v?></td></tr>
					<?php }?></table></td>
					
					<td><table class="table table-bordered table-striped">
					<?php foreach($value[$val]['sub'] as $v){?>
					<tr><td><?=$v?></td></tr>
					<?php }?></table></td>
					<td><table class="table table-bordered table-striped">
					<?php foreach($value[$val]['sub-position'] as $v){?>
					<tr><td><?=$v?></td></tr>
					<?php }?></table></td>
					<td><table class="table table-bordered table-striped">
					<?php foreach($value[$val]['sub-phone'] as $v){?>
					<tr><td><?=$v?></td></tr>
					<?php }?></table></td>
					<td><table class="table table-bordered table-striped">
					<?php foreach($value[$val]['sub-email'] as $v){?>
					<tr><td><?=$v?></td></tr>
					<?php }?></table></td>
					
				  </tr>
				  <?php }?>
				  </table>
					</td>
					
					<td><?=$value['progress']?></td>
					<td><?=$value['plan_num']?></td>
					<td><?=$value['real_num']?></td>
					<td><?=$value['crcname']?></td>
					<td><?=$value['crc_company']?></td>
					<td><?=$value['crc_pm']?></td>
					<td><?=$value['crc_pm_phone']?></td>
					<td><?=$value['cra_name']?></td>
					<td><?=$value['cra_phone']?></td>

					
                  </tr>
                <?php
                }
                ?>              
                </tbody>
              </table>
            </form>
            </div>

            <div class="row">
             
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
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


<!-- Select2 -->
<script src="<?=$cdn?>/style/plugins/select2/select2.full.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?=$cdn?>/style/plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="<?=$cdn?>/style/plugins/fastclick/fastclick.js"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

	<script>
$(function () {
	$("#down").click(function() {
		$("#excle").val(1);
		$("#form").submit();
	
	});


});
   


</script>  

</body>
</html>
