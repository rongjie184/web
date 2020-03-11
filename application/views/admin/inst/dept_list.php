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
  <title><?=$this->config->item('web_title')?> | 机构列表</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">
  <!-- select2 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/plugins/select2/select2.min.css">

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
        <small>机构列表</small>
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
              <form method='post' action='' id="form">
              <input type="hidden" name="orderby" id="orderby" value="<?=$orderby?>">
              <input type="hidden" name="excle" id="excle" >
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <td colspan=1><input type="text" name='search' value='<?=$search?>' class="form-control" placeholder="按科室名 搜索"></td>
                <td colspan=1>
                    <select id='instid' name='instid' class="form-control select2" style="width: 100%;">
                                <option value=''>选择机构</option>
                              
                                <?php
                                foreach($inst as $value){
                                  $opt = '';
                                  if($typeid == $value['id']){
                                    $opt = 'selected';
                                  }
                                ?>
                                <option <?=$opt?> value="<?=$value['id']?>"><?=$value['instname']?> </option>
                                <?php
                                }
                                ?>
                      </select>
                </td>
                <td colspan=1><input type="text" name='type' value='<?=$type?>' class="form-control" placeholder="按类别搜索"></td>
                <td><button type="submit" class="btn btn-default btn-flat" id="find">搜索</button></td>
             
                <!-- <td><a class='btn btn-success btn-sm' href='/index.php/admin/institution/dept_list?download=1&where=<?=$where?>' style="float:right" >导出列表</a></td> -->
                <td><button type="button" class="btn btn-default btn-flat" id="desc">倒序 <button type="button" class="btn btn-default btn-flat" id="asc">正序</td>
                <td><button type="button" class="btn btn-success btn-flat" id="down" style="float:right">下载</td>
                </tr>                
                <tr>
                  <th>科室名称</th>
				          <th>所属机构</th>
                  <th>地址</th>
                  <th>治疗范围</th>
                  <th>状态</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($deptlist as $value){
                    
                  ?>
                  <tr>
                    <td><?=$value['name']?></td>
					          <td><?=$value['instname']?></td>
                    <td><?=$value['address'] ?></td>
                    <td><?=$value['purview']?></td>
                    <td>
                      <?php if($value['status']==1){?>
                      <span class="label label-default">正常</span>
                      <?php }else if($value['status']==2){?>
                      <span class="label label-success">限制</span>
                      <?php }?>
                    </td>
                    <td>
            
            <a class='btn btn-success btn-sm' href='/index.php/admin/institution/detail_dept?id=<?=$value["id"]?>' >查看</a> 
					 <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_dept?id=<?=$value["id"]?>' >修改</a>
           
                      <?php 
                      if($value['role_id']!=2){
                      if($value['status']==2){?>
                      <a class='btn btn-warning btn-sm' href='/index.php/admin/institution/change_dept_status?state=1&id=<?=$value["id"]?>' >解除</a>
                      <?php }else{ ?>
                       <a class='btn btn-danger btn-sm' href='/index.php/admin/institution/change_dept_status?state=2&id=<?=$value["id"]?>' >限制</a>
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




<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script type="text/javascript">



 $(function () {

  $(".select2").select2();

  // $(".datepicker").datepicker({
  //   autoclose: true,
  //   todayHighlight: true,
  //   language:"zh-CN", //--语言设置
  //   format:"yyyy-mm-dd"  //--日期显示格式
  // });
 
   $("#desc").click(function() {
    $("#orderby").val('desc');
    $("#form").submit();
  
  });

  $("#asc").click(function() {
    $("#orderby").val('asc');
    $("#form").submit();
  
  });

  $("#down").click(function() {
    $("#excle").val(1);
    $("#form").submit();
  
  });

  $("#find").click(function() {
    $("#excle").val(0);
  
  });
 });

 

</script>
</body>
</html>
