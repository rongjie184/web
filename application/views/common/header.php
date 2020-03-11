  <header class="main-header">

    <!-- Logo -->
    <a href="/index.php/main" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>
      <?php 
        $n = preg_match('/([A-Z])[\w]*?([A-Z])/',$this->sysconfig->skeyword,$match) ;
        if($n){
          echo "<b>".$match[1]."</b>".$match[2];
        }else{
          echo strtoupper(substr($this->sysconfig->skeyword,0,2));
        }
      ?>            
      </b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
      <?php 
        $n = preg_match('/([A-Z][\w]*?)([A-Z][\w]*)/',$this->sysconfig->skeyword,$match) ;
        if($n){
          echo "<b>".$match[1]."</b>".$match[2];
        }else{
          echo $this->sysconfig->skeyword;
        }
      ?>    
      </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr"><?=$this->sysconfig->title?></span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?=$cdn?>/style/dist/img/user-default.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?=$this->session->userdata('uname');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header" style='height:80px'>
                <p>
                  账号: <?=$this->session->userdata('username');?>
                  <small>上次登录时间: &nbsp;<?php  
                  $last_login_time = $this->session->userdata('last_login_time');
                  echo $last_login_time?date('Y-m-d H:i:s',$last_login_time):'-';
                  ?></small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer" >
                <div class="pull-left">
                  <a href="/index.php/admin/user/edit_mypass" class="btn btn-default btn-flat">修改密码</a>
                </div>              
                <div class="pull-right">
                  <a href="/index.php/admin/login/login_out" class="btn btn-default btn-flat">退出</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>