<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 	class Forget extends CI_Controller{

    	public function __construct(){
    		parent::__construct();
    		date_default_timezone_set('Asia/Bangkok');

    		$this->load->library('user_agent');
        	$this->load->library('session');
        	$this->load->library('form_validation');

        	$this->load->helper('url');
        	$this->load->helper('form');
        	$this->load->helper('cookie');
        	$this->load->helper('inflector');
        	$this->load->helper('Email'); 				//[Athwiat][28/05/2564][add plugin PHPMailer.]
        	//$this->load->helper('Captcha');			//[Athwiat][11/05/2564][add captcha helper.]
        	$this->load->helper('../../common/helpers/thai_date');

        	$this->load->model('Login_model','Login');
			$this->load->model('Repass_model','RepassModel');
			
			$config['upload_path']   = './uploads/';
	        $config['allowed_types'] = 'gif|jpg|jpeg|png|doc|docx|xls|xlsx|ppt|pptx|pdf|txt|csv';
	        $config['max_size']      = 256000;

	        $this->load->library('upload', $config);
		}

		function index($publish_id=null){
			if((!isset($this->session->validated)) || ($this->session->validated)) $this->forget();
		}

		public function forget(){
			return true;
		}

		public function formForget($msg=NULL){
	        if(isset($_COOKIE["user_link"])) $data['user_link'] = $_COOKIE["user_link"];
	        else $data['user_link'] = "";
	        $data['msg'] = $msg;
	        $data['captcha']=$this->genarateRandomCaptcha(6);

	        // $capt_code=substr($rn,0,6);

	        $this->session->sess_destroy();
	        $this->load->view('forget/forget_form_view', $data);
	        $this->load->view('forget/forget_form_script', $data);
    	}

    	public function genarateRandomCaptcha($len){
        	$randomStr="";
        	$strs="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        	$loop=$len*5;
        	for($i=0;$i<$loop;$i++){
        		$randomStr.=$strs[rand(0,$loop-1)];
        	}
        	return substr($randomStr,0,$len);
        }

    	public function requestForgetPassword(){
    		//[Athwiat][15/06/2564][add note && edit flow process requestForgetPassword]
    		/*=========================================================================
    		[DESC : flow process request forget pass.
					   1.check form validate.
					   2.check reCAPTCHA.
					   3.check form.
					   4.insert token and timeout to db.
					   5.sendmail on script.]
			===========================================================================*/

			//[Athwiat][15/06/2564][1.check form validate]
			$this->form_validation->set_rules("username","employee id","required|min_length[5]|max_length[5]");
            $res['input_numot']=$this->input->post("username");
            $oldnumot=$this->RepassModel->checkEmpID($res['input_numot']); //[check numot]
            if(!empty($oldnumot)){
            	$res['old_numot']=$oldnumot->NUM_OT;
            	$getTB=$this->RepassModel->getFixTBs($oldnumot->NUM_OT);
            	$getMail=$this->RepassModel->getEmpMail($oldnumot->NUM_OT);
            	if(!empty($getMail)){
            		$res["emp_email"]=$getMail->employee_cmu_email;
            		/* ======= Settting token ======= */
            		$token45=$this->genarateRandomStr(45);

            		/* ======= Setting timeout ======= */
            		$res['datetime'] = date("Y-m-d H:i:s");
            		$to = new DateTime();
            		$to->modify('+30 minute');
            		$res['datetime_timeout']=$to->format('Y-m-d H:i:s');
            		$diff=abs(strtotime($res['datetime_timeout'])-strtotime($res['datetime']));
     				$res['year_balance'] = floor($diff / (365*60*60*24));
					$res['month_balance'] = floor(($diff - $res['year_balance'] * 365*60*60*24) / (30*60*60*24));
					$res['day_balance']=intval( $diff / 86400 );
			        $res['hour_balance']=intval( ( $diff % 86400 ) / 3600);
			        $res['minute_balance']=intval( ( $diff / 60 ) % 60 );
			        $res['seconds_balance']=intval( $diff % 60 );

            		/* ======= Insert table emp_forget_password ======= */
            		$formFP['NUM_OT']=$oldnumot->NUM_OT;
            		$formFP['forget_token']=$token45;
            		$formFP['forget_status']="ON";
            		$formFP['forget_datetime']=$res['datetime'];
            		$formFP['forget_timeout']=$res['datetime_timeout'];
            		//$resultFP=$this->RepassModel->insertForgetPassword($formFP);

            		/* ======= Setting token and link ======= */
					// [Ath][12/10/2565][Comment && Find cause fix can't send email cmu]
					// $link=base_url()."Forget/LF/".$oldnumot->NUM_OT."/".$token45;
					$link=HOST_URL_UES_IN_CON.base_url()."Forget/LF/".$oldnumot->NUM_OT."/".$token45;
					
            		$res["link"]=$link;
            		$res['fname']=$getTB->fname;
            		$res['lname']=$getTB->lname;
            		$res['position_name']=$getTB->position_name;
            		$res['New_Heading']=$getTB->New_Heading;
            		$res['employee_cmu_email']=$getMail->employee_cmu_email;
            	}else $res['sendmail_status']=0;
            }else $res['old_numot']=0;

    		//[Athwiat][11/05/2564][add process captcha]
    		//[Athwiat][15/06/2564][2.check reCAPTCHA]
			if(!empty($_POST['g-recaptcha-response'])){
				$secretkey=SECRET_KEY;
				$ip=$_SERVER['REMOTE_ADDR'];
				$response=$_POST['g-recaptcha-response'];
				$url="https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$response&remoteip=$ip";
				$fire=file_get_contents($url);
				$captcha_obj=json_decode($fire);
				$res['captcha_obj']=$captcha_obj;

				if($captcha_obj->success==false){
					$res['captcha_status']=false;
					$res['form_error_captcha']="Your reCAPTCHA timeout.";
				}else{
					$res['captcha_status']=true;
					$res['captcha_empty_status']="!empty";
					$res['form_error_captcha']="";
				}

			}else{
				$res['form_error_captcha']="You didn't check reCAPTCHA.";
				$res['captcha_empty_status']="empty";
				$res['captcha_status']=false;
			}

			//[Athwiat][15/06/2564][3.check form]
			if($this->form_validation->run()==false){
                $res['request_status']=false;
                $res['form_error_username']=strip_tags(form_error('username'));
            }else if($res['old_numot'] == 0){
                $res['request_status']=false;
                $res['form_error_username']="Input employee ID was wrong.";
            }else if($res['input_numot']!=$res['old_numot']){
            	$res['request_status']=false;
                $res['form_error_username']="There is no employee ID in system.";
            }else{
                $res['request_status']=true;
                $res['form_error_username']="";
            }

            //[Athwiat][11/05/2564][edit process token && timeout]
            //[Athwiat][15/06/2564][4.process insert token and timeout to db]
            if($res['request_status'] && $res['captcha_status']){
            	$resultFP=$this->RepassModel->insertForgetPassword($formFP);
            	$res['insertForgetPassword_stu']=true;
            }
			
            echo json_encode($res);
        }

        public function genarateRandomStr($len){
        	$randomStr="";
        	$strs="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        	for($i=0;$i<$len;$i++){
        		$randomStr.=$strs[rand(0,$len-1)];
        	}
        	return $randomStr;
        }

        // [Athiwat][31/05/2564][create method linkForget = LF.]
        public function LF($numot,$token,$msg=NULL){
    		$resultFP=$this->RepassModel->checkForgetPassword($numot,$token);  	// [Athiwat][31/05/2564][check has token?]
    		$resultCheckTK=$this->RepassModel->checkTokenLatest($numot);	// [Athiwat][31/05/2564][check has token latest and status : NO ?]
    		if($resultCheckTK!=false && !empty($resultCheckTK)){
	    		// [Athiwat][31/05/2564][check token latest and status:no > only can make transaction.]
	    		$res['latest_token_status']=($resultFP->forget_token==$resultCheckTK->forget_token)?"true":"false";
	    		if(!empty($resultFP) && !empty($resultCheckTK) && $resultCheckTK!=false && $res['latest_token_status']!="false"){
	    			$data=array();
	    			$res['resultFP_status']="Have data in db.";
	    			$res['timeout_datetime']=$resultFP->forget_timeout;
	    			$res['datetime'] = date("Y-m-d H:i:s");
	        		$diff=abs(strtotime($res['datetime'])-strtotime($resultFP->forget_timeout));
	        		$res['diff_datetime'] = $diff; 													//[Athiwat][31/05/2564][diff : 1800 == 30 minute.]
	        		if(abs(strtotime($res['datetime']))<abs(strtotime($resultFP->forget_timeout))){ //[Athwiat][07/06/2564][add check token time out.]
	            		if($diff<1801){
		     				$res['year_balance']=floor($diff / (365*60*60*24));
							$res['month_balance']=floor(($diff - $res['year_balance'] *365*60*60*24) / (30*60*60*24));
							$res['day_balance']=intval( $diff / 86400 );
					        $res['hour_balance']=intval(( $diff % 86400 ) / 3600);
					        $res['minute_balance']=intval(( $diff / 60 ) % 60 );
					        $res['seconds_balance']=intval( $diff % 60 );

					        $msg=NULL;
					        if(isset($_COOKIE["user_link"])) $data['user_link'] = $_COOKIE["user_link"]; else $data['user_link'] = "";
					        $data['msg'] = $msg;
							$data['numot']=$resultFP->NUM_OT;
					        $data['status']=$resultFP->forget_status;

					        $resultTB=$this->RepassModel->getFixTBs($numot);
					        $data['fname']=$resultTB->fname;
					        $data['lname']=$resultTB->lname;
					        $data['position']=$resultTB->position_name;
					        $data['organization']=$resultTB->New_Heading;
					        $data['forget_token']=$resultFP->forget_token;

					        $this->session->sess_destroy();
					        $this->load->view('forget/forget_linkform_view', $data);
					        $this->load->view('forget/forget_linkform_script', $data);
	            		}else{
	            			//[Athwiat][07/06/2564][Is token timeout one.]
	            			$data['timeout_token_status']="true";
	            			$data['timeout_token_desc']="Token over timeout1";
					        $this->load->view('forget/forget_linkform_view', $data);
					        $this->load->view('forget/forget_linkform_script', $data);

	            			//[Athwiat][07/06/2564][view value timeout.]
			        		/*echo "datetime : ".abs(strtotime($res['datetime']))."<br>";
			            	echo "timeout . : ".abs(strtotime($resultFP->forget_timeout))."<br>";
			        		foreach($res as $index => $val){ echo "$index = $val <br>"; } */
	            		} 
	        		}else{
	        			//[Athwiat][07/06/2564][Is token timeout two.]
	        			$data['timeout_token_status']="true";
	        			$data['timeout_token_desc']="Token over timeout2";
				        $this->load->view('forget/forget_linkform_view', $data);
				        $this->load->view('forget/forget_linkform_script', $data);
	        		}
	    		}else{
	    			//[Athwiat][07/06/2564][Is not token latest or status != 'no']
	    			$data['token_status_desc']="Is not token latest";
	    			$data['latest_token_status']=$res['latest_token_status'];
	    			if($res['latest_token_status']=="false") $data['latest_token_remark']="Token $token' system used!";
			        $this->load->view('forget/forget_linkform_view', $data);
			        $this->load->view('forget/forget_linkform_script', $data);
	    		}
    		}else{
    			$data['token_status_desc']="Token out of stack";
    			$data['latest_token_status']="false";
    			$data['latest_token_remark']="All token off status";
		        $this->load->view('forget/forget_linkform_view', $data);
		        $this->load->view('forget/forget_linkform_script', $data);
    		}
    		
        }

        function updateForgetProcess(){
        	$this->form_validation->set_rules("newpassword","new password","required|min_length[12]|max_length[20]");
        	$this->form_validation->set_rules("confirmpassword","confirm password","required|min_length[12]|max_length[20]|matches[newpassword]");

    		if($this->form_validation->run() == false){
    			$res['update_status']=false;
    			$res['form_error_newpassword']=strip_tags(form_error('newpassword'));
    			$res['form_error_confirmpassword']=strip_tags(form_error('confirmpassword'));
    		}else{
    			$res['form_error_newpassword']="";
    			$res['form_error_confirmpassword']="";
    			if($this->input->post("newpassword") == $this->input->post("confirmpassword") && !empty($this->input->post("hidden_numot"))){
    				date_default_timezone_set('Asia/Bangkok');
        			$formNuser['NUM_OT']=$this->input->post("hidden_numot");
        			$formNuser['Upass']=$this->input->post("newpassword");

        			$formLog['NUM_OT']=$this->input->post("hidden_numot");
        			$formLog['change_new_password']=$this->input->post("newpassword");
        			//Get old password.
        			$oldpass=$this->RepassModel->getoldPassword($this->input->post("hidden_numot"));
        			$formLog['change_old_password']=$oldpass->Upass;
        			$formLog['change_status']="forget";
        			$formLog['modify_by']=$this->input->post("hidden_numot");
        			$formLog['modify_date']=date("Y-m-d H:i:s");

        			//[update formNuser and formLog]
        			$resultUpdate=$this->RepassModel->updatePassword($formNuser['NUM_OT'],$formNuser,$formLog);
        			//[update status token = off]
        			$formForget['forget_status']=($resultUpdate!=false)?"OFF":"ON";
        			$resultUpdateStatus=$this->RepassModel->updateForgetStatus($this->input->post("hidden_numot"),$this->input->post("hidden_forget_token"),$formForget); //[ton add comment]

        			$res['forget_status']=$formForget['forget_status'];
        			$res['oldpass']=$oldpass->Upass;
        			$res['newpass']=$this->input->post("newpassword");
        			if($resultUpdate) $res['update_status']=true;
        			
    			}
    		}
        	echo json_encode($res);
        }


	}
?>
