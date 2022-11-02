<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 	class Repass extends MY_Controller{

    	public function __construct(){
    		parent::__construct();
			$this->load->model('Repass_model','RepassModel');
			
			date_default_timezone_set('Asia/Bangkok');
			$config['upload_path']   = './uploads/';
	        $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|pdf|txt|csv';
	        $config['max_size']      = 256000;
	        $this->load->library('upload', $config);
		}

		function index(){
			if((isset($this->session->validated)) || ($this->session->validated)) $this->repass();
		}

		public function formForget(){
	        if(isset($_COOKIE["user_link"])) $data['user_link'] = $_COOKIE["user_link"];
	        else $data['user_link'] = "";
	        $data['msg'] = $msg;

	        $this->session->sess_destroy();
		    $this->load->view('repass/forget_form_view', $data);
		    $this->load->view('repass/forget_form_script', $data);
		}

		public function repass(){
			$this->breadcrumb->add('หน้าหลัก', base_url());
            $this->breadcrumb->add('ข้อมูลผู้ใช้',   base_url().'Repass/repass');
            $this->data['breadcrumb'] = $this->breadcrumb->output();

            $this->data['page']="home";
            $this->data['method']="view";
			$this->data['head_title'] = "ระบบจัดการรหัสผ่าน";
			$this->data['numot']=$this->session->numot;
			$this->data['TB']=$this->RepassModel->getTBs($this->session->numot);
			$this->data['SEV']=$this->RepassModel->getSEVs($this->session->numot);
			$this->data['error']=$this->db->error();
			$this->loadData();
            $this->loadViewWithScript(array('repass/repass_view'), array());
		}

		public function updateRepass($num_ot){
			$this->breadcrumb->add('หน้าหลัก', base_url());
            $this->breadcrumb->add('ข้อมูลผู้ใช้',   base_url().'Repass/repass');
            $this->breadcrumb->add('แก้ไขรหัสผ่าน',   base_url().'Repass/updateRepass/'.$num_ot);
            $this->data['breadcrumb'] = $this->breadcrumb->output();

            $this->loadData();
			$this->data['method']="update";
			$this->data['head_title'] = "ระบบจัดการรหัสผ่าน";
			$this->data['numot']=$this->data['session_username'];
			$this->data['TB']=$this->RepassModel->getTBs($num_ot);
			$this->data['SEV']=$this->RepassModel->getSEVs($num_ot);

			$this->loadViewWithScript(array('repass/repass_form_view'), array('repass/repass_form_script'));
		}

		public function updateRepassProcess(){
			date_default_timezone_set('Asia/Bangkok');
			$this->form_validation->set_rules('newpassword','new password','required|min_length[12]|max_length[40]');
			$this->form_validation->set_rules('confirmpassword','confirm password','required|min_length[12]|max_length[40]|matches[newpassword]');
			$this->form_validation->set_rules('oldpassword','old password','required|max_length[40]');

			// [ton][19/05/2564][add check old password user.]
			$res['numot']=$this->input->post("hidden_numot");
			$oldpass=$this->RepassModel->getoldPassword($res['numot']);
			$res['oldpass']=$oldpass->Upass;
			$res['input_password']=$this->input->post('oldpassword');
			
			$res['form_error_oldpassword']="";
			$res['form_error_newpassword']="";
			$res['form_error_confirmpassword']="";
			if($this->form_validation->run() == false){
				$res['update_status']=false;
				$res['form_error_newpassword']=strip_tags(form_error('newpassword'));
				$res['form_error_confirmpassword']=strip_tags(form_error('confirmpassword'));
				$res['form_error_oldpassword']=strip_tags(form_error('oldpassword'));
			}else if($res['oldpass'] == $this->input->post('newpassword')){ // [ton][15/06/2564][add check new && confirm password == old password.]
				$res['update_status']=false;
				$res['form_error_newpassword']="New password equals old password.";
			}else if($res['oldpass'] == $this->input->post('confirmpassword')){
				$res['update_status']=false;
				$res['form_error_confirmpassword']="Confirm password equals old password.";
			}else if($res['oldpass']!=$this->input->post('oldpassword')){ // [ton][19/05/2564][add check old password user.]
				$res['update_status']=false;
				$res['form_error_oldpassword']="Your old password wrong.";
			}else{
				$res['update_status']=true;
				$res['form_error_newpassword']="";
				$res['form_error_confirmpassword']="";
				$res['form_error_oldpassword']="";
			}
			echo json_encode($res);

			// [ton][19/05/2564][add process update password.]
			if($res['update_status']){
				$formNuser['Upass']=$this->input->post('newpassword');

				$formLog['NUM_OT']=$res['numot'];
				$formLog['change_new_password']=$this->input->post('newpassword');
				$formLog['change_old_password']=$res['oldpass'];
				$formLog['change_status']="update";
				$formLog['modify_by']=$res['numot'];
				$formLog['modify_date']=date("Y-m-d H:i:s");

				$updateResult=$this->RepassModel->updatePassword($res['numot'],$formNuser,$formLog);
				
				if(!$updateResult){
					$msg="แก้ไขรหัสผ่านไม่สำเร็จ !";
					$this->session->set_flashdata("failure",$msg);
					$res['query_update_status']=false;
				}else{
					$msg="แก้ไขรหัสผ่านสำเร็จ !";
					$this->session->set_flashdata("success",$msg);
					$res['query_update_status']=true;
				}
			}

			
		}



	}
?>
