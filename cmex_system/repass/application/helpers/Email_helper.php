<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	include(APPPATH . "../assets/plugins/PHPMailer/PHPMailer.php");
	include(APPPATH . "../assets/plugins/PHPMailer/SMTP.php");
	include(APPPATH . "../assets/plugins/PHPMailer/Exception.php");

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	
		function sendForgetMail($fname,$lname,$posiion,$organization,$empMail,$link){
			/* ======= Setting config ======= */
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host="smtp.office365.com";
			$mail->Port="587";
			$mail->IsHTML(true);
			$mail->SMTPAuth="true";
			$mail->SMTPSecure="tls";

			/* ======= Setting text ======= */
			$sub_txt="IT-CMEx Notification System | แจ้งขอเปลี่ยนรหัสผ่าน.";
			$sub = '=?UTF-8?B?'.base64_encode($sub_txt).'?=';
			$body_txt= "ได้ที่ลิงก์";

			/* ======= Setting Sender ======= */
			$mail->Username="athiwat_ton@windowslive.com";
			$mail->Password="^AK13eNPfjk$*N@gsd%k3pauPV";
			$mail->SetFrom($mail->Username, 'IT-CMEx');
			$mail->addAddress($empMail, 'ToEmail');
			
			/* ======= Start Message ======= */
			$mail->Subject = $sub;
			$mail->Body .= 'เรียน คุณ'.$fname.' '.$lname.'<br>';
			$mail->Body .= 'ตำแหน่ง '.$posiion.'<br>';
			$mail->Body .= 'อีเมลล์ '.$empMail.'<br><br>';
			$mail->Body .= 'ได้ทำการแจ้งลืมรหัสผ่าน<br>';
			$mail->Body .= 'สามารถเปลี่ยนรหัสผ่านได้<br>';
			$mail->Body .= 'ตามลิงก์ : <a href="'.$link.'">'.$link.'</a>';
			/* ======= End Message ======= */

			/* ======= Setting config unicode thai language ======= */
			$mail->CharSet = 'UTF-8';
			$mail->Encoding = 'base64';
			$send_stu="";

			/* ======= send ======= */
			if(!$mail->Send()){ $send_stu='Could not sent'; $send_stu.='Mailer Error: ' . $mail->ErrorInfo; }
			else{ $send_stu='Sended'; }
			
			$mail->smtpClose();
			return $send_stu;
		}
	

?>