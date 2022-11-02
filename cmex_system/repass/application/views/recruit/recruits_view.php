<!-- [manage recruit list] -->
<?php
    date_default_timezone_set('Asia/Bangkok');
    $count=1;
?>
<div class="card">
    <div class="card-header" style="text-align: right;">
        <?php if($system=="backend"){ ?>
            <a href="<?php echo base_url(); ?>Recruit/addRecruit"><button type="button" class="btn btn-success"><i class="nav-icon fas fa-plus"></i> เพิ่มประกาศรับสมัคร</button></a>
        <?php } ?>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped my_table_data_desc">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <?php if($system=="frontend"){ ?> <th style="min-width: 150px;">วันที่ประกาศ</th> <?php }?>
                    <?php if($system=="backend"){ ?> <th style="min-width: 155px;">วันที่ประกาศ</th> <?php }?>
                    <th style="min-width: 110px;">วันที่สิ้นสุด</th>
                    <!-- <th style="min-width: 85px;">ประเภท</th> -->
                    <th>ตำแหน่ง</th>
                    <th>หน่วยงาน</th>
                    <th style="min-width: 50px;">จำนวน</th>
                    <th style="min-width: 85px;">อัตราค่าจ้าง</th>
                    <?php if($system=="frontend"){ ?> <th>สถานะ</th> <?php }?>
                    <!-- <th>หมายเหตุ</th> -->
                    <th style="min-width: 40px;">ผู้ชม</th>
                    <th style="min-width: 100px;">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //[ton][19/04/2564][add session status]
                    $success=$this->session->userdata('success');
                    $failure=$this->session->userdata('failure');
                    if($success!=""){ ?> <div class="alert alert-success" role="alert" style="text-align:center;"><?php echo $success; ?></div><?php }
                    if($failure!=""){ ?> <div class="alert alert-danger" role="alert" style="text-align:center;"><?php echo $failure; ?></div><?php }

                    // echo "baseurl : ".base_url();
                    // echo "s : ".$session_username;
                    // echo "method : ".$method."<br>";
                    // echo "system : ".$system;
                    // echo date("Y-m-d H:i:s");
                    // echo date("Y-m-d")-"2021-04-20";

                    $count_page=1;
                    foreach($recruits as $recruit){
                        $create_date=explode(" ",$recruit->create_date);
                        $end_date=explode(" ",$recruit->end_date);
                        $seconds_create_date=(time()-strtotime($recruit->create_date)); //[ton][29/04/2564][add check new = less than 7 days.]
                        if($system=="frontend"){  //[Frontend] //[ton][delete date("Y-m-d H:i:s")<$recruit->end_date && ]
                            echo "<tr>";
                                echo "<td style='text-align:center;'>" .$count_page. "</td>";
                                // echo $recruit->publish_hd_id." ,";
                                // echo $create_date[0]." ,";
                                // echo $seconds_create_date." ,";
                                // echo time()." ,";
                                // echo date("Y-m-d")." .<br>";
                                if($system=="frontend"){
                                    if($seconds_create_date <=604800){ 
                                        echo "<td style='text-align:right;'>"; }
                                    else{ 
                                        echo "<td style='text-align:center;'>"; } ?>
                                        <div> <?php
                                            echo convert_std_format_thai_datetime_frontend_one($recruit->start_date);
                                            //[ton][29/04/2564][add check new = less than 7 days.]
                                            if($seconds_create_date <=604800){ $path_img=base_url()."assets/img/news.gif"; ?>&nbsp; <img src="<?php echo $path_img; ?>" style="margin:-3px 0px 0px 3px;"width="19%">
                                            <?php } ?>
                                        </div>
                                    </td> <?php
                                }
                                echo "<td style='text-align:center;'>" .convert_std_format_thai_datetime_frontend_one($recruit->end_date)."</td>";
                                $sql_sev_position="SELECT position_name from sev_position where position_id =".$recruit->position_id;
                                $position_name=$this->db->query($sql_sev_position)->row()->position_name;
                                echo "<td>" .$position_name. "</td>";
                                // echo '<td>'.$recruit->end_date.' >='.date("Y-m-d H:i:s").'</td>';

                                $sql_tb_location1="SELECT ward_name1 from tb_location1 where ward_code=".$recruit->ward_code;
                                $ward_name1=$this->db->query($sql_tb_location1)->row()->ward_name1;
                                echo "<td>" .$ward_name1. "</td>";

                                echo "<td style='text-align:right;'>" .$recruit->position_amount. "</td>";                               
                                echo "<td style='text-align:right;'>" .GetMoneyFormatOne($recruit->position_rate,2). "</td>";
                                echo "<td style='color:green;' >" .$recruit->publish_status. "</td>";
                                echo "<td style='text-align:right;'>" .$recruit->viewed. "</td>";
                                echo "<td style='text-align:center;'>";
                                    echo "<a href='" . base_url() . "Recruit/recruit/" . $recruit->publish_hd_id ."/".$system."' class='btn btn-info btn-sm'><i class='fa fa-search'></i></a>";
                                    if($system=="backend"){
                                        echo "<a href='" . base_url() . "Recruit/updateRecruit/" . $recruit->publish_hd_id . "' class='btn btn-warning btn-sm'><i class='fa fa-cogs'></i></a>";
                                        $url_del=base_url()."Recruit/deleteRecruitProcess/";
                                        echo "<button type='button' class='btn btn-danger btn-sm' onclick=\"del_publish('$url_del','$recruit->publish_hd_id','$session_username')\" ><i class='fas fa-minus'></i></button>";    
                                    }
                                    
                                echo "</td>";
                            echo "</tr>";
                            $count_page+=1;
                        }else if($system=="backend"){   //[Backend]
                            echo "<tr>"; 
                                // echo $create_date[0]."<br>";
                                // echo date("Y-m-d")."<br>";
                                echo "<td>" .$count_page. "</td>"; ?>
                                <td style='text-align:center;'>
                                    <div class="row"> <?php
                                        echo convert_std_format_thai_datetime_two($recruit->start_date);
                                        if($recruit->end_date>date("Y-m-d H:i:s")) {
                                            if($seconds_create_date <=604800){ ?>&nbsp;<span class="badge badge-pill badge-info">New</span><?php }
                                            else{ ?>&nbsp;<span class="badge badge-pill badge-success">ON</span><?php }
                                        }else if($recruit->end_date<date("Y-m-d H:i:s")) { ?>&nbsp;<span class="badge badge-pill badge-warning">OFF</span> <?php } ?>
                                    </div>
                                </td> <?php
                                // $sql="SELECT position_type_name from rc_position_type where position_type_id = ".$recruit->position_type_id;
                                // $position_type_name=$this->db->query($sql)->row()->position_type_name;
                                // echo "<td>" .$position_type_name. "</td>";
                                echo "<td style='text-align:center;'>" .convert_std_format_thai_datetime_two($recruit->end_date)."</td>";
                                $sql_sev_position="SELECT position_name from sev_position where position_id =".$recruit->position_id;
                                $position_name=$this->db->query($sql_sev_position)->row()->position_name;
                                echo "<td>" .$position_name. "</td>";
                                // echo '<td>'.$recruit->end_date.' >='.date("Y-m-d H:i:s").'</td>';

                                $sql_tb_location1="SELECT ward_name1 from tb_location1 where ward_code=".$recruit->ward_code;
                                $ward_name1=$this->db->query($sql_tb_location1)->row()->ward_name1;
                                echo "<td>" .$ward_name1. "</td>";

                                echo "<td style='text-align:right;'>" .$recruit->position_amount. "</td>";
                                echo "<td style='text-align:right;'>" .GetMoneyFormatOne($recruit->position_rate,2). "</td>";
                                //echo "<td style='color:green;'>" .$recruit->publish_status. "</td>";
                                // echo "<td>" .$recruit->publish_remark. "</td>";
                                echo "<td style='text-align:right;'>" .$recruit->viewed. "</td>";
                                echo "<td style='text-align:center;'>";
                                    echo "<a href='" . base_url() . "Recruit/recruit/" . $recruit->publish_hd_id ."/".$system."' class='btn btn-info btn-sm'><i class='fa fa-search'></i></a>";
                                    if($system=="backend"){
                                        echo "<a href='" . base_url() . "Recruit/updateRecruit/" . $recruit->publish_hd_id . "' class='btn btn-warning btn-sm'><i class='fa fa-cogs'></i></a>";
                                        $url_del=base_url()."Recruit/deleteRecruitProcess/";
                                        echo "<button type='button' class='btn btn-danger btn-sm' onclick=\"del_publish('$url_del','$recruit->publish_hd_id','$session_username')\" ><i class='fas fa-minus'></i></button>";    
                                    }
                                echo "</td>";
                            echo "</tr>";
                            $count_page+=1;
                        }
                    }

                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- [ton][20/04/2564][add clear session status] -->
<?php $this->session->set_flashdata('success',''); $this->session->set_flashdata('failure',''); ?>
