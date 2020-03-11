<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="renderer" content="webkit" />
  <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
  <title><?=$this->config->item('web_title')?> | CRC相关信息详情</title>
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
        CRC相关信息管理
        <small>CRC相关信息详情</small>
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
              <h3 class="box-title">CRC相关信息详情</h3>
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


				   <label for="gname" class="col-sm-2 control-label">登录账号：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$crcinfo['account']?></p>
                  </div>


                </div>

				 <div class="form-group">
				 <label for="gname" class="col-sm-2 control-label">性别：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$sex[$crcinfo['sex']]?></p>
                  </div>


				   <label for="gname" class="col-sm-2 control-label">出生年月：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$crcinfo['birthday']?></p>
                  </div>


                 
                </div>

				<div class="form-group">

				 <label for="gname" class="col-sm-2 control-label">所属公司：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$company[$crcinfo['company_id']]?></p>
                  </div>

				   <label for="gname" class="col-sm-2 control-label">区域：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$area[$crcinfo['area_id']]?></p>
                  </div>


                  
                </div>

				
				<div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">省：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$province[$crcinfo['province_id']]?></p>
                  </div>

				   <label for="gname" class="col-sm-2 control-label">市：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$city[$crcinfo['city_id']]?></p>
                  </div>


                </div>

				
				<div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">组别：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$group[$crcinfo['group_id']]?></p>
                  </div>

				  <label for="gname" class="col-sm-2 control-label">工作年限：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$crcinfo['work_year']?></p>
                  </div>


                </div>
				

				 <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">主管患者数量：</label>
                  <div class="col-sm-2">
					           <p class="form-control-static"><?=$crcinfo['sufferer_num']?></p>
                  </div>
               
                  <label for="gname" class="col-sm-2 control-label">参与项目：</label>
                  <div class="col-sm-2">
                 
                  <?php if($crcinfo['items_num']>0){?>
				  <div class="dropdown">
					  <button class="btn btn-info" type="button" onclick="info_box(<?=$crcinfo['uid']?>,'crc_items',0,'ckitem')">
						<?=$crcinfo['items_num']?>：查看					
					  </button>
					</div>


                    <?php }else{echo '暂无参与项目';}?>

				   
                  </div>
                </div>

				 <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">加入机构：</label>
                  <div class="col-sm-2">


				   <?php if($crcinfo['institution_num']>0){?>
				  <div class="dropdown">
					  <button class="btn btn-info" type="button" id="" onclick="info_box(<?=$crcinfo['uid']?>,'crc_inits',1,'ckinis')">
						<?=$crcinfo['institution_num']?>：查看
						
					  </button>
					 
					</div>


                    <?php }else{echo '暂无加入机构';}?>



					         
                  </div>
               
                  <label for="gname" class="col-sm-2 control-label">文章发表：</label>
                  <div class="col-sm-2">

				    <?php if($crcinfo['publish_news_num']>0){?>
				  <div class="dropdown">
					  <button class="btn btn-info" type="button" onclick="info_box(<?=$crcinfo['uid']?>,'crc_news',1,'ckpnews')">
						<?=$crcinfo['publish_news_num']?>：查看
					
					  </button>
					 
					</div>


                    <?php }else{echo '暂无发表文章';}?>


					          
                  </div>
                </div>



					<div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">关注文章：</label>
                  <div class="col-sm-2">

				     <?php if($crcinfo['attention_news_num']>0){?>
				  <div class="dropdown">
					  <button class="btn btn-info" type="button" onclick="info_box(<?=$crcinfo['uid']?>,'crc_news',2,'ckanews')">
						<?=$crcinfo['attention_news_num']?>：查看
						
					  </button>
					 
					</div>


                    <?php }else{echo '暂无关注文章';}?>


					         
                  </div>
                
                  <label for="gname" class="col-sm-2 control-label">关注机构：</label>
                  <div class="col-sm-2">

				   <?php if($crcinfo['attention_inst_num']>0){?>
				  <div class="dropdown">
					  <button class="btn btn-info" type="button" onclick="info_box(<?=$crcinfo['uid']?>,'crc_inits',2,'ckainis')">
						<?=$crcinfo['attention_inst_num']?>：查看
					
					  </button>
					 
					</div>


                    <?php }else{echo '暂无关注机构';}?>


					         
                  </div>
                </div>


				<div class="form-group" style="display:none;">
                  <label for="gname" class="col-sm-2 control-label">所获奖励：</label>
                  <div class="col-sm-2">


				   <?php if($crcinfo['award_num']>0){?>
				  <div class="dropdown">
					  <button class="btn btn-info" type="button" onclick="info_box(<?=$crcinfo['uid']?>,'crc_rewards',1,'ckrewards')">
						<?=$crcinfo['award_num']?>：查看
					
					  </button>
					 
					</div>


                    <?php }else{echo '暂无奖励';}?>


                  </div>
                </div>










					
               
             </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-2">
					<a class="btn btn-info btn-block" href="/index.php/admin/crc_manage/crc_flist" role="button">返回</a>
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


