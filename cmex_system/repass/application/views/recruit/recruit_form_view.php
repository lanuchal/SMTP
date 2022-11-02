 <!--Main content-->
<section class="content">
      <div class="container-fluid form_recruit">
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
                	// print_r($method);
                	// print_r($recruitHd);
                	// print_r($recruitDt);
                	// echo $session_username;
                    // if($method == "add") echo form_open_multipart('Recruit/addRecruitProcess', array('id' => 'demo-form2', 'class' => 'form-horizontal form-label-left needs-validation'));
                    // else if($method == "update")echo form_open_multipart('Person/updateRecruitProcess', array('id' => 'demo-form2', 'class' => 'form-horizontal form-label-left needs-validation'));
                    if($method == "update"){
                    	$update=1; echo '<script> var check_update_hd ="'.$update.'";</script>'; ?>
                    	<!-- <input id="hidden_hd_id" name="hidden_hd_id" type="hidden" value="<?php echo $recruitHd->publish_hd_id; ?>"> -->
                    <?php }else{
                    	$update=0; echo '<script> var check_update_hd ="'.$update.'";</script>';
                    }
                ?>

				<form id="form_publish" role="form" enctype="multipart/form-data" class="needs-validation" method="POST"
					 <?php if($method == "add") echo " action='" . base_url() . "Recruit/addRecruitProcess/$session_username' ";
					 	   else if($method == "update") echo " action='" . base_url() . "Recruit/updateRecruitProcess/$recruitHd->publish_hd_id/$session_username' "; ?>  >
                <div class="card-body">
					<!-- ================================ HD ================================ -->
				    <div class="form-group">
				        <div class="row">
				            <label for="ward_code" class="col-sm-3 col-form-label text-al-r">หน่วยงาน</label>
				            <div class="col-sm-9">
				                <select id="ward_code" name="ward_code" class="form-control " style="max-width:100%;" required>
				                    <?php
				                    $sql="SELECT ward_code,ward_name1 from tb_location1";
				                    $query=$this->db->query($sql);
				                    foreach ($query ->result() as $row) {
				                    	if($method == "update"){ ?>
				                    		<option value='<?php echo $row->ward_code; ?>' <?php if($row->ward_code==$recruitHd->ward_code) echo "selected"; ?>><?php echo $row->ward_name1; ?></option>";<?php
				                    	}else echo "<option value='$row->ward_code'>$row->ward_name1</option>";
				                    }
				                    ?>
				                </select>
				                <p class="wardcodeError"></p>
				            </div>
				        </div>
				    </div>

				    <div class="form-group">
				        <div class="row">
				            <label for="position_id" class="col-sm-3 col-form-label text-al-r">ตำแหน่งงาน</label>
				            <div class="col-sm-9">
				                <select id="position_id" name="position_id" class="form-control " style="max-width:100%;" required>
				                    <?php
				                    $sql="SELECT * from sev_position";
				                    $query=$this->db->query($sql);
				                    foreach ($query->result_array() as $row) {
				                    	if($method == "update"){ ?>
				                    		<option value="<?php echo $row['position_id']; ?>" <?php if($recruitHd->position_id==$row['position_id']) echo "selected"; ?>><?php echo $row['position_name']; ?></option> <?php
				                    	}else echo "<option value='$row[position_id]'>$row[position_name]</option>";
				                    }
				                    ?>
				                </select>
				                <p class="positionidError"></p>
				            </div>
				        </div>
				    </div>

				    <div class="form-group">
				        <div class="row mb-3">
				            <label for="position_type_id" class="col-sm-3 col-form-label text-al-r">ประเภทพนักงาน</label>
				            <div class="col-sm-9">
				                <select id="position_type_id" name="position_type_id" class="form-control " style="max-width:100%;" required>
				                    <?php
				                    $sql_pt="SELECT * FROM rc_position_type order by position_type_id DESC";
				                    $query_pt=$this->db->query($sql_pt);
				                    foreach($query_pt->result_array() as $row){
				                    	if($method=="update"){ ?>
				                    		<option value="<?php echo $row['position_type_id']; ?>" <?php if($recruitHd->position_type_id==$row['position_type_id']) echo "selected";?> ><?php echo $row['position_type_name']; ?></option> <?php
				                    	}else if($method=="add"){ ?>
				                    		<option value="<?php echo $row['position_type_id']; ?>"><?php echo $row['position_type_name'];?></option> <?php
				                   		}
				                	} ?>
				               </select>
				               <p class="positiontypeidError"></p>
				           </div>
				       </div>
				    </div>

				    <div class="form-group">
				    	<div class="row">
				    		<label for="start_date" class="col-sm-3 col-form-label text-al-r">วันที่ประกาศ</label>
				    		<div class="col-sm-9" style="float:right;">
	                    		<div class="row">
	                    			<?php 
	                    				if($method=="update"){ 
	                    					if(!empty($recruitHd->start_date)){
	                    						$exp=explode(" ",$recruitHd->start_date);?>
	                    						<input type="date" class="form-control col-6" id="start_date" name="start_date" required value="<?php echo $exp[0]; ?>"> <p class="start_dateError"></p>
		                        				<input type="time" class="form-control col-6" id="start_time" name="start_time" required value="<?php echo $exp[1]; ?>"> <p class="start_timeError"></p> <?php
	                    					}
	                    				}else if($method=="add"){ ?>
	                    					<input type="date" class="form-control col-6" id="start_date" name="start_date" required> <p class="start_dateError"></p>
		                        			<input type="time" class="form-control col-6" id="start_time" name="start_time" required> <p class="start_timeError"></p> <?php
	                    				}
	                    			?>
		                    		
	                        	</div>
	                    	</div>
                    	</div>
                  	</div>

                  	<div class="form-group">
                  		<div class="row">
				    		<label for="start_date" class="col-sm-3 col-form-label text-al-r">วันที่สิ้นสุด</label>
				    		<div class="col-sm-9" style="float:right;">
				    			<div class="row">
				    				<?php
				    					if(!empty($recruitHd->end_date)){
				    						$exp_end=explode(" ",$recruitHd->end_date); ?>
				    						<input type="date" class="form-control col-6" id="end_date" name="end_date" required value="<?php echo $exp_end[0]; ?>"> <p class="end_dateError"></p>
		                        			<input type="time" class="form-control col-6" id="end_time" name="end_time" required value="<?php echo $exp_end[1]; ?>"> <p class="end_timeError"></p> <?php
				    					}else{ ?>
				    						<input type="date" class="form-control col-6" id="end_date" name="end_date" required> <p class="end_dateError"></p>
		                        			<input type="time" class="form-control col-6" id="end_time" name="end_time" required> <p class="end_timeError"></p> <?php
				    					}
				    				?>
		                      	</div>
	                    	</div>
                    	</div>
                  	</div>

				    <div class="form-group">
				        <div class="row mb-3">
				            <label for="publish_name" class="col-sm-3 col-form-label text-al-r">ชื่อประกาศ</label>
				            <div class="col-sm-9">
				                <input type="text" class="form-control" id="publish_name" name="publish_name" placeholder="กรุณากรอกชื่อประกาศ" <?php if(!empty($recruitHd->publish_name)) echo "value='$recruitHd->publish_name' ";?> required>
				                <p class="docunoError"></p>
				            </div>
				        </div>
				    </div>

				    <div class="form-group">
				    	<div class="row">
				    		<label for="publish_status" class="col-sm-3 col-form-label text-al-r">สถานะประกาศ</label>
				    		<div class="col-sm-9">
				    			<div class="autocomplete width100p" style="width: 100%;">
				    				<input type="text" class="form-control" id="publish_status" name="publish_status" placeholder="กรุณากรอกสถานะประกาศ" <?php if(!empty($recruitHd->publish_status)) echo "value='$recruitHd->publish_status' ";?> required>	
				    			</div>
				    		</div>
				    	</div>
				    </div>

				    <!-- Text area -->
				    <div class="form-group">
				        <div class="row mb-3">
				            <label for="publish_remark" class="col-sm-3 col-form-label text-al-r">หมายเหตุ</label>
				            <div class="col-sm-9">
				              <textarea class="form-control" id="publish_remark" name="publish_remark" placeholder="หมายเหตุ"><?php if(!empty($recruitHd->publish_remark)) echo "$recruitHd->publish_remark";?></textarea>
				              <p class="hdremarkError"></p>
				          </div>
				        </div>
				    </div>

				    <!-- ================================ DT ================================<hr> -->
				    <div class="form-group">
				        <div class="row mb-3">
				            <label for="position_number" class="col-sm-3 col-form-label text-al-r">เลขที่ตำแหน่ง</label>
				            <div class="col-sm-9">
				                <input type="text" class="form-control" id="position_number" name="position_number" placeholder="กรุณากรอกเลขที่ตำแหน่ง" <?php if(!empty($recruitHd->position_number)) echo "value='$recruitHd->position_number' ";?> required>
				                <p class="positionnumberError"></p>
				            </div>
				        </div>
				    </div>

				    <div class="form-group">
				        <div class="row mb-3">
				            <label for="position_rate" class="col-sm-3 col-form-label text-al-r">อัตราค่าจ้าง / บาท</label>
				            <div class="col-sm-9">
				            	<?php 
				            		$rate= !empty($recruitHd->position_rate)? number_format($recruitHd->position_rate,3,'.',','):'';
				            		// echo $rate;
				            	?>
				                <input type="number" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="position_rate" name="position_rate" placeholder="00.00 บาท"  <?php if($method=="update") echo "value='$recruitHd->position_rate'";?> required />
				                <p class="positionrateError"></p>
				            </div>
				        </div>
				    </div>

				    <div class="form-group">
				        <div class="row mb-3">
				            <label for="position_amount" class="col-sm-3 col-form-label text-al-r">จำนวนรับสมัคร / คน</label>
				            <div class="col-sm-9">
				                <input type="number" <?php if($method=="add")echo "value='1'"?> min="1" step="1" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control" id="position_amount" name="position_amount" <?php if($method=="update" && !empty($recruitHd->position_amount)) echo "value='$recruitHd->position_amount' ";?> required/>
				                <p class="positionincomecountError"></p>
				            </div>
				        </div>
				    </div>

				    <hr>
				    <div class="form-group">
				        <div class="row mb-3">
				            <label for="exam1_status" class="col-sm-3 col-form-label"></label>
				            <div class="col-sm-9">
				                <div class="col-sm-9 checkbox" >
				                    <input type="checkbox" class="form-check-input" id="exam1_status" name="exam1_status" onclick="check_publish_exam_status()" <?php if(!empty($recruitHd->exam1_status)) {if($recruitHd->exam1_status=="Y") echo "checked";} ?>>
				                    <label class="form-check-label m_t5_l10" for="exam1_status"><b>สอบข้อเขียน</b></label>
				                    <p class="exam1statusError"></p>
				                </div>
				            </div>
				        </div>
				    </div>
				    <div class="form-group publish_status1">
				        <div class="row mb-3">
				            <label for="exam1_date" class="col-sm-3 col-form-label text-al-r">วันที่สอบข้อเขียน</label>
				            <div class="col-sm-9">
					            <?php if($method=="update"){ if(!empty($recruitHd->exam1_date)) $exp_exam1_date=explode(" ",$recruitHd->exam1_date); } ?>
					            <input type="date" class="form-control col-6" id="exam1_date" name="exam1_date" <?php if($method=="update"){ if(!empty($recruitHd->exam1_date)) echo "value='$exp_exam1_date[0]'"; } ?> >
					            <p class="exam1dateError"></p>
				          </div>
				      </div>
				    </div>
				    <div class="form-group publish_status1">
				        <div class="row mb-3">
				            <label for="exam1_publish_date" class="col-sm-3 col-form-label text-al-r">วันที่ประกาศผล ผลสอบข้อเขียน</label>
				            <div class="col-sm-9">
				            	<?php if($method=="update"){ if(!empty($recruitHd->exam1_publish_date)) $exp_exam1_publish_date=explode(" ",$recruitHd->exam1_publish_date); } ?>
					            <input type="date" class="form-control col-6" id="exam1_publish_date" name="exam1_publish_date" <?php if($method=="update"){ if(!empty($recruitHd->exam1_publish_date)) echo "value='$exp_exam1_publish_date[0]'"; } ?>>
					            <p class="resultexam1dateError"></p>
				          </div>
				      </div>
				    </div>
				    <div class="form-group">
				        <div class="row mb-3">
				            <label for="exam2_status" class="col-sm-3 col-form-label"></label>
				            <div class="col-sm-9">
				                <div class="col-sm-9 checkbox" >
				                    <input type="checkbox" class="form-check-input" id="exam2_status" name="exam2_status" onclick="check_publish_exam_status()" <?php if(!empty($recruitHd->exam2_status)) {if($recruitHd->exam2_status=="Y") echo "checked";} ?>>
				                    <label class="form-check-label m_t5_l10" for="exam2_status"><b>สอบปฏิบัติ</b></label>
				                    <p class="exam2statusError"></p>
				                </div>
				            </div>
				        </div>
				    </div>
				    <div class="form-group publish_status2">
				        <div class="row mb-3">
				            <label for="exam2_date" class="col-sm-3 col-form-label text-al-r">วันที่สอบปฏิบัติ</label>
				            <div class="col-sm-9">
				              <?php if($method=="update"){ if(!empty($recruitHd->exam2_date)) $exp_exam2_date=explode(" ",$recruitHd->exam2_date); } ?>
				              <input type="date" class="form-control col-6" id="exam2_date" name="exam2_date" <?php if($method=="update"){ if(!empty($recruitHd->exam1_date)) echo "value='$exp_exam2_date[0]'"; } ?>>
				              <p class="exam2dateError"></p>
				          </div>
				      </div>
				    </div>
				    <div class="form-group publish_status2">
				        <div class="row mb-3">
				            <label for="exam2_publish_date" class="col-sm-3 col-form-label text-al-r">วันที่ประกาศผล สอบปฏิบัติ</label>
				            <div class="col-sm-9">
				              <?php if($method=="update"){ if(!empty($recruitHd->exam2_publish_date)) $exp_exam2_publish_date=explode(" ",$recruitHd->exam2_publish_date); } ?>
				              <input type="date" class="form-control col-6" id="exam2_publish_date" name="exam2_publish_date" <?php if($method=="update"){ if(!empty($recruitHd->exam2_publish_date)) echo "value='$exp_exam2_publish_date[0]'"; } ?>>
				              <p class="resultexam2dateError"></p>
				          </div>
				      </div>
				    </div>

				    <div class="form-group">
				        <div class="row mb-3">
				            <label for="exam3_status" class="col-sm-3 col-form-label"></label>
				            <div class="col-sm-9">
				                <div class="col-sm-9 checkbox" >
				                    <input type="checkbox" class="form-check-input" id="exam3_status" name="exam3_status" onclick="check_publish_exam_status()" <?php if(!empty($recruitHd->exam3_status)) {if($recruitHd->exam3_status=="Y") echo "checked";} ?>>
				                    <label class="form-check-label m_t5_l10" for="exam3_status"><b>สอบสัมภาษณ์</b></label>
				                    <p class="exam3statusError"></p>
				                </div>
				            </div>
				        </div>
				    </div>
				    <div class="form-group publish_status3">
				        <div class="row mb-3">
				            <label for="exam3_date" class="col-sm-3 col-form-label text-al-r">วันที่สอบสัมภาษณ์</label>
				            <div class="col-sm-9">
				              <?php if($method=="update"){ if(!empty($recruitHd->exam3_date)) $exp_exam3_date=explode(" ",$recruitHd->exam3_date); } ?>
				              <input type="date" class="form-control col-6" id="exam3_date" name="exam3_date" <?php if($method=="update"){ if(!empty($recruitHd->exam3_date)) echo "value='$exp_exam3_date[0]'"; } ?>>
				              <p class="exam3dateError"></p>
				          </div>
				      </div>
				    </div>
				    <div class="form-group publish_status3">
				        <div class="row mb-3">
				            <label for="exam3_publish_date" class="col-sm-3 col-form-label text-al-r">วันที่ประกาศผล สอบสัมภาษณ์</label>
				            <div class="col-sm-9">
				              <?php  if($method=="update"){ if(!empty($recruitHd->exam3_publish_date)) $exp_exam3_publish_date=explode(" ",$recruitHd->exam3_publish_date); } ?>
				              <input type="date" class="form-control col-6" id="exam3_publish_date" name="exam3_publish_date" <?php if($method=="update"){ if(!empty($recruitHd->exam3_publish_date)) echo "value='$exp_exam3_publish_date[0]'"; } ?>>
				              <p class="resultexam3dateError"></p>
				          </div>
				      </div>
				    </div>

				    <?php if($method=="update" && count(array_filter($recruitDt))>0){ ?>
				    <!-- ================================ DT for view ================================ --><hr>
				    <div class="form-group pl30_pr30">
					    <div class="row">
					    	<label class="col-sm-3 col-form-label" for="">เอกสารประกาศ</label>
					    	<div class="col-sm-3 publishDt" style="float:left;"><p class="publishviewDtError" style="font-weight: bold; font-size:16px;"></p></div>
	                    	<div class="col-sm-6" style="text-align: right; padding-bottom:5px;"></div>
					    </div>
                        <table id="table_view_publish_dt" class="table table-flush table-striped table-bordered table-hover col-12">
                            <thead class="thead-light">
                                <tr>
                                    <th>ชื่อเอกสาร</th>
                                    <th>วันที่ประกาศ</th>
                                    <th>เวลาประกาศ</th>
                                    <th>ไฟล์</th>
                                    <th style="width:110px;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_view_publish_dt">
                                <?php
                            		for($i=0;$i<count(array_filter($recruitDt));$i++){ 
                            			$trclass="tr_view_publish_dt_".$recruitHd->publish_hd_id."_".$recruitDt[$i]->publish_dt_id;  ?>
                            			<tr class="<?php echo $trclass; ?>"> <?php
                                		echo "<td>".$recruitDt[$i]->publish_dt_name."</td>";
                                			$exp_create_date=explode(" ",$recruitDt[$i]->start_date);
                                		echo "<td>".$exp_create_date[0]."</td>";
                                		echo "<td>".date("H:i", strtotime($exp_create_date[1]))."</td>";
                                		echo "<td>".$recruitFile[$i]->file_name."</td>";
                                			$patchfile= base_url()."uploads/".$recruitFile[$i]->file_name; ?>
                                			<td><a href="<?php echo $patchfile; ?>" class="btn btn-info btn-sm" target="_blank"><i class="nav-icon fas fa-sticky-note"></i></a><a href="javascript:void(0);" onclick="formedit_delete_publish_dt('<?php echo $recruitHd->publish_hd_id; ?>','<?php echo $recruitDt[$i]->publish_dt_id; ?>','<?php echo $session_username; ?>');" class="btn btn-danger btn-sm"><i class="fas fa-minus"></i></a>
                                			</td> <?php
                                		echo "</tr>";
                            		}
                                ?>
                            </tbody>
                        </table>
                  	</div>
                  	<?php } ?>

				    <!-- ================================ DT for add new ================================ --><hr>
				    <div class="form-group pl30_pr30">
					    <div class="row">
					    	<?php if($method=="add"){ ?>
					    		<label class="col-sm-3 col-form-label" for="">รายละเอียดประกาศ</label>
					    	<?php } ?>
					    	<div class="col-sm-3 publishDt" style="float:left;"><p class="publishDtError" style="font-weight: bold; font-size:16px;"></p></div>
	                    	<div class='<?php if($method=="add") echo"col-sm-6"; else echo"col-sm-9";?>' style="text-align: right; padding-bottom:5px;">
	                    		<button type="button" class="btn btn-success" onclick="add_publish_dt()"><i class="nav-icon fas fa-plus"></i> เอกสาร</button>
	                    	</div>	
					    </div>
                        <table id="table_publish_dt" class="table table-flush table-striped table-bordered table-hover col-12">
                            <thead class="thead-light">
                                <tr>
                                    <th>ชื่อเอกสาร</th>
                                    <th>วันที่ประกาศ</th>
                                    <th>เวลาประกาศ</th>
                                    <th>ไฟล์</th>
                                    <th style="width:100px;">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_publish_dt"></tbody>
                        </table>
                  	</div>

				    <!-- ================================ DT file ================================ --><hr>
				    <!-- <div class="form-group">
				        <div class="row mb-3">
				            <label for="files" class="col-sm-3 col-form-label">เอกสาร</label>
				            <div class="col-sm-9">
				                <input type="file" class="form-control" id="files" name="files" multiple="multiple" style="padding:3px !important"> 
				                <p class="filesError"></p>
				            </div>
				        </div>
				    </div> -->

                </div>

                <div class="card-footer" style="text-align:right; float:right;">
                	<div class="row">
                		<button type="button" class="btn btn-secondary" onclick="goback_index()">ยกเลิก</button>
                		<div id="form_submit" style="margin-left:2px;"><button type="submit" class="btn btn-primary">บันทึก</button></div>
                	</div>
                </div>

              </form>
        	</div>
      	</div>
      <!-- right column -->
      <div class="col-md-6"></div>
    </div>
  </div>
</section> <!--/Main content-->
