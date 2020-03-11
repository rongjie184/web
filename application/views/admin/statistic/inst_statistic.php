
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
  <title><?=$this->config->item('web_title')?> | CRC统计</title>
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

   <link rel="stylesheet" href="<?=$cdn?>/style/plugins/daterangepicker/daterangepicker.css">
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
        统计管理
        <small>CRC统计</small>
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
		
			  <input type="hidden" name="orderby" id="orderby" value="<?=$orderby?>">
			   <input type="hidden" name="excle" id="excle" >
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

				  <td columns=2>
                    <select class="form-control select2" id="area_id" name='area_id'  style="width: 100%;">
					 <option value='0'>地域</option>
					   <?php foreach($area as $key=> $val){?>
                         <option <?=$type==$val['id']?'selected':''?> value=<?=$val['id']?>><?=$val['name']?></option>
                       <?php }?>
                    </select>
                  </td>
					<td colspan=2><input type="text" name='search' value='<?=$search?>' class="form-control" placeholder="搜索 科室名称"></td>

			
                  <td><button type="submit" class="btn btn-default btn-flat" id="find">搜索</button></td> 
                  <td></td><td></td>
                  <td><button type="button" class="btn btn-default btn-flat" id="desc">倒序 <button type="button" class="btn btn-default btn-flat" id="asc">正序</td>
				          <td>
                      <button type="button" class="btn btn-info btn-flat" id="downDesc" style="float: right">下载详情
                      <button type="button" class="btn btn-info btn-flat" id="down" style="float: right">下载
                  </td>
                  
                </tr>

                <tr>
                  <th>中心名称</th>
				  <th>简称</th>
                  <th>获得资质时间</th>
                  <th>是否部队系统</th>
                  <th>省份</th>
                  <th>区域</th>
                  <th>状态</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($inst as $value){
                    //print_r($value);
                  ?>
                  <tr>
                    <td><?=$value['instname']?></td>
					<td><?=$value['shortname']?></td>
                    <td><?=date('Y-m-d',$value['qualify_time']) ?></td>
                    <td><?=$value['troop_system']?'是':'否'?></td>
                    <td><?=$value['pname']?></td>
                    <td><?=$value['aname']?></td>

                    <td>
                      <?php if($value['status']==1){?>
                      <span class="label label-default">正常</span>
                      <?php }else if($value['status']==0){?>
                      <span class="label label-success">限制</span>
                      <?php }?>
                    </td>
                    <td>
             
            <a class='btn btn-success btn-sm' href='/index.php/admin/institution/detail_institution?id=<?=$value["id"]?>' >查看</a>
                      
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
<!-- date-range-picker -->
<script src="<?=$cdn?>/style/libs/moment.min.js"></script>
<script src="<?=$cdn?>/style/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

	 
<script>
$(function () {
	 $('#daterange-btn span').html('<?=$date?>');
    //Initialize Select2 Elements
    $(".select2").select2();

	 $('#daterange-btn').daterangepicker(
        {
          ranges: {
            '今日': [moment(), moment()],
            '昨日': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '最近7天': [moment().subtract(6, 'days'), moment()],
            '最近30天': [moment().subtract(29, 'days'), moment()],
            '本周': [moment().startOf('isoWeek'), moment().endOf('isoWeek')],
            '上周': [moment().subtract(1, 'week').startOf('isoWeek'), moment().subtract(1, 'week').endOf('isoWeek')],
            '本月': [moment().startOf('month'), moment().endOf('month')],
            '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'近3个月': [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
			'去年': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
			'今年': [moment().startOf('year'), moment().endOf('year')]
          },
          startDate:moment('<?=$start_date?>'),
          endDate: moment('<?=$end_date?>')
        },
        function (start, end) {
          _html = start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD')
          $('#daterange-btn span').html(_html);
          $('#select2_date').val(_html)
        }
    );



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

	$("#find").click(function(){
		$("#excle").val(0);
	});

  $("#downDesc").click(function(){
    $("#excle").val(2);
    $("#form").submit();
  
  })
  $(function(){
    $("#excle").val(0);
  })

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

  
</body>
</html>
