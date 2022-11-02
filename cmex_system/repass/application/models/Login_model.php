<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->helper('cookie');
    }

    //[Athiwat][17/10/2565][Add receive $user,$pass]
    public function validate($username,$password) {

        // [Anucha][06/10/2565][add escape_str]
        //[Athiwat][17/10/2565][del xss_clean]
        $username = $this->db->escape_str(addslashes($username));
        $password = $this->db->escape_str(addslashes($password));

        //[Athiwat][10/10/2565][Add $result]
        $result = array();
        $result['validate'] = false;
        $result['inputs']   = "u : ".$username." p : ".$password;

        //[Athiwat][10/10/2565][Process check num_row]
        $sql_check = "SELECT NUM_OT from tb_nuser where NUM_OT ='{$username}' and  Upass = '{$password}' ";
        $row_check=$this->db->query($sql_check)->row();
        
        if($row_check){
            $sql = "SELECT u.NUM_OT,w.New_Heading,ps.position_name,p.Fname,p.Lname
                    FROM tb_nuser u JOIN tb_person p ON u.NUM_OT = p.NUM_OT
                                    JOIN tb_position ps ON u.PP = ps.position_code
                                    JOIN tb_nward w ON u.ward_code = w.ward_code
                    WHERE u.NUM_OT = '{$username}' AND u.Upass = '{$password}' ";
            $row = $this->db->query($sql)->row();
            if($row){
                $result['validate']= true;
                $_SESSION['validated'] = true;
                $_SESSION['name'] = $row->Fname . " " . $row->Lname;
                $_SESSION['numot']=$row->NUM_OT;
                $_SESSION['username'] = $username;
                $_SESSION['organization'] = $row->New_Heading;
                $_SESSION["position_name"] = $row->position_name;
            }
        }

        return $result;
    }

}
?>
