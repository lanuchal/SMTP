<!--Main content-->
<section class="content">
      <div class="container-fluid form_repass">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
				<div class="card-header" style="background-color:#343a40;">
				  <div class="row">
				    <div class="col-lg-8">
				      <p class="mb-0">
				          <?php  if((!empty($error)) && ($error["code"]!=0)){
				                  foreach($error as $err){  ?>
			                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
			                          <span class="alert-icon"><i class="ni ni-like-2"></i></span>
			                          <span class="alert-text"><strong>Error!</strong> <?php echo $err; ?> </span>
			                      </div>
				          <?php }
				              }
				          ?>
				      </p>
				      <h6></h6>
				    </div>
				  </div>
				</div>
                <?php
                	// echo $method;
                	// echo base_url();
                	// print_r($recruitHd);
                	// print_r($recruitDt);
                	// echo $session_username;
                    // if($method == "add") echo form_open_multipart('Recruit/addRecruitProcess', array('id' => 'demo-form2', 'class' => 'form-horizontal form-label-left needs-validation'));
                    // else if($method == "update")echo form_open_multipart('Person/updateRecruitProcess', array('id' => 'demo-form2', 'class' => 'form-horizontal form-label-left needs-validation'));
                    if($method == "update"){ $update=1; echo '<script> var check_update_hd ="'.$update.'";</script>'; }
                    else{ $update=0; echo '<script> var check_update_hd ="'.$update.'";</script>'; }
                ?>

					<form id="form_update_repass" class="needs-validation form-horizontal form-input m0" role="form" enctype="multipart/form-data" method="POST"
					<?php
						// if($method == "update") echo " action='" . base_url() . "Repass/updateRepassProcess/$session_username'. ";
					?>
					>
            <div class="card-body">
							<div class="form-group ">
					        <div class="row mb-3">
					            <label for="confirmpassword" class="col-0 col-sm-2 col-form-label text-al-r"></label>
					            <div class="col-12 col-sm-10 npl npr">
					            	<p class="tc-back font-b mb0 mt5 tal-l">คำแนะนำการตั้งรหัสผ่าน</p><br>
	        							<!-- <hr class="mt2"> -->
					              	<p class="tc-back mb0 tal-l">1. ตั้งรหัสผ่านที่มีความยาวอย่างน้อย 12 - 20 ตัวอักษร<br>
	                           2. อย่าใช้รหัสผ่านที่สั้นเกินไปหรือ คำที่คาดเดาง่าย เช่น วันเดือนปีเกิด<br>
	                           3. สามารถใช้ประโยคที่ยาวหรือ ซ้ำกันได้ เน้นที่ความยาวของรหัสผ่าน</p>
	                           <div class="row"> <p class="tc-back">&nbsp;&nbsp;&nbsp;&nbsp;เช่น</p><p class="tc-warning">&nbsp; hotelcalifornia ,morningyellowsunday ,july1990july1990</p></div>
					          </div>
					      </div>
					    </div>

					    <div class="form-group">
					    	<div class="row mb-3 no-m-b">
					            <label for="confirmpassword" class="col-2 col-sm-2 col-form-label text-al-r"></label>
					            <div class="col-sm-10">
					            	<p class="tc-back font-b mb0 mt5 tal-l">ตั้งรหัสผ่าน</p><br>
	        							<!-- <hr class="mt2"> -->
					          </div>
					      </div>
					        <div class="row mb-3 no-m-b">
					            <label for="newpassword" class="col-sm-3 col-form-label text-al-r"></label>
					            <div class="col-sm-9">
					            	<div class="input-group-addon row">
					              		<input type="password" class="form-control col-10 col-sm-8" id="newpassword" name="newpassword" placeholder="รหัสผ่านใหม่" maxlength="40">
					              		<i class="nav-icon fas fa-eye-slash toggle-password" id="showpass_one" class="toggle-password" aria-label="แสดงรหัสผ่าน" onclick="toggle_password(this);" role="button"></i>
					              		<p class="form_error_newpassword"></p>
					              </div>
					          </div>
					      	</div><br>
					        <div class="row mb-3 no-m-b">
					            <label for="confirmpassword" class="col-2 col-sm-3 col-form-label text-al-r"></label>
					            <div class="col-sm-9">
					            	<div class="input-group-addon row">
					              		<input type="password" class="form-control col-10 col-sm-8" id="confirmpassword" name="confirmpassword" placeholder="ยืนยันรหัสผ่านใหม่" maxlength="40">
					              		<i class="nav-icon fas fa-eye-slash toggle-password" id="showpass_two" class="toggle-password" aria-label="แสดงรหัสผ่าน" onclick="toggle_password(this);" role="button"></i>
					              		<p class="form_error_confirmpassword"></p>
					              </div>
					          	</div>
					      	</div><br>
					      	<div class="row mb-3 no-m-b">
					            <label for="newpassword" class="col-sm-3 col-form-label text-al-r"></label>
					            <div class="col-sm-9">
					            	<div class="input-group-addon row">
					              		<input type="password" class="form-control col-10 col-sm-8" id="oldpassword" name="oldpassword" placeholder="รหัสผ่านเดิม" maxlength="40">
					              		<i class="nav-icon fas fa-eye-slash toggle-password" id="showpass_old" class="toggle-password" aria-label="แสดงรหัสผ่าน" onclick="toggle_password(this);" role="button"></i>
					              		<p class="form_error_oldpassword"></p>
					              </div>
					          </div>
					      	</div>
					    </div>

					    <div class="form-group">
					    	<div class="row mb-3 no-m-b">
					            <label for="newpassword" class="col-sm-3 col-form-label text-al-r"></label>
					            <div class="col-sm-6 npl npr">
					            	
				              	<input type="hidden" id="hidden_numot" name="hidden_numot" value="<?php echo $session_username; ?>">
              					<div id="form_submit" style="margin-left:2px; width:100%;">
              						<button type="submit" class="btn btn-primary" style="width:100%;">เปลี่ยนรหัสผ่าน</button>
              						<!-- <button type="button" class="btn btn-secondary" onclick="goback_index()">ยกเลิก</button> -->
              					</div>
					              
					          </div>
					      	</div>
					     </div>

					    	<div class="text-al-c" style="margin-top:30px;">
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
      	</div>
      <!-- right column -->
      <div class="col-md-6"></div>
    </div>
  </div>
</section> <!--/Main content-->
