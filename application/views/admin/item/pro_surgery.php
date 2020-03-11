<div>
  <form id="sergery_form" method="post" action=''>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">请填写手术模块信息：</h3>
            </div>
           
       <div class="box-body">
			 <div class="form-group">
					  <label for="c" class="col-sm-2 control-label">手术日期</label>
					  <div class="col-sm-2">
						   <div class='input-group date' id='datetimepicker2'>
								<input type='text' class="form-control" id="surgery_time" name='surgery_time'/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
					  </div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">注意事项</label>
                  <div class="col-sm-8">
					<textarea name="surgery_notes" id="surgery_notes" class="form-control" rows="10" cols=""></textarea>
                  </div>
                </div>


				 <div class="form-group">
					  <label for="c" class="col-sm-2 control-label">手术提醒设置</label>
					  <div class="col-sm-2">
						<label class="radio-inline">
						  <input type="radio" id="ss_mcrc" value="1" name="ss_mcrc">提醒CRC
						</label>
					  </div>
					</div>

					 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="ss_mtime"  name='ss_mtime'> 
				</div>
				 <div class="col-sm-1">	  			  
						<select id='ss_mtimeunit' name='ss_mtimeunit' class="form-control select2">
						  <option value='1'>小时</option> 
						  <option value='2'>天</option> 
							 
						</select>
					</div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="ss_mhuanzhe" value="2" name="ss_mhuanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="ss_mtime1"  name='ss_mtime1'> 
				</div>
				 <div class="col-sm-1">	  			  
						<select id='ss_mtimeunit1' name='ss_mtimeunit1' class="form-control select2">
						  <option value='1'>小时</option> 
						   <option value='2'>天</option> 
						</select>
					</div>
                </div>


				  <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">术后评估窗</label>
                  <div class="col-sm-1">
				    <select id='assess_time' name='assess_time' class="form-control select2">
					 	 <option value='0'>无</option>
						 <?php for($at=1;$at<=10;$at++){?>
						 <option value='<?=$at?>'><?=$at?></option>
						<?php }?>
						</select>

                  </div>
				  <div class="col-sm-1">
				     <select id='assess_type' name='assess_type' class="form-control select2">
					 	 <option value='0'>无</option>
						 <option value='1'>小时</option>
						 <option value='2'>天</option>
						 <option value='3'>周</option>
						 <option value='4'>月</option>
						 <option value='5'>年</option>
						</select> 
                  </div>  
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">术后评估内容</label>
                  <div class="col-sm-8">
					<textarea name="assess_dis" id="assess_dis" class="form-control" rows="8" cols="5"></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">注意事项</label>
                  <div class="col-sm-8">
					<textarea name="assess_notes" id="assess_notes" class="form-control" rows="10" cols=""></textarea>
                  </div>
                </div>



				<div class="form-group">
					  <label for="c" class="col-sm-2 control-label">术后评估窗提醒设置</label>
					  <div class="col-sm-2">
						<label class="radio-inline">
						  <input type="radio" id="ss_amcrc" value="1" name="ss_amcrc">提醒CRC
						</label>
					  </div>
					</div>

					 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间： </label>
                  </div>
				   <div class="col-sm-1">	  			  
						<select id='ss_aqian' name='ss_aqian' class="form-control select2">
						  <option value='1'>术前</option> 
						  <option value='2'>术后</option> 	 
						</select>
					</div>

				<div class="col-sm-1">
				  <input type="text" class="form-control" id="ss_atime"  name='ss_atime'> 
				</div>
				 <div class="col-sm-1">	  			  
						<select id='ss_amtimeunit' name='ss_amtimeunit' class="form-control select2" onchange="xiantian();">
						  <option value='1'>小时</option> 
						  <option value='2'>天</option> 
							 
						</select>
					</div>
                </div>
				<div id="ss_acrc" style="display:none;" class="form-group">
					   <label for="c" class="col-sm-5 control-label">具体时间</label>
					 <div class="col-sm-1">	  			  
						<select id='ss_amtimeunits' name='ss_amtimeunits' class="form-control select2">
						<?php for($ac=1;$ac<=24;$ac++){?>
						  <option value='<?=$ac?>:00'><?=$ac?>:00</option> 
						<?php }?>
						</select>
					</div>
                  </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="ss_amhuanzhe" value="2" name="ss_amhuanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间 </label>
                  </div>
				  <div class="col-sm-1">	  			  
						<select id='ss_aqians' name='ss_aqians' class="form-control select2">
						  <option value='1'>术前</option> 
						  <option value='2'>术后</option> 	 
						</select>
					</div>

				<div class="col-sm-1">
				  <input type="text" class="form-control" id="ss_amtime1"  name='ss_amtime1'> 
				</div>
				 <div class="col-sm-1">	  			  
						<select id='ss_amtimeunit1' name='ss_amtimeunit1' class="form-control select2" onchange="xiantians();">
						  <option value='1'>小时</option> 
						   <option value='2'>天</option> 
						</select>
					</div>
                </div>
				<div id="ss_ahuanzhe" style="display:none;" class="form-group">
					   <label for="c" class="col-sm-5 control-label">具体时间</label>
					 <div class="col-sm-1">	  			  
						<select id='ss_amtimeunit1s' name='ss_amtimeunit1s' class="form-control select2">
						<?php for($ac=1;$ac<=24;$ac++){?>
						  <option value='<?=$ac?>:00'><?=$ac?>:00</option> 
						<?php }?>
						</select>
					</div>
                  </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">手术相关检查</label> 
				  <div class="col-sm-1">	  			  
						<select id='ss_cqians' name='ss_cqians' class="form-control select2">
						  <option value='1'>术前</option> 
						  <option value='2'>术后</option> 	 
						</select>
					</div>

				<div class="col-sm-1">
				  <input type="text" class="form-control" id="ss_cmtime1"  name='ss_cmtime1'> 
				</div>
				 <div class="col-sm-1">	  			  
						<select id='ss_cmtimeunit1' name='ss_cmtimeunit1' class="form-control select2">
						  <option value='1'>小时</option> 
						  <option value='2'>天</option> 
						  <option value='3'>周</option> 
						  <option value='4'>月</option> 
						</select>
					</div>
                </div>


					<div class="form-group">
                  <label for="c" class="col-sm-2 control-label">检查项：</label>
                  <div class="col-sm-1">
					  <button type="button" class="btn btn-info" id="add_ss_jcx">+</button>
                  </div>
                </div>
				<div id="ssjianchaxiang" style="display:none;" class="form-group">
                   <label for="c" class="col-sm-2 control-label"></label>
				   <div class="col-sm-10">
				   <table id="example1" class="table table-bordered table-striped" style="width:100%">
                  <tr>
				  <td>体格检查
				   <input type="checkbox" id="all_sstg"/></td>
				  <td><table class="table table-bordered">
				  <tr>
					<td>头部</td>
					<td><?php  foreach($tglist1 as $kss1=>$vss1){?><input type="checkbox" value="<?=$kss1?>" name="sstg[]"><?php echo $vss1; }?></td>
				  </tr>
				  <tr>
					<td>颈部</td>
					<td><?php  foreach($tglist2 as $kss2=>$vss2){?><input type="checkbox" value="<?=$kss2?>" name="sstg[]"><?php echo $vss2; }?></td>
				  </tr>
				  <tr>
					<td>躯干</td>
					<td><?php  foreach($tglist3 as $kss3=>$vss3){?><input type="checkbox" value="<?=$kss3?>" name="sstg[]"><?php echo $vss3; }?></td>
				  </tr>
				  <tr>
					<td>四肢</td>
					<td><?php  foreach($tglist4 as $kss4=>$vss4){?><input type="checkbox" value="<?=$kss4?>" name="sstg[]"><?php echo $vss4; }?></td>
				  </tr>
				  </table></td>
				  </tr>
				   <tr>
				  <td>生命体征
				   <input type="checkbox" id="all_sssm"/></td>
				  <td><?php  foreach($smlist as $ksss=>$vsss){?><input type="checkbox" value="<?=$ksss?>" name="sssm[]"><?php echo $vsss; }?></td>
				  </tr>
				   <tr>
				  <td>常规检查
				 <input type="checkbox" id="all_sscg"/></td>
				  <td><?php  foreach($cglist as $kcss=>$vcss){?><input type="checkbox" value="<?=$kcss?>" name="sscg[]"><?php echo $vcss; }?></td>
				  </tr>
				   <tr>
				  <td>血生化检查
				  <input type="checkbox" id="all_ssxsh"/></td>
				  <td><?php  foreach($xshlist as $kxss=>$vxss){?><input type="checkbox" value="<?=$kxss?>" name="ssxsh[]"><?php echo $vxss; }?></td>
				  </tr>
				   <tr>
				  <td>超声检查
				   <input type="checkbox" id="all_sscs"/></td>
				  <td><?php  foreach($cslist as $kass=>$vass){?><input type="checkbox" value="<?=$kass?>" name="sscs[]"><?php echo $vass; }?></td>
				  </tr>
				   <tr>
				  <td>影像检查
				   <input type="checkbox" id="all_ssyx"/></td>
				  <td><table class="table table-bordered">
				  <tr>
					<td>头部</td>
					<td><?php  foreach($yxlist1 as $kyss1=>$vyss1){?><input type="checkbox" value="<?=$kyss1?>" name="ssyx[]"><?php echo $vyss1; }?></td>
				  </tr>
				  <tr>
					<td>颈部</td>
					<td><?php  foreach($yxlist2 as $kyss2=>$vyss2){?><input type="checkbox" value="<?=$kyss2?>" name="ssyx[]"><?php echo $vyss2; }?></td>
				  </tr>
				  <tr>
					<td>躯干</td>
					<td><?php  foreach($yxlist3 as $kyss3=>$vyss3){?><input type="checkbox" value="<?=$kyss3?>" name="ssyx[]"><?php echo $vyss3; }?></td>
				  </tr>
				  <tr>
					<td>四肢</td>
					<td><?php  foreach($yxlist4 as $kyss4=>$vyss4){?><input type="checkbox" value="<?=$kyss4?>" name="ssyx[]"><?php echo $vyss4; }?></td>
				  </tr>
				  </table></td>
				  </tr>
				   <tr>
				  <td>心电/脑电/肌电检查
				   <input type="checkbox" id="all_ssxd"/></td>
				  <td><?php  foreach($xdlist as $kbss=>$vbss){?><input type="checkbox" value="<?=$kbss?>" name="ssxd[]"><?php echo $vbss; }?></td>
				  </tr>
				   <tr>
				  <td>基因检查
				   <input type="checkbox" id="all_ssjy"/></td>
				  <td><?php  foreach($jylist as $kjss=>$vjss){?><input type="checkbox" value="<?=$kjss?>" name="ssjy[]"><?php echo $vjss; }?></td>
				  </tr>
				   <tr>
				  <td>其他
				   <input type="checkbox" id="all_ssqt"/></td>    
				  <td><?php  foreach($qtlist as $kqss=>$vqss){?><input type="checkbox" value="<?=$kqss?>" name="ssqt[]"><?php echo $vqss; }?></td>
				  </tr>

				   </table>
			   </div>
               </div>

					 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">注意事项</label>
                  <div class="col-sm-8">
					<textarea name="ss_jc_dis" id="ss_jc_dis" class="form-control" rows="5" cols="8"></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">提醒设置</label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="ss_jc_mcrc" value="1" name="ss_jc_mcrc">提醒CRC
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="ss_jc_mtime"  name='ss_jc_mtime'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='ss_jc_mtimeunit' name='ss_jc_mtimeunit' class="form-control select2">
						  <option value='1'>小时</option> 
						  <option value='2'>天</option> 
							 
						</select>
					</div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="ss_jc_mhuanzhe" value="2" name="ss_jc_mhuanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="ss_jc_mtime1"  name='ss_jc_mtime1'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='ss_jc_mtimeunit1' name='ss_jc_mtimeunit1' class="form-control select2">
						  <option value='1'>小时</option> 
						   <option value='2'>天</option> 
						</select>
					</div>
                </div>

				</div>
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="button" class="btn btn-info" id="add_surgery">添加</button>
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

 function xiantian(){
  var ss_amtimeunit=parseInt($("#ss_amtimeunit").val());
	  if(ss_amtimeunit==2){
		  $("#ss_acrc").show(); 
	  }else{
		  $("#ss_acrc").hide();
	  
	  }
 }

  function xiantians(){
  var ss_amtimeunit1=parseInt($("#ss_amtimeunit1").val());
	  if(ss_amtimeunit1==2){
		  $("#ss_ahuanzhe").show(); 
	  }else{
		  $("#ss_ahuanzhe").hide();
	  
	  }
 }




$(document).ready(function() {

	 $('#add_ss_jcx').click(function(){//点击a标签
		if($('#ssjianchaxiang').is(':hidden')){//如果当前隐藏
		$('#ssjianchaxiang').show();//那么就显示div
		}else{//否则
		$('#ssjianchaxiang').hide();//就隐藏div
		}
    })


	$(".select2").select2();
	$("#add_surgery").click(function (){
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
	
        var itemsid=$("#itemsid").val();	
		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_surgery", //传递的URL
			data:$("#sergery_form").serialize()+"&items_id="+itemsid+"&pro_id="+pro_id,
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




