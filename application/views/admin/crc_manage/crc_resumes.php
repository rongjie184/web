
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
  <title><?=$this->config->item('web_title')?> | CRC简历列表</title>
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
        CRC简历管理
        <small>CRC简历列表</small>
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
                <td colspan=3><input type="text" name='search' value='<?=$search?>' class="form-control" placeholder="搜索 用户姓名/登录账号/手机号/邮箱"></td>
					<td><input type="text" name='work_year' value='<?=$work_year?>' class="form-control" placeholder="搜索 工作年限"></td>
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
				<td>
				  <a class='btn btn-primary btn-sm' href='/index.php/admin/crc_manage/crc_resumes_upload'>批量上传简历</a>
				</td>
                </tr> 
				

				<tr><td colspan=6> <a class='btn btn-danger btn-sm' href='javascript:download();' >下载简历到本地</a>  <a class='btn btn-warning btn-sm' href='javascript:baomi();' >保密</a>   <a class='btn btn-success btn-sm' href='javascript:gongkai();' >公开</a>     </td></tr>

                <tr>
				 <th><input type="checkbox" id="all"/>全选</th>
                  <th>用户ID</th>
                  <th>姓名</th>
				  <th>性别</th>
				  <th>电话</th>
				  <th>邮箱</th>
				  <th>所属公司</th>
				  <th>工作年限</th>
                  <th>简历状态</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($resumeslist as $value){
                    //print_r($value);
                  ?>
                  <tr>
				   <td><input type="checkbox" value="<?=$value['uid']?>" name="ids[]"></td>
                    <td><?=$value['uid']?></td>
                    <td><?=$value['uname']?></td>            
					<td><?=$sex[$value['sex']]?></td>
					 <td><?=$value['phone']?></td>  
					 <td><?=$value['email']?></td> 

					<td><?=$company[$value['company_id']]?></td>	
					<td><?=$value['work_year']?></td>	
                    <td>
                      <?php if($value['resumes_status']==1){?>
                      <span class="label label-success">公开</span>
                      <?php }else{?>
                      <span class="label label-default">保密</span>
                      <?php }?>
                    </td>
                    <td>
					
					<a class='btn btn-info btn-sm' href='/index.php/admin/crc_manage/crc_redit?uid=<?=$value["uid"]?>' >修改</a>

					<a class='btn btn-success btn-sm' href='/index.php/admin/crc_manage/crc_rinfo?uid=<?=$value["uid"]?>' >查看详情</a>  
					
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

function baomi(){
	morecheck();
	if(confirm("确定要全部保密吗？")){
		document.dbform.action="/index.php/admin/crc_manage/crc_resumes_bm";
		dbform.submit();
	}

}

function gongkai(){
	morecheck();
	if(confirm("确定要全部公开吗？")){
		document.dbform.action="/index.php/admin/crc_manage/crc_resumes_gk";
		dbform.submit();
	}

}


function download(){
	var temp = "";
	var a = document.getElementsByName("ids[]");
	for ( var i = 0; i < a.length; i++) {
		if (a[i].checked) {
			temp = a[i].value;
			window.open("/index.php/admin/crc_manage/download?md="+temp);	
		}
	}

}


</script>     


</body>
</html>
