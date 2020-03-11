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
  <title><?=$this->config->item('web_title')?> | 添加机构</title>
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
        中心管理
        <small>添加中心</small>
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
              <h3 class="box-title">请填写机构办公室信息：</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">中心名称</label>
                  <div class="col-sm-3">
                    <span><input type="text" class="form-control" id="instname" name='instname' placeholder="机构办公地址" value="<?=$inst['instname'] ?>"></span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">机构办公室地址</label>
                  <div class="col-sm-3">
                    <input type="hidden" class="form-control" id="instId" name='instId' value="<?=$inst['inst_id'] ?>">
                    <input type="hidden" class="form-control" id="id" name='id' value="<?=$inst['id'] ?>">
                    <input type="text" class="form-control" id="office" name='office' placeholder="机构办公地址" value="<?=$inst['office_address'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">是否牵头</label>
                  <div class="col-sm-2" >
                    <label class="radio-inline">
                      <input type="radio" value="1" name="is_lead" <?=$inst['is_lead']=='1'?'checked=checked':''?>>是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="is_lead" <?=$inst['is_lead']=='0'?'checked=checked':''?>>否
                    </label>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">是否接待</label>
                  <div class="col-sm-2" name="reception">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="reception" id="shi" <?=$jiedai['is_reception']=='1'?'checked=checked':''?>>是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="reception" id="fou" <?=$jiedai['is_reception']=='0'?'checked=checked':''?>>否
                    </label>
                  </div>
                </div> 

                <div id='jiedai' style="<?=$jiedai['is_reception']==1?'display:black':'display:none'?>;">
                  <div class="form-group">
                    <label for="appid" class="col-sm-2 control-label">接待时间</label>
                    <div class="col-sm-2">
                     <span> <input type="text" class="datepicker" id="reception_time"  name='reception_time' style="width:180px" value="<?=$jiedai['datetime']?date('Y-m-d',$jiedai['datetime']):'' ?>"></span>
                    </div>
                  </div> 

                  <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">接待人</label>
                  <div class="col-sm-2">
                     <span> <input type="text" class="form-control" id="receiver"  name='receiver' style="width:180px" value="<?=$jiedai['receiver']?>"></span>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">职位</label>
                  <div class="col-sm-2">
                     <span> <input type="text" class="form-control" id="position"  name='position' style="width:180px" value="<?=$jiedai['position']?>"></span>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">电话</label>
                  <div class="col-sm-2">
                     <span> <input type="text" class="form-control" id="phone"  name='phone' style="width:180px" value="<?=$jiedai['phone']?>"></span>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">email</label>
                  <div class="col-sm-2">
                     <span> <input type="text" class="form-control" id="email"  name='email' style="width:180px" value="<?=$jiedai['email']?>"></span>
                    </div>
                  </div>

                </div>
              
                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">是否自组smo</label>
                  <div class="col-sm-2" name="smo">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="smo" <?=$inst['is_smo']=='1'?'checked=checked':''?>>是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="smo" <?=$inst['is_smo']=='0'?'checked=checked':''?>>否
                    </label>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">是否自组优选</label>
                  <div class="col-sm-2" name="prior">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="prior" <?=$inst['is_prior']=='1'?'checked=checked':''?>>是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="prior" <?=$inst['is_prior']=='0'?'checked=checked':''?>>否
                    </label>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">优选单位名称</label>
                  <div class="col-sm-3">
                    <textarea type="text" class="form-control" id="prior_list" name='prior_list' placeholder="优选单位名称，以逗号分隔" value=""><?=$inst['prior_list'] ?></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">是否接受联斯达外派</label>
                  <div class="col-sm-2" >
                    <label class="radio-inline">
                      <input type="radio" value="1" name="despatch" <?=$inst['is_despatch']=='1'?'checked=checked':''?>>是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="despatch" <?=$inst['is_despatch']=='0'?'checked=checked':''?>>否
                    </label>
                  </div>
                </div> 


                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">是否收crc管理费</label>
                  <div class="col-sm-2" name="fees">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="is_fees" <?=$inst['is_fees']=='1'?'checked=checked':''?>>是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="is_fees" <?=$inst['is_fees']=='0'?'checked=checked':''?>>否
                    </label>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">crc管理费</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="fees" name='fees' placeholder="请填写管理费用" value="<?=$inst['fees'] ?>">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">发票税率</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="invoice" name='invoice' placeholder="请填税率" value="<?=$inst['invoice'] ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">是否收牵头遗传办</label>
                  <div class="col-sm-2" name="lead_heredity">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="lead_hereditys" <?=$inst['is_lead_heredity']=='1'?'checked=checked':''?>>是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="lead_heredity" <?=$inst['is_lead_heredity']=='0'?'checked=checked':''?>>否
                    </label>
                  </div>
                </div> 

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">收费额度</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="cost" name='cost' placeholder="请填写收费额度" value="<?=$inst['cost'] ?>">
                  </div>
                </div>
               
                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">对crc要求</label>
                  <div class="col-sm-3">
                    <textarea type="text" class="form-control" id="crc_require" name='crc_require' placeholder="填写对crc要求"><?=$inst['crc_require'] ?></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="code" class="col-sm-2 control-label">是否需要派遣函</label>
                  <div class="col-sm-2" name="dpletter">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="dpletter" <?=$inst['is_dpletter']=='1'?'checked=checked':''?>>是
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="dpletter" <?=$inst['is_dpletter']=='0'?'checked=checked':''?>>否
                    </label>
                  </div>
                </div> 

                <!--新增字段修改区域-->
                <div>
                  <?php foreach($columns as $val){?>
                    
                         <div class="form-group">
                          <label class="col-sm-2 control-label"><?=$val['cname'] ?></label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control" name="columns[<?=$val['col_name']?>][]" value="<?php foreach ($col_inst as $key => $value){?><?php if($val['id']==$key){?><?=$value ?><?php }?><?php }?>">
                          </div>
                        </div>
                         <input type="hidden" class="form-control" name="columns[<?=$val['col_name']?>][]" value="<?=$val['id']?>">
                        
                  <?php }?>
                </div>


                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">机构主任</label>
                  <div class="col-sm-2">
                    <select id='linkman' name='linkman' class="form-control select2" style="width: 100%;">
                      <option value=''>选择主任</option>
                      <?php
                      foreach($inst_member as $value){               
                      ?>
                      <option value='<?=$value['id'].','.$value['name']?>' <?=$value['id']==$member['id']?'selected="selected"':''?>><?=$value['name']?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                 
                </div> 

                <div class="form-group" id="newlead">
                    <label for="zh_action" class="col-sm-2 control-label"></label>
                    <?php foreach ($huser as $key=>$value) {?>
                      <div class="col-sm-2" id="lead<?=$key+100?>">
                        <input type="hidden"  name="lead[]" value="<?=$value['id']?>">
                        <span type="text" class="form-control"><?=$value['name']?></span><i class="glyphicon glyphicon-minus" onclick="msDel(<?=$key+100?>)"></i>
                      </div>
                    <?php }?>

                </div> 


                <div class="form-group">
                  <label for="zh_action" class="col-sm-2 control-label">机构秘书</label>
                  <div class="col-sm-2">
                    <select id='mishu' name='mishu' class="form-control select2" style="width: 100%;">
                      <option value=''>选择秘书</option>
                      <?php
                      foreach($inst_member as $value){               
                      ?>
                      <option value='<?=$value['id'].','.$value['name']?>' <?=$value['id']==$member['id']?'selected="selected"':''?>><?=$value['name']?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                 
                </div> 

                <div class="form-group" id="newlead1">
                    <label for="zh_action" class="col-sm-2 control-label"></label>
                    <?php foreach ($suser as $key=>$value) {?>
                      <div class="col-sm-2" id="mishu<?=$key+100?>">
                        <input type="hidden"  name="mishu[]" value="<?=$value['id']?>">
                        <span type="text" class="form-control"><?=$value['name']?></span><i class="glyphicon glyphicon-minus" onclick="msDel1(<?=$key+100?>)"></i>
                      </div>
                    <?php }?>

                </div> 





             </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
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


$(document).ready(function(){
  $('#linkman').change(function(){
    leadBind();
  })
});

var num = 0;
function leadBind(){
   // var provice = $("#mishuid option:selected").val();
   var lead = $('#linkman').val();
    //判断省份这个下拉框选中的值是否为空
    if (lead == "") {
        return;
    }
    var larr = lead.split(',');
     // $(this).val(num);
    var length = $('#newlead input').length; 
    ++num;
    var str = '<div class="col-sm-2" id="lead'+num+'"><input type="hidden"  name="lead[]" value="'+larr[0]+'"><span type="text" class="form-control">'+larr[1]+'</span><i class="glyphicon glyphicon-minus" onclick="msDel('+num+')"></i></div>';
    if(length >4){
      alert('最多添加5个');
      return ;
    }
    $("#newlead").append(str);
   // <i class="glyphicon glyphicon-minus radio-inline" >删除</i> 
   
}

//秘书

$(document).ready(function(){
  $('#mishu').change(function(){
    mishuBind();
  })
});

var num = 0;
function mishuBind(){
   // var provice = $("#mishuid option:selected").val();
   var lead = $('#mishu').val();
    //判断省份这个下拉框选中的值是否为空
    if (lead == "") {
        return;
    }
    var larr = lead.split(',');
     // $(this).val(num);
    var length = $('#newlead1 input').length; 
    ++num;
    var str = '<div class="col-sm-2" id="mishu'+num+'"><input type="hidden"  name="mishu[]" value="'+larr[0]+'"><span type="text" class="form-control">'+larr[1]+'</span><i class="glyphicon glyphicon-minus" onclick="msDel1('+num+')"></i></div>';
    if(length >4){
      alert('最多添加5个');
      return ;
    }
    $("#newlead1").append(str);
   // <i class="glyphicon glyphicon-minus radio-inline" >删除</i> 
   
}


function msDel(num1){
    $('#lead'+num1).remove();
    // console.log(id);
}

function msDel1(num1){
    $('#mishu'+num1).remove();
    // console.log(id);
}

$(function(){
  $("#shi").click(function(){
    $("#jiedai").show();
  });
 });

$(function(){
  $("#fou").click(function(){
    $("#jiedai").hide();
  });
 });


$(document).ready(function(){
  $('#province').change(function(){
    cityBind();
  })
});

$(document).ready(function(){
  $('#city').change(function(){
    areaBind();
  })
});

function cityBind(){
   // var provice = $("#Province option:selected").val();
   var provice = $('#province').val();
    //判断省份这个下拉框选中的值是否为空
    if (provice == "") {
        return;
    }
    // console.log(url);
    $("#city").html('<option value="">--请选择市--</option>');
    var str = '';
    $.ajax({
        type: "POST",
        url: "<?php echo $cdn?>index.php/admin/institution/area_sel",
        data: { "id": provice, "level":1},
        dataType: "JSON",
        async: false,
        success: function (data) {
            //从服务器获取数据进行绑定
            $.each(data, function (i, item) {
                // console.log(i);
                str += "<option value=" + i+ ">" + item + "</option>";
            })
            //将数据添加到省份这个下拉框里面
            $("#city").append(str);
        },
        error: function () { alert("Error"); }
    })
}


function areaBind(){
   // var provice = $("#Province option:selected").val();
   var area = $('#city').val();
    //判断省份这个下拉框选中的值是否为空
    if (area == "") {
        return;
    }
    // console.log(url);
    $("#area").html('<option value="">--请选择区域--</option>');
    var str = '';
    $.ajax({
        type: "POST",
        url: "<?php echo $cdn?>index.php/admin/institution/area_sel",
        data: { "id": area, "level":2},
        dataType: "JSON",
        async: false,
        success: function (data) {
          // console.log(data);
            //从服务器获取数据进行绑定
            $.each(data, function (i, item) {
                // console.log(i);
                str += "<option value=" + i+ ">" + item + "</option>";
            })
            //将数据添加到省份这个下拉框里面
            $("#area").append(str);
        },
        error: function () { alert("Error"); }
    })
    
}

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

        // name:{
        //   validators: {
        //     notEmpty: {message: '机构名称不可为空'}
        //   }
        // },
        code:{
           validators: {
            notEmpty: {message: '代码标识不可为空'},
            remote:{
              url: '/index.php/admin/adminaction/action_check',
              type: 'POST',  
              delay:800,
              message:'代码标识不合法,请更换'                    
            }
          }                 
        }    

      }
   })
})     
</script>        
</body>
</html>


