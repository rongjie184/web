
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
  <title><?=$this->config->item('web_title')?> | 编辑CRC相关信息</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?=$cdn?>/style/plugins/select2/select2.min.css">
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
        CRC相关信息管理
        <small>编辑CRC相关信息</small>
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
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">

			  <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">姓名：</label>
                  <div class="col-sm-4">
					           <p class="form-control-static"><?=$crcinfo['uname']?></p>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">登录账号：</label>
                  <div class="col-sm-4">
					 <p class="form-control-static"><?=$crcinfo['account']?></p>
                  </div>
                </div>



                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">性别：</label>
                  <div class="col-sm-5">

				   <label class="radio-inline"><input type="radio" name="sex" id="carousel1" value="1" <?php if($crcinfo['sex']==1){echo 'checked';}?>>男</label>
					<label class="radio-inline"><input type="radio" name="sex" id="carousel2" value="2" <?php if($crcinfo['sex']==2){echo 'checked';}?>>女</label>


                   
                  </div>
                </div>

				 <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">出生年月：</label>
                  <div class="col-sm-5">
                   <span style="position: relative; z-index: 9999;"> <input type="text" class="datepicker" id="birthday"  name='birthday' value="<?=$crcinfo['birthday']?>"></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="order_url" class="col-sm-2 control-label">所属公司:</label>
                  <div class="col-sm-3">

                    <select class="form-control select2" id="company_id" name='company_id'>
					<?php foreach($company as $key=> $val){?>
                        <option <?=$crcinfo['company_id']==$key?'selected':''?> value=<?=$key?>><?=$val?></option>
                       <?php }?>
                    </select>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="order_url" class="col-sm-2 control-label">省:</label>
                  <div class="col-sm-3">

                    <select class="form-control select2" id="province_id" name='province_id' onchange="changeData()">
					<?php foreach($province as $key=> $val){?>
                        <option <?=$crcinfo['province_id']==$key?'selected':''?> value=<?=$key?>><?=$val?></option>
                       <?php }?>
                    </select>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="order_url" class="col-sm-2 control-label">市：</label>
                  <div class="col-sm-3">

                    <select class="form-control select2" id="city_id" name='city_id'>
					<?php foreach($city as $key=> $val){?>
                        <option <?=$crcinfo['city_id']==$key?'selected':''?> value=<?=$key?>><?=$val?></option>
                       <?php }?>
                    </select>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="order_url" class="col-sm-2 control-label">区域：</label>
                  <div class="col-sm-3">

                    <select class="form-control select2" id="area_id" name='area_id' onchange="changeDatas()">
					<?php foreach($area as $key=> $val){?>
                        <option <?=$crcinfo['area_id']==$key?'selected':''?> value=<?=$key?>><?=$val?></option>
                       <?php }?>
                    </select>
                  </div>
                </div>


				<div class="form-group">
                  <label for="order_url" class="col-sm-2 control-label">组别：</label>
                  <div class="col-sm-3">

                    <select class="form-control select2" id="group_id" name='group_id'>
					<?php foreach($group as $key=> $val){?>
                        <option <?=$crcinfo['group_id']==$key?'selected':''?> value=<?=$key?>><?=$val?></option>
                       <?php }?>
                    </select>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">工作年限：</label>
                  <div class="col-sm-4">
				  <input type="text" id="work_year"  name='work_year' value="<?=$crcinfo['work_year']?>">	
                  </div>
                </div>

                 <div class="form-group">
                  <label for="gname" class="col-sm-2 control-label">主管患者数量：</label>
                  <div class="col-sm-4">
				  <input type="text" id="sufferer_num"  name='sufferer_num' value="<?=$crcinfo['sufferer_num']?>">	
                  </div>
                </div>
				<div class="form-group">
                  <label for="order_url" class="col-sm-2 control-label">参与项目：</label>
                  <div class="col-sm-3">

                    <select class="form-control select2" id="items_id" name='items_id'>
					<?php foreach($items as $key=> $val){?>
                        <option  value=<?=$val['items_id']?>><?=$item[$val['items_id']]?></option>
                       <?php }?>
                    </select>
                  </div>
                </div>



				<div class="form-group">
                  <label for="order_url" class="col-sm-2 control-label">加入机构：</label>
                  <div class="col-sm-3">

                    <select class="form-control select2" id="inits_id" name='inits_id'>
					<?php foreach($inits as $key=> $val){?>
                        <option  value=<?=$val['inits_id']?>><?=$inst[$val['inits_id']]?></option>
                       <?php }?>
                    </select>
                  </div>
                </div>




				

					<div class="form-group">
                  <label for="order_url" class="col-sm-2 control-label">发表文章：</label>
                  <div class="col-sm-3">

                    <select class="form-control select2" id="news_id" name='news_id'>
					<?php foreach($publish_news as $key=> $val){?>
                        <option  value=<?=$val['news_id']?>><a href="/index.php/admin/news/<?=$val['news_id']?>.html"><?=$news[$val['news_id']]?></a></option>
                       <?php }?>
                    </select>
                  </div>
                </div>


					<div class="form-group">
                  <label for="order_url" class="col-sm-2 control-label">关注文章：</label>
                  <div class="col-sm-3">

                    <select class="form-control select2" id="news_id" name='news_id'>
					<?php foreach($publish_news as $key=> $val){?>
                        <option  value=<?=$val['news_id']?>><a href="/index.php/admin/news/<?=$val['news_id']?>.html"><?=$news[$val['news_id']]?></a></option>
                       <?php }?>
                    </select>
                  </div>
                </div>





			<div class="form-group">
                  <label for="order_url" class="col-sm-2 control-label">关注机构：</label>
                  <div class="col-sm-3">

                    <select class="form-control select2" id="inits_id" name='inits_id'>
					<?php foreach($inits as $key=> $val){?>
                        <option  value=<?=$val['inits_id']?>><?=$inst[$val['inits_id']]?></option>
                       <?php }?>
                    </select>
                  </div>
                </div>


              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <input type="hidden" name="uid" value='<?=$crcinfo['uid']?>' id="uid">
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
<!-- Select2 -->
<script src="<?=$cdn?>/style/plugins/select2/select2.full.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="<?=$cdn?>/style/plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="<?=$cdn?>/style/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=$cdn?>/style/dist/js/app.min.js"></script>
<!-- Form Validata -->
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/formValidation.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/framework/bootstrap.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/dist/js/language/zh_CN.js"></script>
<script type="text/javascript" src="<?=$cdn?>/style/plugins/datepicker/bootstrap-datepicker.js"></script> 
<script type="text/javascript" src="<?=$cdn?>/style/plugins/datepicker/bootstrap-datepicker.zh-CN.js"></script> 
 <script type="text/javascript">

   $(function () {
  
    //Initialize Select2 Elements
    $(".select2").select2();


	$(".datepicker").datepicker({
		autoclose: true,
		todayHighlight: true,
		language:"zh-CN", //--语言设置
		format:"yyyy-mm-dd"  //--日期显示格式
	 });
   })



   function changeData(){  
	   $("#city_id").find("option").remove();
        // 获取城市下拉框选中的值  
        var v = $("#province_id").val();  
        if( v == null){  
            // 下拉框禁用  
            $("#city_id").prop("disabled", true);  
        }else{  
            // 城市选择后下拉框启用  
            $("#city_id").prop("disabled", false);  
      
            // 省市联动部门下拉框  
            var url = "/index.php/admin/crc_manage/get_city?province_id=" + v;  
            var city_id = $("#city_id");  
            // 向后台请求获取数据  
            $.getJSON(url,function (data) {  
                if (data == "") {  
                    swal('该省份下无城市，请先添加城市!');  
                }  
                else {  					
                   // 遍历省下的城市给下拉框赋值  
                    $.each(data,function(i,value){ 					
                        var tempOption = document.createElement("option");  
                        tempOption.value = i;  
                        tempOption.innerHTML  = value;  
                        city_id.append(tempOption);  
                    });  
                }  
            });  
        }  
    }  


 function changeDatas(){  
	   $("#group_id").find("option").remove();
        // 获取城市下拉框选中的值  
        var v = $("#area_id").val();  
        if( v == null){  
            // 下拉框禁用  
            $("#group_id").prop("disabled", true);  
        }else{  
            // 城市选择后下拉框启用  
            $("#group_id").prop("disabled", false);  
      
            // 省市联动部门下拉框  
            var url = "/index.php/admin/crc_manage/get_group?area_id=" + v;  
            var group_id = $("#group_id");  
            // 向后台请求获取数据  
            $.getJSON(url,function (data) {  
                if (data == "") {  
                    swal('该区域下无组别，请先添加组别!');  
                }  
                else {  					
                   // 遍历省下的城市给下拉框赋值  
                    $.each(data,function(j,valuej){ 					
                        var tempOption = document.createElement("option");  
                        tempOption.value = j;  
                        tempOption.innerHTML  = valuej;  
                        group_id.append(tempOption);  
                    });  
                }  
            });  
        }  
    } 

</script>   

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
        cname:{
          validators: {
            notEmpty: {message: '所属公司名称不可为空'},
			 remote:{
              url: '/index.php/admin/crc_manage/company_names_check',
              type: 'post',  
              delay:800,
			  data:{
                    id:function(){return $('#id').val()},
				    cname:function(){return $('#cname').val()}
				
               },
              message:'所属公司名称不合法或已存在,请更换'                    
            }

          }
        }

      }
   })
})     
</script>     
</body>
</html>
