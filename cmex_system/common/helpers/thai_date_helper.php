<?php

function convert_to_thai_date_full($date) {
    
    $date = explode("-",$date);
    $year =  doubleval($date[0]) + 543;
    
	$month = 0;
    if($date[1] == "01"){
        $month = "มกราคม";
    }
    if($date[1] == "02"){
        $month = "กุมภาพันธ์";
    }
    if($date[1] == "03"){
        $month = "มีนาคม";
    }
    if($date[1] == "04"){
        $month = "เมษายน";
    }
    if($date[1] == "05"){
        $month = "พฤษภาคม";
    }
    if($date[1] == "06"){
        $month = "มิถุนายน";
    }
    if($date[1] == "07"){
        $month = "กรกฎาคม";
    }
    if($date[1] == "08"){
        $month = "สิงหาคม";
    }
    if($date[1] == "09"){
        $month = "กันยายน";
    }
    if($date[1] == "10"){
        $month = "ตุลาคม";
    }
    if($date[1] == "11"){
        $month = "พฤศจิกายน";
    }
    if($date[1] == "12"){
        $month = "ธันวาคม";
    }

    return $date[2] . " " . $month . " " . $year;
}

function convert_to_thai_date($date) {
    
    $date = explode("-",$date);
    $year = $date[0] + 543;
	$month = 0;
    if($date[1] == "01"){
        $month = "ม.ค.";
    }
    if($date[1] == "02"){
        $month = "ก.พ.";
    }
    if($date[1] == "03"){
        $month = "มี.ค.";
    }
    if($date[1] == "04"){
        $month = "เม.ย.";
    }
    if($date[1] == "05"){
        $month = "พ.ค.";
    }
    if($date[1] == "06"){
        $month = "มิ.ย.";
    }
    if($date[1] == "07"){
        $month = "ก.ค.";
    }
    if($date[1] == "08"){
        $month = "ส.ค.";
    }
    if($date[1] == "09"){
        $month = "ก.ย.";
    }
    if($date[1] == "10"){
        $month = "ต.ค.";
    }
    if($date[1] == "11"){
        $month = "พ.ย.";
    }
    if($date[1] == "12"){
        $month = "ธ.ค.";
    }

    return $date[2] . " " . $month . " " . $year;
}

function get_thai_day($date){
    $date = explode("-",$date);
    return $date[2];
}

function get_thai_month_full($date){
    $date = explode("-",$date);
	//$month = 0;
    if($date[1] == "01"){
        $month = "มกราคม";
    }
    if($date[1] == "02"){
        $month = "กุมภาพันธ์";
    }
    if($date[1] == "03"){
        $month = "มีนาคม";
    }
    if($date[1] == "04"){
        $month = "เมษายน";
    }
    if($date[1] == "05"){
        $month = "พฤษภาคม";
    }
    if($date[1] == "06"){
        $month = "มิถุนายน";
    }
    if($date[1] == "07"){
        $month = "กรกฎาคม";
    }
    if($date[1] == "08"){
        $month = "สิงหาคม";
    }
    if($date[1] == "09"){
        $month = "กันยายน";
    }
    if($date[1] == "10"){
        $month = "ตุลาคม";
    }
    if($date[1] == "11"){
        $month = "พฤศจิกายน";
    }
    if($date[1] == "12"){
        $month = "ธันวาคม";
    }
    return $month;
}

function get_thai_month_full_by_month($month){
	//$month = 0;
    if(($month == "01") || ($month == "1")){
        $month = "มกราคม";
    }
    if(($month == "02")|| ($month == "2")){
        $month = "กุมภาพันธ์";
    }
    if(($month == "03")|| ($month == "3")){
        $month = "มีนาคม";
    }
    if(($month == "04")|| ($month == "4")){
        $month = "เมษายน";
    }
    if(($month == "05")|| ($month == "5")){
        $month = "พฤษภาคม";
    }
    if(($month == "06")|| ($month == "6")){
        $month = "มิถุนายน";
    }
    if(($month == "07")|| ($month == "7")){
        $month = "กรกฎาคม";
    }
    if(($month == "08")|| ($month == "8")){
        $month = "สิงหาคม";
    }
    if(($month == "09")|| ($month == "9")){
        $month = "กันยายน";
    }
    if($month == "10"){
        $month = "ตุลาคม";
    }
    if($month == "11"){
        $month = "พฤศจิกายน";
    }
    if($month == "12"){
        $month = "ธันวาคม";
    }
    return $month;
}

