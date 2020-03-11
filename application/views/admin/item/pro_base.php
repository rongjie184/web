


<div>
<form id="base_form" method="post" action=''>
      
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">请填写基础模块信息：</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">
                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">方案名称</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="name"  name='name' placeholder="请输入方案名称">
                  </div>            
                </div>
				   <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">试验类型</label>
                  <div class="col-sm-6" id="test_id">
						
					
                  </div>
                </div>

				 <div class="form-group" id="class" style="display:none;">
                  <label for="c" class="col-sm-2 control-label">试验分期</label>
                  <div class="col-sm-10"  id="drug_id">
							
                  </div>
                </div>

                <div class="form-group" id="mf">
                  <label for="c" class="col-sm-2 control-label">盲法</label>
                  <div class="col-sm-3">
						  <?php
							foreach($methods as $key=>$value){		
						  ?>

						   <label class="radio-inline">
                      <input type="radio" value="<?=$key?>" name="blind"><?=$value?>
                    </label>

						  <?php
							
							}
						  ?>
					
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">周期</label>
                  <div class="col-sm-1">
                    <select id='cycle' name='cycle' class="form-control select2" onchange="changecyle();">
						
						  <?php
							for($i=1;$i<20;$i++){		
						  ?>
						  <option value='<?=$i?>'><?=$i?></option>
						  <?php
							
							}
						  ?>
						</select>
                  </div>

				   <label for="c" class="col-sm-1 control-label">交叉</label>
                  <div class="col-sm-1">
                    <select id='cross' name='cross' class="form-control select2">
						
						  <?php
							for($i=1;$i<6;$i++){		
						  ?>
						  <option value='<?=$i?>'><?=$i?></option>
						  <?php
							
							}
						  ?>
						</select>
                  </div>

				   <label for="c" class="col-sm-1 control-label">序列</label>
                  <div class="col-sm-1">
                    <select id='order' name='order' class="form-control select2">
						 <option value='0'>无</option>
						  <?php
							for($i=1;$i<20;$i++){		
						  ?>
						  <option value='<?=$i?>'><?=$i?></option>
						  <?php
							
							}
						  ?>
						</select>
                  </div>
                </div>


				

			<div class="form-group">
                  <label for="c" class="col-sm-2 control-label">试验干预类别</label>
                  <div class="col-sm-3">
					<label class="radio-inline">
                      <input type="radio" value="1" name="meddle_type">无对照
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="2" name="meddle_type">对照
                    </label>
                  </div>
                </div>

				<div class="form-group" id="dzz" style="display:none;">
                  <label for="c" class="col-sm-2 control-label">对照方式</label>
                  <div class="col-sm-6">
					<label class="radio-inline">
                      <input type="radio" value="1" name="meddle_id">安慰剂试剂对照
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="2" name="meddle_id">参比对照
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="3" name="meddle_id">空白对照
                    </label>
                  </div>
                </div>

	<div class="form-group" id="dzzs" style="display:none;">
                  <label for="c" class="col-sm-2 control-label">对照方式</label>
                  <div class="col-sm-6">
					<label class="radio-inline">
                      <input type="radio" value="4" name="meddle_id">自身对照
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="5" name="meddle_id">组间对照
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="6" name="meddle_id">空白组间对照
                    </label>
                  </div>
                </div>

              

			  <div class="form-group" id="qxq" style="display:none;">
                  <label for="zh_action" class="col-sm-2 control-label">清洗期</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="washout_time"  name='washout_time'>
                  </div>
				  <div class="col-sm-4">
				     <select id='washout_type' name='washout_type' class="form-control select2">
						 <option value='1'>小时</option>
						 <option value='2'>天</option>
						 <option value='3'>周</option>
						 <option value='4'>月</option>
						
						</select>
                    
                  </div>
                 
                </div>
	            <div class="form-group">
				  <label for="c" class="col-sm-2 control-label" id="fs"></label>
                  <div class="col-sm-1">
                    <select id='use_methods' name='use_methods' class="form-control select2">
						 <option value='1'>单次</option>
						 <option value='2'>多次</option>
						
						</select>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label" id="ftime">首次用药时间</label>
                  <div class="col-sm-3">

				       <div class='input-group date' id='datetimepicker2'>
							<input type='text' class="form-control" id="first_use_time" name='first_use_time'/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>

                  </div>
                </div>


					 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">入组时间</label>
                  <div class="col-sm-3">

				       <div class='input-group date' id='datetimepicker2'>
							<input type='text' class="form-control" id="first_time" name='first_time'/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>

                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">基线日期</label>
                  <div class="col-sm-3">

				       <div class='input-group date' id='datetimepicker2'>
							<input type='text' class="form-control" id="base_time" name='base_time'/>
							<span class="input-group-addon">
								<span class="glyphicon glyphicon-calendar"></span>
							</span>
						</div>

                  </div>
                </div>


				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">入组标准</label>
                  <div class="col-sm-8">
					<textarea name="inclusion_criteria" id="inclusion_criteria" class="form-control" rows="10" cols=""></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">排除标准</label>
                  <div class="col-sm-8">
					<textarea name="exclusion_criteria" id="exclusion_criteria" class="form-control" rows="10" cols=""></textarea>
                  </div>
                </div>


				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">合并用药</label>
                  <div class="col-sm-8">
					<textarea name="drug_combination" id="drug_combination" class="form-control" rows="10" cols=""></textarea>
                  </div>
                </div>


				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">用药禁忌</label>
                  <div class="col-sm-8">
					<textarea name="drug_taboos" id="drug_taboos" class="form-control" rows="10" cols=""></textarea>
                  </div>
                </div>


				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">不良事件</label>
                  <div class="col-sm-8">
					<textarea name="adverse_event" id="adverse_event" class="form-control" rows="10" cols=""></textarea>
                  </div>
                </div>
             </div> 

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="button" class="btn btn-info" id="add_base">添加</button>
                  </div>
                </div>
              </div>
     
          </div>
          <!-- /.box -->
		  </form>
