<?php
/*=================================================================================================================================================================
	Create by  : Athiwat Duliganon
	Create Date: 04/10/2565
	Description: Import Class My_Config.
=================================================================================================================================================================*/
class MY_Config extends CI_Config {

    public function __construct() {

        $this->config =& get_config();

        log_message('debug', "Config Class Initialized");

        // Set the base_url automatically if none was provided
        if ($this->config['base_url'] == '')
        {
            if (isset($_SERVER['HTTP_HOST']))
            {
                $base_url = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
            }
            else
            {
                $base_url = 'http://localhost/';
            }

            $this->set_item('base_url', $base_url);
        }
    }
}