function get_thai_year($date){
    $date = explode("-",$date);
    return $date[0] + 543;
}

function convert_to_two_digit($month){
    if($month == "1"){
        $month = "01";
    }
    if($month == "2"){
        $month = "02";
    }
    if($month == "3"){
        $month = "03";
    }
    if($month == "4"){
        $month = "04";
    }
    if($month == "5"){
        $month = "05";
    }
    if($month == "6"){
        $month = "06";
    }
    if($month == "7"){
        $month = "07";
    }
    if($month == "8"){
        $month = "08";
    }
    if($month == "9"){
        $month = "09";
    }
    return $month;
}

// [ton][20/04/2564][add function convert date]
function convert_std_format_datetime($datetime){
    $exp=explode(" ",$datetime);
    $expl=explode("-",$exp[0]);
    return $expl[0]."-".$expl[1]."-".$expl[2]." ".date("H:i", strtotime($exp[1]));
}

function convert_std_format_thai_datetime_one($datetime){
    $exp=explode(" ",$datetime);
    $expl=explode("-",$exp[0]);
    return (doubleval($expl[0]) + 543)."-".$expl[1]."-".$expl[2]." ".date("H:i", strtotime($exp[1]));
}

function convert_std_format_thai_datetime_two($datetime){
    $exp=explode(" ",$datetime);
    $expl=explode("-",$exp[0]);
    return $expl[2]."/".$expl[1]."/".(doubleval($expl[0]) + 543)." ".date("H:i", strtotime($exp[1]));
}

function convert_std_format_thai_datetime_frontend_one($datetime){
    $exp=explode(" ",$datetime);
    $expl=explode("-",$exp[0]);
    return $expl[2]."/".$expl[1]."/".(doubleval($expl[0]) + 543);
}

function convert_std_format_thai_datetime_frontend_two($datetime){
    $exp=explode(" ",$datetime);
    $expl=explode("-",$exp[0]);
    return (doubleval($expl[0]) + 543)."-".$expl[1]."-".$expl[2];
}

// [Athiwat][29/09/2564][add function convert_thai_full_date]
function convert_thai_full_date($date){
    $date = explode("-",$date);

    $year=($date[0]+543);

    if($date[1] == "01"){
        $month = "มกราคม";
    }
    if($date[1] == "02"){
        $month = "กุมภาพันธ์";
    }
    if($date[1] == "03"){
        $month = "มีนาคม";
    }
    if($date[1] == "04"){
        $month = "เมษายน";
    }
    if($date[1] == "05"){
        $month = "พฤษภาคม";
    }
    if($date[1] == "06"){
        $month = "มิถุนายน";
    }
    if($date[1] == "07"){
        $month = "กรกฎาคม";
    }
    if($date[1] == "08"){
        $month = "สิงหาคม";
    }
    if($date[1] == "09"){
        $month = "กันยายน";
    }
    if($date[1] == "10"){
        $month = "ตุลาคม";
    }
    if($date[1] == "11"){
        $month = "พฤศจิกายน";
    }
    if($date[1] == "12"){
        $month = "ธันวาคม";
    }
    
    if($date[1] == "00" || $date[1] == null){
        $full_thaidate1="ไม่ระบุ";
    } else {
        $full_thaidate1="วันที่ ".$date[2]." ".$month." ".$year;
    }
    
    // $full_thaidate="วันที่ ".$date[2]." เดือน ".$month." ปี ".$year;
    return $full_thaidate1;
}

// [Supapong][19/09/2565][add function convert_string_time]
function convert_string_time($time){
    $time_data = explode(":",$time);
    $time = (int)$time_data[0];
    $minute = (int)$time_data[1];
    return $time.' นาฬิกา '.$minute.' นาที';
}

?>
