
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
  <title><?=$this->config->item('web_title')?> | 添加省市区</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?=$cdn?>/style/plugins/select2/select2.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/skins/skin-blue.min.css">

  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/formValidation.css">

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
        省市区管理
        <small>添加省市区</small>
      </h1>

      <!--  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">请填写基本信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">名称</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="name" name='name' placeholder="请输入省市区名称">
                  </div>
                </div>

				<div class="form-group">
                  <label for="name" class="col-sm-2 control-label">简称</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="short_name" name='short_name' placeholder="请输入省市区简称">
                  </div>
                </div>


				 <div class="form-group">
					  <label for="describe" class="col-sm-2 control-label">选择</label>
					  <div class="col-sm-5">
						<select id='table' name='table' class="form-control select2" style="width: 100%;"  onchange="changeData()">
						  <option value='provinces'>省</option>
						  <option value='city'>市</option>
						  <option value='area'>区</option>
				</select>
					
                  </div>
			</div>

			 <div class="form-group" id="provinces" style="display:none;">
                  <label for="order_url" class="col-sm-2 control-label">省：</label>
                  <div class="col-sm-5">

                    <select class="form-control select2" id="parent_id" name='parent_id'>
					
                    </select>
                  </div>
                </div>


                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">排序</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="sort" name='sort' placeholder="请输入排序">
                  </div>
                </div>
        
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-info">添加</button>
                  </div>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>            

          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
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



<!-- Form Validata -->
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/formValidation.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/framework/bootstrap.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/language/zh_CN.js"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

<script type="text/javascript">
$(document).ready(function() {
   $('#iForm').formValidation({
     framework: 'bootstrap',
     // Feedback icons
     icon: {
         valid: 'glyphicon glyphicon-ok',
         invalid: 'glyphicon glyphicon-remove',
         validating: 'glyphicon glyphicon-refresh'
     }, 
     fields: {
        name:{
          validators: {
            notEmpty: {message: '名称不可为空'},
			remote:{
              url: '/index.php/admin/area_manage/name_check',
              type: 'post',  
              delay:800,
				  data:{
                    table:function(){return $('#table').val()},
				    name:function(){return $('#name').val()}
				
               },
              message:'名称不合法或已存在,请更换'                    
            }
          }
        }
      
      }
   })
})     
</script>  

 <script type="text/javascript">

   $(function () { 
    //Initialize Select2 Elements
    $(".select2").select2();
   })



   function changeData(){  
	   $("#parent_id").find("option").remove();
        // 获取table下拉框选中的值  
        var v = $("#table").val();  
        if( v == 'city'){    
           
                
            // 省市联动部门下拉框  
            var url = "/index.php/admin/area_manage/get_province";  
            var parent_id = $("#parent_id");  
            // 向后台请求获取数据  
            $.getJSON(url,function (data) {  
                if (data == "") {  
                    swal('无省份信息，请先添加省份!');  
                }  
                else {  					
                   // 遍历省下的城市给下拉框赋值  
                    $.each(data,function(i,value){ 					
                        var tempOption = document.createElement("option");  
                        tempOption.value = i;  
                        tempOption.innerHTML  = value;  
                        parent_id.append(tempOption);  
                    });  
                }  
            }); 
			 // 省份下拉框启用  
			$("#provinces").show();  
        }else{
			$("#provinces").hide();  
		
		} 
    }  




</script>   


</body>
</html>
