<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit" />
  <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
  <title><?=$this->config->item('web_title')?> | CRC简历详情</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=$cdn?>/style/ionicons-2.0.1/css/ionicons.min.css">
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
        CRC简历管理
        <small>CRC简历详情</small>
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
              <h3 class="box-title">CRC简历基础信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" >
              <div class="box-body col-sm-offset-1 ">

                <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">姓名：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$crcinfo['uname']?></p>
                  </div>
				 <label for="gname" class="col-sm-2 control-label">性别：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$sex[$crcinfo['sex']]?></p>
                  </div>

                </div>

				 <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">联系电话：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$crcinfo['phone']?></p>
                  </div>
				 <label for="gname" class="col-sm-2 control-label">邮箱：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$crcinfo['email']?></p>
                  </div>

                </div>



				<div class="form-group">

				 <label for="gname" class="col-sm-2 control-label">所属公司：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$company[$crcinfo['company_id']]?></p>
                  </div>

				 
				<label for="gname" class="col-sm-2 control-label">工作年限：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$crcinfo['work_year']?></p>
                  </div>

                  
                </div>
				


				 <div class="form-group"> 
				<label for="gname" class="col-sm-2 control-label">简历状态：</label>
                  <div class="col-sm-2">
					<p class="form-control-static"> 
					<label class="radio-inline">
						  <input type="radio" name="resumes_status" value="1" <?php if($crcinfo['resumes_status']==1){echo 'checked';}?>> 公开
						</label><label class="radio-inline">
						  <input type="radio" name="resumes_status" value="2" <?php if($crcinfo['resumes_status']==2){echo 'checked';}?>> 保密
						</label>	
					</p>
                  </div>  
                </div>	


               
  
			 <div class="form-group"> 
				<label for="gname" class="col-sm-2 control-label">简历文档：</label>
                  <div class="col-sm-4">
					 <?php $us= explode("/",$crcinfo['doc_address']);echo '<a href="'.$crcinfo['doc_address'].'"  download="'.$us[count($us)-1].'">'.$us[count($us)-1].'</a>';?>
                  </div>
				    
                </div>		
               
          </div>



               
             </div>


			 <div class="box-header with-border">
              <h3 class="box-title">CRC简历信息</h3>
            </div>

			  <div class="box-body col-sm-offset-1 ">
				  <div class="form-group">
					  <label class="col-sm-2 control-label">培训经历：</label>
					   <div class="col-sm-10">

					   <table id="example1" class="table table-bordered">

							  <tr class="danger">
							  <th>培训机构</th>
							  <th>时间段</th>
							  <th>培训课程</th>
							  <th>培训内容</th> 
							</tr>
							<?php foreach($rlist['trains'] as $val){
							?>
							<tr><td><?=$val['jxname']?></td>
							<td><?=date('Y-m-d',strtotime($val['start_time'])).'-'.date('Y-m-d',strtotime($val['end_time']))?></td>
							<td><?=$val['postname']?></td>
							<td><?=$val['content']?></td></tr>

							<?php
							}?>
                        </table>
					   </div>
				   </div>

				    <div class="form-group">
					  <label class="col-sm-2 control-label">教育经历：</label>
					   <div class="col-sm-10">

					    <table id="example1" class="table table-bordered">

							  <tr class="success">
							  <th>学校名称</th>
							  <th>时间段</th>
							  <th>专业</th>
							  <th>学历</th>
							  <th>在校经历</th>
							</tr>


							<?php foreach($rlist['school'] as $val1){
							?>

							<tr><td><?=$val1['jxname']?></td>
							<td><?=date('Y-m-d',strtotime($val1['start_time'])).'-'.date('Y-m-d',strtotime($val1['end_time']))?></td>
							<td><?=$val1['postname']?></td>
							<td><?=$val1['dename']?></td>
							<td><?=$val1['content']?></td></tr>
							<?php
							}?>
					</table>
					   </div>
				   </div>


				    <div class="form-group">
					  <label class="col-sm-2 control-label">工作经历：</label>
					   <div class="col-sm-10">
					   <table id="example1" class="table table-bordered">

							  <tr class="warning">
							  <th>公司名称</th>
							  <th>时间段</th>
							  <th>职位</th>
							  <th>部门</th>
							  <th>工作内容</th>
							</tr>

							<?php foreach($rlist['work'] as $val2){
							?>

							<tr><td><?=$val2['jxname']?></td>
							<td><?=date('Y-m-d',strtotime($val2['start_time'])).'-'.date('Y-m-d',strtotime($val2['end_time']))?></td>
							<td><?=$val2['postname']?></td>
							<td><?=$val2['dename']?></td>
							<td><?=$val2['content']?></td></tr>
							<?php
							}?>
                        </table>
					   </div>
				   </div>


			    

			  </div>



              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-2">
					<a class="btn btn-info btn-block" href="/index.php/admin/crc_manage/crc_resumes" role="button">返回</a>
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
<!-- Form Validata -->
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/formValidation.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/framework/bootstrap.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/language/zh_CN.js"></script>
<script 
type='text/javascript'>


 function info_box(uid,table,type,view){
	  window.location.href="/index.php/admin/crc_manage/get_ck_list?table="+table+"&uid="+uid+"&type="+type+"&view="+view;
	
}
</script> 
</body>
</html>


