
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
  <title><?=$this->config->item('web_title')?> | 添加机构负责人</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!--select2-->
  <link rel="stylesheet" href="<?=$cdn?>/style/plugins/select2/select2.min.css">
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
        机构管理
        <small><?=$member['id']?'修改负责人':'添加负责人'?></small>
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
              <h3 class="box-title">添加负责人</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action='<?=$this->form_action?>' id='iForm'>
              <input type="password" style="display: none;">
              <div class="box-body">

                <div class="form-group">
                  <label for="uname" class="col-sm-2 control-label">选择所属机构</label>
                  <div class="col-sm-3">
                    <span type="text" class="form-control" ><?=$inst['instname']?></span>
                    <input type="hidden" id="instId" name="instId" value="<?=$inst['id']?>">
                    <input type="hidden" id="did" name="did" value="<?=$pid?>">
                   <!--  <select id='instid' name='instid' class="form-control select2" style="width: 100%;">
                                <option value='0'>选择机构</option>
                              
                                <?php
                                foreach($inst as $value){
                                  $opt = '';
                                  if($typeid == $value['id']){
                                    $opt = 'selected';
                                  }
                                ?>
                                <option <?=$opt?> value='<?=$value['id']?>' <?=$value['id'] ==$info['inst_id']?'selected="selected"':''?>><?=$value['instname']?> </option>
                                <?php
                                }
                                ?>
                    </select> -->
                  </div>

                </div>

				
                <div class="form-group">
                  <label for="account" class="col-sm-2 control-label">选择添加主任</label>

                
                  <div class="col-sm-2">
                    <select id='leadid' name='leadid' class="form-control select2" style="width: 100%;">
                                <option value='0'>选择主任</option>
                              
                                <?php
                                foreach($inst_member as $value){
                                  $opt = '';
                                  if($typeid == $value['id']){
                                    $opt = 'selected';
                                  }
                                ?>
                                <option <?=$opt?> value='<?=$value['id']?>' ><?=$value['name']?> </option>
                                <?php
                                }
                                ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="passwd" class="col-sm-2 control-label">选择添加秘书</label>

                  
                  <div class="col-sm-2">
                    <select id='mishuid'  class="form-control select2" style="width: 100%;">
                                <option value=''>选择秘书</option>
                              
                                <?php
                                foreach($inst_member as $value){
                                  $opt = '';
                                  if($typeid == $value['id']){
                                    $opt = 'selected';
                                  }
                                ?>
                                <option <?=$opt?> value='<?=$value['id'].','.$value['name']?>' ><?=$value['name']?> </option>
                                <?php
                                }
                                ?>
                    </select>
                  </div>
                </div>

                <div class="form-group" id="newlead">
                    <label for="zh_action" class="col-sm-2 control-label"></label>
                    <!-- <?php foreach ($user as $key=>$value) {?>
                      <div class="col-sm-2" id="lead<?=$key+100?>">
                        <input type="hidden"  name="lead[]" value="<?=$value['id']?>">
                        <span type="text" class="form-control"><?=$value['name']?></span><i class="glyphicon glyphicon-minus" onclick="msDel(<?=$key+100?>)"></i>
                      </div>
                    <?php }?> -->

                </div>




              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-4">
                    <button type="submit" class="btn btn-info"><?=$member['id']?'修改':'添加'?></button>
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
<<!-- AdminLTE App -->
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
$(document).ready(function(){
  $(".select2").select2();

  $(".datepicker").datepicker({
    autoclose: true,
    todayHighlight: true,
    language:"zh-CN", //--语言设置
    format:"yyyy-mm-dd"  //--日期显示格式
})
});


$(document).ready(function(){
  $('#mishuid').change(function(){
    leadBind();
  })
});

var num = 0;
function leadBind(){
   // var provice = $("#mishuid option:selected").val();
   var lead = $('#mishuid').val();
    //判断省份这个下拉框选中的值是否为空
    if (lead == "") {
        return;
    }
    console.log(lead);
    var larr = lead.split(',');
     // $(this).val(num);
    var length = $('#newlead input').length; 
    ++num;
    var str = '<div class="col-sm-2" id="lead'+num+'"><input type="hidden"  name="mishu[]" value="'+larr[0]+'"><span type="text" class="form-control">'+larr[1]+'</span><i class="glyphicon glyphicon-minus" onclick="msDel('+num+')"></i></div>';
    if(length >4){
      alert('最多添加5个');
      return ;
    }
    $("#newlead").append(str);
   // <i class="glyphicon glyphicon-minus radio-inline" >删除</i> 
   
}


