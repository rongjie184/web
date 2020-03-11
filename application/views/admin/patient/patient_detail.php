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
  <title><?=$this->config->item('web_title')?> | 患者详情</title>
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
        患者管理
        <small>患者详情</small>
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
                  <h3 class="box-title" style="font-size: 18px">患者信息：</h3>
                  <?php if(!$is_group){?>
                    <!-- <a class='btn btn-info btn-sm' href='/index.php/admin/patient/entry_group?id=<?=$pdesc["uid"]?>&jid=<?=$pdesc["jid"]?>' >去入组</a>  -->
                  <?php }else{?>
                    <a class='btn btn-info btn-sm' href='/index.php/admin/patient/pat_scheme?id=<?=$pdesc["uid"]?>&jid=<?=$pdesc["jid"]?>' >设置个性方案</a> 
                  <?php }?>
                </div>
                <div class="box-body">
                <div class="form-group">
                    <label for="c" class="col-sm-2 control-label">患者姓名</label>
                    <div class="col-sm-2">
                      <!-- <span class="form-control"><?=$info_desc['office_address'] ?></span> -->
                      <span class="radio-inline"><?=$pdesc['uname'] ?></span>
                    </div>

                    <label for="code" class="col-sm-2 control-label">性别</label>
                    <div class="col-sm-2" name="lead_heredity">
                      <span class="radio-inline"><?=$pdesc['sex']=='1'?'男':'女' ?></span>
                    </div>

                    <label for="code" class="col-sm-1 control-label">出生年月</label>
                    <div class="col-sm-2" name="lead">
                      <span class="radio-inline" ><?=$pdesc['age'] ?></span>
                    </div>

                    
                </div>

                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">患者筛选号</label>
                    <div class="col-sm-2" name="lead">
                      <span class="radio-inline" ><?=$pdesc['select_num'] ?></span>
                    </div>
                  
                  <label for="code" class="col-sm-2 control-label">手机号</label>
                  <div class="col-sm-2" name="smo" >
                    <span class="radio-inline"><?=$pdesc['phone'] ?></span>
                  </div>

                  <label for="code" class="col-sm-1 control-label">居住地</label>
                  <div class="col-sm-2" name="smo" >
                    <span class="radio-inline"><?=$juzhudi ?></span>
                  </div>

                </div> 


                <div class="form-group">

                  <label for="c" class="col-sm-2 control-label">项目</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$items['name'] ?></span>
                  </div>
                  

                  <label for="code" class="col-sm-2 control-label">项目阶段</label>
                  <div class="col-sm-2" name="dpletter">
                    <span class="radio-inline"><?=$progress['name']?></span>
                  </div>
                  
                </div> 

                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">机构名称</label>
                  <div class="col-sm-2" name="fees">
                    <span class="radio-inline"><?=$pdesc['inst_name'] ?></span>
                  </div>

                  <label for="c" class="col-sm-2 control-label">科室</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$pdesc['dname'] ?></span>
                  </div>

                </div>

                <div class="form-group">

                   <label for="c" class="col-sm-2 control-label">主管CRC</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$crc['uname'] ?></span>
                  </div>

                  <label for="code" class="col-sm-2 control-label">CRC所属公司</label>
                  <div class="col-sm-2" name="prior">
                    <span class="radio-inline"><?=$crc['cname'] ?></span>
                  </div>

                </div>

                <div class="form-group">

                   <label for="c" class="col-sm-2 control-label">家属姓名</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$pdesc['family'] ?></span>
                  </div>
                  
                  <label for="c" class="col-sm-2 control-label">家庭联系方式</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$pdesc['family_phone'] ?></span>
                  </div>  

                  <label for="code" class="col-sm-1 control-label">关系</label>
                  <div class="col-sm-2" name="prior">
                    <span class="radio-inline"><?=$pdesc['relation'] ?></span>
                  </div>

                </div>

                <div class="form-group">

                   <label for="code" class="col-sm-2 control-label">身份证号码</label>
                    <div class="col-sm-2" name="lead">
                      <span class="radio-inline" ><?=$pdesc['birth'] ?></span>
                    </div>

                  <label for="code" class="col-sm-2 control-label">微信号</label>
                  <div class="col-sm-2" name="prior">
                    <span class="radio-inline"><?=$pdesc['wechat'] ?></span>
                  </div>

                </div>


                <div class="form-group"  >  
                  <label  class="col-sm-2 control-label">诊疗</label>
                  <table  >
                  <?php foreach($diagnosis as $val){ ?>
                    <tr>
                      <td class="col-sm-1"></td>
                      <td colspan=2 class="radio-inline" style="padding-left: 0px"><?=$val?></td>
                    </tr>
                  <?php }?>
                  </table>
                </div> 


                <div class="form-group">
                    <label  class="col-sm-2 control-label">月活跃度</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$m_count?></span>
                  </div>
                  <label  class="col-sm-2 control-label">季活跃度</label>
                  <div class="col-sm-1" name="prior">
                    <span class="radio-inline"><?=$j_count?></span>
                  </div>
                  <label  class="col-sm-2 control-label">半年活跃度</label>
                  <div class="col-sm-1" name="prior">
                    <span class="radio-inline"><?=$y_count ?></span>
                  </div>

                </div>
                

             <!-- 机构办公室负者人信息-->

            <div class="box-body">

            <!--   <div class="box-header ">
                  <h3 class="box-title col-sm-2 " style="font-size: 16px;width:120px">活跃度：</h3>
                  <a class='btn btn-info btn-sm' href='/index.php/admin/patient/p_liveness?id=<?=$pdesc["uid"]?>' >点击查看</a> 
              </div>
 -->
              <div class="box-header ">
                  <h3 class="box-title col-sm-2" style="font-size: 16px;width:120px">发表资讯：</h3>
                  <a class='btn btn-info btn-sm' href='/index.php/admin/patient/publish_information?id=<?=$pdesc["uid"]?>' >点击查看</a> 
              </div>

              <div class="box-header ">
                  <h3 class="box-title col-sm-2" style="font-size: 16px;width:120px">关注资讯：</h3>
                  <a class='btn btn-info btn-sm' href='/index.php/admin/patient/my_information?id=<?=$pdesc["uid"]?>' >点击查看</a> 
              </div>


            </div>

 
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                      <a class="btn btn-default" href='/index.php/admin/patient/patient_list' >返回列表</a> 
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


