<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>

<!-- fullCalendar 2.2.5 -->
<script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/main.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar-interaction/main.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/fullcalendar-bootstrap/main.min.js"></script>


<script>
	<?php echo 'var base_url="'.base_url().'";';?>

	//[Athiwat][10/06/2564][add function sendForgetMail]
	function sendForgetMail(datas){
		if(typeof(datas)!="undefined" && datas!==null){
			$.ajax({
				type:"POST",
				url:'<?php echo HOST_URL_UES_IN_CON."service/sendmail.php"; ?>',
				dataType:'json',
				data:datas,
				success:function(res){
					alert("Coming sendmail.php ^^");
					// console.log("res[send_stu] : "+res['send_stu']);
					// console.log("sendForgetMail("+res['send_stu']+")");
					if(res['send_stu']=="Sended"){
						// console.log("sendForgetMail(Sended)");
						swal({title:"ส่งคำขอเปลี่ยนรหัสผ่านแล้ว",text:"กรุณาตรวจสอบอีเมลล์CMU ของท่าน",type:"success",timer:9500});
						setTimeout(function(){location.href=base_url},6500);
					}else{
						swal({title:"ไม่สามารถแจ้งลืมได้ !",text:"คลิกปุ่ม OK เพื่อกลับสู่หน้าหลัก",type:"warning",timer:9500});
						setTimeout(function(){location.href=base_url},6500);
					}
				},error:function(xhr,textSatus,errorThrown,res){
					alert("Get sendForgetMail\nStatus: "+textSatus+"\nError: "+errorThrown+"\nFunction: sendForgetMail");
				}
			});
		}
	}

	// ------------------------------ [form_request_forget] ------------------------------
	$("body").on("submit","#form_request_forget",function(e){
		e.preventDefault();
			$.ajax({
				type:"POST",
				url:'<?php echo base_url()."Forget/requestForgetPassword"?>',
				dataType:'json',
				data:new FormData(this),
				cache:false,
				contentType:false,
				processData:false,
				success:function(res){
					if(!res["request_status"] && res['form_error_username']!=''){
						$(".form_error_username").html(res['form_error_username']).addClass('invalid-feedback d-block');
						$("#username").addClass("id-invalid");
						// console.log("c 1"); //[Athwiat][12/10/2564][add comment]
					}else if(!res["captcha_status"] && res["form_error_captcha"]!=""){
						$(".form_error_username").html(res['form_error_captcha']).addClass('invalid-feedback d-block');
						$(".g-recaptcha").addClass("id-invalid");
						// console.log("c 2"); //[Athwiat][12/10/2564][add comment]
					}else{
						if(res["request_status"] && res["captcha_status"]){
							$(".form_error_username").html(res['form_error_username']).addClass('invalid-feedback d-block');
							$("#username").addClass("id-invalid");
							
							$(".form_error_username").html(res['form_error_captcha']).addClass('invalid-feedback d-block');
							$(".g-recaptcha").addClass("id-invalid");

							//[Athiwat][10/06/2564][add service function sendForgetMail]
							//[Athwiat][15/06/2564][5.process send mail]
							
							sendForgetMail(res);
							//[Athwiat][12/10/2564][add view]
							console.log("Called sendForgetMail().");
							console.log(res);
						}
					}
					// [Athwiat][15/06/2564][add view status]
					// console.log("r : "+res["request_status"]);  console.log("desc : "+res["form_error_username"]);
					// console.log("c : "+res["captcha_status"]);	console.log("desc : "+res["form_error_captcha"]);
					// console.log("__________________________");
				},error:function(xhr,textSatus,errorThrown,res){
					alert("Get form_request_forget\nStatus: "+textSatus+"\nError: "+errorThrown+"\nFunction: form_request_forget");
				}
			});
	});

</script>
