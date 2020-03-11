<div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">请填写干预模块信息：</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->           
              <div class="box-body"  id="gy_yp">
                <div class="form-group text-center">
				  <label class="col-sm-10 control-label">
				  <button type="button" class="btn btn-success" id="yp_sj">试验试剂</button>
				  <button type="button" class="btn btn-success" id="yp_cb">参比试剂</button>
				  <button type="button" class="btn btn-success" id="yp_awj">安慰剂</button>
				  <button type="button" class="btn btn-success" id="yp_lh">联合用药</button>
				  <button type="button" class="btn btn-success" id="yp_fz">试验分组</button>
				  <button type="button" class="btn btn-success" id="yp_pp">试验药物匹配</button>
				  <button type="button" class="btn btn-success" id="yp_tb">交叉图表</button>
				  <button type="button" class="btn btn-success" id="yp_xq">药物使用详情</button>
				  <button type="button" class="btn btn-success" id="yp_cx">采血</button>
				  <button type="button" class="btn btn-success" id="yp_jc">检查</button>
                  </label>
				</div>
             </div>

			 
           
              <div class="box-body  form-btn-success" id="form-yp_sj" style="display:none;">
			  <form id="ypsj_form" method="post" action=''>
					  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">试验试剂名称</label>
						  <div class="col-sm-4">
							<input type="text" name="tiname" id="tiname" class="form-control">
						  </div>
						</div>
						 <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">用药方式</label>
						  <div class="col-sm-2">
						     <select id='use_type' name='use_type' class="form-control select2">
						
						  <?php
							foreach($use_type_list as $key=> $value){ 
						  ?>
						  <option value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select>
							
						  </div>
						</div>

						 <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">单位</label>
						  <div class="col-sm-2">
						  <select id='use_unit' name='use_unit' class="form-control select2">
						
						  <?php
							foreach($use_unit_list as $key=> $value){ 
						  ?>
						  <option value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select>
						  </div>
						</div>

						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_sssj">添加</button>
							  </div>
							</div>
						  </div>  



			</form>
            </div>


			  <div class="box-body  form-btn-success" id="form-yp_cb" style="display:none;">
			    <form id="ypcb_form" method="post" action=''>
					  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">参比试剂名称</label>
						  <div class="col-sm-4">
							<input type="text" name="tinames" id="tinames" class="form-control">
						  </div>
						</div>

						 <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">用药方式</label>
						  <div class="col-sm-2">
						     <select id='use_types' name='use_types' class="form-control select2">
						
						  <?php
							foreach($use_type_list as $key=> $value){ 
						  ?>
						  <option value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select>
							
						  </div>
						</div>

						 <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">单位</label>
						  <div class="col-sm-2">
						  <select id='use_units' name='use_units' class="form-control select2">
						
						  <?php
							foreach($use_unit_list as $key=> $value){ 
						  ?>
						  <option value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select>
						  </div>
						</div>

						  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">剂量</label>
						  <div class="col-sm-4">
							<input type="text" name="tigroupname" id="tigroupname" class="form-control">
						  </div>
						</div>



						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_cbsj">添加</button>
							  </div>
							</div>
						  </div>  
              </form>
            </div>

			<div class="box-body  form-btn-success" id="form-yp_awj" style="display:none;">
			  <form id="ypawj_form" method="post" action=''>
					  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">安慰剂代码</label>
						  <div class="col-sm-4">
							<input type="text" name="awjname" id="awjname" class="form-control">
						  </div>
						</div>
						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_awj">添加</button>
							  </div>
							</div>
						  </div>
						  </form>
            </div>


		  <div class="box-body  form-btn-success" id="form-yp_lh" style="display:none;">
		    <form id="yplh_form" method="post" action=''>
		  <div id="lh">
					  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">联合用药药品名称</label>
						  <div class="col-sm-4">
							<input type="text" name="lhtinames[]" id="lhtinames" class="form-control">
						  </div>
						</div>

						 <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">用药方式</label>
						  <div class="col-sm-2">
						     <select id='lhuse_types_1' name='lhuse_types[]' class="form-control select2">
						
						  <?php
							foreach($use_type_list as $key=> $value){ 
						  ?>
						  <option value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select>
							
						  </div>
						</div>

						 <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">单位</label>
						  <div class="col-sm-2">
						  <select id='lhuse_units_1' name='lhuse_units[]' class="form-control select2">
						
						  <?php
							foreach($use_unit_list as $key=> $value){ 
						  ?>
						  <option value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select>
						  </div>
						</div>

						<div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">用药剂量</label>
						  <div class="col-sm-2">
							<input type="text" name="lhgroupname[]" id="lhgroupname_1" class="form-control">
						  </div>
						   <label for="c" class="col-sm-1 control-label">药品代码</label>
						  <div class="col-sm-2">
							<input type="text" name="lhgroupcode[]" id="lhgroupcode_1" class="form-control">
						  </div>
						</div>

                    </div>

					<div id="add_button">
						<div class="form-group">
							 <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-primary" id="add_div">添加联合用药</button> 
							 </div>
						</div>
					</div>
						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_lh">添加</button>
							  </div>
							</div>
						  </div>  
            </form>
            </div>


			  <div class="box-body  form-btn-success" id="form-yp_fz" style="display:none;">
		  <form id="ypfz_form" method="post" action=''>
					  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">试验组别</label>
						  <div class="col-sm-2">
							<input type="text" name="group_num" id="group_num" class="form-control">
							  <input type="hidden" name="fzsjreagent_id" id="fzsjreagent_id" class="form-control">
							   <input type="hidden" name="fzsjnum" id="fzsjnum" class="form-control">
						  </div>
						</div>

						 <div class="form-group" id="gy_fz_dzz">
						  <label for="c" class="col-sm-2 control-label">对照组</label>
						  
                           <input type="hidden" name="fzreagent_id" id="fzreagent_id" class="form-control">
						   <input type="hidden" name="fzgroupname" id="fzgroupname" class="form-control">
						  <div class="col-sm-2" id="fz_dzzname">
						  </div>

						   <label for="c" class="col-sm-1 control-label">药品代码</label>
						  <div class="col-sm-2">
                            <input type="text" name="fzgroupcode" id="fzgroupcode" class="form-control">
						  </div>
		
                    </div>
					<div class="form-group" id="gy_fz_num">
							</div>

						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_fz">添加</button>
							  </div>
							</div>
						  </div>  
             </form>
            </div>


			<div class="box-body  form-btn-success" id="form-yp_pp" style="display:none;">
		              <form id="yppp_form" method="post" action=''>
					  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">药品代码</label>
						  <div  id="pp_mname">
						  <div class="col-sm-1">
							<input type="text" name="mname[]" id="mname" class="form-control">
							</div>
						  </div>
						   <label for="c" class="col-sm-1 control-label"><button type="button" class="glyphicon-plus" id="add_code"></button></label>
						   <label for="c" class="col-sm-1 control-label"><button type="button" class="glyphicon-minus" id="del_code"></button></label>
						</div>

						 <div class="form-group">
						  <label for="zh_action" class="col-sm-2 control-label">药品分组</label>
						  <div class="col-sm-1">
							<input type="text" class="form-control" id="pp_groupnum"  name='pp_groupnum'>
						  </div>            
						</div>


						 <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">药物匹配代码</label>	 
						</div>

						 <div id="gy_pp_fz"> 
							
						</div>

							
                  
						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_pp">添加</button>
							  </div>
							</div>
						  </div>  
						  </form>

            </div>

				<div class="box-body  form-btn-success" id="form-yp_tb" style="display:none;">
				  <form id="yptb_form" method="post" action=''>
		            <div class="form-group">
						 <label for="c" class="col-sm-2 control-label">交叉</label>
						  <div class="col-sm-1">
								<input type="text" class="form-control yp_tb" id="tb_jiaocha"  name='tb_jiaocha'>
						</div>
						<label for="c" class="col-sm-2 control-label">序列</label>
						  <div class="col-sm-1">
								<input type="text" class="form-control yp_tb" id="tb_xulie"  name='tb_xulie'>
						</div>
					</div>
					  <div class="form-group" id="tb_table"> 
					  </div>


						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_tb">添加</button>
							  </div>
							</div>
						  </div>  
						  </form>

            </div>

				<div class="box-body  form-btn-success" id="form-yp_xq" style="display:none;">
                   
                     <div id="yp_xq_dc"   style="display:none;">
					   <form id="ypxqd_form" method="post" action=''>
		              <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">周期</label>
						  <div class="col-sm-1">
								<select id='yp_xq_cycle' name='yp_xq_cycle' class="form-control select2" onchange="changebzq();">  
								</select>
						  </div>
                         </div>
						   <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">首次用药时间</label>
						  <div class="col-sm-6">
								<select id='yp_xqd_usetime' name='yp_xqd_usetime' class="form-control select2">
								</select>
						  </div>
					</div>

				<div class="form-group">
                  <label for="c" class="col-sm-2 control-label">用药规则</label>
                  <div class="col-sm-3">
				 <label class="radio-inline">
                      <input type="radio" value="1" name="ypd_is_repast">与就餐相关
                   </label>
				   <label class="radio-inline">
                      <input type="radio" value="2" name="ypd_is_repast">与就餐无关
                   </label>
                  </div>
                </div>

				  <div class="form-group" id="d_time" style="display:none;">
                  <label for="c" class="col-sm-2 control-label">用药时间</label>
                  <div class="col-sm-3">
				    <select id='dnot_repast_time' name='dnot_repast_time' class="form-control select2">
						  <?php
							for($i=5;$i<23;$i++){		
						  ?>
							<option value='<?=$i?>:00'><?=$i?>:00</option>
						   

						  <?php
							
							}
						  ?>
					</select>
                  </div>
                </div>
                 <div  id="d_ctime" style="display:none;">
				 <div class="form-group">
				  <label for="c" class="col-sm-2 control-label"></label>
				   <div class="col-sm-2">
                  <label class="radio-inline">
                      <input type="radio" value="1" name="d_can">餐前
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="2" name="d_can">餐中
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="3" name="d_can">餐后
                    </label> 
				</div>
                </div>
				 <div class="form-group">
				  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2" >
                    <select id='dcshijian' name='dcshijian' class="form-control select2" onchange="changedctime();">
						  <option value='1'>距离用餐时间</option> 
						  <option value='2'>距离用餐时间段</option> 
				    </select>
                  </div>
				   <div class="col-sm-1">
                    <input type="text" class="form-control" id="dchmin"  name='dchmin'>
                  </div> 
				  <div class="col-sm-1">
				  <select id='dctime1' name='dctime1' class="form-control select2">
						  <option value='1'>分钟</option> 
						  <option value='2'>小时</option> 
						</select>
                  </div>
                  <div id="dcshijianduan" style="display:none;">
				 <label for="zh_action" class="col-sm-1 control-label">至</label>
				 <div class="col-sm-1">
                    <input type="text" class="form-control" id="dchmin2"  name='dchmin2'>
                  </div> 
				  <div class="col-sm-1">			 
				  <select id='dctime2' name='dctime2' class="form-control select2">
						  <option value='1'>分钟</option> 
						  <option value='2'>小时</option> 
						</select>
                  </div>
                 </div>
                </div>
              </div>
			   <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">用药说明</label>
                  <div class="col-sm-6">
					<textarea name="dexplains" id="dexplains" class="form-control" rows="5" cols=""></textarea>
                  </div>
                </div>


				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">用药禁忌</label>
                  <div class="col-sm-6">
					<textarea name="dtabu" id="dtabu" class="form-control" rows="5" cols=""></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">用药提醒</label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="tx_crc" value="1" name="tx_crc">提醒CRC
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="tx_dtime"  name='tx_dtime'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='tx_dtimeunit' name='tx_dtimeunit' class="form-control select2">
						  <option value='1'>分钟</option> 
						  <option value='2'>小时</option> 
						    <option value='3'>天</option> 
							  <option value='4'>周</option> 
							    <option value='5'>月</option> 
						</select>
					</div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="tx_huanzhe" value="2" name="tx_huanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="tx_dtime1"  name='tx_dtime1'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='tx_dtimeunit1' name='tx_dtimeunit1' class="form-control select2">
						  <option value='1'>分钟</option> 
						  <option value='2'>小时</option> 
						    <option value='3'>天</option> 
							  <option value='4'>周</option> 
							    <option value='5'>月</option> 
						</select>
					</div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">此规则同时适用</label> 
				 <div class="col-sm-1" id="ypxq_gz">	  			  
						<label class="checkbox-inline">
						  <input type="checkbox" id="tb_dzhouqi" value="2" name="ypxq_tbdzq[]"> 2
						</label>

					</div>
                </div>



						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_xqd">添加</button>
							  </div>
							</div>
						  </div> 
						  </form>
                   </div>

				   <div id="yp_xq_mc" style="display:none;">
				     <form id="ypxqm_form" method="post" action=''>
				     <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">周期</label>
						  <div class="col-sm-1">
								<select id='yp_xqm_cycle' name='yp_xqm_cycle' class="form-control select2" onchange="changebmzq();">
								</select>
						  </div>
					</div>

					 <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">用药时间</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="yp_xqm_usetime"  name='yp_xqm_usetime' placeholder="匹配上患者后填写">
                  </div>            
                </div>

			<div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">用药次数</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="m_totalnum"  name='m_totalnum' >
                  </div>            
                </div>

				<div class="form-group">
                  <label for="c" class="col-sm-2 control-label">用药规则</label>
                  <div class="col-sm-3">
				 <label class="radio-inline">
                      <input type="radio" value="1" name="ypd_is_law">规律
                   </label>
				   <label class="radio-inline">
                      <input type="radio" value="2" name="ypd_is_law">不规律
                   </label>
                  </div>
                </div>

				<div class="form-group">
				  <label for="c" class="col-sm-2 control-label">药品类型</label>
                  <div class="col-sm-3">
                    <select id='m_drug_types' name='m_drug_types' class="form-control select2">
						 <option value='1'>试验试剂和参比试剂</option>
						 <option value='2'>联合用药</option>
						</select>
                  </div>
                </div>


				<div id="ypxq_mguilv" style="display:none;">
				 

				 <div class="form-group">
				  <label for="c" class="col-sm-2 control-label">用药规律</label>
                  <div class="col-sm-3">
                    <select id='m_drug_law' name='m_drug_law' class="form-control select2" onchange="changedruglaw();">
						 <option value='1'>连续用药</option>
						 <option value='2'>间隔用药</option>
						</select>
                  </div>
                </div>
			
			   <div id="m_lianxu">

			    <div class="form-group">
				  <label for="c" class="col-sm-2 control-label">连续用药</label>
				  <div class="col-sm-1">
                   <input type='text' class="form-control" id="m_drug_lawlnum" name='m_drug_lawlnum'/>
                  </div>
                  <div class="col-sm-1">
                    <select id='m_drug_lawlunit' name='m_drug_lawlunit' class="form-control select2">
						 <option value='1'>日</option>
						 <option value='2'>周</option>
						 <option value='3'>月</option>
						 <option value='4'>年</option>
						</select>
                  </div>
                </div>	

				 <div class="form-group">
				  <label for="c" class="col-sm-2 control-label">每日用药频率</label>
				  <div class="col-sm-8">
                  <label class="radio-inline">
                      <input type="radio" value="1" name="m_frequencies">一天一次
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="2" name="m_frequencies">一天两次
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="3" name="m_frequencies">一天三次
                    </label>
					<label class="radio-inline">
                      <input type="radio" value="4" name="m_frequencies">一天四次
                    </label>
                  </div>
                
                </div>	

				 <div class="form-group">
				  <label for="c" class="col-sm-2 control-label">用药与就餐关系</label>
				   <div class="col-sm-8"  id="m_ycgx">
                  <label class="radio-inline" id="m_can_1">
                      <input type="radio" value="1" name="m_can">餐前
                    </label>
					<label class="radio-inline" id="m_can_2">
                      <input type="radio" value="2" name="m_can">餐中
                    </label>
					<label class="radio-inline" id="m_can_3">
                      <input type="radio" value="3" name="m_can">餐后
                    </label> 
					<label class="radio-inline" id="m_can_4">
                      <input type="radio" value="4" name="m_can">与餐无关
                    </label> 
				</div>
			   </div>

				 <div class="form-group" id="m_lx_can">
				  <label for="c" class="col-sm-2 control-label">就餐时间间隔</label>        
				   <div class="col-sm-1">
                    <input type="text" class="form-control" id="mchmin"  name='mchmin'>
                  </div> 
				  <div class="col-sm-1">
				  <select id='mctime' name='mctime' class="form-control select2">
						  <option value='1'>分钟</option> 
						  <option value='2'>小时</option> 
						</select>
                  </div>
				  </div>
                  <div  id="m_lx_wcan">
				   <div class="form-group">
                   <label for="c" class="col-sm-2 control-label">两次用药时间间隔</label>  
				   <label class="radio-inline">
							 <input type="radio" value="2" name="mg_can">无要求
                    </label> 
				   	<label class="radio-inline">
						<input type="radio" value="1" name="mg_can">间隔  
					</label> 
					</div>
					<div class="form-group">
					 <label for="c" class="col-sm-2 control-label"></label> 
					 <div class="col-sm-1">
							<input type="text" class="form-control" id="mchmin1"  name='mchmin1'>
						</div>
					  <label for="c" class="radio-inline">小时</label>
				  </div>
                </div>
				  	<div class="form-group">
				  <label for="c" class="col-sm-2 control-label">一天内用药时间设置</label>
				  <label for="c" class="col-sm-1 control-label">第一次</label>
				  <div class="col-sm-1">
                     <select id='mg_drug_lawftime' name='mg_drug_lawftime' class="form-control select2">
						  <?php
							for($i=5;$i<23;$i++){		
						  ?>
							<option value='<?=$i?>:00'><?=$i?>:00</option>					
						  <?php							
							}
						  ?>
					</select>
                  </div>                  
                </div>


				</div>


			</div>
				<div id="ypxq_mbuguilv" style="display:none;">	
					 <div id="m_buguilvlist">
					  

					 </div>
				</div>

	<div id="m_jiange" style="display:none;">
				 <div class="form-group">
				  <label for="c" class="col-sm-2 control-label">两次用药时间间隔</label>
				  <div class="col-sm-1">
                   <input type='text' class="form-control" id="m_drug_lawnum" name='m_drug_lawnum'/>
                  </div>
                  <div class="col-sm-1">
                    <select id='m_drug_lawunit' name='m_drug_lawunit' class="form-control select2">
						 <option value='1'>日</option>
						 <option value='2'>周</option>
						 <option value='3'>月</option>
						 <option value='4'>年</option>
						</select>
                  </div>
                </div>				
				<div class="form-group" id="m_j_num">
				  <label for="c" class="col-sm-2 control-label">用药日用药次数</label>
				  <div class="col-sm-1">
                   <input type='text' class="form-control" id="m_drug_lawnums" name='m_drug_lawnums'/>
                  </div>
                    <label for="c" class="col-sm-1 control-label">次</label>
                </div>
				<div class="form-group">
				  <label for="c" class="col-sm-2 control-label">用药日用药时间</label>
				  <label for="c" class="col-sm-1 control-label">第一次</label>
				  <div class="col-sm-1">
                     <select id='m_drug_lawftime' name='m_drug_lawftime' class="form-control select2">
						  <?php
							for($i=5;$i<23;$i++){		
						  ?>
							<option value='<?=$i?>:00'><?=$i?>:00</option>					
						  <?php							
							}
						  ?>
					</select>
                  </div>                  
                </div>

               </div>


			   <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">用药说明</label>
                  <div class="col-sm-6">
					<textarea name="mexplains" id="mexplains" class="form-control" rows="5" cols=""></textarea>
                  </div>
                </div>


				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">用药禁忌</label>
                  <div class="col-sm-6">
					<textarea name="mtabu" id="mtabu" class="form-control" rows="5" cols=""></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">用药提醒</label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="tx_mcrc" value="1" name="tx_mcrc">提醒CRC
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="tx_mtime"  name='tx_mtime'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='tx_mtimeunit' name='tx_mtimeunit' class="form-control select2">
						  <option value='1'>分钟</option> 
						  <option value='2'>小时</option> 
						    <option value='3'>天</option> 
							  <option value='4'>周</option> 
							    <option value='5'>月</option> 
						</select>
					</div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="tx_mhuanzhe" value="2" name="tx_mhuanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="tx_mtime1"  name='tx_mtime1'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='tx_mtimeunit1' name='tx_mtimeunit1' class="form-control select2">
						  <option value='1'>分钟</option> 
						  <option value='2'>小时</option> 
						    <option value='3'>天</option> 
							  <option value='4'>周</option> 
							    <option value='5'>月</option> 
						</select>
					</div>
                </div>



				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">此规则同时适用</label> 
				 <div class="col-sm-1" id="ypxq_mgz">	  			  
						<label class="checkbox-inline">
						  <input type="checkbox" id="tb_dmzhouqi" value="2" name="ypxq_tbdmzq[]"> 2
						</label>
					</div>
                </div>


						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_xqm">添加</button>
							  </div>
							</div>
						  </div>
						  </form>
				   </div>
            </div>

				<div class="box-body  form-btn-success" id="form-yp_cx" style="display:none;">
				  <form id="ypcx_form" method="post" action=''>
		             <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">周期</label>
						  <div class="col-sm-6">
								<select id='yp_cx_cycle' name='yp_cx_cycle' class="form-control select2">
								</select>
						  </div>
					</div>

					 <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">用药轮次：第</label>
						  <div class="col-sm-1">
								<select id='yp_cx_drug' name='yp_cx_drug' class="form-control select2">
								
								</select>
						  </div>
						   <label for="c"  class="col-sm-1 control-label">次用药</label>
					</div>

					 <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">时间</label>
						  <div class="col-sm-1">
								<select id='yp_cx_qh' name='yp_cx_qh' class="form-control select2">
								 <option value='1'>前</option>
								<option value='2'>后</option>
								</select>
						  </div>
						     <div class="col-sm-1">
							 	<input type='text' class="form-control" id="yp_cx_time" name='yp_cx_time'/>
							 </div>
						     <div class="col-sm-1">
								<select id='yp_cx_ttype' name='yp_cx_ttype' class="form-control select2">
								 <option value='1'>分钟</option>
								<option value='2'>小时</option>
								</select>
						  </div>
					</div>

					 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">采血说明</label>
                  <div class="col-sm-8">
					<textarea name="yp_cx_dis" id="yp_cx_dis" class="form-control" rows="5" cols="8"></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">提醒设置</label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="yp_cx_mcrc" value="1" name="yp_cx_mcrc">提醒CRC
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="yp_cx_mtime"  name='yp_cx_mtime'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='yp_cx_mtimeunit' name='yp_cx_mtimeunit' class="form-control select2">
						  <option value='1'>小时</option> 
						  <option value='2'>天</option> 
							 
						</select>
					</div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="yp_cx_mhuanzhe" value="2" name="yp_cx_mhuanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="yp_cx_mtime1"  name='yp_cx_mtime1'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='yp_cx_mtimeunit1' name='yp_cx_mtimeunit1' class="form-control select2">
						  <option value='1'>小时</option> 
						   <option value='2'>天</option> 
						</select>
					</div>
                </div>
 
						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_cx">添加</button>
							  </div>
							</div>
						  </div>  
                  </form>
            </div>

			<div class="box-body  form-btn-success" id="form-yp_jc" style="display:none;">
			  <form id="ypjc_form" method="post" action=''>
		              <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">周期</label>
						  <div class="col-sm-6">
								<select id='yp_jc_cycle' name='yp_jc_cycle' class="form-control select2">
								</select>
						  </div>
					</div>

					 <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">用药轮次：第</label>
						  <div class="col-sm-1">
								<select id='yp_jc_drug' name='yp_jc_drug' class="form-control select2">
								
								</select>
						  </div>
						   <label for="c"  class="col-sm-1 control-label">次用药</label>
					</div>

					 <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">时间</label>
						  <div class="col-sm-1">
								<select id='yp_jc_qh' name='yp_jc_qh' class="form-control select2">
								 <option value='1'>前</option>
								<option value='2'>后</option>
								</select>
						  </div>
						     <div class="col-sm-1">
							 	<input type='text' class="form-control" id="yp_jc_time" name='yp_jc_time'/>
							 </div>
						     <div class="col-sm-1">
								<select id='yp_jc_ttype' name='yp_jc_ttype' class="form-control select2">
								 <option value='1'>分钟</option>
								<option value='2'>小时</option>
								</select>
						  </div>
					</div>

				<div class="form-group">
                  <label for="c" class="col-sm-2 control-label">检查项：</label>
                  <div class="col-sm-1">
					  <button type="button" class="btn btn-info" id="add_yp_jcx">+</button>
                  </div>
                </div>
				<div id="jianchaxiang" style="display:none;" class="form-group">
                   <label for="c" class="col-sm-2 control-label"></label>
				   <div class="col-sm-10">
				   <table id="example1" class="table table-bordered table-striped" style="width:100%">
                  <tr>
				  <td>体格检查
				   <input type="checkbox" id="all_tg"/></td>
				  <td><table class="table table-bordered">
				  <tr>
					<td>头部</td>
					<td><?php  foreach($tglist1 as $k1=>$v1){?><input type="checkbox" value="<?=$k1?>" name="tg[]"><?php echo $v1; }?></td>
				  </tr>
				  <tr>
					<td>颈部</td>
					<td><?php  foreach($tglist2 as $k2=>$v2){?><input type="checkbox" value="<?=$k2?>" name="tg[]"><?php echo $v2; }?></td>
				  </tr>
				  <tr>
					<td>躯干</td>
					<td><?php  foreach($tglist3 as $k3=>$v3){?><input type="checkbox" value="<?=$k3?>" name="tg[]"><?php echo $v3; }?></td>
				  </tr>
				  <tr>
					<td>四肢</td>
					<td><?php  foreach($tglist4 as $k4=>$v4){?><input type="checkbox" value="<?=$k4?>" name="tg[]"><?php echo $v4; }?></td>
				  </tr>
				  </table></td>
				  </tr>
				   <tr>
				  <td>生命体征
				   <input type="checkbox" id="all_sm"/></td>
				  <td><?php  foreach($smlist as $ks=>$vs){?><input type="checkbox" value="<?=$ks?>" name="sm[]"><?php echo $vs; }?></td>
				  </tr>
				   <tr>
				  <td>常规检查
				 <input type="checkbox" id="all_cg"/></td>
				  <td><?php  foreach($cglist as $kc=>$vc){?><input type="checkbox" value="<?=$kc?>" name="cg[]"><?php echo $vc; }?></td>
				  </tr>
				   <tr>
				  <td>血生化检查
				  <input type="checkbox" id="all_xsh"/></td>
				  <td><?php  foreach($xshlist as $kx=>$vx){?><input type="checkbox" value="<?=$kx?>" name="xsh[]"><?php echo $vx; }?></td>
				  </tr>
				   <tr>
				  <td>超声检查
				   <input type="checkbox" id="all_cs"/></td>
				  <td><?php  foreach($cslist as $ka=>$va){?><input type="checkbox" value="<?=$ka?>" name="cs[]"><?php echo $va; }?></td>
				  </tr>
				   <tr>
				  <td>影像检查
				   <input type="checkbox" id="all_yx"/></td>
				  <td><table class="table table-bordered">
				  <tr>
					<td>头部</td>
					<td><?php  foreach($yxlist1 as $ky1=>$vy1){?><input type="checkbox" value="<?=$ky1?>" name="yx[]"><?php echo $vy1; }?></td>
				  </tr>
				  <tr>
					<td>颈部</td>
					<td><?php  foreach($yxlist2 as $ky2=>$vy2){?><input type="checkbox" value="<?=$ky2?>" name="yx[]"><?php echo $vy2; }?></td>
				  </tr>
				  <tr>
					<td>躯干</td>
					<td><?php  foreach($yxlist3 as $ky3=>$vy3){?><input type="checkbox" value="<?=$ky3?>" name="yx[]"><?php echo $vy3; }?></td>
				  </tr>
				  <tr>
					<td>四肢</td>
					<td><?php  foreach($yxlist4 as $ky4=>$vy4){?><input type="checkbox" value="<?=$ky4?>" name="yx[]"><?php echo $vy4; }?></td>
				  </tr>
				  </table></td>
				  </tr>
				   <tr>
				  <td>心电/脑电/肌电检查
				   <input type="checkbox" id="all_xd"/></td>
				  <td><?php  foreach($xdlist as $kb=>$vb){?><input type="checkbox" value="<?=$kb?>" name="xd[]"><?php echo $vb; }?></td>
				  </tr>
				   <tr>
				  <td>基因检查
				   <input type="checkbox" id="all_jy"/></td>
				  <td><?php  foreach($jylist as $kj=>$vj){?><input type="checkbox" value="<?=$kj?>" name="jy[]"><?php echo $vj; }?></td>
				  </tr>
				   <tr>
				  <td>其他
				   <input type="checkbox" id="all_qt"/></td>    
				  <td><?php  foreach($qtlist as $kq=>$vq){?><input type="checkbox" value="<?=$kq?>" name="qt[]"><?php echo $vq; }?></td>
				  </tr>

				   </table>
			   </div>
               </div>

					 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">注意事项</label>
                  <div class="col-sm-8">
					<textarea name="yp_jc_dis" id="yp_jc_dis" class="form-control" rows="5" cols="8"></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">提醒设置</label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="yp_jc_mcrc" value="1" name="yp_jc_mcrc">提醒CRC
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="yp_jc_mtime"  name='yp_jc_mtime'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='yp_jc_mtimeunit' name='yp_jc_mtimeunit' class="form-control select2">
						  <option value='1'>小时</option> 
						  <option value='2'>天</option> 
							 
						</select>
					</div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="yp_jc_mhuanzhe" value="2" name="yp_jc_mhuanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="yp_jc_mtime1"  name='yp_jc_mtime1'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='yp_jc_mtimeunit1' name='yp_jc_mtimeunit1' class="form-control select2">
						  <option value='1'>小时</option> 
						   <option value='2'>天</option> 
						</select>
					</div>
                </div>


						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_jc">添加</button>
							  </div>
							</div>
						  </div>  
						  </form>
       </div>



  <div class="box-body"  id="gy_qx" style="display:none;">
			  <div class="form-group text-center">
				  <label class="col-sm-8 control-label">
				  <button type="button" class="btn btn-success" id="qx_sy">试验器械</button>
				  <button type="button" class="btn btn-success" id="qx_cb">参比器械</button>
				  <button type="button" class="btn btn-success" id="qx_fz">试验分组</button>
				  <button type="button" class="btn btn-success" id="qx_cs">干预措施</button>
				  <button type="button" class="btn btn-success" id="qx_cx">采血</button>
				  <button type="button" class="btn btn-success" id="qx_jc">检查</button>
                  </label>
				</div>
             </div>  

			      <div class="box-body  form-btn-success" id="form-qx_sy" style="display:none;">
				    <form id="qxsy_form" method="post" action=''>
					  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">试验器械名称</label>
						  <div class="col-sm-4">
							<input type="text" name="qxtiname" id="qxtiname" class="form-control">
						  </div>
						</div>

						 <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">使用方式</label>
						  <div class="col-sm-2">
						     <select id='qxuse_type' name='qxuse_type' class="form-control select2">
						
						  <?php
							foreach($use_type_lists as $key=> $value){ 
						  ?>
						  <option value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select>
							
						  </div>
						</div>

						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_ssqx">添加</button>
							  </div>
							</div>
						  </div>  


           </form>

            </div>


			  <div class="box-body  form-btn-success" id="form-yp_cb" style="display:none;">
			    <form id="qxcb_form" method="post" action=''>
					  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">参比器械名称</label>
						  <div class="col-sm-4">
							<input type="text" name="qxtinames" id="qxtinames" class="form-control">
						  </div>
						</div>

						 <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">使用方式</label>
						  <div class="col-sm-2">
						     <select id='qxuse_types' name='qxuse_types' class="form-control select2">
						
						  <?php
							foreach($use_type_lists as $key=> $value){ 
						  ?>
						  <option value='<?=$key?>'><?=$value?></option>
						  <?php
							}
							
						  ?>
						</select>
							
						  </div>
						</div>

						

						  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">规格</label>
						  <div class="col-sm-4">
							<input type="text" name="qxtigroupname" id="qxtigroupname" class="form-control">
						  </div>
						</div>



						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_cbqx">添加</button>
							  </div>
							</div>
						  </div>  
              </form>
            </div>


			  <div class="box-body  form-btn-success" id="form-qx_fz" style="display:none;">
		  <form id="qxfz_form" method="post" action=''>
					  <div class="form-group" >
						  <label for="c" class="col-sm-2 control-label">试验组别</label>
						  <div class="col-sm-2">
							<input type="text" name="qxgroup_num" id="qxgroup_num" class="form-control">
							  <input type="hidden" name="fzsjreagent_ids" id="fzsjreagent_ids" class="form-control">
							   <input type="hidden" name="fzsjnums" id="fzsjnums" class="form-control">
						  </div>
						</div>

						 <div class="form-group" id="gy_fz_dzzs">
						  <label for="c" class="col-sm-2 control-label">对照组</label>
						  
                           <input type="hidden" name="fzreagent_ids" id="fzreagent_ids" class="form-control">
						   <input type="hidden" name="fzgroupnames" id="fzgroupnames" class="form-control">
						  <div class="col-sm-2" id="fz_dzzname">
						  </div>

						   <label for="c" class="col-sm-1 control-label">代码</label>
						  <div class="col-sm-2">
                            <input type="text" name="qxfzgroupcode" id="qxfzgroupcode" class="form-control">
						  </div>
							<div class="form-group" id="gy_fz_nums">
							</div>
                    </div>

						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_qxfz">添加</button>
							  </div>
							</div>
						  </div>  
            </form>
            </div>

			 	<div class="box-body  form-btn-success" id="form-qx_cs" style="display:none;">
				  <form id="qxcs_form" method="post" action=''>
				     <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">周期</label>
						  <div class="col-sm-1">
								<select id='qx_xqm_cycle' name='qx_xqm_cycle' class="form-control select2">
								</select>
						  </div>
					</div>

					 <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">首次使用器械时间</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="qx_xqm_usetime"  name='qx_xqm_usetime' placeholder="匹配上患者后填写">
                  </div>            
                </div>

			<div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">使用器械总次数</label>
                  <div class="col-sm-4">
				  <input type="hidden"  id="tb_jiaochas"  name='tb_jiaochas'>
				  <input type="hidden"  id="tb_xulies"  name='tb_xulies'>
                    <input type="text" class="form-control" id="qxm_totalnum"  name='qxm_totalnum' >
                  </div>            
                </div>

				<div id="qx_xqlist">
				
				</div>
				<div id="qx_tb">
				
				</div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">器械使用说明</label>
                  <div class="col-sm-8">
					<textarea name="qx_tb_dis" id="qx_tb_dis" class="form-control" rows="5" cols="8"></textarea>
                  </div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">器械使用禁忌</label>
                  <div class="col-sm-8">
					<textarea name="qx_tb_tabu" id="qx_tb_tabu" class="form-control" rows="5" cols="8"></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">提醒设置</label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="qx_tb_mcrc" value="1" name="qx_tb_mcrc">提醒CRC
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="qx_tb_mtime"  name='qx_tb_mtime'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='qx_tb_mtimeunit' name='qx_tb_mtimeunit' class="form-control select2">
						  <option value='1'>小时</option> 
						  <option value='2'>天</option> 
							 
						</select>
					</div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="qx_tb_mhuanzhe" value="2" name="qx_tb_mhuanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="qx_tb_mtime1"  name='qx_tb_mtime1'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='qx_tb_mtimeunit1' name='qx_tb_mtimeunit1' class="form-control select2">
						  <option value='1'>小时</option> 
						   <option value='2'>天</option> 
						</select>
					</div>
                </div>
                <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_qxcs">添加</button>
							  </div>
							</div>
						  </div>  
						  </form>
				</div>




		<div class="box-body  form-btn-success" id="form-qx_cx" style="display:none;">
		  <form id="qxcx_form" method="post" action=''>
		             <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">周期</label>
						  <div class="col-sm-6">
								<select id='qx_cx_cycle' name='qx_cx_cycle' class="form-control select2">
								</select>
						  </div>
					</div>

					 <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">器械使用轮次：第</label>
						  <div class="col-sm-1">
								<select id='qx_cx_drug' name='qx_cx_drug' class="form-control select2">
								
								</select>
						  </div>
						   <label for="c"  class="col-sm-1 control-label">次用药</label>
					</div>

					 <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">时间</label>
						  <div class="col-sm-1">
								<select id='qx_cx_qh' name='qx_cx_qh' class="form-control select2">
								 <option value='1'>前</option>
								<option value='2'>后</option>
								</select>
						  </div>
						     <div class="col-sm-1">
							 	<input type='text' class="form-control" id="yp_cx_time" name='yp_cx_time'/>
							 </div>
						     <div class="col-sm-1">
								<select id='qx_cx_ttype' name='qx_cx_ttype' class="form-control select2">
								 <option value='1'>分钟</option>
								<option value='2'>小时</option>
								</select>
						  </div>
					</div>

					 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">采血说明</label>
                  <div class="col-sm-8">
					<textarea name="qx_cx_dis" id="qx_cx_dis" class="form-control" rows="5" cols="8"></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">提醒设置</label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="qx_cx_mcrc" value="1" name="qx_cx_mcrc">提醒CRC
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="qx_cx_mtime"  name='qx_cx_mtime'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='qx_cx_mtimeunit' name='qx_cx_mtimeunit' class="form-control select2">
						  <option value='1'>小时</option> 
						  <option value='2'>天</option> 
							 
						</select>
					</div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="qx_cx_mhuanzhe" value="2" name="qx_cx_mhuanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="qx_cx_mtime1"  name='qx_cx_mtime1'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='qx_cx_mtimeunit1' name='qx_cx_mtimeunit1' class="form-control select2">
						  <option value='1'>小时</option> 
						   <option value='2'>天</option> 
						</select>
					</div>
                </div>
 
						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_qxcx">添加</button>
							  </div>
							</div>
						  </div>  
             </form>
            </div>

			<div class="box-body  form-btn-success" id="form-qx_jc" style="display:none;">
			  <form id="qxjc_form" method="post" action=''>
		              <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">周期</label>
						  <div class="col-sm-6">
								<select id='qx_jc_cycle' name='qx_jc_cycle' class="form-control select2">
								</select>
						  </div>
					</div>

					 <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">器械使用轮次：第</label>
						  <div class="col-sm-1">
								<select id='qx_jc_drug' name='qx_jc_drug' class="form-control select2">
								
								</select>
						  </div>
						   <label for="c"  class="col-sm-1 control-label">次用药</label>
					</div>

					 <div class="form-group">
						  <label for="c" class="col-sm-2 control-label">时间</label>
						  <div class="col-sm-1">
								<select id='qx_jc_qh' name='qx_jc_qh' class="form-control select2">
								 <option value='1'>前</option>
								<option value='2'>后</option>
								</select>
						  </div>
						     <div class="col-sm-1">
							 	<input type='text' class="form-control" id="qx_jc_time" name='qx_jc_time'/>
							 </div>
						     <div class="col-sm-1">
								<select id='qx_jc_ttype' name='qx_jc_ttype' class="form-control select2">
								 <option value='1'>分钟</option>
								<option value='2'>小时</option>
								</select>
						  </div>
					</div>

				<div class="form-group">
                  <label for="c" class="col-sm-2 control-label">检查项：</label>
                  <div class="col-sm-1">
					  <button type="button" class="btn btn-info" id="add_qx_jcx">+</button>
                  </div>
                </div>
				<div id="qxjianchaxiang" style="display:none;" class="form-group">
                   <label for="c" class="col-sm-2 control-label"></label>
				   <div class="col-sm-10">
				   <table id="example1" class="table table-bordered table-striped" style="width:100%">
                  <tr>
				  <td>体格检查
				   <input type="checkbox" id="all_qxtg"/></td>
				  <td><table class="table table-bordered">
				  <tr>
					<td>头部</td>
					<td><?php  foreach($tglist1 as $k1=>$v1){?><input type="checkbox" value="<?=$k1?>" name="qxtg[]"><?php echo $v1; }?></td>
				  </tr>
				  <tr>
					<td>颈部</td>
					<td><?php  foreach($tglist2 as $k2=>$v2){?><input type="checkbox" value="<?=$k2?>" name="qxtg[]"><?php echo $v2; }?></td>
				  </tr>
				  <tr>
					<td>躯干</td>
					<td><?php  foreach($tglist3 as $k3=>$v3){?><input type="checkbox" value="<?=$k3?>" name="qxtg[]"><?php echo $v3; }?></td>
				  </tr>
				  <tr>
					<td>四肢</td>
					<td><?php  foreach($tglist4 as $k4=>$v4){?><input type="checkbox" value="<?=$k4?>" name="qxtg[]"><?php echo $v4; }?></td>
				  </tr>
				  </table></td>
				  </tr>
				   <tr>
				  <td>生命体征
				   <input type="checkbox" id="all_qxsm"/></td>
				  <td><?php  foreach($smlist as $ks=>$vs){?><input type="checkbox" value="<?=$ks?>" name="qxsm[]"><?php echo $vs; }?></td>
				  </tr>
				   <tr>
				  <td>常规检查
				 <input type="checkbox" id="all_qxcg"/></td>
				  <td><?php  foreach($cglist as $kc=>$vc){?><input type="checkbox" value="<?=$kc?>" name="qxcg[]"><?php echo $vc; }?></td>
				  </tr>
				   <tr>
				  <td>血生化检查
				  <input type="checkbox" id="all_qxxsh"/></td>
				  <td><?php  foreach($xshlist as $kx=>$vx){?><input type="checkbox" value="<?=$kx?>" name="qxxsh[]"><?php echo $vx; }?></td>
				  </tr>
				   <tr>
				  <td>超声检查
				   <input type="checkbox" id="all_qxcs"/></td>
				  <td><?php  foreach($cslist as $ka=>$va){?><input type="checkbox" value="<?=$ka?>" name="qxcs[]"><?php echo $va; }?></td>
				  </tr>
				   <tr>
				  <td>影像检查
				   <input type="checkbox" id="all_qxyx"/></td>
				  <td><table class="table table-bordered">
				  <tr>
					<td>头部</td>
					<td><?php  foreach($yxlist1 as $ky1=>$vy1){?><input type="checkbox" value="<?=$ky1?>" name="qxyx[]"><?php echo $vy1; }?></td>
				  </tr>
				  <tr>
					<td>颈部</td>
					<td><?php  foreach($yxlist2 as $ky2=>$vy2){?><input type="checkbox" value="<?=$ky2?>" name="qxyx[]"><?php echo $vy2; }?></td>
				  </tr>
				  <tr>
					<td>躯干</td>
					<td><?php  foreach($yxlist3 as $ky3=>$vy3){?><input type="checkbox" value="<?=$ky3?>" name="qxyx[]"><?php echo $vy3; }?></td>
				  </tr>
				  <tr>
					<td>四肢</td>
					<td><?php  foreach($yxlist4 as $ky4=>$vy4){?><input type="checkbox" value="<?=$ky4?>" name="qxyx[]"><?php echo $vy4; }?></td>
				  </tr>
				  </table></td>
				  </tr>
				   <tr>
				  <td>心电/脑电/肌电检查
				   <input type="checkbox" id="all_qxxd"/></td>
				  <td><?php  foreach($xdlist as $kb=>$vb){?><input type="checkbox" value="<?=$kb?>" name="qxxd[]"><?php echo $vb; }?></td>
				  </tr>
				   <tr>
				  <td>基因检查
				   <input type="checkbox" id="all_qxjy"/></td>
				  <td><?php  foreach($jylist as $kj=>$vj){?><input type="checkbox" value="<?=$kj?>" name="qxjy[]"><?php echo $vj; }?></td>
				  </tr>
				   <tr>
				  <td>其他
				   <input type="checkbox" id="all_qxqt"/></td>    
				  <td><?php  foreach($qtlist as $kq=>$vq){?><input type="checkbox" value="<?=$kq?>" name="qxqt[]"><?php echo $vq; }?></td>
				  </tr>

				   </table>
			   </div>
               </div>

					 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">注意事项</label>
                  <div class="col-sm-8">
					<textarea name="qx_jc_dis" id="qx_jc_dis" class="form-control" rows="5" cols="8"></textarea>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">提醒设置</label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="qx_jc_mcrc" value="1" name="qx_jc_mcrc">提醒CRC
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="qx_jc_mtime"  name='qx_jc_mtime'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='qx_jc_mtimeunit' name='qx_jc_mtimeunit' class="form-control select2">
						  <option value='1'>小时</option> 
						  <option value='2'>天</option> 
							 
						</select>
					</div>
                </div>
				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					<label class="radio-inline">
					  <input type="radio" id="qx_jc_mhuanzhe" value="2" name="qx_jc_mhuanzhe">提醒患者
					</label>
                  </div>
                </div>

				 <div class="form-group">
                  <label for="c" class="col-sm-2 control-label"></label>
                  <div class="col-sm-2">
					 <label class="checkbox-inline">提醒时间：提前 </label>
                  </div>
				<div class="col-sm-1">
				  <input type="text" class="form-control" id="qx_jc_mtime1"  name='qx_jc_mtime1'> 
				   </div>
				 <div class="col-sm-1">	  			  
						<select id='qx_jc_mtimeunit1' name='qx_jc_mtimeunit1' class="form-control select2">
						  <option value='1'>小时</option> 
						   <option value='2'>天</option> 
						</select>
					</div>
                </div>


						   <div class="box-footer">
							<div class="form-group">
							  <div class="col-sm-offset-2 col-sm-4">
								<button type="button" class="btn btn-info" id="add_qxjc">添加</button>
							  </div>
							</div>
						  </div>  
             </form>
            </div>

              <!-- /.box-body --> 
           
          </div>
          <!-- /.box -->

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

	  <script>
  $(function () {
	  $("input[id^='all_']").click(function(){	
		 var id=$(this).attr('id');
		 var sc=id.split('_');
		 var ids=sc[1];
    　　// 使用attr只能执行一次
    　　$("input[name='"+ids+"[]']").attr("checked", $(this).attr("checked"));    
    　　// 使用prop则完美实现全选和反选
    　　$("input[name='"+ids+"[]']").prop("checked", $(this).prop("checked"));
　　　　// 获取所有选中的项并把选中项的文本组成一个字符串
    　　var str = '';
    　　$($("input[name='"+ids+"[]']:checked")).each(function(){
        　　str += $(this).next().text() + ',';
    　　});
　　});

  }); 
</script>  


<script type="text/javascript">
$(function(){		

		var testid=$('#testid').val();
		if(testid==1){
			$("#gy_yp").show();
			$("#gy_qx").hide();			
		}else if(testid==2){
			$("#gy_yp").hide();
			$("#gy_qx").show();			
		}

		$(".btn-success").click(function (){
			var id=$(this).attr('id');
			$(".form-btn-success").hide();
			$("#form-"+id).show();		
			if(id=='yp_xq'){
				var yao=$("#usemethods").val();
				if(yao==1){
					$("#yp_xq_dc").show();
					$("#yp_xq_mc").hide();
				}else{
					$("#yp_xq_dc").hide();
					$("#yp_xq_mc").show();
				
				}
			
			}
		});

	$("#add_code").click(function (){
			$("#pp_mname").append('<div class="col-sm-1"><input type="text" name="mname[]" id="mname" class="form-control"></div>');
		});
	$("#del_code").click(function (){
			$("#pp_mname>div:last").remove();
		});



$("#pp_groupnum").blur(function (){
		var num1s=parseInt($("#pp_groupnum").val());

		 if(num1s>0){
						   $("#ppsjnum").val(num1s);
							   var numbody1s='';
							   for(var i=1;i<=num1s;i++){
									numbody1s+='<div id="ppfz_'+i+'" class="form-group"><label for="c" class="col-sm-2 control-label">组'+i+'使用药物代码</label> <div  id="pp_fzcode_'+i+'"><div class="col-sm-1"><input type="text" name="ppgroupnames'+i+'[]" id="ppgroupnames" class="form-control"></div></div> <label for="c" class="col-sm-1 control-label"><button type="button" class="glyphicon-plus" onclick="add_codes('+i+')"></button></label><label for="c" class="col-sm-1 control-label"><button type="button" class="glyphicon-minus" onclick="del_codes('+i+')"></button></label></div>';
							   }
							   $("#gy_pp_fz").html(numbody1s);  
						   }



});

				$("#group_num").blur(function (){
					var nums=parseInt($("#group_num").val());
					  if($("#meddletype").val()==2){
						  nums=nums-1;	  
					  }

					   if(nums>0){
						   $("#fzsjnum").val(nums);
							   var numbodys='';
							   for(var i=1;i<=nums;i++){
									numbodys+='<div class="form-group"><label for="c" class="col-sm-2 control-label">实验组'+i+'</label><div class="col-sm-2"><input type="text" name="fzgroupnames[]" id="fzgroupnames" class="form-control" placeholder="请填写药物剂量"></div><label for="c" class="col-sm-1 control-label">药品代码</label><div class="col-sm-2"><input type="text" name="fzgroupcodes[]" id="fzgroupcode" class="form-control" placeholder="请填写药物剂量"></div></div>';
							   }
							   $("#gy_fz_num").html(numbodys);  
						   }


				})

			$("#qxgroup_num").blur(function (){
					var qxnums=parseInt($("#qxgroup_num").val());
					  if($("#meddletype").val()==2){
						  qxnums=qxnums-1;	  
					  }
					   if(qxnums>0){
						   $("#fzsjnums").val(qxnums);
							   var qxnumbodys='';
							   for(var i=1;i<=qxnums;i++){
									qxnumbodys+='<div class="form-group"><label for="c" class="col-sm-2 control-label">实验组'+i+'</label><div class="col-sm-2"><input type="text" name="qxfzgroupnames[]" id="qxfzgroupnames" class="form-control" placeholder="请填写器械规格"></div><label for="c" class="col-sm-1 control-label">代码</label><div class="col-sm-2"><input type="text" name="qxfzgroupcodes[]" id="qxfzgroupcode" class="form-control" placeholder="请填写组名缩写"></div></div>';
							   }
							   $("#gy_fz_nums").html(qxnumbodys);  
						   }


				})



		$(".yp_tb").blur(function (){
			var c=parseInt($("#tb_jiaocha").val())+1;
			var nums=parseInt($("#tb_xulie").val())+1;

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

	    })

				$('input[name="ypd_is_law"]').click(function(){
					if($(this).val()=='1'){
						 $("#ypxq_mguilv").show();	
						 $("#ypxq_mbuguilv").hide();						
					}else if($(this).val()=='2'){
						 $("#ypxq_mguilv").hide();	
						 $("#ypxq_mbuguilv").show();	
					}
				});

	$('input[name="ypd_is_repast"]').click(function(){
		if($(this).val()=='1'){
			   $("#d_ctime").show();	
			   $("#d_time").hide();				   
		}else if($(this).val()=='2'){
			$("#d_ctime").hide();	
			$("#d_time").show();	
		}
		
		
		

	})


			$("#m_totalnum").blur(function (){
				var m_totalnum=$("#m_totalnum").val();
				var mbuguilv='';
				for(var m=1;m<=m_totalnum;m++){
					mbuguilv+='<div class="form-group"><label for="c" class="col-sm-2 control-label">第'+m+'次用药</label><div class="col-sm-1"> <select id="m_drug_timetype" name="m_drug_timetype_'+m+'" class="form-control select2"><option value="1">距离基线时间</option><option value="2">距离上次用药时间</option></select></div> <div class="col-sm-1"><input type="text" class="form-control" id="m_drug_time" name="m_drug_time_'+m+'"/></div><div class="col-sm-1"><select id="m_drug_timeunit" name="m_drug_timeunit_'+m+'" class="form-control select2"><option value="2">小时</option><option value="3">天</option><option value="4">周</option><option value="5">月</option><option value="6">年</option></select></div></div> ';
				
				}
				$("#m_buguilvlist").html(mbuguilv);
			});

			$("#qxm_totalnum").blur(function (){
				var qxm_totalnum=$("#qxm_totalnum").val();
				var qxmlist='';
				for(var qxm=1;qxm<=qxm_totalnum;qxm++){
					qxmlist+='<div class="form-group"><label for="c" class="col-sm-2 control-label">第'+qxm+'次使用</label><div class="col-sm-2"> <select id="m_qx_timetype" name="m_qx_timetype_'+qxm+'" class="form-control select2"><option value="1">距离基线时间</option><option value="2">距离上次使用时间</option></select></div> <div class="col-sm-1"><input type="text" class="form-control" id="m_qx_time" name="m_qx_time_'+qxm+'"/></div><div class="col-sm-1"><select id="m_qx_timeunit" name="m_qx_timeunit_'+qxm+'" class="form-control select2"><option value="1">分钟</option><option value="2">小时</option><option value="3">天</option><option value="4">周</option><option value="5">月</option><option value="6">年</option></select></div><div class="col-sm-1">使用时间</div><div class="col-sm-1"><input type="text" class="form-control" id="ms_qx_time" name="ms_qx_time_'+qxm+'"/></div><div class="col-sm-1"><select id="ms_qx_timeunit" name="ms_qx_timeunit_'+qxm+'" class="form-control select2"><option value="1">分钟</option><option value="2">小时</option><option value="3">天</option><option value="4">周</option><option value="5">月</option><option value="6">年</option></select></div></div> ';
				
				}
				$("#qx_xqlist").html(qxmlist);
			})

			$('input[name="m_frequencies"]').click(function(){
				var m_frequencies=$(this).val();
				if(m_frequencies=='4'){	
					$("#m_can_1").hide();
					$("#m_can_2").hide();
					$("#m_can_3").hide();
					$("#m_can_4").show();
				
				}else{
					$("#m_can_1").show();
					$("#m_can_2").show();
					$("#m_can_3").show();
					$("#m_can_4").show();
					
				}

			})

			$('input[name="m_can"]').click(function(){
				var m_can=$(this).val();
				if(m_can=='4'){	
					$("#m_lx_wcan").show();
					$("#m_lx_can").hide();
					
				}else{
					$("#m_lx_wcan").hide();	
					if(m_can=='2'){
						$("#m_lx_can").hide();					
					}else{
						$("#m_lx_can").show();					
					}
					
					
				}

			})

	 $('#add_yp_jcx').click(function(){//点击a标签
		if($('#jianchaxiang').is(':hidden')){//如果当前隐藏
		$('#jianchaxiang').show();//那么就显示div
		}else{//否则
		$('#jianchaxiang').hide();//就隐藏div
		}
    })


$('#add_qx_jcx').click(function(){//点击a标签
		if($('#qxjianchaxiang').is(':hidden')){//如果当前隐藏
		$('#qxjianchaxiang').show();//那么就显示div
		}else{//否则
		$('#qxjianchaxiang').hide();//就隐藏div
		}
    })

 
 });


 function changedctime(){
  var dcshijian=parseInt($("#dcshijian").val());
	  if(dcshijian==1){
		  $("#dcshijianduan").hide(); 
	  }else if(dcshijian==2){
		  $("#dcshijianduan").show();	  
	  }
 }


 function changedruglaw(){
	 var m_drug_law=parseInt($("#m_drug_law").val());
	  if(m_drug_law==1){
		  $("#m_jiange").hide(); 
		  $("#m_lianxu").show(); 
	  }else if(m_drug_law==2){
		  $("#m_jiange").show();	
		  $("#m_lianxu").hide(); 
	  }
 
 }


 function changebzq(){
	 var checkzq='';
     var val = $.map(  $("#yp_xq_cycle option:not(:selected)"),
                                              function(ele){return ele.value} 
                                           ).join(",");

	ss = val.split(",");
	for(var c=0;c<ss.length;c++){

		checkzq+='<label class="checkbox-inline"><input type="checkbox" id="tb_dzhouqi" value="'+ss[c]+'" name="ypxq_tbdzq[]"> '+ss[c]+'</label>';
		
	}
	$("#ypxq_gz").html(checkzq);
	
 }


 function changebmzq(){
	 var checkzqd='';
     var vald = $.map(  $("#yp_xqm_cycle option:not(:selected)"),
                                              function(ele){return ele.value} 
                                           ).join(",");

	ssd = vald.split(",");
	for(var cd=0;cd<ssd.length;cd++){

		checkzqd+='<label class="checkbox-inline"><input type="checkbox" id="tb_dmzhouqi" value="'+ssd[cd]+'" name="ypxq_tbdmzq[]"> '+ssd[cd]+'</label>';
		
	}
	$("#ypxq_mgz").html(checkzqd);
	
 }

function add_codes(id){
	$("#pp_fzcode_"+id).append('<div class="col-sm-1"><input type="text" name="ppgroupnames[]" id="ppgroupnames" class="form-control"></div>');
}

function del_codes(id){
	$("#pp_fzcode_"+id+">div:last").remove();
}

</script>




<script type="text/javascript">

$(document).ready(function() {


	$(".select2").select2();
	$("#add_sssj").click(function (){
		var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}


		var tiname=$("#tiname").val();
		if(tiname==null||tiname==""){
			alert('请填写试剂名称');
			return false;
		}
		var use_type=$("#use_type").val();
		var use_unit=$("#use_unit").val();

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_reagent", //传递的URL
			data:"tiname="+tiname+"&use_type="+use_type+"&use_unit="+use_unit+"&type_id=1&items_id="+itemsid+"&pro_id="+pro_id,
			async:false,
			success: function(res)//如果成功执行的函数
			{
				if(res<=0){
					alert('添加失败，请稍后重试！');
					return false;
				}else{    
					
					$("#fzsjreagent_id").val(res);
				   alert('添加成功');
				   
				}
			}
			})

	});

	$("#add_cbsj").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}


		var tinames=$("#tinames").val();
		if(tinames==null||tinames==""){
			alert('请填写参比试剂名称');
			return false;
		}

		var tigroupname=$("#tigroupname").val();
		if(tigroupname==null||tigroupname==""){
			alert('请填写参比试剂剂量');
			return false;
		}
		var use_types=$("#use_types").val();
		var use_units=$("#use_units").val();

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_reagent", //传递的URL
			data:"tiname="+tinames+"&use_type="+use_types+"&use_unit="+use_units+"&type_id=2&items_id="+itemsid+"&pro_id="+pro_id+"&tigroupname="+tigroupname,
			async:false,
			success: function(res)//如果成功执行的函数
			{ 
				if(res<=0){
					alert('添加失败，请稍后重试！');
					return false;
				}else{ 
					$("#fz_dzzname").html(tinames);
					$("#fzgroupname").val(tigroupname);
					$("#fzreagent_id").val(res);
				   alert('添加成功');
				   
				}
			}
			})

	});

	$("#add_awj").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}


		var awjname=$("#awjname").val();
		if(awjname==null||awjname==""){
			alert('请填写安慰剂代码');
			return false;
		}

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_reagent", //传递的URL
			data:"groupcode="+awjname+"tiname=安慰剂&type_id=2&items_id="+itemsid+"&pro_id="+pro_id,
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

		$("#add_div").click(function (){
			var p1='<div id="lh"><div class="form-group" > <label for="c" class="col-sm-2 control-label">联合用药药品名称</label><div class="col-sm-4"><input type="text" name="lhtinames[]" id="lhtinames" class="form-control"></div></div><div class="form-group" ><label for="c" class="col-sm-2 control-label">用药方式</label><div class="col-sm-2"><select id="lhuse_types_1" name="lhuse_types[]" class="form-control select2"><?php foreach($use_type_list as $key=> $value){  ?><option value="<?=$key?>"><?=$value?></option><?php } ?></select></div></div><div class="form-group" ><label for="c" class="col-sm-2 control-label">单位</label> <div class="col-sm-2"> <select id="lhuse_units_1" name="lhuse_units[]" class="form-control select2"><?php foreach($use_unit_list as $key=> $value){ ?><option value="<?=$key?>"><?=$value?></option><?php } ?></select></div></div><div class="form-group" ><label for="c" class="col-sm-2 control-label">用药剂量</label><div class="col-sm-2"><input type="text" name="lhgroupname[]" id="lhgroupname_1" class="form-control"></div><label for="c" class="col-sm-1 control-label">药品代码</label> <div class="col-sm-2"><input type="text" name="lhgroupcode[]" id="lhgroupcode_1" class="form-control"></div></div></div>';
			$("#add_button").before(p1);


		})

	$("#add_lh").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}
		
		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_drugcom", //传递的URL
			data:$("#yplh_form").serialize()+"&items_id="+itemsid+"&pro_id="+pro_id,
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


	$("#add_fz").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_reagents", //传递的URL
			data:$("#ypfz_form").serialize()+"&items_id="+itemsid+"&pro_id="+pro_id,
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

	$("#add_pp").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_mates", //传递的URL
			data:$("#yppp_form").serialize()+"&pro_id="+pro_id+"&itemsid="+itemsid,
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

	$("#add_tb").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}
		
		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_chart", //传递的URL
			data:$("#yptb_form").serialize()+"&pro_id="+pro_id+"&itemsid="+itemsid,
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


		$("#add_xqd").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}
		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_druguse", //传递的URL
		    data:$("#ypxqd_form").serialize()+"&items_id="+itemsid+"&pro_id="+pro_id,
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

		$("#add_xqm").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}

	
		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_druguse_more", //传递的URL
			data:$("#ypxqm_form").serialize()+"&items_id="+itemsid+"&pro_id="+pro_id,
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

		$("#add_cx").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_blood", //传递的URL
			data:$("#ypcx_form").serialize()+"&items_id="+itemsid+"&pro_id="+pro_id,
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



	$("#add_jc").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}



		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_inspects", //传递的URL
			data:$("#ypcx_form").serialize()+"&items_id="+itemsid+"&pro_id="+pro_id,
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







