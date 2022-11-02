<?php
// [Ath][12/10/2565][Modify]
// require_once('PHPMailer/PHPMailer.php');
// require_once('PHPMailer/SMTP.php');
// require_once('PHPMailer/Exception.php');
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// [Ath][13/10/2565][Modify]
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');
require_once('PHPMailer/src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$fname = (isset($_POST['fname']) && !empty($_POST['fname'])) ? $_POST['fname'] : null;
$lname = (isset($_POST['lname']) && !empty($_POST['lname'])) ? $_POST['lname'] : null;
$posiion = (isset($_POST['position_name']) && !empty($_POST['position_name'])) ? $_POST['position_name'] : null;
$organization = (isset($_POST['New_Heading']) && !empty($_POST['New_Heading'])) ? $_POST['New_Heading'] : null;
$empMail = (isset($_POST['employee_cmu_email']) && !empty($_POST['employee_cmu_email'])) ? $_POST['employee_cmu_email'] : null;
$link = (isset($_POST['link']) && !empty($_POST['link'])) ? $_POST['link'] : null;
// echo json_encode($fname);
// exit();
//[Ath][12/10/2565][Add]
$link = "https://excellent.med.cmu.ac.th/cmex_system/repass2/Forget/LF/64027/dypoCxrq9p1vkayBmh7fDHCAjF5kam09Hf8q5z6m8zzwj";
// $link="http://excellent.med.cmu.ac.th/cmex_system/repass/Forget/LF/64027/dypoCxrq9p1vkayBmh7fDHCAjF5kam09Hf8q5z6m8zzwj";
$empMail="athiwat.du@cmu.ac.th";
// $empMail = "anucha.lu@cmu.ac.th";

if ($link != null && $empMail != null) {
	/* ======= Setting config ======= */
	
	
	$mail = new PHPMailer();

	$mail->SMTPDebug = 3;
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;

	$mail->isSMTP();
	$mail->Host = "smtp.office365.com";
	$mail->Port = "587";
	$mail->IsHTML(true);
	$mail->SMTPAuth = "true";
	$mail->SMTPSecure = "tls";

	/* ======= Setting text ======= */
	$sub_txt = "IT CMEx Forget Password Notification | แจ้งลืมรหัสผ่าน.";
	$sub = '=?UTF-8?B?' . base64_encode($sub_txt) . '?=';
	$body_txt = "ได้ที่ลิงก์";

	/* ======= Setting Sender ======= */
	$mail->Username = "athiwat_ton@windowslive.com";
	$mail->Password = "^AK13eNPfjk$*N@gsd%k3pauPV";
	$mail->SetFrom($mail->Username, 'IT CMEx');
	$mail->addAddress($empMail, 'ToEmail');

	/* ======= Start Message ======= */
	$mail->Subject = $sub;
	$mail->Body .= 'เรียน คุณ' . $fname . ' ' . $lname . '<br>';
	$mail->Body .= 'ตำแหน่ง ' . $posiion . '<br>';
	$mail->Body .= 'อีเมลล์ ' . $empMail . '<br><br>';
	$mail->Body .= 'ได้ทำการแจ้งลืมรหัสผ่าน<br>';
	$mail->Body .= 'ท่านสามารถเปลี่ยนรหัสผ่านได้<br>';
	$mail->Body .= 'ที่ลิงก์ : <a href="' . $link . '">' . $link . '</a>';
	/* ======= End Message ======= */

	/* ======= Setting config unicode thai language ======= */
	$mail->CharSet = 'UTF-8';
	$mail->Encoding = 'base64';

	/* ======= send ======= */
	$res['send_stu'] = "";
	if (!$mail->Send()) {
		$res['send_stu'] = 'Mailer Error : ' . $mail->ErrorInfo;
	} else {
		$res['send_stu'] = 'Sended';
	}
	$mail->smtpClose();
	// echo json_encode($res);
	// exit();
} else $res['send_stu'] = "Could not sent.";


//[Ath][12/10/2565][Add]
// print_r($mail);
echo json_encode($res['send_stu']);
