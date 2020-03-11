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
  <title><?=$this->config->item('web_title')?> | 患者方案</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="<?=$cdn?>/style/plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/skins/skin-blue.min.css">

  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/formValidation.css">
  <!--添加时间控件 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/plugins/datepicker/datepicker3.css">
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
        患者管理
        <small>配置个性方案</small>
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
           
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">项目全称</label>
                  <div class="col-sm-4">
                    <span type="text" class="form-control" id="scheme" name='scheme'></span>
                  </div>
                 
                </div>

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">项目简称</label>
                  <div class="col-sm-3">
                    <span type="text" class="form-control" id="shortname" name='shortname'></span>
                  </div>
               
                  <label for="appid" class="col-sm-2 control-label">项目编号</label>
                  <div class="col-sm-3">
                   <span type="text" class="form-control" id="item_number"  name='item_number'></span>
                  </div>

                </div>   
				
                <div class="form-group ">
				  <label class="col-sm-8 control-label">
				  <button type="button" class="btn btn-info" id="jichu">基础模块</button>
				  <button type="button" class="btn btn-info" id="shaixuan">筛选模块</button>
				  <button type="button" class="btn btn-info" id="ganyu">干预模块</button>
				  <button type="button" class="btn btn-info" id="shoushu">手术模块</button>
				  <button type="button" class="btn btn-info" id="suifang">随访模块</button>
                  </label>
				</div>
             </div> 

			   <div class="box-body" id="mokuai">
		
			   </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-info">提交</button>
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
<?php $this->load->helper('url'); ?>
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
<script src="<?=$cdn?>/style/plugins/datepicker/bootstrap-datepicker.js"></script> 
<script src="<?=$cdn?>/style/plugins/datepicker/bootstrap-datepicker.zh-CN.js"></script> 
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script type="text/javascript">

$(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
    language:"zh-CN", //--语言设置
    format:"yyyy-mm-dd"  //--日期显示格式
});



 function changeid(){
	var v = $("#items_id").val(); 
	var url = "/index.php/admin/item_program/get_info?items_id=" + v;
            // 向后台请求获取数据  
            $.getJSON(url,function (data) {  
                if (data == "") {  
                    swal('暂无该项目信息');  
                }  
                else {
					$("#shortname").val(data['shortname']);
					$("#item_number").val(data['item_number']+data['exte_number']);
                }  
            });  
          


 }


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
            notEmpty: {message: '项目名称不可为空'},
            remote:{
              url: '/index.php/admin/item_manage/item_name_check',
              type: 'POST',  
              delay:800,
              message:'项目名称不合法或已使用,请更换'                    
            }
          }                 
        },
		'inis_id[]':{
          validators:{
             notEmpty: {message: '合作中心不可为空'},
			 remote:{
              url: '/index.php/admin/item_manage/inis_check',
              type: 'post',  
              delay:800,
			  data:{
                    inis_num:function(){return $('#inis_num').val()},
				    inis_id:function(){return $('#inis_id').val()}
				
               },
              message:'合作中心数量不匹配'                    
            }
          }
        },
		inis_num:{
          validators:{
             notEmpty: {message: '合作中心不可为空'},
			 remote:{
              url: '/index.php/admin/item_manage/inisn_check',
              type: 'post',  
              delay:800,
			  data:{
                    inis_num:function(){return $('#inis_num').val()},
				    inis_id:function(){return $('#inis_id').val()}
				
               },
              message:'合作中心数量不匹配'                    
            }
          }
        }

      }
   })
     
</script>        
</body>
</html>


