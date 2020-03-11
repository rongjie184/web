<div>
<form id="follow_form" method="post" action=''>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">请填写随访模块信息：</h3>
            </div>
           
       <div class="box-body">
	    <div class="form-group">
					  <label for="c" class="col-sm-2 control-label">随访基线时间</label>
					  <div class="col-sm-6">
						  <label class="radio-inline">
                      <input type="radio" value="1" name="follow_basetime">首次用药时间
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="2" name="follow_basetime">入组时间
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="3" name="follow_basetime">其它
                    </label>
					  </div>
					   <div class="col-sm-2">
						   <div class='input-group date' id='datetimepicker2'>
								<input type='text' class="form-control" id="follow_time" name='follow_time'/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
					  </div>
                </div>

			
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">访视/随访窗</label>
                  <div class="col-sm-1">
					 <label class="checkbox-inline">距离基线时间 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="follow_times"  name='follow_times'> 
				</div>
				 <div class="col-sm-1">	  			  
						<select id='follow_type' name='follow_type' class="form-control select2">
						  <option value='1'>天</option> 
						  <option value='2'>周</option> 
						  <option value='3'>月</option> 
						  <option value='4'>年</option> 
						</select>
					</div>
                 <div class="col-sm-1">
					 <label class="checkbox-inline">访视窗类型 </label>
                  </div>
				
				 <div class="col-sm-1">	  			  
						<select id='follow_falt' name='follow_falt' class="form-control select2">
						  <option value='1'>+/-</option> 
						  <option value='2'>+</option> 
						  <option value='3'>-</option> 
						 
						</select>
					</div>
              

				  <div class="col-sm-1">
					 <label class="checkbox-inline">访视窗 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="follow_ftime"  name='follow_ftime'> 
				</div>
				 <div class="col-sm-1">	  			  
						<select id='follow_ftype' name='follow_ftype' class="form-control select2">
						  <option value='1'>天</option> 
						  <option value='2'>周</option> 
						  <option value='3'>月</option> 
						  <option value='4'>年</option> 
						</select>
					</div>
                </div>

				  <div class="form-group">
					  <label for="c" class="col-sm-1 control-label">随访总数</label>
					  <div class="col-sm-1">
						  <label class="radio-inline">
                      <input type="radio" value="1" name="follow_num_type">
                    </label>
					
					  </div>
					   <div class="col-sm-1">
						     <select id='follow_num' name='follow_num' class="form-control select2">
						 <?php for($ats=1;$ats<=30;$ats++){?>
						 <option value='<?=$ats?>'><?=$ats?></option>
						<?php }?>
						</select>
					  </div>
					   <label for="c" class="col-sm-1 control-label">次</label>
                </div>

				 <div class="form-group">
					  <label for="c" class="col-sm-1 control-label"></label>
					  <div class="col-sm-2">
						  <label class="radio-inline">
                      <input type="radio" value="2" name="follow_num_type">不限次数
                    </label>
					
					  </div>
					   <div class="col-sm-3">
						     <input type="text" class="form-control" id="follow_num_up"  name='follow_num_up' placeholder="请输入随访终止条件">
					  </div>
					
                </div>

				  <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="button" class="btn btn-info" id="add_follow">保存设置</button>
                  </div>
                </div>
              </div> 
              </form>


