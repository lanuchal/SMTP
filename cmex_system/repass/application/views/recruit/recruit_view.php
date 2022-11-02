<!--Main content -->
<section class="content">
<?php if($method=="view_detail") $cls="container-fluid view_detail"; else $cls="container-fluid";?>
  <div class="<?php echo $cls; ?>">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
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
                  <!-- <h6><?php echo $head_title_s1; ?></h6> -->
                  <h6></h6>
                </div>
              </div>
          </div>
          	<!-- start card-header -->
            <div class="card-body">

            	<!-- <div class="form-group"> -->
        	 		<div class="col-sm-12">
    	 				<div class="row mb-6">
				            <label for="publish_status" class="col-sm-2 col-form-label text-al-r">สถานะประกาศ</label>
				            <div class="col-sm-9">
				                <?php if(!empty($recruitHd->publish_status)) echo "<p style=' color:green; margin-top:10px;'>".$recruitHd->publish_status."</p>"; ?>	
				            </div>
				        </div>
        	 		</div>
				<!-- </div> -->

				<!-- <div class="form-group"> -->
        	 		<div class="col-sm-12">
    	 				<div class="row mb-12">
				            <label for="publish_name" class="col-sm-2 col-form-label text-al-r">ชื่อประกาศรับสมัคร</label>
				            <div class="col-sm-9">
				                <?php if(!empty($recruitHd->publish_name)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".$recruitHd->publish_name."</p>"; ?>	
				            </div>
				        </div>
        	 		</div>
				<!-- </div> -->
				<hr>

				<!-- <div class="form-group"> -->
        	 		<div class="col-sm-12">
        	 			<div class="row">
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
						            <label for="position_name" class="col-sm-3 col-form-label text-al-r">ตำแหน่งงาน</label>
						            <div class="col-sm-9">
						                <?php
						                    $sql="SELECT * from sev_position";
						                    $query=$this->db->query($sql);
						                    foreach ($query->result_array() as $row) {
						                    	if($method == "view_detail"){ if($recruitHd->position_id==$row['position_id']) echo "<p style=' color:#0400fff0; margin-top:10px;'>".$row['position_name']."</p>"; }
						                    }
						                ?>
						            </div>
						        </div>
	        	 			</div>
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
	        	 					<label for="position_number" class="col-sm-3 col-form-label text-al-r">เลขที่ตำแหน่ง</label>
						            <div class="col-sm-9">
						                <?php
						                    if(!empty($recruitHd->position_number)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".$recruitHd->position_number."</p>";
						                ?>
						            </div>
	        	 				</div>
	        	 			</div>
        	 			</div>
        	 		</div>
				<!-- </div> -->

				<!-- <div class="form-group"> -->
        	 		<div class="col-sm-12">
        	 			<div class="row">
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
						            <label for="ward_code" class="col-sm-3 col-form-label text-al-r">หน่วยงาน</label>
						            <div class="col-sm-9"> <?php
						                $sql="SELECT ward_code,ward_name1 from tb_location1";
					                    $query=$this->db->query($sql);
					                    foreach ($query ->result() as $row) {
					                    	if($method == "view_detail"){ if($row->ward_code==$recruitHd->ward_code) echo "<p style=' color:#0400fff0; margin-top:10px;'>".$row->ward_name1."</p>"; }
					                    } ?>
						            </div>
						        </div>
	        	 			</div>
	        	 			<div class="col-sm-6"><div class="row mb-6">
	        	 				<label for="position_type_name" class="col-sm-3 col-form-label text-al-r">ประเภทพนักงาน</label>
						            <div class="col-sm-9">
						                <?php
											$sql_pt="SELECT * FROM rc_position_type order by position_type_id DESC";
											$query_pt=$this->db->query($sql_pt);
											foreach($query_pt->result_array() as $row){
												if($method=="view_detail"){ if($recruitHd->position_type_id==$row['position_type_id']) echo "<p style=' color:#0400fff0; margin-top:10px;'>".$row['position_type_name']."</p>"; }
											}
						                ?>
						            </div>
	        	 			</div></div>
	        	 		</div>
        	 		</div>
				<!-- </div> -->

				<!-- <div class="form-group"> -->
					<div class="col-sm-12">
						<div class="row">
				 			<div class="col-sm-6">
				 				<div class="row mb-6">
						            <label for="start_date" class="col-sm-3 col-form-label text-al-r">วันริ่มต้น</label>
						            <div class="col-sm-9"> <?php
						               	// $exp=explode(" ",$recruitHd->start_date);
						            	if($system=="backend"){
						            		echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_std_format_thai_datetime_two($recruitHd->start_date)."</p>";
						            	}else if($system=="frontend"){
						            		echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_std_format_thai_datetime_frontend_one($recruitHd->start_date)."</p>";
						            	}?>
						            </div>
						        </div>
				 			</div>
				 			<div class="col-sm-6"><div class="row mb-6">
				 				<label for="end_date" class="col-sm-3 col-form-label text-al-r">วันสิ้นสุด</label>
						            <div class="col-sm-9"> <?php
						                // $exp_end=explode(" ",$recruitHd->end_date);
						            	if($system=="backend"){
						            		echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_std_format_thai_datetime_two($recruitHd->end_date)."</p>";
						            	}else if($system=="frontend"){
						            		echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_std_format_thai_datetime_frontend_one($recruitHd->end_date)."</p>";
						            	}?>
						            </div>
				 			</div></div>
			 			</div>
					</div>
				<!-- </div> -->

				<!-- <div class="form-group"> -->
					<div class="col-sm-12">
						<div class="row">
				 			<div class="col-sm-6">
				 				<div class="row mb-6">
						            <label for="position_amount" class="col-sm-3 col-form-label text-al-r">จำนวนรับสมัคร</label>
						            <div class="col-sm-9">
						               <?php echo "<p style=' color:#0400fff0; margin-top:10px;'>".$recruitHd->position_amount."</p>";
						               		 //echo "<b style='margin-top:10px;margin-left: 50px;'> คน</b>"; 
						               		 ?>
						            </div>
						        </div>
				 			</div>
				 			<div class="col-sm-6"><div class="row mb-6">
				 				<label for="position_rate" class="col-sm-3 col-form-label text-al-r">อัตราค่าจ้าง</label>
								<div class="col-sm-9">
									<?php echo "<p style=' color:#0400fff0; margin-top:10px;'>".GetMoneyFormatOne($recruitHd->position_rate,2)."</p>"; 
										  //echo "<b style='margin-top:10px;margin-left: 50px;'> บาท</b>"; 
										  ?>
								</div>
				 			</div></div>
			 			</div>
					</div>
				<!-- </div> -->

				<!-- <div class="form-group"> -->
					<div class="col-sm-12">
						<div class="row">
				 			<div class="col-sm-6">
				 				<div class="row mb-6">
						            <label for="position_amount" class="col-sm-3 col-form-label text-al-r">หมายเหตุ</label>
						            <div class="col-sm-9">
						               <?php if(!empty($recruitHd->publish_remark)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".$recruitHd->publish_remark."</p>"; ?>
						            </div>
						        </div>
				 			</div>
				 			<div class="col-sm-6"><div class="row mb-6">
				 			</div></div>
			 			</div>
					</div>
				<!-- </div> -->

				<!-- [ton][03/05/2564][change format view remark] -->
				<!-- <div class="form-group"> -->
        	 		<!-- <div class="col-sm-12">
    	 				<div class="row mb-12">
				            <label for="publish_remark" class="col-sm-2 col-form-label text-al-r">หมายเหตุ</label>
				            <div class="col-sm-9">
				                <?php if(!empty($recruitHd->publish_remark)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".$recruitHd->publish_remark."</p>"; ?>
				            </div>
				        </div>
        	 		</div> -->
				<!-- </div> -->

				<hr>

              <?php if($recruitHd->exam1_status=="Y"){?>
              	
              	<!-- [ton][03/05/2564][change format view exam1_status] -->
              	<!-- <div class="form-group"> -->
	              	<!-- <div class="form-check">
	              		<input type="checkbox" class="form-check-input" id="exam1_status" name="exam1_status" <?php if(!empty($recruitHd->exam1_status)) {if($recruitHd->exam1_status=="Y") echo "checked";} ?>>
	                	<label class="m_t5_l10" for="exam1_status text-al-r">สอบข้อเขียน</label>
	              	</div> -->
	            <!-- </div> -->

		            <div class="col-sm-12">
	    	 			<div class="row">
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
						            <label for="exam1_date" class="col-sm-3 col-form-label text-al-r">สอบข้อเขียน</label>
						            <div class="col-sm-9">
						                <input type="checkbox" class="form-check-input ml5" id="exam1_status" name="exam1_status" <?php if(!empty($recruitHd->exam1_status)) {if($recruitHd->exam1_status=="Y") echo "checked";} ?>>
						            </div>
						        </div>
	        	 			</div>
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
	        	 				</div>
	        	 			</div>
	    	 			</div>
	    	 		</div>

				<!-- <div class="form-group"> -->
        	 		<div class="col-sm-12">
        	 			<div class="row">
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
						            <!-- <label for="exam1_date" class="col-sm-3 col-form-label text-al-r">วันที่สอบข้อเขียน</label> -->
						            <label for="exam1_date" class="col-sm-3 col-form-label text-al-r">วันที่สอบ</label>
						            <div class="col-sm-9">
						                <?php
						                	// $exp_exam1_date=explode(" ",$recruitHd->exam1_date);
	                    					if(!empty($recruitHd->exam1_date)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_std_format_thai_datetime_frontend_one($recruitHd->exam1_date)."</p>";
						                ?>
						            </div>
						        </div>
	        	 			</div>
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
	        	 					<label for="exam1_publish_date" class="col-sm-3 col-form-label text-al-r">วันที่ประกาศผล</label>
						            <div class="col-sm-9">
						                <?php
						                   // $exp_exam1_publish_date=explode(" ",$recruitHd->exam1_publish_date);
	                    					if(!empty($recruitHd->exam1_publish_date)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_std_format_thai_datetime_frontend_one($recruitHd->exam1_publish_date)."</p>";
						                ?>
						            </div>
	        	 				</div>
	        	 			</div>
        	 			</div>
        	 		</div>
				<!-- </div> -->
              <?php } ?>

              <?php if($recruitHd->exam2_status=="Y"){?>
              	  <!-- [ton][03/05/2564][change format view exam2_status] -->
	              <!-- <div class="form-group"> -->
	              	<!-- <div class="form-check">
	              		<input type="checkbox" class="form-check-input" id="exam2_status" name="exam2_status" <?php if(!empty($recruitHd->exam2_status)) {if($recruitHd->exam2_status=="Y") echo "checked";} ?>>
	                	<label class="m_t5_l10" for="exam2_status text-al-r">สอบปฏิบัติ </label>	
	              	</div> -->
	              <!-- </div> -->

	              <div class="col-sm-12">
	    	 			<div class="row">
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
						            <label for="exam1_date" class="col-sm-3 col-form-label text-al-r">สอบปฏิบัติ</label>
						            <div class="col-sm-9">
						                <input type="checkbox" class="form-check-input ml5" id="exam2_status" name="exam2_status" <?php if(!empty($recruitHd->exam2_status)) {if($recruitHd->exam2_status=="Y") echo "checked";} ?>>
						            </div>
						        </div>
	        	 			</div>
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
	        	 				</div>
	        	 			</div>
	    	 			</div>
	    	 		</div>

	              <!-- <div class="form-group"> -->
        	 		<div class="col-sm-12">
        	 			<div class="row">
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
						            <!-- <label for="exam2_date" class="col-sm-3 col-form-label text-al-r">วันที่สอบปฏิบัติ</label> -->
						            <label for="exam2_date" class="col-sm-3 col-form-label text-al-r">วันที่สอบ</label>
						            <div class="col-sm-9">
						                <?php
						                	// $exp_exam2_date=explode(" ",$recruitHd->exam2_date);
	                    					if(!empty($recruitHd->exam2_date)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_std_format_thai_datetime_frontend_one($recruitHd->exam2_date)."</p>";
						                ?>
						            </div>
						        </div>
	        	 			</div>
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
	        	 					<label for="exam2_publish_date" class="col-sm-3 col-form-label text-al-r">วันที่ประกาศผล</label>
						            <div class="col-sm-9">
						                <?php
						                   // $exp_exam2_publish_date=explode(" ",$recruitHd->exam2_publish_date);
	                    				   if(!empty($recruitHd->exam2_publish_date)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_std_format_thai_datetime_frontend_one($recruitHd->exam2_publish_date)."</p>";
						                ?>
						            </div>
	        	 				</div>
	        	 			</div>
        	 			</div>
        	 		</div>
				<!-- </div> -->
              <?php } ?>

              <?php if($recruitHd->exam3_status=="Y"){?>
              	<!-- [ton][03/05/2564][change format view exam3_status] -->
				<!-- <div class="form-group"> -->
					<!-- <div class="form-check">
				  		<input class="form-check-input" type="checkbox" value="" id="exam3_status" name="exam3_status" <?php if(!empty($recruitHd->exam3_status)) {if($recruitHd->exam3_status=="Y") echo "checked";} ?>>
				  		<label class="m_t5_l10" for="exam3_status text-al-r">สอบสัมภาษณ์ </label>
					</div> -->
				<!-- </div> -->

					<div class="col-sm-12">
	    	 			<div class="row">
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
						            <label for="exam1_date" class="col-sm-3 col-form-label text-al-r">สอบสัมภาษณ์</label>
						            <div class="col-sm-9">
						                <input class="form-check-input ml5" type="checkbox" value="" id="exam3_status" name="exam3_status" <?php if(!empty($recruitHd->exam3_status)) {if($recruitHd->exam3_status=="Y") echo "checked";} ?>>
						            </div>
						        </div>
	        	 			</div>
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
	        	 				</div>
	        	 			</div>
	    	 			</div>
	    	 		</div>

	            <!-- <div class="form-group"> -->
        	 		<div class="col-sm-12">
        	 			<div class="row">
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
						            <!-- <label for="exam3_date" class="col-sm-3 col-form-label text-al-r">วันที่สอบสัมภาษณ์</label> -->
						            <label for="exam3_date" class="col-sm-3 col-form-label text-al-r">วันที่สอบ</label>
						            <div class="col-sm-9">
						                <?php
						                	// $exp_exam3_date=explode(" ",$recruitHd->exam3_date);
	                    					if(!empty($recruitHd->exam3_date)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_std_format_thai_datetime_frontend_one($recruitHd->exam3_date)."</p>";
						                ?>
						            </div>
						        </div>
	        	 			</div>
	        	 			<div class="col-sm-6">
	        	 				<div class="row mb-6">
	        	 					<label for="exam3_publish_date" class="col-sm-3 col-form-label text-al-r">วันที่ประกาศผล</label>
						            <div class="col-sm-9">
						                <?php
						                   // $exp_exam3_publish_date=explode(" ",$recruitHd->exam3_publish_date);
	                    				   if(!empty($recruitHd->exam3_publish_date)) echo "<p style=' color:#0400fff0; margin-top:10px;'>".convert_std_format_thai_datetime_frontend_one($recruitHd->exam3_publish_date)."</p>";
						                ?>
						            </div>
	        	 				</div>
	        	 			</div>
        	 			</div>
        	 		</div>
				<!-- </div> -->
              <?php } 
              	if($recruitHd->exam1_status=="Y" || $recruitHd->exam2_status=="Y" || $recruitHd->exam3_status=="Y") echo "<hr>"; ?>
                <!-- <div class="form-group"> -->
                    <label class="label-control" for="upl_files">เอกสารประกาศ</label>
                    <div class="form-group pl30_pr30">
                        <table id="table_files" class="table table-flush table-striped table-bordered table-hover col-12">
                            <thead>
                                <tr>
                                    <th>ชื่อเอกสาร</th>
                                    <th>วันที่ประกาศ</th>
                                    <th style="width:110px;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody><?php
                                for($i=0;$i<count(array_filter($recruitDt));$i++){
                                	$patchfile= base_url()."uploads/".$recruitFile[$i]->file_name;
                                	// $exp_create_date=explode(" ",$recruitDt[$i]->create_date);
                                	// echo $system;
                                	?>
                                    <tr>
                                        <td><?php echo $recruitDt[$i]->publish_dt_name; ?></td>
                                        <td><?php 
                                        	if($system=="frontend")echo convert_std_format_thai_datetime_frontend_one($recruitDt[$i]->start_date);
                                        	else echo convert_std_format_thai_datetime_two($recruitDt[$i]->start_date);
                                        	?></td>
                                        <td><a href="<?php echo $patchfile; ?>" class="btn btn-info btn-sm" target="_blank"><i class='fas fa-folder'></i></a></td>
                                    </tr> <?php
                            	} ?>
                            </tbody>
                        </table>
                    <div>
                <!-- </div> -->

	        <div class="card-footer" style="text-align:right; float:right;">
	        	<div class="row">
	        		<button type="button" class="btn btn-secondary" onclick="goback_index()">กลับหน้าหลัก</button>
	        	</div>
	        </div>
        </div>
        <!-- /.card -->
      </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-6"></div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script type="text/javascript">
	var url_index="<?php echo base_url(); ?>";
</script>