</div>



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

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
<script type="text/javascript">



$(function(){	
	
  	$('input[name="meddle_type"]').click(function(){
		var testid=$('#testid').val();
		if(testid==1){
			 $("#dzzs").hide();	 
			 if($(this).val()=='1'){
				   $("#dzz").hide();	  
			   }else if($(this).val()=='2'){
				   $("#dzz").show();		  
			   }
		
		}else if(testid==2){
			$("#dzz").hide();	
			 if($(this).val()=='1'){
				   $("#dzzs").hide();	  
			   }else if($(this).val()=='2'){
				   $("#dzzs").show();		  
			   }
		
		}
	  
  });




 
 });

 function changecyle(){
  var num=parseInt($("#cycle").val());
	  if(num>1){
		  $("#qxq").show(); 
	  }else{
		  $("#qxq").hide();
	  
	  }
 }


</script>

<script type="text/javascript">

$(document).ready(function() {

	$(".select2").select2();
	$("#add_base").click(function (){
		var testid=$("#testid").val();
		if(testid==null||testid==""){
			alert('请选择项目');
			return false;
		}
		var name=$("#name").val();
		if(name==null||name==""){
			alert('请填写方案名称');
			return false;
		}	
		var itemsid=$("#itemsid").val();	
	    var formdate=$("#base_form").serialize();
		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_base", //传递的URL
			data:formdate+"&itemsid="+itemsid,
			async:false,
			success: function(res)//如果成功执行的函数
			{
				if(res<=0){
					alert('添加失败，请稍后重试！');
					return false;
				}else{     
				   $('#pro_id').val(res);  
				   $("#mokuai_jc").hide();	
				   $("#mokuai_gy").show();	
				   $("#blind_id").val($("input[name='blind']:checked").val());
				   $("#meddletype").val($("input[name='meddle_type']:checked").val());
				   $("#meddleid").val($("input[name='meddle_id']:checked").val());
				   $("#cycle_id").val($("#cycle").val());
				   $("#cross_id").val($("#cross").val());
				   $("#order_id").val($("#order").val());
				   $("#tb_jiaocha").val($("#cross").val());
				   $("#tb_xulie").val($("#order").val());
				    $("#tb_jiaochas").val($("#cross").val());
				   $("#tb_xulies").val($("#order").val());
				   $("#usemethods").val($("#use_methods").val());	 
				   alert('添加成功');
                  if($("#testid").val()==1){
					   if($("#order_id").val()>0){
						   var num=parseInt($("#order_id").val());
						    $("#fzsjnum").val(num);
						   if($("#meddletype").val()==1){
                                $("#form-yp_cb").hide();
								$("#form-yp_awj").hide();
							   $("#group_num").val($("#order_id").val());							  
						   }else{
							   if($("#meddleid").val()==1){
								    $("#form-yp_cb").hide();
									$("#form-yp_awj").show();
							   
							   }else if($("#meddleid").val()==2){
								   $("#form-yp_cb").show();
								   $("#form-yp_awj").hide();
							   }
							   $("#group_num").val(parseInt($("#order_id").val())+1); 
						   }
						   $("#group_num").attr("readonly","readonly");//设为只读
						   
						   //实验分组 内容 

						   if(num>0){
							   var numbody='';
							   var numbodys='';
							   for(var i=1;i<=num;i++){
									numbody+='<div class="form-group"><label for="c" class="col-sm-2 control-label">实验组'+i+'</label><div class="col-sm-2"><input type="text" name="fzgroupnames[]" id="fzgroupnames" class="form-control" placeholder="请填写药物剂量"></div><label for="c" class="col-sm-1 control-label">药品代码</label><div class="col-sm-2"><input type="text" name="fzgroupcodes[]" id="fzgroupcode" class="form-control" placeholder="请填写药物剂量"></div></div>';

									numbodys+='<div id="ppfz_'+i+'" class="form-group"><label for="c" class="col-sm-2 control-label">组'+i+'使用药物代码</label> <div  id="pp_fzcode_'+i+'"><div class="col-sm-1"><input type="text" name="ppgroupnames'+i+'[]" id="ppgroupnames" class="form-control" ></div></div> <label for="c" class="col-sm-1 control-label"><button type="button" class="glyphicon-plus" onclick="add_codes('+i+')"></button></label><label for="c" class="col-sm-1 control-label"><button type="button" class="glyphicon-minus" onclick="del_codes('+i+')"></button></label></div>';

							   }

							   if($("#cross").val()>0){
								   var c=parseInt($("#cross").val())+1;
								   var nums=num+1;
								   var table='<table id="example1" class="table table-bordered">';
								   for(var rows=0;rows<nums;rows++){
								   table+='<tr>';
								   for(var spans=0;spans<c;spans++){
									    if(rows==0){
											if(spans==0){
												table+='<td>序列/周期</td>';
												}else{
													table+='<td>第'+spans+'周期</td>';
												}
										 }else{
											 	if(spans==0){
												table+='<td><input type="text" name="yptbxl_'+rows+'" id="yptbxl_'+rows+'" class="form-control" placeholder="序列'+rows+'命名"></td>';
												}else{
													table+='<td><input type="text" name="yptbjc_'+rows+'_'+spans+'" id="yptbjc_'+rows+'_'+spans+'" class="form-control" placeholder="周期'+spans+'药物代码"></td>';
												}
										 }
								   
								   }
								  
								   table+='</tr>';


								   
								   }

								   table+='</table>';
							   
							      $("#tb_table").html(table);
							   }
							   $("#gy_fz_num").html(numbody);  
							   $("#gy_pp_fz").html(numbodys);  
								var zqnum=parseInt($("#cycle").val());
								var use_methods=parseInt($("#use_methods").val());
								if(use_methods==1){
									$("#yp_xq_dc").show();
									$("#yp_xq_mc").hide();
								}else if(use_methods==2){
									$("#yp_xq_dc").hide();
									$("#yp_xq_mc").show();
								
								}

							   if(zqnum>0){
								   for(var k=1;k<=zqnum;k++){
									   $("#yp_cx_cycle").append("<option value='"+k+"'>"+k+"</option>");
									   $("#yp_jc_cycle").append("<option value='"+k+"'>"+k+"</option>");
									   $("#yp_xq_cycle").append("<option value='"+k+"'>"+k+"</option>"); 
									   $("#yp_xqm_cycle").append("<option value='"+k+"'>"+k+"</option>"); 
								   }
								
							   
							   }
						   }
					   }
				  }else if($("#testid").val()==2){

					     if($("#meddletype").val()==1){
								$("#form-yp_cb").hide();
						 }else{
							   $("#form-yp_cb").show();					 
						 }
					  	var qzqnum=parseInt($("#cycle").val());
						  if(qzqnum>0){
								   for(var kq=1;kq<=qzqnum;kq++){
									   $("#qx_xqm_cycle").append("<option value='"+kq+"'>"+kq+"</option>");
									   $("#qx_cx_cycle").append("<option value='"+kq+"'>"+kq+"</option>");
									   $("#qx_jc_cycle").append("<option value='"+kq+"'>"+kq+"</option>");  
								   } 
							   }

							     if($("#order_id").val()>0){
										   var qnum1=parseInt($("#order_id").val());
											$("#fzsjnums").val(num);
											$("#qxgroup_num").val($("#order_id").val());							  
										  if($("#cross").val()>0){
										   var qxc=parseInt($("#cross").val())+1;
										   var qnum1s=qnum1+1;
										   var table='<table id="example1" class="table table-bordered">';
										   for(var rows=0;rows<qnum1s;rows++){
										   table+='<tr>';
										   for(var spans=0;spans<qxc;spans++){
												if(rows==0){
													if(spans==0){
														table+='<td>序列/周期</td>';
														}else{
															table+='<td>第'+spans+'周期</td>';
														}
												 }else{
														if(spans==0){
														table+='<td><input type="text" name="qxtbxl_'+rows+'" id="qxtbxl_'+rows+'" class="form-control" placeholder="序列'+rows+'命名"></td>';
														}else{
															table+='<td><input type="text" name="qxtbjc_'+rows+'_'+spans+'" id="qxtbjc_'+rows+'_'+spans+'" class="form-control" placeholder="周期'+spans+'器械代码"></td>';
														}
												 }
										   
										   }
										  
										   table+='</tr>';


										   
										   }

										   table+='</table>';
									   
										  $("#qx_tb").html(table);
									   }
								 }


				  }
				}
			}
			})

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
		  itemsid:{
           validators: {
            notEmpty: {message: '请选择项目'}
          }                 
        },
        name:{
           validators: {
            notEmpty: {message: '方案名称不可为空'},
            remote:{
              url: '/index.php/admin/item_manage/item_name_check',
              type: 'POST',  
              delay:800,
              message:'方案名称不合法或已使用,请更换'                    
            }
          }                 
        }
		
      }
   });
})     
</script>        