<form id="follows_form" method="post" action=''>
					 <div class="form-group">
					  <label for="c" class="col-sm-1 control-label">随访内容</label>	
                     </div>

					  <div class="form-group">
					  <label for="c" class="col-sm-1 control-label"></label>
						<label for="c" class="col-sm-2 control-label">随访次数:第</label>
					   <div class="col-sm-1">
						     <select id='follow_numon' name='follow_numon' class="form-control select2">
						 <?php for($ats=1;$ats<=30;$ats++){?>
						 <option value='<?=$ats?>'><?=$ats?></option>
						<?php }?>
						</select>
					  </div>
					   <label for="c" class="col-sm-1 control-label">次</label>

					   <label for="c" class="col-sm-1 control-label">随访方式</label>
					   <div class="col-sm-1">
						     <select id='follow_types' name='follow_types' class="form-control select2">						
						 <option value='1'>电话随访</option>
						 <option value='2'>回院随访</option>					
						</select>
					  </div>
                     </div>

				<div class="form-group">
                  <label for="c" class="col-sm-2 control-label">随访内容：</label>
				  <div class="col-sm-3">
					<label class="radio-inline">
                      <input type="radio" value="1" name="follow_distypes">症状询问
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="2" name="follow_distypes">检查
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="3" name="follow_distypes">其他
                    </label>
                  </div>
                </div>
				<div id="sfjianchaxiang" style="display:none;" class="form-group">
                   <label for="c" class="col-sm-2 control-label"></label>
				   <div class="col-sm-10">
				   <table id="example1" class="table table-bordered table-striped" style="width:100%">
                  <tr>
				  <td>体格检查
				   <input type="checkbox" id="all_sftg"/></td>
				  <td><table class="table table-bordered">
				  <tr>
					<td>头部</td>
					<td><?php  foreach($tglist1 as $ksf1=>$vsf1){?><input type="checkbox" value="<?=$ksf1?>" name="sftg[]"><?php echo $vsf1; }?></td>
				  </tr>
				  <tr>
					<td>颈部</td>
					<td><?php  foreach($tglist2 as $ksf2=>$vsf2){?><input type="checkbox" value="<?=$ksf2?>" name="sftg[]"><?php echo $vsf2; }?></td>
				  </tr>
				  <tr>
					<td>躯干</td>
					<td><?php  foreach($tglist3 as $ksf3=>$vsf3){?><input type="checkbox" value="<?=$ksf3?>" name="sftg[]"><?php echo $vsf3; }?></td>
				  </tr>
				  <tr>
					<td>四肢</td>
					<td><?php  foreach($tglist4 as $ksf4=>$vsf4){?><input type="checkbox" value="<?=$ksf4?>" name="sftg[]"><?php echo $vsf4; }?></td>
				  </tr>
				  </table></td>
				  </tr>
				   <tr>
				  <td>生命体征
				   <input type="checkbox" id="all_sfsm"/></td>
				  <td><?php  foreach($smlist as $kssf=>$vssf){?><input type="checkbox" value="<?=$kssf?>" name="sfsm[]"><?php echo $vssf; }?></td>
				  </tr>
				   <tr>
				  <td>常规检查
				 <input type="checkbox" id="all_sfcg"/></td>
				  <td><?php  foreach($cglist as $kcsf=>$vcsf){?><input type="checkbox" value="<?=$kcsf?>" name="sfcg[]"><?php echo $vcsf; }?></td>
				  </tr>
				   <tr>
				  <td>血生化检查
				  <input type="checkbox" id="all_sfxsh"/></td>
				  <td><?php  foreach($xshlist as $kxsf=>$vxsf){?><input type="checkbox" value="<?=$kxsf?>" name="sfxsh[]"><?php echo $vxsf; }?></td>
				  </tr>
				   <tr>
				  <td>超声检查
				   <input type="checkbox" id="all_sfcs"/></td>
				  <td><?php  foreach($cslist as $kasf=>$vasf){?><input type="checkbox" value="<?=$kasf?>" name="sfcs[]"><?php echo $vasf; }?></td>
				  </tr>
				   <tr>
				  <td>影像检查
				   <input type="checkbox" id="all_sfyx"/></td>
				  <td><table class="table table-bordered">
				  <tr>
					<td>头部</td>
					<td><?php  foreach($yxlist1 as $kysf1=>$vysf1){?><input type="checkbox" value="<?=$kysf1?>" name="sfyx[]"><?php echo $vysf1; }?></td>
				  </tr>
				  <tr>
					<td>颈部</td>
					<td><?php  foreach($yxlist2 as $kysf2=>$vysf2){?><input type="checkbox" value="<?=$kysf2?>" name="sfyx[]"><?php echo $vysf2; }?></td>
				  </tr>
				  <tr>
					<td>躯干</td>
					<td><?php  foreach($yxlist3 as $kysf3=>$vysf3){?><input type="checkbox" value="<?=$kysf3?>" name="sfyx[]"><?php echo $vysf3; }?></td>
				  </tr>
				  <tr>
					<td>四肢</td>
					<td><?php  foreach($yxlist4 as $kysf4=>$vysf4){?><input type="checkbox" value="<?=$kysf4?>" name="sfyx[]"><?php echo $vysf4; }?></td>
				  </tr>
				  </table></td>
				  </tr>
				   <tr>
				  <td>心电/脑电/肌电检查
				   <input type="checkbox" id="all_sfxd"/></td>
				  <td><?php  foreach($xdlist as $kbsf=>$vbsf){?><input type="checkbox" value="<?=$kbsf?>" name="sfxd[]"><?php echo $vbsf; }?></td>
				  </tr>
				   <tr>
				  <td>基因检查
				   <input type="checkbox" id="all_sfjy"/></td>
				  <td><?php  foreach($jylist as $kjsf=>$vjsf){?><input type="checkbox" value="<?=$kjsf?>" name="sfjy[]"><?php echo $vjsf; }?></td>
				  </tr>
				   <tr>
				  <td>其他
				   <input type="checkbox" id="all_sfqt"/></td>    
				  <td><?php  foreach($qtlist as $kqsf=>$vqsf){?><input type="checkbox" value="<?=$kqsf?>" name="sfqt[]"><?php echo $vqsf; }?></td>
				  </tr>

				   </table>
			   </div>
               </div>

			   	 <div class="form-group" id="sfsm" style="display:none;">
                  <label for="c" class="col-sm-2 control-label" id="shuoming">填写症状</label>
                  <div class="col-sm-8">
					<textarea name="follow_diss" id="follow_diss" class="form-control" rows="10" cols=""></textarea>
                  </div>
                </div>



					 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">注意事项</label>
                  <div class="col-sm-8">
					<textarea name="follow_notes" id="follow_notes" class="form-control" rows="10" cols=""></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">提醒设置</label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="sf_jc_mcrc" value="1" name="sf_jc_mcrc">提醒CRC
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="sf_jc_mtime"  name='sf_jc_mtime'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='sf_jc_mtimeunit' name='sf_jc_mtimeunit' class="form-control select2">
						  <option value='1'>小时</option> 
						  <option value='2'>天</option> 
							 
						</select>
					</div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="sf_jc_mhuanzhe" value="2" name="sf_jc_mhuanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="sf_jc_mtime1"  name='sf_jc_mtime1'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='sf_jc_mtimeunit1' name='sf_jc_mtimeunit1' class="form-control select2">
						  <option value='1'>小时</option> 
						   <option value='2'>天</option> 
						</select>
					</div>
                </div>

				  <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
					 <button type="button" class="btn btn-info" id="add_follow_dis_do">保存随访内容</button>
                  </div>
                </div>

				<div id="addsf">
				</div>



				</div>
				
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="button" class="btn btn-primary" id="add_follow_dis">添加随访内容</button>
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

