<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('inflector');
        $this->load->helper('cookie');

        $this->load->model('Login_model', 'Login');
    }

    public function index($msg = NULL)
    {
        if (isset($_COOKIE["user_link"])) $data['user_link'] = $_COOKIE["user_link"];
        else $data['user_link'] = "";
        $data['msg'] = $msg;

        $this->load->view('login_view', $data);
    }

    //[Athiwat][17/10/2565][Mo -> Post by ajax]
    public function process(){
        $user_link = $this->security->xss_clean($this->input->post('user_link'));

        $username = $this->security->xss_clean($_POST['username']);
		$password = $this->security->xss_clean($_POST['password']);
        
        //[Athiwat][17/10/2565][Mo -> Post by ajax]
        $result = $this->Login->validate($username,$password);
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

        // if(!$result['validate']){
        //     $msg = '<font color=red>Invalid username or password.</font><br />';
        //     $this->index($msg);
        // }else{
            //[Athiwat][17/10/2565][add isset($user_link)]
            // if (!empty($user_link) && isset($user_link)) {
            //     header("location: ".$user_link." ");
            // } else {
            //     header("location: ".base_url('Home')." ");
            // }
        // }

    }

}
