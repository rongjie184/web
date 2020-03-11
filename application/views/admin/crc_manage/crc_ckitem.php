
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
  <title><?=$this->config->item('web_title')?> | CRC参与项目列表</title>
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
        CRC相关信息管理
        <small>CRC参与项目列表</small>
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
              <form method='post' action=''  id="form" name="dbform">
			   <input type="hidden" name="excle" id="excle" >
				<input type="hidden" name="uid" id="uid" value="<?=$uid?>">
				<input type="hidden" name="table" id="table" value="<?=$table?>">
				<input type="hidden" name="type" id="type" value="<?=$type?>">
				<input type="hidden" name="view" id="view" value="<?=$view?>">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <td colspan=2><input type="text" name='itemname' value='<?=$itemname?>' class="form-control" placeholder="搜索 项目名称"></td>

				 <td><select id='smo_company' name='smo_company' class="form-control select2" style="width: 100%;">
						  <option value='0'>SMO公司</option>
						  <?php
							foreach($smolist as $value){
							  $opt = '';
							  if($smo_company == $value['id']){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$value['id']?>'><?=$value['cname']?></option>
						  <?php
							
							}
						  ?>
						</select></td>
                  <td><button type="submit" class="btn btn-default btn-flat">搜索</button></td>
                 <td><button type="button" class="btn btn-info btn-flat" id="down">下载</td>
                </tr>                
                <tr>
                  <th>项目名称</th>
                  <th>项目编号</th>
				  <th>外司编号</th>
				  <th>申办方</th>
				  <th>SMO公司</th>
				  <th>机构名称</th>
				  <th>项目接手时间</th>
				  <th>项目交出时间</th>
				  <th>项目进度</th>
				  <th>计划入组人数</th>
				  <th>实际入组人数</th>
				  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($list as $key=> $value){
                    //print_r($value);
                  ?>
                  <tr>
                    <td><?=$value['name']?></td>
                    <td><?=$value['item_number']?></td>
					<td><?=$value['exte_number']?></td>
                    <td><?=$sponsor[$value['sponsor_company']]?></td>		
					<td><?php $smos=unserialize($value['smo_company']);
					foreach($smos as $val){echo $smo[$val].'<br>';}?></td>
					<td><?=$inst[$value['inis_id']]?></td>
					<td><?=date('Y-m-d H:i:s',$value['enter_time'])?></td>
					<td><?=date('Y-m-d H:i:s',$value['out_time'])?></td>
                    <td><?=$progress[$value['progress_id']]?></td>
					<td><?=$value['plan_num']?></td>
					<td><?=$value['real_num']?></td>
					<td><a class="btn btn-info btn-block" href="/index.php/admin/item_manage/item_info?id=<?=$value['id']?>" role="button">查看项目详情</a></td>
                  </tr>
                <?php
                }
                ?>              
                </tbody>
              </table>
            </form>
            </div>

            <div class="row">
              <?=$page?>
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
	 
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
	$("#down").click(function() {
		$("#excle").val(1);
		$("#form").submit();
	
	});
	  });



</script> 
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
