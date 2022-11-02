<?php
    function cal_age_year($birth_date){
        $date = new DateTime($birth_date);
        $now = new DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }
