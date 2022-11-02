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

	//[ton][21/05/2567][test selectors]
	$('input[type="password"]').on('keyup',function(){
		var $this=$(this);
		// let length =$this.val().length;
		// $this.parent().html("<span>parent</span>");
		// $this.parent().addClass("tc_red");
		// $this.prev().prev().prev().prev().html("<span>parent</span>");
		// $this.prev().prev().prev().prev().addClass("bg-black");
		// $this.prev().prev().prev().prev().prev().prev().addClass("bg-black");
		// $this.prev().prev().prev().prev().prev().prev().prev().prev().prev().addClass("bg-black");
		// $this.prev().html("<span>Prev</span>");
		// $this.prev().addClass("tc_red");
		// $this.next().addClass("tc_red");
		// $this.next().html("<span>next</span>");
		// $this.parent().html("<p>parent</p>");
		// console.dir("p : "+prev);
		// console.dir("pa : "+parent);
		// console.log("chriden : "+$this.chriden());
		// let test_input = $("input[type='password']").val();
		// if($this.val().length>0) console.log("value input 3 password : "+Object.values($this));
		// let txt;
		// for(i in $this){
		// 	txt+= $this[i]+" ";
		// }
		// console.log("value : "+txt);
	});

	<?php echo 'var base_url="'.base_url().'";'; ?>
	// console.log("base_url : "+base_url); //[Athiwat][10/10/2565][add comment]
	
	// [14/05/2564][ton][setting check method add && update of btn submit]
	var target = document.getElementById("showpass");
	var pwd = document.getElementById("newpassword");
	var pwd_con = document.getElementById("confirmpassword");

	// [ton][14/05/2564][add toggle password]
	function toggle_password(e){
		$(e).toggleClass("fa-eye fa-eye-slash");
		var input_old = $("#oldpassword");
		var input_one = $("#newpassword");
		var input_two = $("#confirmpassword");

		if(e==document.getElementById("showpass_old")){
			if(input_old.attr("type")==="password") input_old.attr("type","text");
			else if(input_old.attr("type")==="text") input_old.attr("type","password");
		}

		if(e == document.getElementById("showpass_one")){
			if(input_one.attr("type")==="password") input_one.attr("type","text");
			else if(input_one.attr("type")==="text") input_one.attr("type","password");
		}

		if(e == document.getElementById("showpass_two")){
			if(input_two.attr("type")==="password") input_two.attr("type","text");
			else if(input_two.attr("type")==="text") input_two.attr("type","password");
		}
	}

	// ------------------------------ [form update] ------------------------------
	$("body").on("submit","#form_update_repass",function(e){
		e.preventDefault();
			$.ajax({
				type:"POST",
				url:'<?php echo base_url()."Repass/updateRepassProcess"?>',
				dataType:'json',
				data:new FormData(this),
				cache:false,
				contentType:false,
				processData:false,
				success:function(res){
					if(!res["update_status"]){
						// console.dir(res); //[Athiwat][10/10/2565][add comment]

						if(res['form_error_newpassword']!=''){
							$(".form_error_newpassword").html(res['form_error_newpassword']).addClass('invalid-feedback d-block');
							$("#newpassword").addClass("id-invalid");
						}else{
							$(".form_error_newpassword").html(res['form_error_newpassword']).addClass('invalid-feedback d-block');
							$("#newpassword").addClass("id-invalid");
						}
						if(res['form_error_confirmpassword']!=''){
							$(".form_error_confirmpassword").html(res['form_error_confirmpassword']).addClass('invalid-feedback d-block');
							$("#confirmpassword").addClass("id-invalid");
						}else{
							$(".form_error_confirmpassword").html(res['form_error_confirmpassword']).addClass('invalid-feedback d-block');
							$("#newpassword").addClass("id-invalid");
						}
						if(res['form_error_oldpassword']!=""){
							$(".form_error_oldpassword").html(res['form_error_oldpassword']).addClass('invalid-feedback d-block');
							$("#oldpassword").addClass("id-invalid");
						}else{
							$(".form_error_oldpassword").html(res['form_error_oldpassword']).removeClass('invalid-feedback d-block');
							$("#oldpassword").removeClass("id-invalid");
						}

					}else{
						$(".form_error_newpassword").html(res['form_error_newpassword']).removeClass('invalid-feedback d-block');
						$("#newpassword").removeClass("id-invalid");
						$(".form_error_confirmpassword").html(res['form_error_confirmpassword']).removeClass('invalid-feedback d-block');
						$("#confirmpassword").removeClass("id-invalid");
						$(".form_error_oldpassword").html(res['form_error_oldpassword']).removeClass('invalid-feedback d-block');
						$("#oldpassword").removeClass("id-invalid");

						swal({title:"เปลี่ยนรหัสผ่านเรียบร้อย",text:"คลิกปุ่ม OK เพื่อกลับสู่หน้าหลัก",type:"success",timer:9500});
						setTimeout(function(){location.href=base_url} , 3500);
					}
				},error:function(xhr,textSatus,errorThrown,res){
					alert("Get form_update_repass\nStatus: "+textSatus+"\nError: "+errorThrown+"\nFunction: form_update_repass");
				}
			});
	});

</script>
