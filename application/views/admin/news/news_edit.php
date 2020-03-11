
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
  <title><?=$this->config->item('web_title')?> | 编辑资讯</title>
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
        资讯管理
        <small>编辑资讯</small>
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
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm' enctype="multipart/form-data">
              <div class="box-body">

			 
             


                <div class="form-group">
                  <label for="mname" class="col-sm-2 control-label">资讯标题</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="title" name='title' value="<?=$news['title']?>">
                  </div>
                </div>
			<div class="form-group">
                  <label for="mname" class="col-sm-2 control-label">资讯副标题</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="ftitle" name='ftitle' value="<?=$news['ftitle']?>">
                  </div>
                </div>


				               <div class="form-group">
					  <label for="describe" class="col-sm-2 control-label">资讯类别</label>
					  <div class="col-sm-5">
						<select id='typeid' name='typeid' class="form-control select2" style="width: 100%;">
						  <option value='0'>选择类别</option>
						  <?php
							foreach($typelist as $value){
							  $opt = '';
							  if($news['typeid'] == $value['id']){
								  $opt = 'selected';
							  }
						  ?>
						  <option <?=$opt?> value='<?=$value['id']?>'><?=$value['name']?></option>
						  <?php
							}
						  ?>
						</select>
					
                  </div>
			</div>
           <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">作者</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="author" name='author' value="<?=$news['author']?>">
                  </div>
                </div>

             <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">排序</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="order_num" name='order_num' value="<?=$news['order_num']?>">
                  </div>
                </div>
            



				 <div class="form-group">
                  <label for="titpic" class="col-sm-2 control-label">资讯图片</label>
                  <div class="col-sm-4">
				  <span class="help-block"></span>
					 <input type="file" name="titpic" class="file" id="titpic" size="28" value=""><?php $u= explode("/",$news['titpic']);echo $u[count($u)-1];?>
                  </div>
				    <input type="button" value="取消" id="reset" style="display:none;">
                </div>

 


				 <div class="form-group">
                  <label for="private_key" class="col-sm-2 control-label">描述</label>
                  <div class="col-sm-8">
				  <script id="container" name="describe" type="text/plain">
				  <?=$news['describe']?>
					</script>

			    <script type="text/javascript" src="<?=$cdn?>ueditor/ueditor.config.js"></script>

				<script type="text/javascript" src="<?=$cdn?>ueditor/ueditor.all.js"></script>
				<script type="text/javascript">
					var editor =new UE.ui.Editor();
					UE.getEditor('container');
				</script> 
                  </div>
                </div>



              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <input type="hidden" name="id" value='<?=$news['id']?>'>
                    <button type="submit" class="btn btn-warning">编辑</button>
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
<<!-- AdminLTE App -->
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
        title:{
          validators: {
            notEmpty: {message: '资讯标题不可为空'}
          }
        }

      }
   })
})     
</script>     

<script type="text/javascript">
					$(document).ready(function() {
						$("#titpic").change(function(){

							if(document.getElementById("titpic").value!=""){
								document.getElementById("reset").style="display:block";								
							}
						})
							$("#reset").click(function(){
								document.getElementById("titpic").value="";	
								document.getElementById("reset").style="display:none";	
						})


					})
					
					</script> 

</body>
</html>