function msDel(num1){
    $('#lead'+num1).remove();
    // console.log(id);
}



// $(document).ready(function(){
//   $('#instid').change(function(){
//     instBind();
//   })
// });

// $(document).ready(function(){
//   $('#mishuDel').click(function(){
//     mishuDel();
//   })
// });

// $(document).ready(function(){
//   $('#mishuid').change(function(){
//       mishuBind();
//   })
// })

// function instBind(){
//    // var provice = $("#Province option:selected").val();
//    var provice = $('#instid').val();
//     //判断省份这个下拉框选中的值是否为空
//     if (provice == "") {
//         return;
//     }
//     // console.log(provice);
//     $("#leadid").html('<option value="">--请选择主任--</option>');
//     $("#mishuid").html('<option value="">--请选择秘书--</option>')
//     var str = '';
//     $.ajax({
//         type: "POST",
//         url: "<?php echo $cdn?>index.php/admin/institution/member",
//         data: { "id": provice, "level":1},
//         dataType: "JSON",
//         async: false,
//         success: function (data) {
//           // console.log(data);
//             //从服务器获取数据进行绑定
//             $.each(data, function (i, item) {
//                 // console.log(i);
//                 var position;
//                 if(item['position']){
//                   position = "("+item['position']+")";
//                 }else{
//                   position ='';
//                 }
//                 str += "<option value=" + item['id']+','+item['name']+ ">" + item['name'] + position +"</option>";
//             })
//             //将数据添加到省份这个下拉框里面
//             $("#leadid").append(str);
//             $("#mishuid").append(str);
//         },
//         error: function () { alert("Error"); }
//     })
// }

// var num = 0;
// function mishuBind(){
//    // var provice = $("#mishuid option:selected").val();
//    var mishu = $('#mishuid').val();
//    console.log(mishu);
//     //判断省份这个下拉框选中的值是否为空
//     if (mishu == "") {
//         return;
//     }
//     var marr = mishu.split(',');
//     ++num;
//     $(this).val(num);
//     var str = '<div id="new'+num+'"><div class="form-group"><label class="col-sm-2 control-label"></label><div class="col-sm-2" id="mishudiv" ><input type="hidden" name="mishu[]" value="'+marr[0]+'"><input type="text" class="form-control" id="mi'+num+'" value="'+marr[1]+'" ></div><div class="col-sm-2" id="mishuDel"  ><a href="javascript:void(0)" class="glyphicon glyphicon-minus radio-inline" onclick="msDel('+num+')" >删除</a> </div></div></div>';
//     $("#newbox").append(str);
//    // <i class="glyphicon glyphicon-minus radio-inline" >删除</i> 
// }
// function msDel(num){
//     $('#new'+num).remove();
//     // console.log(id);
// }


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
        uname:{
          validators: {
            notEmpty: {message: '管理员姓名不可为空'}
          }
        },
		roleid:{
          validators: {
            notEmpty: {message: '用户角色不可为空'}
			,
             callback: {
                      message: '必须选择一个角色',
                      callback: function(value, validator) {

                            if (value == 0) {
                                 return false;
                            }else {
                                 return true;
                            }
                        }
                    }
          }
        },
        account:{
           validators: {
            notEmpty: {message: '用户账号不可为空'},
            remote:{
              url: '/index.php/admin/user/user_account_check',
              type: 'post',  
              delay:800,
              message:'登录账号不合法或已存在,请更换'                    
            }
          }                 
        },
        passwd: {
          validators: {
            notEmpty: {message: '密码不可为空'}
          }
        },
        repatpass:{
          validators:{
            // notEmpty: {message: '重复密码不可为空'},
            identical:{field:'passwd',message:'两次密码输入不一致'}
          }
        }

      }
   })
})     
</script>     
</body>
</html>
