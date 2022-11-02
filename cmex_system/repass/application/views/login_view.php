<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ระบบจัดการรหัสผ่าน | Log in</title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>../common/assets/images/favicon.ico">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">

  <!-- [Athwiat][01/06/2564][add style] -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/noscript.css" /></noscript>
  
  <style>
    .fpass{
      float:right !important; 
      margin-top:5px !important;
    }
  </style>

</head>


<body class="is-preload">
  <div id="wrapper">
    <section id="main">
        <!-- <p class="tc-back font-b mb0">ข้อมูลผู้ใช้</p><hr class="mt2"> -->
        <!-- <p class="tc-back font-b mb0 mt5 fs20">ระบบจัดการรหัสผ่าน</p> -->
        <p class="tc-back font-b mb0 mt5 fs20">ระบบจัดการ ข้อมูลพนักงาน</p> <!-- [Athwiat][17/10/2565][Mo] -->
        <br>
        <!-- <br><p class="tc-back font-b mb0">ตั้งรหัสผ่านใหม่</p><hr class="mt2"> -->

        <!-- [Athwiat][17/10/2565][Mo] -->
        <?php //$base_url = base_url(); ?>
        <!-- <form role="form" method="POST" action="<?php echo base_url(); ?>Login/process"> -->
        <!-- <form role="form" id="form_login" method="POST" enctype="multipart/form-data"> -->
        <section class="content">
	        <div class="container-fluid">
            <form role="form" method="post" id="form_repass_login" name="form_repass_login" enctype="multipart/form-data">
              <input type="hidden" name="user_link" value="<?php echo $user_link; ?>">
              <div class="input-group mb-3">
                <!-- [Athwiat][17/10/2565][Cut && Backup onchange and oninput] -->
                <input type="text" class="form-control" name="username" placeholder="รหัสพนักงาน" id="username" oninput="check_username_login(this.value,'username','div_msg');">
                <!-- onchange="checkInjection(this.value,'username');" oninput="checkInjection(this.value,'username');" -->
                  <div class="input-group-text">
                <div class="input-group-append">
                  <ion-icon name="person-circle-outline"></ion-icon>
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <!-- [Athwiat][17/10/2565][Cut && Backup onchange and oninput] -->
                <input type="password" class="form-control" name="password" placeholder="รหัสผ่าน" id="password" oninput="check_password_login(this.value,'password','div_msg');">
                <!-- onchange="checkInjection(this.value,'password');" oninput="checkInjection(this.value,'password');" -->
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div id='div_btn_login' class="col-12 div_btn_login">
                  <!-- <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button> -->
                  <button id="btn_submit" name="btn_submit" type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                </div>
                <div id="div_forget_password" class="col-12 div_forget_password">
                  <?php $btn_forget="ลืมรหัสผ่าน";  $url_forget_pass=base_url()."Forget/formForget"; ?>
                  <div class="col-12"><span class="badge badge-pill badge-light fpass"><a href="<?php echo $url_forget_pass; ?>" ><?php echo $btn_forget; ?></a></span></div>
                </div>
                <div class="col-12" id="div_msg"><?php echo $msg; ?></div>
              </div>

              <div style="margin-top:30px;">
                  <?php
                    $img1=base_url()."assets/img/cmex_logo2.png";
                    $img2=base_url()."assets/img/med_logo.png";
                    $img3=base_url()."assets/img/cmu_logo.png";
                  ?>
                  <img src='<?php echo $img1; ?>' height="23">
                  <img src='<?php echo $img2; ?>' height="23">
                  <img src='<?php echo $img3; ?>' height="23">
              </div>

            </form>
          </div>
        </section>
    </section>
  </div>
  <!-- Footer -->
  <footer id="footer">
    <ul class="copyright">
      <a href="/meccmu/">
      <li>&copy; ศูนย์ความเป็นเลิศทางการแพทย์</li><li>คณะแพทยศาสตร์ มหาวิทยาลัยเชียงใหม่</li>
      </a>
    </ul>
  </footer>

<!-- /.login-box -->
<!-- [Anucha][06/10/2565][checkInjection] -->
<!-- SQL injection -->
<!-- <script src="/website_cmex_helper/js/injection.js"></script> -->

<!-- [Athwiat][17/10/2565][add validate_login helper] -->
<!-- <script src="/website_cmex_helper/js/validate_login.js"></script> -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.js"></script>

<!-- <script src="<?php echo base_url(); ?>assets/js/jquery-3.1.0.min.js"></script> -->
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>

<!-- Scripts -->
<script type="text/javascript">
  
  if ('addEventListener' in window) {
    window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-preload\b/, ''); });
    document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
  }

  //[Ath][17/10/2565][add var relationshiped with website_cmex_helper/validate_login.js && form_submit]
  var user_pattern = false;
  var pwd_pattern = false;
  // var base_url = <?php //echo json_encode($base_url); ?>;
  // var base_url_home = <?php //echo base_url('Home'); ?>;
  <?php echo 'var base_url="'.base_url().'"; ';?>
  <?php echo 'var base_url_home="'.base_url('Home').'"; ';?>
  <?php echo 'var base_url_login="'.base_url('Login/process').'"; ';?>
  
  //$("#div_forget_password").hide(); //[Ath][17/10/2565][add hide]
  
  $("#form_repass_login").on("submit",function(e){
    e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax
    
    if(pwd_pattern && user_pattern){
      
      $.ajax({
        url:base_url_login,
        type:'post',
        dataType:'json',
        data:new FormData(this),
        cache:false,
        contentType:false,
        processData:false,
        success:function(res){
          // console.log(res);
          if(res['validate']){
            window.location.href = base_url_home;
          }else{
            AlertWrongPasswordLogin('div_msg');
          }
        },error:function(xhr,textStatus,errorThrown,res){
          alert("POST form_repass_login\nStatus: "+textStatus+"\nError: "+errorThrown+"\nFunction: form_repass_login");
        }
      });

    }
    
  });

</script>

<!-- [Ath][17/10/2565][Add helper][add var relationshiped with website_cmex_helper/validate_login.js && form_submit] -->
<script src="/website_cmex_helper/js/validate_login.js"></script>

</body>
</html>
