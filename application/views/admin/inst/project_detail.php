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
  <title><?=$this->config->item('web_title')?> | 立项详情</title>
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
        <small>立项详情</small>
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
              <h3 class="box-title">立项详情信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">接待时间</label>
                  <div class="col-sm-2">
                    <!-- <input type="text" class="form-control" id="name"  name='name' placeholder="请输入机构名称"> -->
                    <span class="form-control"><?=$info['reception_time']?date('Y-m-d',$info['reception_time']):'' ?></span>
                  </div>
                 
                </div>

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">立项办公室地址</label>
                  <div class="col-sm-3">
                    <!-- <input type="text" class="form-control" id="shortname" name='shortname' placeholder="机构简称"> -->
                    <span class="form-control"><?=$info['address'] ?></span>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">机构官网文件下载网址</label>
                  <div class="col-sm-2" name="budui">
                    <span class="form-control"><?=$info['url'] ?></span>
                  </div>
                </div>  

                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">合同审核流程</label>
                  <div class="col-sm-2">
                    <span  class="radio-inline" id="procedure" name='procedure'  >
                      <a href="<?=$info['procedure']?>">点击查看</a>
                    </span>
                  </div>
                </div> 

                <div class="form-group">
                    <label for="appid" class="col-sm-2 control-label">立项文件要求</label>
                    <div class="col-sm-4">
                        <!-- <span class="form-control"></span> -->
                        <textarea class="form-control"><?=$info['require'] ?>
                        </textarea>
                    </div>
                    
                </div>

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">备注说明</label>
                  <div class="col-sm-3">
                    <!-- <span class="form-control"><?=$info['remarks'] ?></span> -->
                    <textarea class="form-control"><?=$info['remarks'] ?>
                        </textarea>
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
                              <span class="form-control"><?=$value ?></span>
                            </div>
                          </div>
                          <?php } ?>
                        <?php } ?>
                       
                  
                  <?php }?>

                </div>


                <div class="form-group">
                <label for="c" class="col-sm-2 control-label">立项负责人</label>
              </div>
                <?php foreach($uid as $val){?>
                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">姓名：</label>
                  <div class="col-sm-1">
                    <span class="form-control"><?=$val['name'] ?></span>
                  </div>
                  <label for="c" class="col-sm-2 control-label">电话：</label>
                  <div class="col-sm-2">
                    <span class="form-control"><?=$val['phone'] ?></span>
                  </div>
                  <label for="c" class="col-sm-2 control-label">email：</label>
                  <div class="col-sm-3">
                    <span class="form-control"><?=$val['email'] ?></span>
                  </div>
                
                </div>
                <?php } ?>

               
              

             </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <a class="btn btn-default" href='/index.php/admin/institution/detail_institution?id=<?=$instid?>' >返回中心</a> 
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


