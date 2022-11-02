<?php

function is_logged_in() {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $userdata = $CI->session->userdata();
    
    if (!isset($userdata)) { return false; } else { return true; }
}
