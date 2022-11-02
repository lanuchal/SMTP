<!-- [Athiwat][16/06/2564][edit layout for responsive] -->
<section class="content">
<?php //echo $page; ?>  <?php //echo $method; ?>
<?php if($method=="view" && $page=="home") $cls="container-fluid form_repass_home"; else $cls="container-fluid";?>
  <div class="<?php echo $cls; ?>">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header" style="background-color:#343a40;">
              <div class="row">
                <div class="col-lg-8">
                  <p class="mb-0">
                    <?php
                        if((!empty($error)) && ($error["code"]!=0)){
                            foreach($error as $err){ ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Error!</strong>
                                        <?php echo $err; ?> </span>
                                </div><?php
                            }
                        }
                    ?>
                  </p>
                  <h6></h6>
                </div>
              </div>
          </div>

		  <?php
		//   echo $_SERVER['REQUEST_SCHEME']."<br>";
		//   echo $_SERVER['HTTP_HOST']."<br>";
		//   $project = explode('/', $_SERVER['REQUEST_URI'])[2];
		//   echo $project;
		//   echo "13";
		//   echo $this->db->database;
		//   echo $this->db->username;
		//   echo $this->db->password;
		//   echo $this->db->hostname;
		  ?>

      	<form id="form_repass" role="form" enctype="multipart/form-data" class="needs-validation" method="POST"
			     <?php if($method == "new") echo " action='" . base_url() . "Repass/newRepassProcess/$session_username' ";
                 else if($method == "update") echo " action='" . base_url() . "Repass/updateRepassProcess/$session_username' "; ?>  >
           	<div class="card-body">
        	 		<div class="col-sm-12">
        	 		<?php
			         if($this->session->userdata("success")!=""){ ?><div class="alert alert-success tal-c" style="text-align: center;"><?php echo $this->session->userdata("success"); ?></div><?php }
			         if($this->session->userdata("failure")!=""){ ?><div class="alert alert-danger tal-c" style="text-align: center;"><?php echo $this->session->userdata("failure"); ?></div><?php }
			        ?>
      	 			<div id="wrapper">
								<section id="main">
	        	 			<heade>
						        <span class="avatar">
						        	<?php
						        		// [Athiwat][02/07/2564][add file_exists()]
						            if(file_exists(PATH_IMG_EMP.$TB->NUM_OT.'.png')) $img_file_path = URL_IMG_EMP.$TB->NUM_OT.'.png';
						          	else $img_file_path = base_url().PATH_IMG_PERSON;
						        	?>
						          <img src='<?php echo $img_file_path; ?>' alt="" width="180" class="bg-white"/>
						        </span>
						      </heade>
						    </section>
						   </div>

    	 				<div class="row mb-6">
				        <label for="publish_status" class="col-5 col-sm-5 col-form-label text-al-r">สำนักงาน</label>
			            <div class="col-7 col-sm-7">
			                <?php if(!empty($TB->New_Heading)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".$TB->New_Heading."</p>"; ?>
			            </div>
				        </div>
        	 		</div>

        	 		<div class="col-sm-12">
    	 					<div class="row mb-12">
				            <label for="publish_name" class="col-5 col-sm-5 col-form-label text-al-r">ตำแหน่ง</label>
				            <div class="col-7 col-sm-7">
				                <?php if(!empty($TB->position_name)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".$TB->position_name."</p>"; ?>
				            </div>
				        </div>
        	 		</div>

        	 		<?php if($system=="b" && !empty($SEV->person_start_work_date)){ ?>
        	 				<div class="col-sm-12">
		    	 					<div class="row mb-6">
						            <label for="publish_status" class="col-5 col-sm-5 col-form-label text-al-r">วันที่เริ่มงาน</label>
						            <div class="col-7 col-sm-7">
						                <?php if($system=="b"){ echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_to_thai_date_full($SEV->person_start_work_date)."</p>"; } ?>	
						            </div>
						        </div>
		        	 		</div>
        	 		<?php } ?>
        	 		
				<!-- <hr> -->
				<?php
					// echo "1 : ".$SEV->person_prefix;
					// echo "2 : ".$TB->Fname;
					// echo "3 : ".$TB->Lname;
				?>
        <?php if(!empty($SEV->person_prefix) && !empty($TB->Fname) && !empty($TB->Lname)){?>
				<div class="col-sm-12">
	 				<div class="row mb-6">
			            <label for="publish_status" class="col-5 col-sm-5 col-form-label text-al-r">ชื่อ - นามสกุล</label>
			            <div class="col-7 col-sm-7">
			                <?php echo "<p style=' color:#0400fff0; margin-top:10px;'>".$SEV->person_prefix." ".$TB->Fname." ".$TB->Lname."</p>"; ?>
			            </div>
			        </div>
    	 		</div>
    	 	<?php } ?>

    	 		<div class="col-sm-12">
	 					<div class="row mb-6">
			            <label for="publish_status" class="col-5 col-sm-5 col-form-label text-al-r">รหัสพนักงาน</label>
			            <div class="col-7 col-sm-7">
			                <?php if(!empty($TB->NUM_OT)){ echo "<p style=' color:#0400fff0; margin-top:10px;'>".$TB->NUM_OT."</p>"; } ?>	
			            </div>
			        </div>
    	 		</div>
    	 		<div class="col-sm-12">
		 				<div class="row mb-6">
				            <label for="publish_status" class="col-5 col-sm-5 col-form-label text-al-r">รหัสผ่าน</label>
				            <div class="col-7 col-sm-3">
				            		<?php
						               if(!empty($TB->Upass)){
						            		echo "<p style=' color:#0400fff0; margin-top:15px;'>";
						            		for($i=0;$i<strlen($TB->Upass);$i++){
						            			echo "*";
						            		}
						            		echo "</p>";
						               }
					            	?>
				            </div>
				            <?php
				            	// if(isset($page)&& $page=="home"){
				            	// 	echo $page;
				            	// }
				            ?>
				            <div class="col-12 col-sm-3 mt5 text-al-c">
				            	<!-- <?php echo "<a href='" . base_url() . "Repass/updateRepass/" . $TB->NUM_OT . "' class='btn btn-warning btn-sm'><i class='fa fa-cogs'></i> | แก้ไขรหัสผ่าน</a>";?> -->
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
      <div class="col-md-6"></div>
    </div>
  </div>
</section>

<?php // [ton][19/05/2564][clear update status session.]
 $this->session->set_flashdata("success","");
 $this->session->set_flashdata("failure","");
?>