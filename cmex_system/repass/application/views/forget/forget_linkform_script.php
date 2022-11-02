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
	<?php 
		echo 'var base_url="'.base_url().'";';

		// [Athiwat][07/06/2564][add reaction token timeout.]
		if(isset($timeout_token_status) && !empty($timeout_token_status)) echo 'var timeout_token_status="'.$timeout_token_status.'";';
		if(isset($timeout_token_desc) && !empty($timeout_token_desc)) echo 'var timeout_token_desc="'.$timeout_token_status.'";';

		// [Athiwat][07/06/2564][add reaction not token latest.]
		if(isset($latest_token_status) && !empty($latest_token_status)) echo 'var latest_token_status="'.$latest_token_status.'";';
		if(isset($latest_token_remark) && !empty($latest_token_remark)) echo 'var latest_token_remark="'.$latest_token_remark.'";';
		
	?>

	if(typeof(timeout_token_status)!="undefined" && timeout_token_status!==null) checkTokenTimeout(timeout_token_status,timeout_token_desc);
	if(typeof(latest_token_status)!="undefined" && latest_token_status!==null) checkTokenLatest(latest_token_status,latest_token_remark);

	function checkTokenTimeout(stu,desc){
		if(typeof(stu)!=="undefined" && stu=="true"){
			swal({title:"ลิงก์หมดอายุการใช้งาน !",text:"คลิกปุ่ม OK เพื่อกลับสู่หน้าหลัก",type:"warning",timer:9500});
			setTimeout(function(){location.href=base_url},6500);
		}
	}

	function checkTokenLatest(stu,desc){
		// console.log("come checkTokenLatest and latest_token_status : "+stu+" ,desc : "+desc);
		if(typeof(stu)!="undefined" && stu=="false"){
			swal({title:"ไม่สามารถใช้งานลิงก์นี้ได้ !",text:"คลิกปุ่ม OK เพื่อกลับสู่หน้าหลัก",type:"warning",timer:9500});
			setTimeout(function(){location.href=base_url},6500);
		}
	}

	function toggle_password(e){
		$(e).toggleClass("fa-eye fa-eye-slash");
		var input_one=$("#newpassword");
		var input_two=$("#confirmpassword");
		if(e==document.getElementById("showpass_one")){
			if(input_one.attr("type")==="password") input_one.attr("type","text");
			else if(input_one.attr("type")==="text") input_one.attr("type","password");
		}
		if(e==document.getElementById("showpass_two")){
			if(input_two.attr("type")==="password") input_two.attr("type","text");
			else if(input_two.attr("type")==="text") input_two.attr("type","password");
		}
	}

	$("#form_forget_password").on("submit",function(e){
		e.preventDefault();
		
		$.ajax({
			type:"POST",
			url:"<?php echo base_url().'Forget/updateForgetProcess';?>",
			dataType:"json",
			data:new FormData(this),
			cache:false,
			contentType:false,
			processData:false,
			success:function(res){
				// console.log("submit form forget password[success].");
				// console.log(res);
				if(!res['update_status']){
					if(res['form_error_newpassword']!=""){
						$(".form_error_newpassword").html(res['form_error_newpassword']).addClass("invalid-feedback d-block");
						$("#newpassword").addClass("id-invalid");
					}else{
						$(".form_error_newpassword").html(res['form_error_newpassword']).removeClass("invalid-feedback d-block");
						$("#newpassword").removeClass("id-invalid");
					}
					if(res['form_error_confirmpassword']!=""){
						$(".form_error_confirmpassword").html(res['form_error_confirmpassword']).addClass("invalid-feedback d-block");
						$("#confirmpassword").addClass("id-invalid");
					}else{
						$(".form_error_confirmpassword").html(res['form_error_confirmpassword']).removeClass("invalid-feedback d-block");
						$("#confirmpassword").removeClass("id-invalid");
					}
				}else{
					$(".form_error_newpassword").html(res['form_error_newpassword']).removeClass("invalid-feedback d-block");
					$('.form_error_confirmpassword').html(res['form_error_confirmpassword']).removeClass('invalid-feedback d-block');
					$("#newpassword").removeClass("invalid-feedback d-block");
					$('#confirmpassword').removeClass("invalid-feedback d-block");

					swal({title:"เปลี่ยนรหัสผ่านเรียบร้อย",text:"คลิกปุ่ม OK เพื่อกลับสู่หน้าหลัก",type:"success",timer:9500});
					setTimeout(function(){location.href=base_url},5500);
				}
			},error:function(xhr,textSatus,errorThrown,res){
				alert("Get form_forget_password\nStatus: "+textSatus+"\nError: "+errorThrown+"\nFunction: form_forget_password");
			}
		});
	});

</script>
