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
  <title><?=$this->config->item('web_title')?> | 新增字段列表</title>
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
        <small>字段列表</small>
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
              <form method='post' action='' name='dbform'>
                <input type="hidden" id="tempString" name="tempString" />
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <td colspan=2><input type="text" name='search' value='<?=$search?>' class="form-control" placeholder="搜索 字段名称"></td>
                <td><button type="submit" class="btn btn-default btn-flat">搜索</button></td>
                <td></td>
                </tr>                
                <tr>
                  <th>表名</th>
				          <th>字段名</th>
                  <th>操作人员</th>
                  <th>新增时间</th>
                  <th>状态</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($columns as $value){
                    //print_r($value);
                  ?>
                  <tr>
                    <td><?=$value['table']?></td>
					          <td><?=$value['cname']?></td>
                    <td><?=$value['username']?></td>
                    <td><?=$value['add_time']?date('Y-m-d',$value['add_time']):'' ?></td>
                    <td>
                      <?php if($value['status']==1){?>
                      <span class="label label-default">正常</span>
                      <?php }else if($value['status']==2){?>
                      <span class="label label-success">限制</span>
                      <?php }?>
                    </td>
                    <td>
            
					 <a class='btn btn-info btn-sm' href='/index.php/admin/institution/edit_columns?id=<?=$value["id"]?>' >修改</a>
                      <?php 
                      if($value['role_id']!=2){
                      if($value['status']==1){?>
                        <a class='btn btn-danger btn-sm' href='/index.php/admin/institution/change_columns_status?state=2&id=<?=$value["id"]?>' >删除</a> 
                      <?php }else{ ?>
                        <a class='btn btn-warning btn-sm' href='/index.php/admin/institution/change_columns_status?state=1&id=<?=$value["id"]?>' >恢复</a> 
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

<script type="text/javascript">
$(function () {
 $("#all").click(function(){
    　　// 使用attr只能执行一次
    　　$("input[name='ids[]']").attr("checked", $(this).attr("checked")); 
    
    　　// 使用prop则完美实现全选和反选
    　　$("input[name='ids[]']").prop("checked", $(this).prop("checked"));

　　　　// 获取所有选中的项并把选中项的文本组成一个字符串
    　　var str = '';
    　　$($("input[name='ids[]']:checked")).each(function(){
        　　str += $(this).next().text() + ',';
    　　});
　　});

  });

  function morecheck() {
  var bb = "";
  var temp = "";
  var a = document.getElementsByName("ids[]");
  for ( var i = 0; i < a.length; i++) {
    if (a[i].checked) {
      temp = a[i].value;
      bb = bb + "," +temp;
    }
  }
  document.getElementById("tempString").value = bb .substring(1, bb.length); //赋值给隐藏域
  }

  function del(url){
  // morecheck();
  if(confirm("确定要删除吗？")){
    // document.dbform.action="/index.php/admin/news/del";
    // dbform.submit();
    window.location= url;
  }

}
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
