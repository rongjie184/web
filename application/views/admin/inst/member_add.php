
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
  <title><?=$this->config->item('web_title')?> | 添加机构人员</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=$cdn?>/style/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=$cdn?>/style/font-awesome-4.5.0/css/font-awesome.min.css">
    <!--select2-->
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
        机构管理
        <small><?=$member['id']?'修改人员':'添加人员'?></small>
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
              <input type="password" style="display: none;">
              <input type="hidden" class="form-control" id="memberId"  name='memberId' placeholder="年龄" value="<?=$member['id']?>" >
              <div class="box-body">

      			  <div class="form-group">
      				<label for="roleid" class="col-sm-2 control-label">人员姓名</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="uname" name='uname' placeholder="请输入用户姓名" value="<?=$member['name']?>">
                        </div>

      				</div>

                <div class="form-group">
                  <label for="uname" class="col-sm-2 control-label">选择所属机构</label>
                  <div class="col-sm-3">
                    <select id='instid' name='instid' class="form-control select2" style="width: 100%;">
                      <option value='0'>选择机构</option>
                      <?php
                      foreach($inst as $value){               
                      ?>
                      <option value='<?=$value['id']?>' <?=$value['id']==$member['inst_id']?'selected="selected"':''?>><?=$value['instname']?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                </div>

                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">科室</label>

                  <div class="col-sm-3">
                    <select id='department' name='department' class="form-control select2" style="width: 100%;">
                      <option value='0'>选择科室</option>
                      <?php
                      foreach($dept as $value){               
                      ?>
                      <option value="<?=$value['id'] ?>" <?=$value['id']==$member['department']?'selected="selected"':''?> ><?=$value['name']?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="passwd" class="col-sm-2 control-label">职位</label>

                  <div class="col-sm-3">
                    <select id='position' name='position' class="form-control select2" style="width: 100%;">
                      <option value='0'>选择职位</option>
                      <?php
                      foreach($position as $value){               
                      ?>
                      <option value="<?=$value['id'] ?>" <?=$value['id']==$member['position']?'selected="selected"':''?> ><?=$value['name']?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>

				
                <div class="form-group">
                  <label for="account" class="col-sm-2 control-label">年龄</label>

                  <div class="col-sm-1">
                    <input type="text" class="form-control" id="age"  name='age' placeholder="年龄" value="<?=$member['age']?>" >
                  </div>

                </div>
                
                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">性别</label>
                  <div class="col-sm-2" name="sex">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="sex" <?=$member['sex']==1?'checked="checked"':''?>>男
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="0" name="sex" <?=$member['sex']==0?'checked="checked"':''?> >女
                    </label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">联系电话</label>

                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="phone" name='phone' placeholder="请填写联系电话" value="<?=$member['phone']?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="text" class="col-sm-2 control-label">邮箱</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="email" name='email' placeholder="请填写邮箱" value="<?=$member['email']?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">办公地址</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="office_address" name='office_address' placeholder="请填写办公地址" value="<?=$member['office_address']?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">主管方向</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="in_charge" name='in_charge' placeholder="请填写主管方向" value="<?=$member['in_charge']?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">毕业院校</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="academy" name='academy' placeholder="请填写毕业院校" value="<?=$member['academy']?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">毕业时间</label>

                  <div class="col-sm-3">
                    <span> <input type="text" class="datepicker" id="graduation_time"  name='graduation_time' style="width:180px" value="<?=$member['graduation_time']?date('Y-m-d',$member['graduation_time']):''?>"></span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">专业</label>

                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="major" name='major' placeholder="请填写专业" value="<?=$member['major']?>">
                  </div>
                </div>

                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">学历</label>

                  <div class="col-sm-4" name="prior">
                    <label class="radio-inline">
                      <input type="radio" value="1" name="qualification" <?=$member['qualification']==1?'checked="checked"':''?>>博士
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="2" name="qualification" <?=$member['qualification']==2?'checked="checked"':''?>>硕士
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="3" name="qualification" <?=$member['qualification']==3?'checked="checked"':''?>>本科
                    </label>
                    <label class="radio-inline">
                      <input type="radio" value="4" name="qualification" <?=$member['qualification']==4?'checked="checked"':''?>>专科
                    </label>
                  </div>
                </div>

                

                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">性格特征</label>

                  <div class="col-sm-4">
                    <textarea type="text" class="form-control" id="character" name='character' placeholder="请填写性格特征" ><?=$member['character']?></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label for="repatpass" class="col-sm-2 control-label">兴趣爱好</label>
                  <div class="col-sm-4">
                    <textarea type="text" class="form-control" id="interest" name='interest' placeholder="请填写兴趣爱好" ><?=$member['interest']?></textarea>
                  </div>
                </div>

                <!--新加字段-->
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
<<!-- AdminLTE App -->
<script src="<?=$cdn?>/style/dist/js/app.min.js"></script>
<!-- Select2 -->
<script src="<?=$cdn?>/style/plugins/select2/select2.full.min.js"></script>
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
  });
});

$(document).ready(function(){
  $('#instid').change(function(){
    instBind();
  })
});


function instBind(){
   // var provice = $("#Province option:selected").val();
   var provice = $('#instid').val();
    //判断省份这个下拉框选中的值是否为空
    if (provice == "") {
        return;
    }
    // console.log(provice);
    $("#department").html('<option value="">--请选择科室--</option>');
    $("#position").html('<option value="">--请选择职位--</option>')
    var str = '';
    var str1 = '';
    $.ajax({
        type: "POST",
        url: "<?php echo $cdn?>index.php/admin/institution/dept",
        data: { "id": provice, "level":1},
        dataType: "JSON",
        async: false,
        success: function (data) {
          // console.log(data);
            //从服务器获取数据进行绑定
            $.each(data['keshi'], function (i, item) {
                console.log(item);
                var position;
                if(item['name']){
                  position = "("+item['name']+")";
                }else{
                  position ='';
                }
                str += "<option value=" + item['id']+ ">" + item['name']  +"</option>";
            });
            $.each(data['position'], function (i, item) {
                console.log(item);
                var position;  
                str1 += "<option value=" + item['id']+ ">" + item['name'] +"</option>";
            });

            //将数据添加到省份这个下拉框里面
            $("#department").append(str);
            $("#position").append(str1);
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
        uname:{
          validators: {
            notEmpty: {message: '姓名不可为空'}
          }
        },
    roleid:{
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
        },
        
    phone:{
           validators: {
            // notEmpty: {message: '手机号不可为空'},
            remote:{
              url: '/index.php/admin/web_user/user_phone_check',
              type: 'post',  
              delay:800,
              message:'登录手机号不合法或已存在,请更换'                    
            }
          }                 
        },
    email:{
           validators: {
            // notEmpty: {message: '用户邮箱不可为空'},
            remote:{
              url: '/index.php/admin/web_user/user_email_check',
              type: 'post',  
              delay:800,
              message:'登录邮箱不合法或已存在,请更换'                    
            }
          }                 
        }

      }
   })
})     
</script>     
</body>
</html>
