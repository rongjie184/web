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
  <title><?=$this->config->item('web_title')?> | 编辑项目</title>
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
        <small>编辑项目</small>
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
              <h3 class="box-title">请填写项目信息：</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">

                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">项目名称</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="name"  name='name' value="<?=$info['name']?>" placeholder="请输入项目名称">
                  </div>
                 
                </div>

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">项目简称</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="shortname" name='shortname' placeholder="项目简称" value="<?=$info['shortname']?>">
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">项目启动时间</label>
                  <div class="col-sm-3">
                    <input type="text" class="datepicker" id="start_time" name='start_time' value="<?=$info['start_time']?>">
                  </div>
                </div>


                 <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">项目归属</label>
                  <div class="col-sm-10">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="is_linkstart" <?php if($info['is_linkstart']==1){echo 'checked';}?>>联斯达
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="is_linkstart" <?php if($info['is_linkstart']!=1){echo 'checked';}?>>其它SMO公司
                    </label>
                  </div>
                </div>  

                <div class="form-group" id="xmbh">
                  <label for="appid" class="col-sm-2 control-label">项目编号</label>
                  <div class="col-sm-2">
                   <span> <input type="text" id="item_number"  name='item_number' style="width:180px" placeholder="请以LST-开头，32位" value="<?=$info['item_number'].$info['exte_number']?>"></span>
                  </div>
                </div>   
				 <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">申办方</label>
                  <div class="col-sm-2">
                   <select id='sponsor_company' name='sponsor_company' class="form-control select2" style="width: 100%;">
						  <option value='0'>选择申办方</option>
						  <?php
							foreach($sponsor as $key=>$value){
								$opt='';
								if($key==$info['sponsor_company']){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                   <label id="but_sponsor"> <button type="button" class="btn btn-info" onclick="add_sponsor()">添加</button></label>
				  <div class="col-sm-5" style="display:none;" id="sponsors">
                   <input type="text" id="sponsor"  name='sponsor' style="width:180px">
				   <button type="button" class="btn btn-info" onclick="add_sponsors()">添加
				   <button type="button" class="btn btn-info" onclick="res_sponsors()">取消</button>
                  </div>
                </div> 
				
				 <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">CRO公司</label>
                  <div class="col-sm-4">
                   <select id='cro_company' name='cro_company[]' class="form-control select2" multiple="multiple">
						  <option value='0'>选择CRO</option>
						  <?php
							foreach($cro as $key=>$value){	
								$opt='';
								if(in_array($key,unserialize($info['cro_company']))){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                   <label id="but_cro"> <button type="button" class="btn btn-info" onclick="add_cro()">添加</button></label>
				  <div class="col-sm-5" style="display:none;" id="cros">
                   <input type="text" id="cro"  name='cro' style="width:180px">
				   <button type="button" class="btn btn-info" onclick="add_cros()">添加
				   <button type="button" class="btn btn-info" onclick="res_cros()">取消</button>
                  </div>
                </div>   


				 <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">SMO公司</label>
                  <div class="col-sm-4">
                   <select id='smo_company' name='smo_company[]' class="form-control select2" multiple="multiple">
						  <option value='0'>选择CRO</option>
						  <?php
							foreach($smo as $key=>$value){	
								$opt='';
								if(in_array($key,unserialize($info['smo_company']))){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                   <label id="but_smo"> <button type="button" class="btn btn-info" onclick="add_smo()">添加</button></label>
				  <div class="col-sm-5" style="display:none;" id="smos">
                   <input type="text" id="smo"  name='smo' style="width:180px">
				   <button type="button" class="btn btn-info" onclick="add_smos()">添加
				   <button type="button" class="btn btn-info" onclick="res_smos()">取消</button>
                  </div>
                </div> 
				
				 <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">项目合作中心数量</label>
                  <div class="col-sm-4">
				  <span><input type="text" class="form-control" id="inis_num" name='inis_num' value="<?=$info['inis_num']?>"></span>
				  </div>
				  </div>
				  <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">项目合作中心</label>
                  <div class="col-sm-4">
                   <select id='inis_id' name='inis_id[]' class="form-control select2" multiple="multiple" onchange="changeinisl()">
						  <option value='0'>选择合作中心</option>
						  <?php
							foreach($inis as $key=>$value){	
								$opt='';
								if(in_array($key,unserialize($info['inis_id']))){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                  
                </div> 
				

				<div class="form-group" id="qtjg">
                  <label for="appid" class="col-sm-2 control-label">牵头机构</label>
                  <div class="col-sm-4">
                   <select id='leader_inis' name='leader_inis' class="form-control select2" onchange="changeinis()">
						  <option value='0'>选择牵头机构</option>
						  <?php
							foreach($inis as $key=>$value){	
								$opt='';
								if($key==$info['leader_inis']){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                  
                </div>  
				
				<div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">试验类型</label>
                  <div class="col-sm-4">
                   <select id='test_id' name='test_id' class="form-control select2" onchange="changeData()">
						  <option value='0'>选择试验类型</option>
						  <?php
							foreach($test as $key=>$value){	
								$opt='';
								if($key==$info['test_id']){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                  
                </div>  
				
				<div class="form-group" id="yaopin" style="display:<?php if($info['test_id']==1){echo 'block;';}else{echo 'none;';}?>">
                  <label for="appid" class="col-sm-2 control-label">药品分期</label>
                  <div class="col-sm-4">
                   <select id='drug_id' name='drug_id' class="form-control select2">
						  <option value='0'>选择药品分期</option>
						  <?php
							foreach($drug as $key=>$value){	
								$opt='';
								if($key==$info['drug_id']){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                  
                </div> 


				<div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">试验分类</label>
                  <div class="col-sm-4">
                   <select id='dtype_id' name='dtype_id' class="form-control select2" onchange="changeDatad()">
						  <option value='0'>选择分类</option>
						  <?php
							foreach($drugtype  as $key=>$value){
								$opt='';
								if($key==$info['dtype_id']){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                  
                </div>  

				<div class="form-group" id="ypfl" style="display:none;">
                  <label for="appid" class="col-sm-2 control-label">药品分类</label>
                  <div class="col-sm-4">
                   <select id='classify_id' name='classify_id' class="form-control select2">
						  <option value='0'>选择分类</option>
						  <?php
							foreach($classify  as $key=>$value){
								$opt='';
								if($key==$info['classify_id']){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                  
                </div>  

				


<!--
				 <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">研究方法：</label>
                  <div class="col-sm-5">
                  <?php foreach($methods as $key=>$val){
				  $opt='';
				        if($key==$info['methods_id']){$opt='checked';}
				  
				  ?>
				   <label class="radio-inline"><input type="radio" name="methods_id" id="methods_id<?=$key?>" value="<?=$key?>" <?=$opt?>><?=$val?></label>

                     <?php }?>
                   
                  </div>
                </div>
-->

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">适应症</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="indications" name='indications' placeholder="适应症" value="<?=$info['indications']?>">
                  </div>
                </div>

				<div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">所属领域</label>
                  <div class="col-sm-2">
                   <select id='field_id' name='field_id' class="form-control select2">
						  <option value='0'>选择领域</option>
						  <?php
							foreach($field as $key=>$value){
								$opt='';
								if($key==$info['field_id']){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>

				  <label id="but_field"> <button type="button" class="btn btn-info" onclick="add_field()">添加</button></label>
				  <div class="col-sm-5" style="display:none;" id="fields">
                   <input type="text" id="field"  name='field' style="width:180px">
				   <button type="button" class="btn btn-info" onclick="add_fields()">添加
				   <button type="button" class="btn btn-info" onclick="res_fields()">取消</button>
                  </div>
                  
                </div>  

				

				<div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">科室</label>
                  <div class="col-sm-4">
                   <select id='leader_dept' name='leader_dept' class="form-control select2">
						  <option value='0'>选择机构</option>
						  <?php
							foreach($dept as $key=>$value){	
								$opt='';
								if($key==$info['leader_dept']){$opt='selected';}
						  ?>
						  <option value='<?=$key?>' <?=$opt?>><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                  
                </div> 
				

				<div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">项目进度</label>
                  <div class="col-sm-4">
                   <select id='progress_id' name='progress_id' class="form-control select2">
						  <option value='0'>选择进度</option>
						  <?php
							foreach($progress  as $key=>$value){
								$opt='';
								if($key==$info['progress_id']){$opt='selected';}
						  ?>
						  <option value='<?=$key?>'><?=$value?></option>
						  <?php
							
							}
						  ?>
						</select>
                  
                  </div>
                  
                </div>  



				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">计划入组人数</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="plan_num" name='plan_num' value="<?=$info['plan_num']?>">
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">实际入组人数</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="real_num" name='real_num' value="<?=$info['real_num']?>">
                  </div>
                </div>

             </div> 

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
				  <input type="hidden" name="id" value="<?=$info['id']?>" id="id">
				  <input type="hidden" name="view" value="<?=$view?>" id="view">
                    <button type="submit" class="btn btn-info">修改</button>
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
<script type="text/javascript">

$(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
    language:"zh-CN", //--语言设置
    format:"yyyy-mm-dd"  //--日期显示格式
});


$(function(){
	$('input[name="is_linkstart"]').click(function(){
   if($(this).val()=='1'){
	   $("#xmbh").show();
   
   }else{
	   $("#xmbh").hide();
   
   }
  });

  $("#inis_num").blur(function(){
	  var num=parseInt($("#inis_num").val());
	  if(num>1){
		  $("#qtjg").show(); 
	  }else{
		  $("#qtjg").hide();
	  
	  }

  
  });
 
 });

 function changeData(){
	var v = $("#test_id").val(); 
	if(v==1){
		$("#yaopin").show();
		$("#ypfl").show();	
	}else{
		$("#yaopin").hide();
		$("#ypfl").hide();	
	}
	 $("#dtype_id").find("option").remove();
        if( v == null){             
            $("#dtype_id").prop("disabled", true);  
        }else{             
            $("#dtype_id").prop("disabled", false);             
            var url = "/index.php/admin/item_manage/get_drug?test_id=" + v;  
            var dtype_id = $("#dtype_id");  
            // 向后台请求获取数据  
            $.getJSON(url,function (data) {  
                if (data == "") {  
                    swal('该试验类型下无试验分类，请先添加试验分类!');  
                }  
                else {  					
                    
                    $.each(data,function(i,value){ 					
                        var tempOption = document.createElement("option");  
                        tempOption.value = i;  
                        tempOption.innerHTML  = value;  
                        dtype_id.append(tempOption);  
                    });  
                }  
            });  
        }  


 }

 function changeDatad(){
	var v = $("#dtype_id").val(); 
	if(v>2){
		$("#ypfl").hide();		
	}else{
		$("#ypfl").show();	
	}
	 $("#classify_id").find("option").remove();
        if( v == null){             
            $("#classify_id").prop("disabled", true);  
        }else{             
            $("#classify_id").prop("disabled", false);             
            var url = "/index.php/admin/item_manage/get_classi?drug_id=" + v;  
            var classify_id = $("#classify_id");  
            // 向后台请求获取数据  
            $.getJSON(url,function (data) {  
                if (data == "") {  
                    swal('该药品分类下无药品种类，请先添加药品种类!');  
                }  
                else {  					
                    
                    $.each(data,function(i,value){ 					
                        var tempOption = document.createElement("option");  
                        tempOption.value = i;  
                        tempOption.innerHTML  = value;  
                        classify_id.append(tempOption);  
                    });  
                }  
            });  
        }  


 }

 function changeinis(){  
	   $("#leader_dept").find("option").remove();
        
        var v = $("#leader_inis").val();  
        if( v == null){  
            
            $("#leader_dept").prop("disabled", true);  
        }else{  
            
            $("#leader_dept").prop("disabled", false);  
      
           
            var url = "/index.php/admin/item_manage/get_dept?leader_inis=" + v;  
            var leader_dept = $("#leader_dept");  
            // 向后台请求获取数据  
            $.getJSON(url,function (data) {  
                if (data == "") {  
                    swal('该牵头机构下无科室，请先添加科室!');  
                }  
                else {  					
                    
                    $.each(data,function(i,value){ 					
                        var tempOption = document.createElement("option");  
                        tempOption.value = i;  
                        tempOption.innerHTML  = value;  
                        leader_dept.append(tempOption);  
                    });  
                }  
            });  
        }  
    } 
	
	function changeinisl(){ 
		 var num=parseInt($("#inis_num").val());
		if(num==1){
			$("#leader_dept").find("option").remove();        
			var v = $("#inis_id").val(); 
			if( v == null){  
				
				$("#leader_dept").prop("disabled", true);  
			}else{  
				
				$("#leader_dept").prop("disabled", false);  
		  
			   
				var url = "/index.php/admin/item_manage/get_dept?leader_inis=" + v;  
				var leader_dept = $("#leader_dept");  
				// 向后台请求获取数据  
				$.getJSON(url,function (data) {  
					if (data == "") {  
						swal('该牵头机构下无科室，请先添加科室!');  
					}  
					else {  					
						
						$.each(data,function(i,value){ 					
							var tempOption = document.createElement("option");  
							tempOption.value = i;  
							tempOption.innerHTML  = value;  
							leader_dept.append(tempOption);  
						});  
					}  
				});  
			}  

		
		}
	  
    } 





 function add_sponsor(){
	 $("#sponsors").show();
	 $("#but_sponsor").hide();
 }

 function res_sponsors(){
	 $("#sponsors").hide();
	 $("#but_sponsor").show();
 }


  function add_sponsors(){

	  var sponsor=$("#sponsor").val();
	  $.ajax({
			   type:"post",
			   url: "/index.php/admin/item_manage/add_sponsor",
			   dataType:"json",
			   data:"sponsor="+sponsor,
			   success: function(data){ 
				   if(data=="no"){
						alert('添加申办方失败');
				   }else{
					   $("#sponsor_company").append("<option value='"+data+"' selected='selected'>"+sponsor+"</option>"); //为Select追加一个Option(下拉项)
					   $("#sponsors").hide();
					   $("#but_sponsor").show();
						 
				   }				  
			   }
		   });
	
 }

  function add_field(){
	 $("#fields").show();
	 $("#but_field").hide();
 }

 function res_fields(){
	 $("#fields").hide();
	 $("#but_field").show();
 }


  function add_fields(){

	  var field=$("#field").val();
	  $.ajax({
			   type:"post",
			   url: "/index.php/admin/item_manage/add_field",
			   dataType:"json",
			   data:"field="+field,
			   success: function(data){ 
				   if(data=="no"){
						alert('添加领域失败');
				   }else{
					   $("#field_id").append("<option value='"+data+"' selected='selected'>"+sponsor+"</option>"); //为Select追加一个Option(下拉项)
					   $("#fields").hide();
					   $("#but_field").show();
						 
				   }				  
			   }
		   });
	
 }




 function add_cro(){
	 $("#cros").show();
	 $("#but_cro").hide();
 }

 function res_cros(){
	 $("#cros").hide();
	 $("#but_cro").show();
 }


  function add_cros(){

	  var cro=$("#cro").val();
	  $.ajax({
			   type:"post",
			   url: "/index.php/admin/item_manage/add_cro",
			   dataType:"json",
			   data:"cro="+cro,
			   success: function(data){ 
				   if(data=="no"){
						alert('添加cro公司失败');
				   }else{
					   $("#cro_company").append("<option value='"+data+"' selected='selected'>"+cro+"</option>"); //为Select追加一个Option(下拉项)
					   $("#cros").hide();
					   $("#but_cro").show();
						 
				   }				  
			   }
		   });
	
 }


 function add_smo(){
	 $("#smos").show();
	 $("#but_smo").hide();
 }

 function res_smos(){
	 $("#smos").hide();
	 $("#but_smo").show();
 }


  function add_smos(){

	  var smo=$("#smo").val();
	  $.ajax({
			   type:"post",
			   url: "/index.php/admin/item_manage/add_smo",
			   dataType:"json",
			   data:"smo="+smo,
			   success: function(data){ 
				   if(data=="no"){
						alert('添加smo公司失败');
				   }else{
					   $("#smo_company").append("<option value='"+data+"' selected='selected'>"+cro+"</option>"); //为Select追加一个Option(下拉项)
					   $("#smos").hide();
					   $("#but_smo").show();
						 
				   }				  
			   }
		   });
	
 }






$(document).ready(function() {

	 $(".select2").select2();

	   //  $(".select2").select2().on("select2:select",function(e){  
       // getClusterNodes($(this).val(),null);  
      // });  



	 $("#item_number").blur(function(){ 
		 var item_number=$("#item_number").val();
		 if(item_number.length!=32){
			 alert('项目编号长度为32位！');
			 return false;
		 
		 }else{
			 if(item_number.indexOf('LST-')==0){
				 $.ajax({
				   type:"post",
				   url: "/index.php/admin/item_manage/check_number",
				   dataType:"json",
				   data:"item_number="+item_number,
				   success: function(data){ 
					   if(data=="no"){
							alert('项目编号已存在，请重新填写！');
							return false;
					   }			  
				   }
			   });
			 }else{
				 alert('请以LST-开头命名');
			     return false;
				  
			 }
		 
		 }
	 
	 });


   $('#iForm').formValidation({
     framework: 'bootstrap',

     // Feedback icons
     icon: {
         valid: 'glyphicon glyphicon-ok',
         invalid: 'glyphicon glyphicon-remove',
         validating: 'glyphicon glyphicon-refresh'
     }, 

     fields: {
        name:{
           validators: {
            notEmpty: {message: '项目名称不可为空'},
            remote:{
              url: '/index.php/admin/item_manage/item_names_check',
              type: 'POST',  
              delay:800,
			data:{
                    id:function(){return $('#id').val()},
				    name:function(){return $('#name').val()}
				
               },
              message:'项目名称不合法或已使用,请更换'                    
            }
          }                 
        },
		'inis_id[]':{
          validators:{
             notEmpty: {message: '合作中心不可为空'},
			 remote:{
              url: '/index.php/admin/item_manage/inis_check',
              type: 'post',  
              delay:800,
			  data:{
                    inis_num:function(){return $('#inis_num').val()},
				    inis_id:function(){return $('#inis_id').val()}
				
               },
              message:'合作中心数量不匹配'                    
            }
          }
        },
		inis_num:{
          validators:{
             notEmpty: {message: '合作中心不可为空'},
			 remote:{
              url: '/index.php/admin/item_manage/inisn_check',
              type: 'post',  
              delay:800,
			  data:{
                    inis_num:function(){return $('#inis_num').val()},
				    inis_id:function(){return $('#inis_id').val()}
				
               },
              message:'合作中心数量不匹配'                    
            }
          }
        }

      }
   })
})     
</script>        
</body>
</html>