$("#add_ssqx").click(function (){
		var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}


		var qxtiname=$("#qxtiname").val();
		if(qxtiname==null||qxtiname==""){
			alert('请填写器械名称');
			return false;
		}
		var qxuse_type=$("#qxuse_type").val();
	

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_reagent", //传递的URL
			data:"tiname="+qxtiname+"&use_type="+qxuse_type+"&type_id=1&items_id="+itemsid+"&pro_id="+pro_id,
			async:false,
			success: function(res)//如果成功执行的函数
			{
				if(res<=0){
					alert('添加失败，请稍后重试！');
					return false;
				}else{    
					
					$("#fzsjreagent_ids").val(res);
				   alert('添加成功');
				   
				}
			}
			})

	});

	$("#add_cbqx").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}


		var qxtinames=$("#qxtinames").val();
		if(qxtinames==null||qxtinames==""){
			alert('请填写参比器械名称');
			return false;
		}

		var qxtigroupname=$("#qxtigroupname").val();
		if(qxtigroupname==null||qxtigroupname==""){
			alert('请填写参比器械规格');
			return false;
		}
		var qxuse_types=$("#qxuse_types").val();
	
		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_reagent", //传递的URL
			data:"tiname="+qxtinames+"&use_type="+qxuse_types+"&type_id=2&items_id="+itemsid+"&pro_id="+pro_id+"&tigroupname="+qxtigroupname,
			async:false,
			success: function(res)//如果成功执行的函数
			{ 
				if(res<=0){
					alert('添加失败，请稍后重试！');
					return false;
				}else{ 
					$("#fz_dzznames").html(qxtinames);
					$("#fzgroupnames").val(qxtigroupname);
					$("#fzreagent_ids").val(res);
				   alert('添加成功');
				   
				}
			}
			})

	});


