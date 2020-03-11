
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
  <title><?=$this->config->item('web_title')?> | 资讯列表</title>
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
        资讯管理
        <small>资讯列表</small>
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
				<td colspan=2>

				<a class="btn btn-white" style="width: 70px;" href="#">时间</a>
                       <input type="hidden" name="date" id='select2_date' value="<?=$date?>">
                       <button type="button" class="btn btn-default pull-left"  id="daterange-btn" >
                        <span>
                          <i class="fa fa-calendar"></i> 选择时间
                        </span>
                        <i class="fa fa-caret-down"></i>
                      </button>

				</td>
                <td colspan=2><input type="text" name='search' value='<?=$search?>' class="form-control" placeholder="搜索 资讯标题/作者姓名 "></td>
				 <td><select id='typeid' name='typeid' class="form-control select2" style="width: 100%;">
						  <option value='0'>选择类别</option>
						  <?php
							foreach($typelist as $value){
							  $opt = '';
							  if($typeid == $value['id']){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$value['id']?>'><?=$value['name']?></option>
						  <?php
							}
						  ?>
						</select></td>
						 <td><select id='status' name='status' class="form-control select2" style="width: 100%;">
						  <option value='0'>选择状态</option>
						   <option value='-1' <?php if($status=='-1'){echo 'selected';}?>>待审核</option>
						    <option value='1' <?php if($status=='1'){echo 'selected';}?>>正常</option>
							 <option value='2' <?php if($status=='2'){echo 'selected';}?>>已下架</option>
						</select></td>
                  <td><button type="submit" class="btn btn-default btn-flat">搜索</button></td>
                  <td></td>
                </tr>      
				<tr><td colspan=6>   <a class='btn btn-danger btn-sm' href='javascript:del();' >批量下架</a></td></tr>
                <tr>
				 <th><input type="checkbox" id="all"/>全选</th>
                  <th>文章id</th>
                  <th>资讯标题</th>
				  <th>资讯副标题</th>
				  <th>资讯图片</th>
				  <th>作者</th>
				  <th>关注数量</th>
				  <th>点赞数量</th>
				  <th>点击数量</th>
				  <th>状态</th>
                  <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach($list as $value){
                    //print_r($value);
                  ?>
                  <tr>
				  <td><input type="checkbox" value="<?=$value['id']?>" name="ids[]"></td>
                    <td><?=$value['id']?></td>
					<td><?=$value['title']?></td>
                    <td>
                    <?=$value['ftitle']?>
                    </td>
					 <td> <img src="<?=$value['titpic']?>" height="20px;" width="40px;">
                   
                    </td>
					<td><?=$value['author']?></td>
					<td><?=$value['attention_num']?></td>
					<td><?=$value['like_num']?></td>
					<td><?=$value['click_num']?></td>
                    <td>
                      <?php if($value['status']==2){?>
                      <span class="label label-default">已下架</span>
                      <?php }else{?>
                      <span class="label label-success">正常</span>
                      <?php }?>
                    </td>
                    <td>
                      <!--<a class='btn btn-warning btn-sm' href='/index.php/admin/resource/resource_edit?id=<?=$value["id"]?>' >编辑</a>-->
                      <a class='btn btn-primary btn-sm' href='/index.php/admin/news/news_view?id=<?=$value["id"]?>' >查看</a>
                   <?php 
                      if($value['status']==1){?>
                      <a class='btn btn-danger btn-sm' href='/index.php/admin/news/change_status?status=1&id=<?=$value["id"]?>' >下架</a>
                      
                      <a class='btn btn-success btn-sm' href='/index.php/admin/news/news_edit?id=<?=$value["id"]?>' >修改</a>  
                      <?php } ?>
					
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
<!-- Select2 -->
<script src="<?=$cdn?>/style/plugins/select2/select2.full.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?=$cdn?>/style/plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="<?=$cdn?>/style/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=$cdn?>/style/dist/js/app.min.js"></script>

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

function del(){
	morecheck();
	if(confirm("确定要下架吗？")){
		document.dbform.action="/index.php/admin/news/del";
		dbform.submit();
	}

}



</script>     
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
