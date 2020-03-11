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
  <title><?=$this->config->item('web_title')?> | 机构负责人员列表</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
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
        机构管理
        <small>机构负责人列表</small>
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
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">主任信息</h3>
            </div>
            <div class="box-body">
              <form method='post' action=''>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                                
                <tr>
                  <th>姓名</th>
                  <th>年龄</th>
                  <th>职位</th>
                  <th>性别</th>
                  <th>办公地址</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($member as $value){
                    //print_r($value);
                  ?>
                  <tr>
                    <td><?=$value['name']?></td>
					          <td><?=$value['inst_name']?></td>
                    <td><?=$value['age'] ?></td>
                    <td><?=$value['position']?></td>
                    <td><?=$value['sex']?></td>
                    <td><?=$value['office_address']?></td>
                    <td><?=$value['in_charge']?></td>
                    <td><?=$value['qualification']?></td>
                    
                    <td>

					 <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_member?id=<?=$value["id"]?>' >修改</a>

                      
                      <a class='btn btn-success btn-sm' href='/index.php/admin/adminaction/change_user_status?state=1&uid=<?=$value["uid"]?>' >删除</a>
                     
                      <a class='btn btn-danger btn-sm' href='/index.php/admin/institution/detail_member?id=<?=$value["id"]?>' >查看</a>  
                      
                    </td>
                  </tr>
                <?php
                }
                ?>              
                </tbody>
              </table>
            </form>
            </div>
            <!--秘书列表-->
            <div class="box-header with-border">
              <h3 class="box-title">秘书信息</h3>
            </div>
            <div class="box-body">
              <form method='post' action=''>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                                
                <tr>
                  <th>姓名</th>
                  <th>年龄</th>
                  <th>职位</th>
                  <th>性别</th>
                  <th>办公地址</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($member as $value){
                    //print_r($value);
                  ?>
                  <tr>
                    <td><?=$value['name']?></td>
                    <td><?=$value['inst_name']?></td>
                    <td><?=$value['age'] ?></td>
                    <td><?=$value['position']?></td>
                    <td><?=$value['sex']?></td>
                    <td><?=$value['office_address']?></td>
                    <td><?=$value['in_charge']?></td>
                    <td><?=$value['qualification']?></td>
                    
                    <td>

           <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_member?id=<?=$value["id"]?>' >修改</a>

                      <?php 
                      if($value['role_id']!=2){
                      if($value['state']==1){?>
                      <a class='btn btn-success btn-sm' href='/index.php/admin/adminaction/change_user_status?state=1&uid=<?=$value["uid"]?>' >删除</a>
                      <?php }else{ ?>
                      <a class='btn btn-danger btn-sm' href='/index.php/admin/institution/detail_member?id=<?=$value["id"]?>' >查看</a>  
                      <?php } }?>
                    </td>
                  </tr>
                <?php
                }
                ?>              
                </tbody>
              </table>
            </form>
            </div>

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



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
