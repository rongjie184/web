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
  <title><?=$this->config->item('web_title')?> | 机构办公室详情</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
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
        中心管理
        <small>机构办公室详情</small>
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
             
                <!--机构办公室信息-->
                <div class="box-header with-border">
                  <h3 class="box-title" style="font-size: 18px">机构办公室信息：</h3>
                </div>
                <div class="box-body">
                <div class="form-group">
                    <label for="c" class="col-sm-2 control-label">机构办公地址</label>
                    <div class="col-sm-2">
                      <!-- <span class="form-control"><?=$info_desc['office_address'] ?></span> -->
                      <span class="radio-inline"><?=$info_desc['office_address'] ?></span>
                    </div>

                    <label for="code" class="col-sm-2 control-label">是否收牵头遗传办</label>
                    <div class="col-sm-2" name="lead_heredity">
                      <span class="radio-inline"><?=$info_desc['is_lead_heredity']=='1'?'是':'否' ?></span>
                    </div>

                    <label for="code" class="col-sm-1 control-label">是否牵头</label>
                    <div class="col-sm-2" name="lead">
                      <span class="radio-inline" ><?=$info_desc['is_lead']=='1'?'是':'否' ?></span>
                    </div>

                    
                    
                </div>

                <div class="form-group">

                  <label for="code" class="col-sm-2 control-label">是否自组smo</label>
                  <div class="col-sm-2" name="smo" >
                    <span class="radio-inline"><?=$info_desc['is_smo']=='1'?'是':'否' ?></span>
                  </div>

                   <label for="code" class="col-sm-2 control-label">是否接受联斯达外派</label>
                  <div class="col-sm-2" name="despatch">
                    <span class="radio-inline"><?=$info_desc['is_despatch']=='1'?'是':'否' ?></span>
                  </div>

                  <label for="c" class="col-sm-1 control-label">发票税率</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$info_desc['invoice'] ?></span>
                  </div>
                  

                </div> 

                
              
               

                <div class="form-group">

                  <label for="code" class="col-sm-2 control-label">是否需要派遣函</label>
                  <div class="col-sm-2" name="dpletter">
                    <span class="radio-inline"><?=$info_desc['is_dpletter']=='1'?'是':'否' ?></span>
                  </div>

                  <label for="code" class="col-sm-2 control-label">是否收crc管理费</label>
                  <div class="col-sm-2" name="fees">
                    <span class="radio-inline"><?=$info_desc['is_fees']=='1'?'是':'否' ?></span>
                  </div>

                  <label for="c" class="col-sm-1 control-label">crc管理费</label>
                  <div class="col-sm-2">
                   <span class="radio-inline"><?=$info_desc['fees'] ?></span>
                  </div>

                  
                </div> 

                <div class="form-group">

                   <label for="c" class="col-sm-2 control-label">收费额度</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$info_desc['cost'] ?></span>
                  </div>

                  <label for="code" class="col-sm-2 control-label">是否自组优选</label>
                  <div class="col-sm-2" name="prior">
                    <span class="radio-inline"><?=$info_desc['is_prior']=='1'?'是':'否' ?></span>
                  </div>

                  

                </div>

                <div class="form-group">
                  
                  <label for="code" class="col-sm-2 control-label">优选单位</label>
                  <div class="col-sm-4" name="prior">
                    <span class="radio-inline"><?=$info_desc['prior_list'] ?></span>
                  </div>

                </div> 
                <!--新添加的字段-->
                <div>
                    <?php foreach($columns as $key=>$val){?>
 
                        <?php foreach ($col_inst as $key => $value) {?>
                          <?php if($val['id']==$key){?>
                          <div class="form-group">
                            <label  class="col-sm-2 control-label"><?=$val['cname']?></label>
                            <div class="col-sm-2">
                              <span class="radio-inline"><?=$value ?></span>
                            </div>
                          </div>
                          <?php } ?>
                        <?php } ?>
                       
                  
                  <?php }?>
                </div>


                <div class="form-group">

                   <label for="code" class="col-sm-2 control-label">是否接待</label>
                  <div class="col-sm-2" name="reception">
                    <span class="radio-inline"><?=$jiedai['is_reception']>='1'?'是':'否' ?></span>
                  </div>
                  <?php if($jiedai['is_reception']){?>
                  <label for="appid" class="col-sm-2 control-label">接待时间</label>
                  <div class="col-sm-2">
                   <span class="radio-inline"><?=$jiedai['datetime']?date('Y-m-d',$jiedai['datetime']):'' ?></span>
                  </div>

                  <label for="code" class="col-sm-1 control-label">接待人</label>
                  <div class="col-sm-2" name="smo" >
                    <span class="radio-inline"><?=$jiedai['receiver']?></span>
                  </div>
                </div>

                <div class="form-group">

                  <label for="appid" class="col-sm-2 control-label">职位</label>
                  <div class="col-sm-2">
                   <span class="radio-inline"><?=$jiedai['position'] ?></span>
                  </div>

                  <label for="code" class="col-sm-2 control-label">电话</label>
                  <div class="col-sm-2" name="reception">
                    <span class="radio-inline"><?=$jiedai['phone'] ?></span>
                  </div>

                  <label for="appid" class="col-sm-1 control-label">email</label>
                  <div class="col-sm-2">
                   <span class="radio-inline"><?=$jiedai['email'] ?></span>
                  </div>

                </div>
                <?php }else{?> 
                  </div>
                <?php }?>
             </div>

             <!-- 机构办公室负者人信息-->

            <div class="box-body">
              <div class="box-header ">
                  <h3 class="box-title" style="font-size: 16px">主任信息：</h3>
              </div>
                <?php foreach($lead as $val){ ?>
                <div class="form-group" >
                  <label for="zh_action" class="col-sm-2 control-label">主任名称</label>
                  <div class="col-sm-2" >
                    <span class="radio-inline"><?=$val['name'] ?></span>
                  </div>

                   <label for="c" class="col-sm-2 control-label">主任电话</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$val['phone'] ?></span>
                  </div>
                </div>

                <div class="form-group" >
                  <label for="zh_action" class="col-sm-2 control-label">主任邮箱</label>
                  <div class="col-sm-2" >
                    <span class="radio-inline"><?=$val['email'] ?></span>
                  </div>

                   <label for="c" class="col-sm-2 control-label">主任办公地址</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$val['office_address'] ?></span>
                  </div>
                </div>
                <?php }?>


              <div class="box-header ">
                  <h3 class="box-title" style="font-size: 16px">秘书信息：</h3>
              </div>
              <?php foreach($secretary as $val){ ?>
              <div class="form-group" >
                  <label for="zh_action" class="col-sm-2 control-label">秘书名称</label>
                  <div class="col-sm-2" >
                    <span class="radio-inline"><?=$val['name'] ?></span>
                  </div>

                   <label for="c" class="col-sm-2 control-label">秘书电话</label>
                   <div class="col-sm-1">
                    <span class="radio-inline"><?=$val['phone'] ?></span>
                  </div>

                  <label for="zh_action" class="col-sm-2 control-label">秘书邮箱</label>
                  <div class="col-sm-2" >
                    <span class="radio-inline"><?=$val['email'] ?></span>
                  </div>
              </div>
              <?php }?>

            </div>

 
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                      <a class="btn btn-default" href='/index.php/admin/institution/detail_institution?id=<?=$info_desc["id"]?>' >返回中心</a> 
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
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script type="text/javascript">

     
</script>        
</body>
</html>


