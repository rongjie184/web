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
  <title><?=$this->config->item('web_title')?> | 添加科室</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
  <!-- select2 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/plugins/select2/select2.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?=$cdn?>/style/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=$cdn?>/style/dist/css/skins/_all-skins.min.css">

   <link rel="stylesheet" href="<?=$cdn?>/style/plugins/daterangepicker/daterangepicker.css">

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
        机构管理
        <small><?=$dept['id']?'修改科室':'添加科室'?></small>
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
              <h3 class="box-title">请填写科室信息</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <div class="box-body">

                <div class="form-group">
                  <label for="uname" class="col-sm-2 control-label">选择所属机构</label>
                  <div class="col-sm-2">
                      <select id='instid' name='instid' class="form-control select2" style="width: 100%;">
                                <option value='0'>选择机构</option>
                              
                                <?php
                                foreach($typelist as $value){
                                  $opt = '';
                                  if($typeid == $value['id']){
                                    $opt = 'selected';
                                  }
                                ?>
                                <option <?=$opt?> value='<?=$value['id'].','.$value['instname']?>' <?=$value['id'] ==$dept['inst_id']?'selected="selected"':''?>><?=$value['instname']?> </option>
                                <?php
                                }
                                ?>
                      </select>
         
                  </div>
                </div>

                <div class="form-group">
                   <input type="hidden" class="form-control" id="id"  name='id' value="<?=$dept['id']?>">
                  <label for="zh_action" class="col-sm-2 control-label">科室名称</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="name"  name='name' placeholder="请输入科室名称" value="<?=$dept['name']?>">
                  </div>
                 
                </div>


                <div class="form-group">
                  <label for="appid" class="col-sm-2 control-label">科室地点</label>
                  <div class="col-sm-3">
                   <span> <input type="text" class="form-control" id="address"  name='address' value="<?=$dept['address']?>"></span>
                  </div>
                </div>   

                <div class="form-group">
                  <label for="c" class="col-sm-2 control-label">疾病诊疗范围</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="purview" name='purview' placeholder="诊疗范围" value="<?=$dept['purview']?>">
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
                  <label for="uname" class="col-sm-2 control-label">选择所属类别</label>
                  <div class="col-sm-2">
                      <select id='dept_type' name='dept_type' class="form-control select2" style="width: 100%;">
                                <option value=''>选择类别</option>
                              
                                <?php
                                foreach($type as $value){
                                  $opt = '';
                                  if($typeid == $value['id']){
                                    $opt = 'selected';
                                  }
                                ?>
                                <option <?=$opt?> value='<?=$value?>'><?=$value?> </option>
                                <?php
                                }
                                ?>
                      </select>
         
                  </div>


                </div>
                <div class="form-group">
                  <label for="uname" class="col-sm-2 control-label"></label>
                  <div id="newlead1">
                    <?php foreach($dept_type as $key=>$val){?>
                          <div class="col-sm-2" id="mishu<?=$key+100?>"><input type="hidden" name="dept_type[]" value="<?=$val?>"><span type="text" class="form-control" style="width:150px;"><?=$val?></span><i class="glyphicon glyphicon-minus" onclick="msDel1(<?=$key+100?>)"></i></div>
                    <?php }?>
                  </div>
                </div>

             </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-info"><?=$dept['id']?'修改':'添加'?></button>
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



 $(function () {

  $(".select2").select2();

  // $(".datepicker").datepicker({
  //   autoclose: true,
  //   todayHighlight: true,
  //   language:"zh-CN", //--语言设置
  //   format:"yyyy-mm-dd"  //--日期显示格式
  // });
 });



$(document).ready(function(){
  $('#dept_type').change(function(){
    deptType();
  })
});

var num = 0;
function deptType(){
   // var provice = $("#mishuid option:selected").val();
   var lead = $('#dept_type').val();
    //判断省份这个下拉框选中的值是否为空
    if (lead == "") {
        return;
    }
    // var larr = lead.split(',');
    // console.log(lead);
     // $(this).val(num);
    var length = $('#newlead1 input').length; 
    ++num;
    var str = '<div class="col-sm-1" id="mishu'+num+'" ><input type="hidden" name="dept_type[]" value="'+lead+'"><span type="text" class=" radio-inline label label-default" >'+lead+'</span><i class="glyphicon glyphicon-remove" onclick="msDel1('+num+')" ></i></div>';
    // console.log(str);
    if(length >4){
      alert('最多添加5个');
      return ;
    }
    $("#newlead1").append(str);
   // <i class="glyphicon glyphicon-minus radio-inline" >删除</i> 
   
}

function msDel1(num1){
    $('#mishu'+num1).remove();
    // console.log(id);
}

 //    
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

        name:{
          validators: {
            notEmpty: {message: '科室名称不可为空'}
          }
        },
        instid:{
          validators: {
            notEmpty: {message: '中心机构不可为空'},
             callback: {
                      message: '必须选择一个中心机构',
                      callback: function(value, validator) {

                            if (value == 0) {
                                 return false;
                            }else {
                                 return true;
                            }
                        }
                    }
          }
        }    

      }
   })
})     
</script>        
</body>
</html>


