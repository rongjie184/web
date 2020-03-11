
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
  <title><?=$this->config->item('web_title')?> | CRC人员管理</title>
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
        CRC人员管理
        <small>crc人员管理</small>
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
				 <input type="hidden" id="check" name="check" value="<?=$check?>" />
				  <input type="hidden" id="uid" name="uid" />
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <td colspan=2><input type="text" name='search' value='<?=$search?>' class="form-control" placeholder="搜索 用户姓名/登录账号/手机号/邮箱"></td>
                  <td colspan=3><button type="submit" class="btn btn-default btn-flat">搜索</button></td>
                 
                </tr> 
				



                <tr>

				<td><select id='items_id' name='items_id' class="form-control select2" style="width: 100%;" onchange="changeDatas()">
						  <option value='0'>选择项目</option>
						  <?php
							foreach($items as $key1=> $value1){
							  $opt = '';
							  if($items_id == $key1){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key1?>'><?=$value1?></option>
						  <?php
							}
							
						  ?>
						</select></td>


				 <td><select id='inits_id' name='inits_id' class="form-control select2" style="width: 100%;">
						  <option value='0'>选择机构</option>
						  <?php
							foreach($inist as $key=>$value){
							  $opt = '';
							  if($inits_id == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select></td>
						<td colspan=3><a class='btn btn-primary btn-sm' href='javascript:void(0);' onclick="return check()">人员管理</a>  </td> 
				

                      
                </tr>
                <tr>
				
                  <th>用户ID</th>
                  <th>姓名</th>
                  <th>登录账号</th>
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
                    <td><?=$value['account']?></td>	
					<td><?php if($check){?> <a class='btn btn-info btn-sm' href='javascript:void(0);' onclick="return out(<?=$value['uid']?>)">退出</a> <?php }else{?>  
						<a class='btn btn-info btn-sm' href='javascript:void(0);' onclick="return out(<?=$value['uid']?>)">退出</a>  <a class='btn btn-success btn-sm' href='javascript:void(0);' onclick="return enter(<?=$value['uid']?>)">加入</a><?php }?></td>	
					
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

	  });

	 function changeDatas(){  
	   $("#inits_id").find("option").remove();
        // 获取城市下拉框选中的值  
        var v = $("#items_id").val();  
        if( v == null){  
            // 下拉框禁用  
            $("#inits_id").prop("disabled", true);  
        }else{  
            // 城市选择后下拉框启用  
            $("#inits_id").prop("disabled", false);  
      
            // 省市联动部门下拉框  
            var url = "/index.php/admin/crc_manage/get_iteminst?items_id=" + v;  
            var inits_id = $("#inits_id");  
            // 向后台请求获取数据  
            $.getJSON(url,function (data) {  
                if (data == "") {  
                    swal('该项目下无中心，请先添加中心!');  
                }  
                else {  					
                   // 遍历省下的城市给下拉框赋值  
                    $.each(data,function(j,valuej){ 					
                        var tempOption = document.createElement("option");  
                        tempOption.value = j;  
                        tempOption.innerHTML  = valuej;  
                        inits_id.append(tempOption);  
                    });  
                }  
            });  
        }  
    }

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

function enter(uid){
	var items=$("#items_id").val();
	var inits=$("#inits_id").val();
	$("#uid").val(uid);
	if(items==0){alert('请选择项目');return false;}
	if(inits==0){alert('请选择中心');return false;}
	if(confirm("确定要加入吗？")){
		document.dbform.action="/index.php/admin/crc_manage/crc_lists_enter";
		dbform.submit();
	}

}

function out(uid){
	var items=$("#items_id").val();
	var inits=$("#inits_id").val();
	$("#uid").val(uid);
	if(items==0){alert('请选择项目');return false;}
	if(inits==0){alert('请选择中心');return false;}
	if(confirm("确定要退出吗？")){
		document.dbform.action="/index.php/admin/crc_manage/crc_lists_out";
		dbform.submit();
	}

}

function check(){
	var items=$("#items_id").val();
	var inits=$("#inits_id").val();
	if(items==0){alert('请选择项目');return false;}
	if(inits==0){alert('请选择中心');return false;}
	document.dbform.action="/index.php/admin/crc_manage/crc_lists_check";
	dbform.submit();
	

}


</script>     



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
