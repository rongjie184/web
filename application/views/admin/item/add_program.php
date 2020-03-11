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
  <title><?=$this->config->item('web_title')?> | 添加方案</title>
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
 <link rel="stylesheet" href="<?=$cdn?>/style/plugins/datetimepicker/bootstrap-datetimepicker.min.css">
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
        <small>添加方案</small>
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
          <div class="box box-primary form-horizontal">
           
            <!-- /.box-header -->
            <!-- form start -->
        
              <div class="box-body">
   <form class="" method="post" action='' id='iForm' name="dbform">
			<input type="hidden" name="itemsid" id="itemsid">
			<input type="hidden" name="itemsid1" id="itemsid1">
			<input type="hidden" name="pro_id" id="pro_id">
			<input type="hidden" name="testid" id="testid">
			<input type="hidden" name="blind_id" id="blind_id">
			<input type="hidden" name="cycle_id" id="cycle_id">
			<input type="hidden" name="cross_id" id="cross_id">
			<input type="hidden" name="order_id" id="order_id">
			<input type="hidden" name="meddletype" id="meddletype">
			<input type="hidden" name="meddleid" id="meddleid">
			<input type="hidden" name="usemethods" id="usemethods">
                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">项目全称</label>
                  <div class="col-sm-8">
                    <select id='items_id' name='items_id' class="form-control select2" onchange="changeid()">
						  <option  value='0'>选择项目</option>
						  <?php
							foreach($list as $key=> $value){
							  $opt = '';
							  if($items_id == $key){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select>
                  </div>
                 
                </div>

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">项目简称</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="shortname" name='shortname'>
                  </div>
               
                  <label for="appid" class="col-sm-2 control-label">项目编号</label>
                  <div class="col-sm-3">
                   <input type="text" class="form-control" id="item_number"  name='item_number'>
                  </div>
                </div>  			
				</form>
                <div class="form-group text-center">
				  <label class="col-sm-8 control-label">
				  <button type="button" class="btn btn-info" id="jichu">基础模块</button>
				<!--  <button type="button" class="btn btn-info" id="shaixuan">筛选模块</button>-->
				  <button type="button" class="btn btn-info" id="ganyu">干预模块</button>
				  <button type="button" class="btn btn-info" id="shoushu">手术模块</button>
				  <button type="button" class="btn btn-info" id="suifang">随访模块</button>
                  </label>
				</div>
             </div> 

			   <div class="box-body" id="mokuai_jc" style="display:none;">
						<?php $this->load->view('admin/item/pro_base.php');?>
			   </div>
			    <div class="box-body" id="mokuai_sx" style="display:none;">						
			   </div>
			    <div class="box-body" id="mokuai_gy" style="display:none;">	
			<?php $this->load->view('admin/item/pro_meddle.php');?>
			   </div>
			    <div class="box-body" id="mokuai_ss" style="display:none;">	
						<?php $this->load->view('admin/item/pro_surgery.php');?>
			   </div>
			    <div class="box-body" id="mokuai_sf" style="display:none;">	
						<?php $this->load->view('admin/item/pro_follow.php');?>
			   </div>
<!---->
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
<script src="<?=$cdn?>/style/plugins/datetimepicker/moment-with-locales.min.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script type="text/javascript">

$(function(){

	 $('#datetimepicker2').datetimepicker({
        format: 'yyyy-mm-dd HH:ii',
		locale: moment.locale('zh-cn')
    });
	$("#jichu").click(function (){	
		$("#mokuai_jc").show();	
		$("#mokuai_gy").hide();	
		$("#mokuai_ss").hide();
		$("#mokuai_sf").hide();
		var testid=$('#testid').val();
		if(testid==1){
			$("#class").show();
			$("#mf").show();
		}else if(testid==2){
			$("#class").hide();
			$("#mf").hide();	
		}
	})
	$("#ganyu").click(function (){	
		$("#mokuai_gy").show();	
		$("#mokuai_jc").hide();	
		$("#mokuai_ss").hide();
		$("#mokuai_sf").hide();
		var testid=$('#testid').val();
		var pro_id=$('#pro_id').val();
		var blind_id=$('#blind_id').val();
		var meddletype=$('#meddletype').val();
		var meddleid=$('#meddleid').val();
		var cycle_id=$('#cycle_id').val();
		var cross_id=$('#cross_id').val();
		var order_id=$('#order_id').val();
		var usemethods=$('#usemethods').val();
		if(testid==1){
			$("#gy_yp").show();
			$("#gy_qx").hide();	
			
		}else if(testid==2){
			$("#gy_yp").hide();
			$("#gy_qx").show();			
		}

		if(pro_id!=null||pro_id!=""){
			if(testid==1){
				if(blind_id==1||blind_id==4){
					$("#yp_fz").show();
					$("#yp_pp").hide();				
				}else{
					$("#yp_fz").hide();
					$("#yp_pp").show();				
				}

				if(cross_id>0){
					$("#yp_tb").show();		
				}else{
					$("#yp_tb").hide();	
				}

				if(meddletype==2){
					if(meddleid==1){
						$("#yp_awj").show();
						$("#yp_cb").hide();
					}else if(meddleid==2){
						$("#yp_cb").show();
						$("#yp_awj").hide();
					}
				}else{
					$("#yp_cb").hide();	
					$("#yp_awj").hide();
				}

				if(usemethods==2){
					$("#yp_qxm").show();	
					$("#yp_qxd").hide();	
				}else{
					$("#yp_qxd").show();	
					$("#yp_qxm").hide();	
				}


			
			}else if(testid==2){
				if(meddletype==2){
					$("#qx_cb").show();		
				}else{
					$("#qx_cb").hide();		
				}	

				if(usemethods==2){
					$("#qx_qxm").show();	
					$("#qx_qxd").hide();	
				}else{
					$("#qx_qxd").show();	
					$("#qx_qxm").hide();	
				}

			}

		
		}
		
	})
	$("#shoushu").click(function (){	
		$("#mokuai_gy").hide();	
		$("#mokuai_jc").hide();	
		$("#mokuai_ss").show();
		$("#mokuai_sf").hide();	
	})

	$("#suifang").click(function (){	
		$("#mokuai_gy").hide();	
		$("#mokuai_jc").hide();	
		$("#mokuai_ss").hide();
		$("#mokuai_sf").show();	
	})
})


function changeid(){

		 var items_id=parseInt($("#items_id").val());
				var url = "/index.php/admin/item_program/get_item_info?items_id=" + items_id;
				$.getJSON(url,function (data) {  
					if (data == "") {  
						swal('无该项目信息!');  
					}  
					else {  						
						$("#shortname").val(data['shortname']);
						$("#item_number").val(data['item_number']+data['exte_number']);
						$("#itemsid").val(items_id);
						$("#testid").val(data['test_id']);
						$("#test_id").html(data['test']);
						$("#drug_id").html(data['drug']);	
						$("#mokuai_jc").show();	
						if(data['test_id']==1){
							$("#fs").html('给药方式');
							$("#ftime").html('首次用药时间');
						}else if(data['test_id']==2){
							$("#fs").html('使用器械方式');
							$("#ftime").html('首次使用时间');	
						}


					}  
				});  
		}
   
</script>        
</body>
</html>


