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

  <!-- [Athwiat][24/05/2564][add sweetalert] -->
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

</head>
<body class="is-preload">
<?php 
if(isset($latest_token_status) && !empty($latest_token_status)){
  // [Athiwat][07/06/2564][add reaction not token latest.]
}else if(isset($timeout_token_status) && !empty($timeout_token_status)){
  // [Athiwat][07/06/2564][add reaction token timeout.]
}else{ ?>
  <div id="wrapper">
  <section id="main">
      <!-- <p class="tc-back font-b mb0">ข้อมูลผู้ใช้</p><hr class="mt2"> -->
      <heade>
        <span class="avatar">
          <?php
            // [Athiwat][02/07/2564][add file_exists()] 
            /*if (file_exists('../../../assets/img/person/'.$numot . '.png'))  echo '../../../assets/img/person/'.$numot . '.png';
              else echo '../../../assets/img/avatar.jpg'; */
            $filename_a="avatar";
            if(file_exists(PATH_IMG_EMP.$numot.'.png')) $img_file_path = URL_IMG_EMP.$numot.'.png';
            else $img_file_path = base_url().PATH_IMG_PERSON;
          ?>
          <img src="<?php echo $img_file_path;?>" alt="" width="122"/>
          <?php //echo $img_file_path; ?>
        </span>
      </heade>
      
        <div class="col-12">
          <div class="row">
          <div class="col-5 col-sm-5"><p class="tc-back-mb5 font-b">รหัสพนักงาน</p></div>
          <div class="col-7 col-sm-7"><p class="tc-back-mb5"><?php echo $numot; ?></p></div>
          </div>
        </div>
        <div class="col-12">
          <div class="row">
          <div class="col-5 col-sm-5"><p class="tc-back-mb5 ">ชื่อ-นามสกุล</p></div>
          <div class="col-7 col-sm-7"><p class="tc-back-mb5"><?php echo "คุณ ".$fname." ".$lname; ?></p></div>
          </div>
        </div>
        <div class="col-12">
          <div class="row">
          <div class="col-5 col-sm-5"><p class="tc-back-mb5 ">ตำแหน่ง</p></div>
          <div class="col-7 col-sm-7"><p class="tc-back-mb5"><?php echo $position; ?></p></div>
          </div>
        </div>
        <div class="col-12">
          <div class="row">
          <div class="col-5 col-sm-5"><p class="tc-back-mb5 ">สำนักงาน</p></div>
          <div class="col-7 col-sm-7"><p class="tc-back-mb5"><?php echo $organization; ?></p></div>
          </div>
        </div>
        
        <p class="tc-back font-b mb0 mt10 tal-l">คำแนะนำการตั้งรหัสผ่าน</p>
        <hr class="mt2">
        <p class="tc-back mb0 tal-l">1. ตั้งรหัสผ่านที่มีความยาวอย่างน้อย 12 - 20 ตัวอักษร<br>
                                     2. อย่าใช้รหัสผ่านที่สั้นเกินไปหรือ คำที่คาดเดาง่าย เช่น วันเดือนปีเกิด<br>
                                     3. สามารถใช้ประโยคที่ยาวหรือ ซ้ำกันได้ เน้นที่ความยาวของรหัสผ่าน</p>
         <div class="row"> 
          <p class="tc-back">&nbsp;&nbsp;&nbsp;&nbsp;เช่น</p>
          <p class="tc-warning">&nbsp; hotelcalifornia ,morningyellowsunday ,july1990july1990</p>
        </div>

        <p class="tc-back font-b mb10 mt10 tal-l">ตั้งรหัสผ่าน</p>
        <!-- <hr class="mt2"> -->

        <form role="form" method="POST" id="form_forget_password" class="form_forget_password">

          <div class="input-group mb-3 mb0">
            <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="รหัสผ่านใหม่">
            <div class="input-group-text">
              <div class="input-group-append">
                <span class="fas fa-eye-slash toggle-password" id="showpass_one" class="toggle-password" aria-label="แสดงรหัสผ่าน" onclick="toggle_password(this);" role="button"></span>
              </div>
              
            </div>
          </div>
          <div><p class="form_error_newpassword mb10"></p></div>
          
          <div class="input-group mb-3 mb0">
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="ยืนยันรหัสผ่านใหม่" maxlength="40">
              <div class="input-group-text">
                <div class="input-group-append">
                  <ion-icon name="person-circle-outline"></ion-icon>
                  <span class="fas fa-eye-slash toggle-password" id="showpass_two" class="toggle-password" aria-label="แสดงรหัสผ่าน" onclick="toggle_password(this);" role="button"></span>
                </div>
               
              </div>
          </div>
          <div><p class="form_error_confirmpassword mb10"></p></div>
          
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="user_link" value="<?php echo $user_link; ?>">
              <input type="hidden" name="hidden_numot" value="<?php echo $numot; ?>">
              <input type="hidden" name="hidden_forget_token" value="<?php echo $forget_token; ?>">
              <button type="submit" class="btn btn-primary btn-block">บันทึก</button>
            </div>
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
  <!-- Footer -->
  <footer id="footer">
    <ul class="copyright">
      <a href="/meccmu/">
      <li>&copy; ศูนย์ความเป็นเลิศทางการแพทย์</li><li>คณะแพทยศาสตร์ มหาวิทยาลัยเชียงใหม่</li>
      </a>
    </ul>
  </footer>
  </div>

  <!--[Athwiat][01/06/2564][add comment.]-->
  <!-- <div class="login-logo w500">
    <b>ระบบจัดการรหัสผ่าน</b> 
  </div>
  <div class="card w500">
    <div class="card-body login-card-body"></div>
  </div> -->
  

<?php } ?>

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
