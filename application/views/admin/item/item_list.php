
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
  <title><?=$this->config->item('web_title')?> | 项目列表</title>
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
        <small>项目列表</small>
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
			    <input type="hidden" id="tempString" name="tempString" />
			  <input type="hidden" name="orderby" id="orderby" value="<?=$orderby?>">
			   <input type="hidden" name="excle" id="excle" >
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <td colspan=2><input type="text" name='search' value='<?=$search?>' class="form-control" placeholder="搜索 项目名称/项目简称/项目编号"></td>
						<td><select id='sponsor_company' name='sponsor_company' class="form-control select2" style="width: 100%;">
						  <option value='0'>申办方公司</option>
						  <?php
							foreach($sponsor as $key=> $value){
							  $opt = '';
							  if($sponsor_company == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>

						<td ><select id='progress_id' name='progress_id' class="form-control select2" style="width: 100%;">
						  <option value='0'>项目进度</option>
						  <?php
							foreach($progress as $key=> $value){
							  $opt = '';
							  if($progress_id == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>

						<td ><select id='inis_num' name='inis_num' class="form-control select2" style="width: 100%;">
						  <option value='0'>合作中心数量</option>
						 
						  <option  value='1' <?php if($inis_num==1){echo 'selected';}?>>1</option>
						  <option  value='2' <?php if($inis_num==2){echo 'selected';}?>>>1</option>
						  
						</select></td>

						<td ><select id='field_id' name='field_id' class="form-control select2" style="width: 100%;">
						  <option value='0'>所属领域</option>
						  <?php
							foreach($field as $key=> $value){
							  $opt = '';
							  if($field_id == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>


						<td ><select id='leader_dept' name='leader_dept' class="form-control select2" style="width: 100%;">
						  <option value='0'>组长科室</option>
						  <?php
							foreach($dept as $key=> $value){
							  $opt = '';
							  if($leader_dept == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>




						<td><select id='drug_id' name='drug_id' class="form-control select2" style="width: 100%;">
						  <option value='0'>试验分期</option>
						  <?php
							foreach($drug as $key=>$value){
							  $opt = '';
							  if($drug_id == $value['id']){
								  $opt = 'selected';
							  }

							 

						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>

						<td><select id='status' name='status' class="form-control select2" style="width: 100%;">
						  <option value='0'>项目状态</option>
						 
						  <option <?php if($status==3){echo 'selected';}?> value='3'>待审核</option>
						  <option <?php if($status==1){echo 'selected';}?> value='1'>正常</option>
						  <option <?php if($status==2){echo 'selected';}?> value='2'>异常关闭</option>
						
							
						 
						</select></td>

						





                  <td><button type="submit" class="btn btn-default btn-flat">搜索</button></td> 
                </tr>
				
				<tr> 
				<td colspan="7"><a class='btn btn-warning btn-sm' href='javascript:pass();' >关闭项目</a></td>
				<td><button type="button" class="btn btn-default btn-flat" id="desc">倒序</td>
				<td><button type="button" class="btn btn-default btn-flat" id="asc">正序</td>
				<td><button type="button" class="btn btn-default btn-flat" id="down">下载</td>
				</tr>
                <tr>
				 <th><input type="checkbox" id="all"/>全选</th>
                  <th>项目简称</th>
                  <th>项目编号</th>
				  <th>立项时间</th>
				  <th>申办方</th>
				  <th>组长科室</th>
				  <th>试验分期</th>
				  <th>合作中心数量</th>
				  <th>项目状态</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($list as $value){
                    //print_r($value);
                  ?>
                  <tr>
				   <td><?php if($value['status']==1){?><input type="checkbox" value="<?=$value['id']?>" name="ids[]"><?php }?></td>
                    <td><?=$value['shortname']?></td>
                    <td><?=$value['item_number'].$value['exte_number']?></td>
					<td><?=$value['start_time']?></td>	
					<td><?=$sponsors[$value['sponsor_company']]['sname']?></td>		
					<td><?=$depts[$value['leader_dept']]?></td>	
					<td><?=$drug[$value['drug_id']]?></td>	
					<td><?=$value['inis_num']?></td>	
					<td><?php if($value['status']==0){?>
                      <span class="label label-default">未审核</span>
                      <?php }elseif($value['status']==1){?>
                      <span class="label label-success">正常</span>
                      <?php }elseif($value['status']==2){?>
					  <span class="label label-warning">异常关闭</span>  
					 <?php }?></td>

                    <td>
					<?php if($value['status']==1||$value['status']==0){?>
					<a class='btn btn-info btn-sm' href='/index.php/admin/item_manage/item_edit?view=list&id=<?=$value["id"]?>' >修改</a>
					<?php }?>
					<a class='btn btn-success btn-sm' href='/index.php/admin/item_manage/item_info?id=<?=$value["id"]?>' >查看详情</a>                    
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
    //Initialize Select2 Elements
    $(".select2").select2();
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


});
   


</script> 

 <script>
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

function pass(){
	morecheck();
	if(confirm("确定要关闭项目吗？")){
		document.dbform.action="/index.php/admin/item_manage/item_check_close";
		dbform.submit();
	}

}



</script>  
</body>
</html>