$("#add_qxfz").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}

		var qxgroup_num=$("#qxgroup_num").val();
		var fzreagent_ids=$("#fzreagent_ids").val();
		var fzgroupcodes=$("#fzgroupcodes").val();
		var fzsjreagent_ids=$("#fzsjreagent_ids").val();
		var fzsjnums=$("#fzsjnums").val();

		var qxfzgroupnames=$.map(  $('input[name="qxfzgroupnames[]"]'),
                                              function(ele){return ele.value} 
        
		var qxfzgroupcodes=$.map(  $('input[name="qxfzgroupcodes[]"]'),
                                              function(ele){return ele.value} 
                                           ).join(",");

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_reagents", //传递的URL
			data:"group_num="+qxgroup_num+"&fzreagent_id="+fzreagent_ids+"&fzgroupcode="+fzgroupcodes+"&fzsjreagent_id="+fzsjreagent_ids+"&fzsjnum="+fzsjnums+"&fzgroupnames="+qxfzgroupnames+"&fzgroupcodes="+qxfzgroupcodes+"&items_id="+itemsid+"&pro_id="+pro_id,
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

		$("#add_qxcs").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			//alert('请选择项目');
			//return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			//alert('请先填写基础模块');
			//return false;
		}
		
		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_qxchart", //传递的URL
			data:$("#qxcs_form").serialize()+"&pro_id="+pro_id+"&itemsid="+itemsid,
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




		$("#add_qxcx").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}


		var qx_cx_cycle=$("#qx_cx_cycle").val();	
		var qx_cx_drug=$("#qx_cx_drug").val();
		var qx_cx_qh=$("#qx_cx_qh").val();
		var qx_cx_time=$("#qx_cx_time").val();
		var qx_cx_ttype=$("#qx_cx_ttype").val();
		var qx_cx_dis=$("#qx_cx_dis").val();
		var qx_cx_mcrc=$("#qx_cx_mcrc").val();
		var qx_cx_mtime=$("#qx_cx_mtime").val();
		var qx_cx_mtimeunit=$("#qx_cx_mtimeunit").val();
		var qx_cx_mhuanzhe=$("#qx_cx_mhuanzhe").val();
		var qx_cx_mtime1=$("#qx_cx_mtime1").val();
		var qx_cx_mtimeunit1=$("#qx_cx_mtimeunit1").val();
		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_blood", //传递的URL
			data:"yp_cx_cycle="+qx_cx_cycle+"&yp_cx_drug="+qx_cx_drug+"&yp_cx_qh="+qx_cx_qh+"&qx_cx_time="+qx_cx_time+"&items_id="+itemsid+"&pro_id="+pro_id+"&qx_cx_ttype="+qx_cx_ttype+"&yp_cx_dis="+qx_cx_dis+"&yp_cx_mcrc="+qx_cx_mcrc+"&yp_cx_mtime="+qx_cx_mtime+"&yp_cx_mtimeunit="+qx_cx_mtimeunit+"&yp_cx_mhuanzhe="+qx_cx_mhuanzhe+"&yp_cx_mtime1="+qx_cx_mtime1+"&yp_cx_mtimeunit1="+qx_cx_mtimeunit1,
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



	$("#add_qxjc").click(function (){
			var itemsid=$("#itemsid").val();
		if(itemsid==null||itemsid==""){
			alert('请选择项目');
			return false;
		}

		var pro_id=$("#pro_id").val();
		if(pro_id==null||pro_id==""){
			alert('请先填写基础模块');
			return false;
		}


		var qx_jc_cycle=$("#qx_jc_cycle").val();	
		var qx_jc_drug=$("#qx_jc_drug").val();
		var qx_jc_qh=$("#qx_jc_qh").val();
		var qx_jc_time=$("#qx_jc_time").val();
		var qx_jc_ttype=$("#qx_jc_ttype").val();
		var qx_jc_dis=$("#qx_jc_dis").val();
		var qx_jc_mcrc=$("#qx_jc_mcrc").val();
		var qx_jc_mtime=$("#qx_jc_mtime").val();
		var qx_jc_mtimeunit=$("#qx_jc_mtimeunit").val();
		var qx_jc_mhuanzhe=$("#qx_jc_mhuanzhe").val();
		var qx_jc_mtime1=$("#qx_jc_mtime1").val();
		var qx_jc_mtimeunit1=$("#yp_jc_mtimeunit1").val();

		var yp_jc_qxtg=$.map(  $('input[name="qxtg[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var yp_jc_qxsm=$.map(  $('input[name="qxsm[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var yp_jc_qxcg=$.map(  $('input[name="qxcg[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var yp_jc_qxxsh=$.map(  $('input[name="qxxsh[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		 var yp_jc_qxcs=$.map(  $('input[name="qxcs[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var yp_jc_qxyx=$.map(  $('input[name="qxyx[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var yp_jc_qxxd=$.map(  $('input[name="qxxd[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		var yp_jc_qxjy=$.map(  $('input[name="qxjy[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");
		 var yp_jc_qxqt=$.map(  $('input[name="qxqt[]"]:checked'),
                                              function(ele){return ele.value} 
                                           ).join(",");

		$.ajax({
			cache:true,//保留缓存数据
            type:"POST",//为post请求
			url: "/index.php/admin/item_program/add_inspects", //传递的URL
			data:"yp_jc_cycle="+qx_jc_cycle+"&yp_jc_drug="+qx_jc_drug+"&yp_jc_qh="+qx_jc_qh+"&yp_jc_time="+qx_jc_time+"&items_id="+itemsid+"&pro_id="+pro_id+"&yp_jc_ttype="+qx_jc_ttype+"&yp_jc_dis="+qx_jc_dis+"&yp_jc_mcrc="+qx_jc_mcrc+"&yp_jc_mtime="+qx_jc_mtime+"&yp_jc_mtimeunit="+qx_jc_mtimeunit+"&yp_jc_mhuanzhe="+qx_jc_mhuanzhe+"&yp_jc_mtime1="+qx_jc_mtime1+"&yp_jc_mtimeunit1="+qx_jc_mtimeunit1+"&tg="+yp_jc_qxtg+"&sm="+yp_jc_qxsm+"&cg="+yp_jc_qxcg+"&xsh="+yp_jc_qxxsh+"&cs="+yp_jc_qxcs+"&yx="+yp_jc_qxyx+"&xd="+yp_jc_qxxd+"&jy="+yp_jc_qxjy+"&qt="+yp_jc_qxqt,
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




