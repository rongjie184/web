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
  <title><?=$this->config->item('web_title')?> | 项目详情</title>
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
        项目管理
        <small>查看项目</small>
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
              <h3 class="box-title">项目信息：</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">项目名称</label>
                  <div class="col-sm-4">
                    <p class="form-control-static"><?=$info['name']?></p>
                  </div>
                 
                </div>

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">项目简称</label>
                  <div class="col-sm-2">
                    <p class="form-control-static"><?=$info['shortname']?></p>
                  </div>
               
                  <label for="c" class="col-sm-2 control-label">项目启动时间</label>
                  <div class="col-sm-2">
                    <p class="form-control-static"><?=$info['start_time']?></p>
                  </div>
                </div>


                 <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">项目归属</label>
                  <div class="col-sm-2">
                       <p class="form-control-static"> <?php if($info['is_linkstart']==1){echo '联斯达';}else{echo '其它SMO公司';}?>
                   </p>
                   
                  </div>
               
                  <label for="appid" class="col-sm-2 control-label">项目编号</label>
                  <div class="col-sm-2">
                  <p class="form-control-static"><?=$info['item_number'].$info['exte_number']?></p>
                  </div>
                </div>   
				 <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">申办方</label>
                  <div class="col-sm-10">
                  公司：<?=$sponsor[$info['sponsor_company']]['sname']?>-
				  PM：<?=$sponsor[$info['sponsor_company']]['pm']?>-
				  PM电话：<?=$sponsor[$info['sponsor_company']]['pm_phone']?>
                  
                  </div>
                  
                </div> 
				
				 <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">CRO公司</label>
                  <div class="col-sm-4">
						  <?php
							$cros=unserialize($info['cro_company']);
							foreach($cros as $key =>$val){
								echo '公司：'.$cro[$val]['crname'].'-PM:'.$cro[$val]['pm'].'-PM电话：'.$cro[$val]['pm_phone'].'<br>';
							}
						  ?>
						 
                  
                  </div> 
                </div>   


				 <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">SMO公司</label>
                  <div class="col-sm-4">
                  
                  <?php
							$smos=unserialize($info['smo_company']);
							foreach($smos as $key =>$val){
								echo '公司：'.$cro[$val]['cname'].'-PM:'.$cro[$val]['pm'].'-PM电话：'.$cro[$val]['pm_phone'].'<br>';
							}
						  ?>
                  </div>
                  
                </div> 
				
				 <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">项目合作中心数量</label>
                  <div class="col-sm-2">
					<p class="form-control-static"><button class="btn btn-info" type="button" onclick="info_box(<?=$info['id']?>,'ckinis')">
						<?=$info['inis_num']?>：查看					
					  </button></p>
				  </div>		
                  <label for="appid" class="col-sm-2 control-label">牵头机构</label>
                  <div class="col-sm-2">
                   
                   <p class="form-control-static"><?=$inis[$info['leader_inis']]?></p>
                  </div>
                  
                </div>  
				
				<div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">试验类型</label>
                  <div class="col-sm-2">
                   <p class="form-control-static"><?=$test[$info['test_id']]?></p>
                  
                  </div>
 
                  <label for="appid" class="col-sm-2 control-label">药品分期</label>
                  <div class="col-sm-2">
                  
                   <p class="form-control-static"><?=$drug[$info['drug_id']]?></p>
                  </div>
                  
                </div> 


				<div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">试验分类</label>
                  <div class="col-sm-2">
                  
                   <p class="form-control-static"><?=$drugtype[$info['dtype_id']]?></p>
                  </div>
                  
               
                  <label for="appid" class="col-sm-2 control-label">药品分类</label>
                  <div class="col-sm-2">
                  
                   <p class="form-control-static"><?=$classify[$info['classify_id']]?></p>
                  </div>
                  
                </div>  

				


<!--
				 <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">研究方法</label>
                  <div class="col-sm-2">
                  <p class="form-control-static"><?=$methods[$info['methods_id']]?></p>
                  </div>

				  <label for="name" class="col-sm-2 control-label">项目进度</label>
                  <div class="col-sm-2">
                  <p class="form-control-static"><?=$progress[$info['progress_id']]?></p>
                  </div>


                </div>


-->


				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">适应症</label>
                  <div class="col-sm-2">
                   <p class="form-control-static"><?=$info['indications']?></p>
                  </div>
                </div>

				<div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">所属领域</label>
                  <div class="col-sm-2">
                  <p class="form-control-static"><?=$field[$info['field_id']]?></p>
                  
                  </div>

                  <label for="appid" class="col-sm-2 control-label">科室</label>
                  <div class="col-sm-2">
                  
                  <p class="form-control-static"><?=$dept[$info['leader_dept']]?></p>
				  <p class="form-control-static">pi<?php foreach($pi as $val){echo '姓名：'.$val['name'].'电话：'.$val['phone'].'邮箱：'.$val['email'].'<br>';}?></p>

				  <p class="form-control-static">sub-i<?php foreach($sub as $val){echo '姓名：'.$val['name'].'电话：'.$val['phone'].'邮箱：'.$val['email'].'<br>';}?></p>


                  </div>
                  
                </div>  

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">计划入组人数</label>
                  <div class="col-sm-2">
                    <p class="form-control-static"><?=$info['plan_num']?></p>
                  </div>
                
                  <label for="c" class="col-sm-2 control-label">实际入组人数</label>
                  <div class="col-sm-2">
                    <p class="form-control-static"><?=$info['real_num']?></p>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">首次入住时间</label>
                  <div class="col-sm-2">
                    <p class="form-control-static"><?=date('Y-m-d H:i:s',$info['first_time'])?></p>
                  </div>
                
                  <label for="c" class="col-sm-2 control-label">首次入组机构</label>
                  <div class="col-sm-2">
                    <p class="form-control-static"><?=$inis[$info['first_inis']]?></p>
                  </div>
                </div>



             </div> 

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
				 
                    <button type="button" class="btn btn-info" onclick="javascript:history.back(-1)">返回</button>
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
  <script 
type='text/javascript'>


 function info_box(id,view){
	  window.location.href="/index.php/admin/item_manage/get_ck_list?id="+id+"&view="+view;
	
}
</script>      
</body>
</html>