<script type="text/javascript">

$(document).ready(function() {

	 	$('input[name="follow_distypes"]').click(function(){
	
			 if($(this).val()=='2'){
				 $('#sfjianchaxiang').show();//那么就显示div
				  $('#sfsm').hide();//那么就显示div
			 
			 }else{
				 $('#sfjianchaxiang').hide();//那么就显示div
				  $('#sfsm').show();//那么就显示div
				  if($(this).val()=='3'){
					 $("#shuoming").html('填写随访内容');
				  }else{
					   $("#shuoming").html('填写症状');
				  
				  }
			 
			 }  
  });
   $("#addsf").on("click","input[id^='all_']",function(){
		 var id=$(this).attr('id');
		 var sc=id.split('_');
		 var ids=sc[1];
		 var fnums=sc[2];
    　　// 使用attr只能执行一次
    　　$("input[name='"+ids+"_"+fnums+"[]']").attr("checked", $(this).attr("checked")); 
    
    　　// 使用prop则完美实现全选和反选
    　　$("input[name='"+ids+"_"+fnums+"[]']").prop("checked", $(this).prop("checked"));

　　　　// 获取所有选中的项并把选中项的文本组成一个字符串
    　　var str = '';
    　　$($("input[name='"+ids+"_"+fnums+"[]']:checked")).each(function(){
        　　str += $(this).next().text() + ',';
    　　});
　　});


  $("#addsf").on("click","input[name^='follow_distypes_']",function(){
	  var id=$(this).attr("id");
	  var ids=id.split('_');
	  var fnumss=ids[2];
	 if($(this).val()=='2'){
				 $('#sfjianchaxiang_'+fnumss).show();//那么就显示div
				  $('#sfsm_'+fnumss).hide();//那么就显示div
			 
			 }else{
				 $('#sfjianchaxiang_'+fnumss).hide();//那么就显示div
				  $('#sfsm_'+fnumss).show();//那么就显示div
				  if($(this).val()=='3'){
					 $('#shuoming_'+fnumss).html('填写随访内容');
				  }else{
					   $('#shuoming_'+fnumss).html('填写症状');
				  
				  }
			 
			 }
			
  });

	$(".select2").select2();

	 $("#addsf").on("click","input[id^='add_follow_dis_do_']",function(){
		  var id=$(this).attr("id");
		  var ids=id.split('_');
		  var fnumss=ids[2];

		  var testid=$("#testid").val();
		if(testid==null||testid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}
		var follow_count=$("#follow_numon_"+fnumss).val();
		var follow_way=$("#follow_types_"+fnumss).val();
		var follow_detail=$('input[name="follow_num_type_'+fnumss+'"]:checked ').val();
		var follow_notes=$("#follow_notes_"+fnumss).val();
		var follow_diss=$("#follow_diss_"+fnumss).val();
		var sf_jc_mcrc=$("#sf_jc_mcrc_"+fnumss).val();
		var sf_jc_mtime=$("#sf_jc_mtime_"+fnumss).val();
		var sf_jc_mtimeunit=$("#sf_jc_mtimeunit_"+fnumss).val();
		var sf_jc_mhuanzhe=$("#sf_jc_mhuanzhe_"+fnumss).val();
		var sf_jc_mtime1=$("#sf_jc_mtime1_"+fnumss).val();
		var sf_jc_mtimeunit1=$("#sf_jc_mtimeunit1_"+fnumss).val();
		var sf_jc_tg=$.map(  $('input[name="sftg_'+fnumss+'[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var sf_jc_sm=$.map(  $('input[name="sfsm_'+fnumss+'[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var sf_jc_cg=$.map(  $('input[name="sfcg_'+fnumss+'[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var sf_jc_xsh=$.map(  $('input[name="sfxsh_'+fnumss+'[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		 var sf_jc_cs=$.map(  $('input[name="sfcs_'+fnumss+'[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var sf_jc_yx=$.map(  $('input[name="sfyx_'+fnumss+'[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var sf_jc_xd=$.map(  $('input[name="sfxd_'+fnumss+'[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var sf_jc_jy=$.map(  $('input[name="sfjy_'+fnumss+'[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		 var sf_jc_qt=$.map(  $('input[name="sfqt_'+fnumss+'[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_follow", //传递的URL
			data:"items_id="+items_id+"&pro_id="+pro_id+"&follow_count="+follow_count+"&follow_way="+follow_way+"&follow_detail="+follow_detail+"&follow_notes="+follow_notes+"&follow_diss="+follow_diss+"&sf_jc_mcrc="+sf_jc_mcrc+"&sf_jc_mtime="+sf_jc_mtime+"&sf_jc_mtimeunit="+sf_jc_mtimeunit+"&sf_jc_mhuanzhe="+sf_jc_mhuanzhe+"&sf_jc_mtime1="+sf_jc_mtime1+"&sf_jc_mtimeunit1="+sf_jc_mtimeunit1+"&sftg="+sf_jc_tg+"&sfsm="+sf_jc_sm+"&sfcg="+sf_jc_cg+"&sfxsh="+sf_jc_xsh+"&scs="+sf_jc_cs+"&sfyx="+sf_jc_yx+"&sfxd="+sf_jc_xd+"&sfjy="+sf_jc_jy+"&sfqt="+sf_jc_qt,
			async:false,
			success: function(res)//如果成功执行的函数
			{
				if(res<=0){
					alert('添加失败，请稍后重试！');
					return false;
				}else{     
				   alert('添加成功');
				   
				}
			}
			})





	 });
	$("#add_follow_dis_do").click(function (){
		var testid=$("#testid").val();
		if(testid==null||testid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}
		var items_id=$("#itemsid").val();	
		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_follow", //传递的URL
			data:$("#follows_form").serialize()+"&items_id="+items_id+"&pro_id="+pro_id,
			async:false,
			success: function(res)//如果成功执行的函数
			{
				if(res<=0){
					alert('添加失败，请稍后重试！');
					return false;
				}else{     
				   alert('添加成功');
				   
				}
			}
			})

	});

		$("#add_follow_dis_do").click(function (){
		var testid=$("#testid").val();
		if(testid==null||testid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}
       var items_id=$("#itemsid").val();

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_follow_base", //传递的URL
			data:$("#follow_form").serialize()+"&items_id="+items_id+"&pro_id="+pro_id,
			async:false,
			success: function(res)//如果成功执行的函数
			{
				if(res<=0){
					alert('添加失败，请稍后重试!');
					return false;
				}else{     
				   alert('添加成功');
				   
				}
			}
			})

	});

		$("#add_follow_dis").click(function (){
			var follow_count_num=$(".follow_do").length;
			var fnum=follow_count_num+1;
			var con='<div class="form-group"><label for="c" class="col-sm-1 control-label">随访内容</label></div><div class="form-group"><label for="c" class="col-sm-1 control-label"></label><label for="c" class="col-sm-2 control-label">随访次数:第</label> <div class="col-sm-1"> <select id="follow_numon_'+fnum+'" name="follow_numon_'+fnum+'" class="form-control select2"><?php for($ats=1;$ats<=30;$ats++){?><option value="<?=$ats?>"><?=$ats?></option><?php }?></select></div><label for="c" class="col-sm-1 control-label">次</label><label for="c" class="col-sm-1 control-label">随访方式</label> <div class="col-sm-1"><select id="follow_types_'+fnum+'" name="follow_types_'+fnum+'" class="form-control select2"><option value="1">电话随访</option><option value="2">回院随访</option></select></div></div><div class="form-group"><label for="c" class="col-sm-2 control-label">随访内容：</label><div class="col-sm-3"><label class="radio-inline"><input type="radio" value="1" name="follow_distypes_'+fnum+'" id="follow_distypes_'+fnum+'" >症状询问</label><label class="radio-inline"><input type="radio" value="2" name="follow_distypes_'+fnum+'" id="follow_distypes_'+fnum+'" >检查</label><label class="radio-inline"><input type="radio" value="3" name="follow_distypes_'+fnum+'" id="follow_distypes_'+fnum+'" >其他</label> </div></div><div id="sfjianchaxiang_'+fnum+'" style="display:none;" class="form-group"><label for="c" class="col-sm-2 control-label"></label><div class="col-sm-10"> <table id="example1" class="table table-bordered table-striped" style="width:100%"><tr> <td>体格检查<input type="checkbox" id="all_sftg_'+fnum+'" /></td><td><table class="table table-bordered"><tr><td>头部</td><td><?php  foreach($tglist1 as $ksf1=>$vsf1){?><input type="checkbox" value="<?=$ksf1?>" name="sftg_'+fnum+'[]"><?php echo $vsf1; }?></td></tr><tr><td>颈部</td><td><?php  foreach($tglist2 as $ksf2=>$vsf2){?><input type="checkbox" value="<?=$ksf2?>" name="sftg_'+fnum+'[]"><?php echo $vsf2; }?></td></tr><tr><td>躯干</td><td><?php  foreach($tglist3 as $ksf3=>$vsf3){?><input type="checkbox" value="<?=$ksf3?>" name="sftg_'+fnum+'[]"><?php echo $vsf3; }?></td></tr><tr><td>四肢</td><td><?php  foreach($tglist4 as $ksf4=>$vsf4){?><input type="checkbox" value="<?=$ksf4?>" name="sftg_'+fnum+'[]"><?php echo $vsf4; }?></td></tr></table></td></tr><tr><td>生命体征<input type="checkbox" id="all_sfsm_'+fnum+'" /></td><td><?php  foreach($smlist as $kssf=>$vssf){?><input type="checkbox" value="<?=$kssf?>" name="sfsm_'+fnum+'[]"><?php echo $vssf; }?></td></tr><tr><td>常规检查<input type="checkbox" id="all_sfcg_'+fnum+'" /></td><td><?php  foreach($cglist as $kcsf=>$vcsf){?><input type="checkbox" value="<?=$kcsf?>" name="sfcg_'+fnum+'[]"><?php echo $vcsf; }?></td></tr><tr><td>血生化检查<input type="checkbox" id="all_sfxsh_'+fnum+'" /></td><td><?php  foreach($xshlist as $kxsf=>$vxsf){?><input type="checkbox" value="<?=$kxsf?>" name="sfxsh_'+fnum+'[]"><?php echo $vxsf; }?></td></tr><tr><td>超声检查<input type="checkbox" id="all_sfcs_'+fnum+'" /></td><td><?php  foreach($cslist as $kasf=>$vasf){?><input type="checkbox" value="<?=$kasf?>" name="sfcs_'+fnum+'[]"><?php echo $vasf; }?></td></tr> <tr><td>影像检查<input type="checkbox" id="all_sfyx_'+fnum+'" /></td><td><table class="table table-bordered"><tr><td>头部</td><td><?php  foreach($yxlist1 as $kysf1=>$vysf1){?><input type="checkbox" value="<?=$kysf1?>" name="sfyx_'+fnum+'[]"><?php echo $vysf1; }?></td></tr><tr><td>颈部</td><td><?php  foreach($yxlist2 as $kysf2=>$vysf2){?><input type="checkbox" value="<?=$kysf2?>" name="sfyx_'+fnum+'[]"><?php echo $vysf2; }?></td></tr><tr><td>躯干</td><td><?php  foreach($yxlist3 as $kysf3=>$vysf3){?><input type="checkbox" value="<?=$kysf3?>" name="sfyx_'+fnum+'[]"><?php echo $vysf3; }?></td></tr><tr><td>四肢</td><td><?php  foreach($yxlist4 as $kysf4=>$vysf4){?><input type="checkbox" value="<?=$kysf4?>" name="sfyx_'+fnum+'[]"><?php echo $vysf4; }?></td></tr></table></td></tr><tr><td>心电/脑电/肌电检查<input type="checkbox" id="all_sfxd_'+fnum+'" /></td><td><?php  foreach($xdlist as $kbsf=>$vbsf){?><input type="checkbox" value="<?=$kbsf?>" name="sfxd_'+fnum+'[]"><?php echo $vbsf; }?></td></tr><tr><td>基因检查<input type="checkbox" id="all_sfjy_'+fnum+'" /></td><td><?php  foreach($jylist as $kjsf=>$vjsf){?><input type="checkbox" value="<?=$kjsf?>" name="sfjy_'+fnum+'[]"><?php echo $vjsf; }?></td> </tr><tr><td>其他<input type="checkbox" id="all_sfqt_'+fnum+'" /></td> <td><?php  foreach($qtlist as $kqsf=>$vqsf){?><input type="checkbox" value="<?=$kqsf?>" name="sfqt_'+fnum+'[]"><?php echo $vqsf; }?></td></tr></table></div></div><div class="form-group" id="sfsm_'+fnum+'" style="display:none;"><label for="c" class="col-sm-2 control-label" id="shuoming_'+fnum+'">填写症状</label><div class="col-sm-8"><textarea name="follow_diss_'+fnum+'" id="follow_diss_'+fnum+'" class="form-control" rows="10" cols=""></textarea></div></div><div class="form-group"><label for="c" class="col-sm-2 control-label">注意事项</label> <div class="col-sm-8"><textarea name="follow_notes_'+fnum+'" id="follow_notes_'+fnum+'" class="form-control" rows="10" cols=""></textarea></div></div><div class="form-group"><label for="c" class="col-sm-2 control-label">提醒设置</label><div class="col-sm-2"><label class="radio-inline"><input type="radio" id="sf_jc_mcrc_'+fnum+'" value="1" name="sf_jc_mcrc_'+fnum+'">提醒CRC</label></div></div> <div class="form-group"><label for="c" class="col-sm-2 control-label"></label><div class="col-sm-2"><label class="checkbox-inline">提醒时间：提前 </label></div><div class="col-sm-1"><input type="text" class="form-control" id="sf_jc_mtime_'+fnum+'"  name="sf_jc_mtime_'+fnum+'"> </div><div class="col-sm-1">	<select id="sf_jc_mtimeunit_'+fnum+'" name="sf_jc_mtimeunit_'+fnum+'" class="form-control select2"> <option value="1">小时</option> <option value="2">天</option></select></div></div> <div class="form-group"><label for="c" class="col-sm-2 control-label"></label><div class="col-sm-2"><label class="radio-inline"> <input type="radio" id="sf_jc_mhuanzhe_'+fnum+'" value="2" name="sf_jc_mhuanzhe_'+fnum+'">提醒患者</label></div></div><div class="form-group"><label for="c" class="col-sm-2 control-label"></label><div class="col-sm-2"> <label class="checkbox-inline">提醒时间：提前 </label></div><div class="col-sm-1"> <input type="text" class="form-control" id="sf_jc_mtime1_'+fnum+'"  name="sf_jc_mtime1_'+fnum+'"></div> <div class="col-sm-1"><select id="sf_jc_mtimeunit1_'+fnum+'" name="sf_jc_mtimeunit1_'+fnum+'" class="form-control select2"><option value="1">小时</option><option value="2">天</option> </select></div></div><div class="form-group"><div class="col-sm-offset-2 col-sm-4"><button type="button" class="btn btn-info follow_do"  id="add_follow_dis_do_'+fnum+'">保存随访内容</button></div></div>';

			$("#addsf").append(con);
		
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
        }
		
      }
   });
})     



</script>



