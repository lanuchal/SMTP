<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ระบบจัดการรหัสผ่าน | Forget password</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>../common/assets/images/favicon.ico">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">

  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">

   <!-- [ton][24/05/2564][add sweetalert] -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert2.min.css">

  <!-- [Athwiat][01/06/2564][add style] -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
  <noscript><link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/noscript.css" /></noscript>
  
  <style>
    .fpass{
      float:right !important; 
      margin-top:5px !important;
    }
  </style>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script> <!-- [Athiwat][14/06/2564][add recaptcha] -->

</head>

<body class="is-preload">
  <div id="wrapper">
    <section id="main">
        <p class="tc-back font-b mb0 mt5 fs20">ระบบแจ้งลืมรหัสผ่าน</p><br>
              
        <form role="form" method="POST" id="form_request_forget" >
          <input type="hidden" name="user_link" value="<?php echo $user_link; ?>">

          <div class="input-group mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="รหัสพนักงาน">
            <div class="input-group-text">
              <div class="input-group-append">
                <ion-icon name="person-circle-outline"></ion-icon>
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <!-- [Athiwat][14/06/2564][add recaptcha] -->
          <div class="row">
            <div class="col-12">
              <div class="g-recaptcha ds-inb" data-sitekey="<?php echo SITE_KEY; ?>">
              </div>
            </div>
          </div>
          
          <!-- [Athiwat][14/06/2564][edit div] -->
          <div class="row">
            <div class="col-0 mt10"></div>
            <div class="col-12 mt10"><button type="submit" class="btn btn-primary btn-block">ขอเปลี่ยนรหัสผ่าน</button></div>
            <div class="col-2 mt10"></div>
          </div>

          <div class="col-12" id="div_msg">
            <?php echo $msg; ?>
            <div><p class="form_error_username"></p></div>
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

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>

<!-- [ton][18/04/2564][add sweetalert] -->
<script src="<?php echo base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert-dev.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert.min.js"></script>

<!-- Scripts -->
<script>
  if ('addEventListener' in window) {
    window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-preload\b/, ''); });
    document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
  }
</script>

</body>
</html>
