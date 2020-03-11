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
  <title><?=$this->config->item('web_title')?> | 中心详情</title>
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
        <small>中心详情</small>
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
              <h3 class="box-title">中心信息：</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">
                
                <div class="form-group" >
                  <label for="zh_action" class="col-sm-2 control-label">机构名称</label>
                  <div class="col-sm-2" >
                    <span class="radio-inline"><?=$info['instname'] ?></span>
                  </div>

                   <label for="c" class="col-sm-2 control-label">机构简称</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$info['shortname'] ?></span>
                  </div>

                  <label for="code" class="col-sm-1 control-label">部队系统</label>
                  <div class="col-sm-2" name="budui">
                    <span class="radio-inline"><?=$info['troop_system']=='1'?'是':'否' ?></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">资质获取时间</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=date('Y-m-d',$info['qualify_time'])?></span>
                  </div>  

                  <label for="appid" class="col-sm-2 control-label">所属区域</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$info['area']?></span>
                  </div>  

                  <label for="appid" class="col-sm-1 control-label">中心地址</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$info['province'].$info['city'].$info['address']?></span>
                  </div> 
                
                </div>
                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">中心实验室</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$info['inst_lib']=='1'?'有':'无'?></span>
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

              </div>

                 
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
                  
                  <label for="code" class="col-sm-2 control-label">是否接受联斯达外派</label>
                  <div class="col-sm-2" name="despatch">
                    <span class="radio-inline"><?=$info_desc['is_despatch']=='1'?'是':'否' ?></span>
                  </div>

                  
                  <label for="code" class="col-sm-2 control-label">是否需要派遣函</label>
                  <div class="col-sm-2" name="dpletter">
                    <span class="radio-inline"><?=$info_desc['is_dpletter']=='1'?'是':'否' ?></span>
                  </div>

                  <label for="c" class="col-sm-1 control-label">收费额度</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$info_desc['cost'] ?></span>
                  </div>

                </div> 


                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">是否收crc管理费</label>
                  <div class="col-sm-2" name="fees">
                    <span class="radio-inline"><?=$info_desc['is_fees']=='1'?'是':'否' ?></span>
                  </div>

                  <label for="c" class="col-sm-2 control-label">crc管理费</label>
                  <div class="col-sm-2">
                   <span class="radio-inline"><?=$info_desc['fees'] ?></span>
                  </div>

                  <label for="c" class="col-sm-1 control-label">发票税率</label>
                  <div class="col-sm-2">
                    <span class="radio-inline"><?=$info_desc['invoice'] ?></span>
                  </div>
                </div> 

                <div class="form-group">

                  <label for="code" class="col-sm-2 control-label">是否自组优选</label>
                  <div class="col-sm-2" name="prior">
                    <span class="radio-inline"><?=$info_desc['is_prior']=='1'?'是':'否' ?></span>
                  </div>

                  <label for="code" class="col-sm-2 control-label">是否自组smo</label>
                  <div class="col-sm-2" name="smo" >
                    <span class="radio-inline"><?=$info_desc['is_smo']=='1'?'是':'否' ?></span>
                  </div>


                </div>

               
                <div class="form-group" >
                    <label for="c" class="col-sm-2 control-label">对crc要求</label>
                  <div class="col-sm-4">
                    <span class="radio-inline"><?=$info_desc['crc_require'] ?></span>
                  </div>  
                  
                  <label for="zh_action" class="col-sm-2 control-label"></label>
                  <div class="col-sm-3" >
                    <span class="radio-inline"><a class='btn btn-success btn-sm' href='/index.php/admin/institution/detail_inst?id=<?=$info_desc["id"]?>&instId=<?=$info["id"]?>' >查看</a> 
                    <?php if(empty($info_desc['head_id'])){?>
                    <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_lead?id=<?=$info_desc["id"]?>&instId=<?=$info["id"]?>'>添加负责人</a>
                    <?php }?>
                    <a class='btn btn-info btn-sm' href='/index.php/admin/institution/edit_instoffice?id=<?=$info_desc["id"]?>&instId=<?=$info["id"]?>' >修改</a>
                  </span>

                  </div>
                </div>


             </div>


            <!--立项信息-->
            <div class="box-header with-border">
              <h3 class="box-title col-sm-2" >立项信息：</h3>
              <?php if(empty($project['id'])){?>
              <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_project?instId=<?=$info["id"]?>' >立项添加</a> 
              <?php }?>
            </div>
            <?php if(!empty($project['id'])){?>
            <div class="box-body">
          
                <div class="form-group" >
                  <label for="zh_action" class="col-sm-2 control-label">立项办公地址</label>
                  <div class="col-sm-3" >
                    <span class="radio-inline"><?=$project['address']?></span>
                  </div>

                   <label for="c" class="col-sm-1 control-label">接待时间</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$project['reception_time']?date('Y-m-d',$project['reception_time']):'' ?></span>
                  </div>

                <div class="col-sm-2" >
                    <!-- <label for="zh_action" class="col-sm-1 control-label"></label> -->
                    <span class="radio-inline"><a class='btn btn-success btn-sm' href='/index.php/admin/institution/detail_project?id=<?=$project["id"]?>&instId=<?=$info["id"]?>' >查看</a> 
                    <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_project?id=<?=$project["id"]?>&instId=<?=$info["id"]?>' >修改</a>
                    <!-- <a class='btn btn-danger btn-sm' onclick="del('/index.php/admin/institution/change_project_status?instId=<?=$info["id"]?>&id=<?=$project["id"]?>')">删除</a> -->
                    </span>

                  </div>
                </div>
   
            </div>
            <?php }?>

            <!--伦理信息-->
            <div class="box-header with-border">
              <h3 class="box-title col-sm-2">伦理信息：</h3>
              <?php if(empty($ethic)){?>
              <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_ethic?instId=<?=$info["id"]?>' >添加伦理</a> 
              <?php }?>
            </div>
            <?php foreach($ethic as $val){?>
            <div class="box-body">
              
                <div class="form-group" >
                  <label for="zh_action" class="col-sm-2 control-label">提交流程</label>
                  <div class="col-sm-2" >
                   <!--  <span class="radio-inline"><?=$val['procedure']?></span> -->
                     <span class="radio-inline"><a href="<?=$val['procedure']?>">点击查看</a></span>
                  </div>

                   <label for="c" class="col-sm-2 control-label">伦理接待时间</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$val['reception_time']?date('Y-m-d',$val['reception_time']):'' ?></span>
                  </div>

                  <div class="col-sm-2">
                      <span class="radio-inline"><a class='btn btn-success btn-sm' href='/index.php/admin/institution/detail_ethic?id=<?=$val["id"]?>&instId=<?=$info["id"]?>' >查看</a> 
                      <a class='btn btn-info btn-sm' href='/index.php/admin/institution/edit_ethic?id=<?=$val["id"]?>&instId=<?=$info["id"]?>' >修改</a>
                      <!-- <a class='btn btn-danger btn-sm' onclick="del('/index.php/admin/institution/change_ethic_status?instId=<?=$info["id"]?>&id=<?=$val["id"]?>')">删除</a></span> -->
                  </div>
                </div>
             
            </div>
             <?php } ?>

            <!--合同信息-->
            <div class="box-header with-border">
              <h3 class="box-title col-sm-2">合同信息：</h3>
              <?php if(empty($contract['id'])){?>
              <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_contract?instId=<?=$info["id"]?>' >添加合同</a> 
              <?php }?>
            </div>
            <?php if(!empty($contract['id'])){?>
            <div class="box-body">
         
                <div class="form-group" >
                 
                   <label for="c" class="col-sm-2 control-label">办公室地址</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$contract['address'] ?></span>
                   </div>

                   <label for="zh_action" class="col-sm-2 control-label">合同类型</label>
                   <div class="col-sm-2" >
                    <span class="radio-inline"><?=$contract['contract_type']?></span>
                   </div>

                  <!-- <label for="c" class="col-sm-1 control-label">文件要求</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$val['reception_time'] ?></span>
                  </div> -->

                  <div class="col-sm-2">
                    <span class="radio-inline">
                    <a class='btn btn-success btn-sm' href='/index.php/admin/institution/detail_contract?id=<?=$contract["id"]?>&instId=<?=$info["id"]?>' >查看</a> 
                    <a class='btn btn-info btn-sm' href='/index.php/admin/institution/edit_contract?id=<?=$contract["id"]?>&instId=<?=$info["id"]?>' >修改</a>
                    <!-- <a class='btn btn-danger btn-sm' onclick="del('/index.php/admin/institution/change_contract_status?instId=<?=$info["id"]?>&id=<?=$contract["id"]?>')">删除</a> -->
                  </span>
                  </div>
                </div>
          
            </div>
            <?php }?>


            <!--遗传办信息-->
            <div class="box-header with-border">
              <h3 class="box-title col-sm-2">遗传办信息：</h3>
              <?php if(empty($heredity['id'])){?>
              <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_heredity?instId=<?=$info["id"]?>' >添加遗传办</a> 
              <?php }?>
            </div>
            <?php if(!empty($heredity['id'])){?>
            <div class="box-body">
         
                <div class="form-group" >
                  <label for="zh_action" class="col-sm-2 control-label">遗传办公地址</label>
                  <div class="col-sm-2" >
                    <span class="radio-inline"><?=$heredity['address']?></span>
                  </div>

                   <label for="c" class="col-sm-2 control-label">备注</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$heredity['remarks'] ?></span>
                  </div>

                  <div class="col-sm-2">
                    <span class="radio-inline">
                    <a class='btn btn-success btn-sm' href='/index.php/admin/institution/detail_heredity?id=<?=$heredity["id"]?>&instId=<?=$info["id"]?>' >查看</a> 
                    <a class='btn btn-info btn-sm' href='/index.php/admin/institution/edit_heredity?id=<?=$heredity["id"]?>&instId=<?=$info["id"]?>' >修改</a>
                    <!-- <a class='btn btn-danger btn-sm' onclick="del('/index.php/admin/institution/change_heredity_status?instId=<?=$info["id"]?>&id=<?=$heredity["id"]?>')">删除</a> -->
                  </span>
                  </div>
                </div>
          
            </div>
            <?php }?>

            <!--关中心信息-->
            <div class="box-header with-border">
              <h3 class="box-title col-sm-2">关中心信息：</h3>
              <?php if(empty($closeinst['id'])){?>
              <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_closeinst?instId=<?=$info["id"]?>' >添加关中心</a>
              <?php }?> 
            </div>
            <?php if(!empty($closeinst['id'])){?>
            <div class="box-body">
         
                <div class="form-group" >
                  <label for="zh_action" class="col-sm-2 control-label">关中心流程</label>
                  <div class="col-sm-2" >
                    <span class="radio-inline"><a href="<?=$closeinst['procedure']?>">点击查看</a></span>
                  </div>

                   <label for="c" class="col-sm-2 control-label">关中心特殊要求</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$closeinst['require'] ?></span>
                  </div>

                  <div class="col-sm-2">
                    <span class="radio-inline">
                    <a class='btn btn-success btn-sm' href='/index.php/admin/institution/detail_closeinst?id=<?=$closeinst["id"]?>&instId=<?=$info["id"]?>' >查看</a> 
                    <a class='btn btn-info btn-sm' href='/index.php/admin/institution/edit_closeinst?id=<?=$closeinst["id"]?>&instId=<?=$info["id"]?>' >修改</a>
                    <!-- <a class='btn btn-danger btn-sm' onclick="del('/index.php/admin/institution/change_closeinst_status?instId=<?=$info["id"]?>&id=<?=$closeinst["id"]?>')">删除</a> -->
                  </span>
                  </div>
                </div>
          
            </div>
            <?php }?>

            <!--1期病房信息-->
                       
            <div class="box-header with-border">
              <h3 class="box-title col-sm-2">1期病房信息</h3>
              <?php if(empty($first_ward)){?>
              <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_ward?instId=<?=$info["id"]?>' >添加1期病房</a> 
              <?php }?>
            </div>
            <?php foreach($first_ward as $val){?>
            <div class="box-body">
                <div class="form-group" >
                   <label for="c" class="col-sm-2 control-label">办公地址</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$val['office_address'] ?></span>
                  </div>
                  <label for="zh_action" class="col-sm-2 control-label">床位数量</label>
                  <div class="col-sm-2" >
                    <span class="radio-inline"><?=$val['beds']?></span>
                  </div>
                </div>
                <div class="form-group" >
                  <label for="zh_action" class="col-sm-2 control-label">是否接待</label>
                  <div class="col-sm-2" >
                    <span class="radio-inline"><?=$val['is_reception']==1?'是':'否'?></span>
                  </div>

                   <label for="c" class="col-sm-2 control-label">接待时间</label>
                   <div class="col-sm-2">
                    <span class="radio-inline"><?=$val['reception_time']?date('Y-m-d',$val['reception_time']):'' ?></span>
                  </div>
                  <div class="col-sm-2" >
                    <span class="radio-inline"><a class='btn btn-success btn-sm' href='/index.php/admin/institution/detail_ward?id=<?=$val["id"]?>&instId=<?=$info["id"]?>' >查看</a> 
                    <a class='btn btn-info btn-sm' href='/index.php/admin/institution/add_ward?id=<?=$val["id"]?>&instId=<?=$info["id"]?>' >修改</a>
                    <!-- <a class='btn btn-danger btn-sm' onclick="del('/index.php/admin/institution/change_firstward_status?instId=<?=$info["id"]?>&id=<?=$val["id"]?>')">删除</a> -->
                  </span>

                  </div>

                </div>
            </div>
            <?php } ?>


              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    
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
function del(url){
  // morecheck();
  if(confirm("确定要删除吗？")){
    // document.dbform.action="/index.php/admin/news/del";
    // dbform.submit();
    window.location= url;
  }

}
     
</script>        
</body>
</html>


