
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
  <title><?=$this->config->item('web_title')?> | CRC相关信息列表</title>
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
        <small>CRC相关信息列表</small>
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
              <form method='post' action=''>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <td colspan=5><input type="text" name='search' value='<?=$search?>' class="form-control" placeholder="搜索 用户姓名/登录账号/手机号/邮箱"></td>
						<td><select id='province_id' name='province_id' class="form-control select2" style="width: 100%;" onchange="changeData()">
						  <option value='0'>省</option>
						  <?php
							foreach($province as $key=> $value){
							  $opt = '';
							  if($province_id == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>

						<td ><select id='city_id' name='city_id' class="form-control select2" style="width: 100%;">
						  <option value='0'>市</option>
						  <?php
							foreach($city as $key=> $value){
							  $opt = '';
							  if($city_id == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>

						<td ><select id='area_id' name='area_id' class="form-control select2" style="width: 100%;" onchange="changeDatas()">
						  <option value='0'>区域</option>
						  <?php
							foreach($area as $key=> $value){
							  $opt = '';
							  if($area_id == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>

						<td ><select id='group_id' name='group_id' class="form-control select2" style="width: 100%;">
						  <option value='0'>组别</option>
						  <?php
							foreach($group as $key=> $value){
							  $opt = '';
							  if($group_id == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>




						<td><select id='roleid' name='roleid' class="form-control select2" style="width: 100%;">
						  <option value='0'>选择角色</option>
						  <?php
							foreach($rlist as $value){
							  $opt = '';
							  if($roleid == $value['id']){
								  $opt = 'selected';
							  }

							  if($value['rolename']=='患者'){
								
								}else{


						  ?>
						  <option <?=$opt?> value='<?=$value['id']?>'><?=$value['rolename']?></option>
						  <?php
							}
							}
						  ?>
						</select></td>

						 <td><select id='company_id' name='company_id' class="form-control select2" style="width: 100%;">
						  <option value='0'>所属公司</option>
						  <?php
							foreach($company as $key=> $value){
							  $opt = '';
							  if($company_id == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>

						 <td><select id='sex_id' name='sex_id' class="form-control select2" style="width: 100%;">
						  <option value='0'>性别</option>
						  <?php
							foreach($sex as $key=> $value){
							  $opt = '';
							  if($sex_id == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>





                  <td><button type="submit" class="btn btn-default btn-flat">搜索</button></td> 
                </tr>                
                <tr>
                  <th>用户ID</th>
                  <th>姓名</th>
                 <!-- <th>登录账号</th>-->
				  <th>性别</th>
				  <th>出生年月</th>
				  <th>所属公司</th>
				  <th>省</th>
				  <th>市</th>
				  <th>区域</th>
				  <th>组别</th>
				  <th>工作年限</th>
				  <th>主管患者数量</th>
                  <th>登录状态</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($crclist as $value){
                    //print_r($value);
                  ?>
                  <tr>
                    <td><?=$value['uid']?></td>
                    <td><?=$value['uname']?></td>
                   <!-- <td><?=$value['account']?></td>	-->
					<td><?=$sex[$value['sex']]?></td>	
					<td><?=$value['birthday']?></td>	
					<td><?=$company[$value['company_id']]?></td>	
					<td><?=$province[$value['province_id']]?></td>	
					<td><?=$city[$value['city_id']]?></td>	
					<td><?=$area[$value['area_id']]?></td>	
					<td><?=$group[$value['group_id']]?></td>	
					<td><?=$value['work_year']?></td>	
					<td><?=$value['sufferer_num']?></td>	
                    <td>
                      <?php if($value['state']==1){?>
                      <span class="label label-default">限制</span>
                      <?php }else{?>
                      <span class="label label-success">正常</span>
                      <?php }?>
                    </td>
                    <td>
					<a class='btn btn-info btn-sm' href='/index.php/admin/crc_manage/crc_fedit?uid=<?=$value["uid"]?>' >修改</a>

					<a class='btn btn-success btn-sm' href='/index.php/admin/crc_manage/crc_finfo?uid=<?=$value["uid"]?>' >查看详情</a>                    
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
});
   function changeData(){  
	   $("#city_id").find("option").remove();
        // 获取城市下拉框选中的值  
        var v = $("#province_id").val();  
        if( v == null){  
            // 下拉框禁用  
            $("#city_id").prop("disabled", true);  
        }else{  
            // 城市选择后下拉框启用  
            $("#city_id").prop("disabled", false);  
      
            // 省市联动部门下拉框  
            var url = "/index.php/admin/crc_manage/get_city?province_id=" + v;  
            var city_id = $("#city_id");  
            // 向后台请求获取数据  
            $.getJSON(url,function (data) {  
                if (data == "") {  
                    swal('该省份下无城市，请先添加城市!');  
                }  
                else {  					
                   // 遍历省下的城市给下拉框赋值  
                    $.each(data,function(i,value){ 					
                        var tempOption = document.createElement("option");  
                        tempOption.value = i;  
                        tempOption.innerHTML  = value;  
                        city_id.append(tempOption);  
                    });  
                }  
            });  
        }  
    }  


	 function changeDatas(){  
	   $("#group_id").find("option").remove();
        // 获取城市下拉框选中的值  
        var v = $("#area_id").val();  
        if( v == null){  
            // 下拉框禁用  
            $("#group_id").prop("disabled", true);  
        }else{  
            // 城市选择后下拉框启用  
            $("#group_id").prop("disabled", false);  
      
            // 省市联动部门下拉框  
            var url = "/index.php/admin/crc_manage/get_group?area_id=" + v;  
            var group_id = $("#group_id");  
            // 向后台请求获取数据  
            $.getJSON(url,function (data) {  
                if (data == "") {  
                    swal('该区域下无组别，请先添加组别!');  
                }  
                else {  					
                   // 遍历省下的城市给下拉框赋值  
                    $.each(data,function(j,valuej){ 					
                        var tempOption = document.createElement("option");  
                        tempOption.value = j;  
                        tempOption.innerHTML  = valuej;  
                        group_id.append(tempOption);  
                    });  
                }  
            });  
        }  
    }  




</script>  
</body>
</html>
