<?php
	class Repass_model extends CI_model{

		function __contruct(){
			parent::__contruct();
		}

		public function updateForgetStatus($numot,$token,$formForget,$tb="emp_forget_password"){
			if(!empty($numot) && !empty($token) && !empty($formForget)){
				//[Athiwat][11/06/2564][add comment && add new $where]
				// $where="NUM_OT='{$numot}' AND forget_token='{$token}'";
				$where="NUM_OT='{$numot}' AND forget_status='ON'";
				$query=$this->db->update($tb,$formForget,$where);
				return true;
			}else return false;
		}

		public function checkTokenLatest($numot,$notin="off"){
			$sql="SELECT EM.* FROM emp_forget_password EM WHERE EM.num_ot='{$numot}' AND EM.forget_status not in ('{$notin}') ORDER BY EM.forget_datetime DESC LIMIT 1";
			$query=$this->db->query($sql);
			$row=$query->num_rows();
			if($row>0) return $this->db->query($sql)->row(); else return false;
		}

		public function checkForgetPassword($numot,$token){
			$sql="SELECT * from emp_forget_password where NUM_OT=".$numot." AND forget_token='{$token}'";
			$query=$this->db->query($sql);
			$row=$query->num_rows();
			if($row>0) return $this->db->query($sql)->row(); else return false;
		}

		public function insertForgetPassword($formFP){
			$this->db->insert('emp_forget_password',$formFP);
			return true;
		}

		public function getFixTBs($num_ot){
			$sql="SELECT p.fname,p.lname,po.position_name,nw.New_Heading
				  from tb_nuser n
				 	left outer join tb_person p on (n.NUM_OT = p.NUM_OT)
				 	left outer join tb_position po on (n.pp=po.position_code)
				 	left outer join tb_nward nw on (nw.ward_code=n.ward_code)
				   where n.NUM_OT= '{$num_ot}' ";
			$query=$this->db->query($sql);
			$row=$query->num_rows();
			if($row>0) return $this->db->query($sql)->row(); else return false;
		}

		public function getEmpMail($numot){
			$sql="SELECT employee_cmu_email FROM emp_contact WHERE NUM_OT=".$numot;
			$query=$this->db->query($sql);
			$numrow=$query->num_rows();
			if($numrow>0) return $this->db->query($sql)->row(); else return false;
		}

		public function checkEmpID($numot){
			if($numot!=""){
				$sql="SELECT NUM_OT FROM tb_nuser WHERE NUM_OT=".$numot;
				$query=$this->db->query($sql);
				$numrow=$query->num_rows();
				if($numrow>0) return $this->db->query($sql)->row(); else return false;
			}else return false;
		}
		
		public function updatePassword($id,$formNuser,$formLog){
			if(!empty($id) && !empty($formNuser) && !empty($formLog)){
				$sql_where="NUM_OT=".$id;
				$this->db->update('tb_nuser',$formNuser,$sql_where);
				$this->db->insert('emp_password_log',$formLog);
				return true;
			}else return false;
		}

		public function getoldPassword($num_ot){
			$sql="SELECT Upass from tb_nuser where num_ot='{$num_ot}' "; //[Ath][18/10/2565][use '{$var}']
			$result=$this->db->query($sql);
			$numrow=$result->num_rows();
			if($numrow>0) return $this->db->query($sql)->row(); else return false;
		}

		public function getTBs($num_ot){
			$sql="SELECT n.*
   						,p.*
						,po.*
						,nw.*
				  from tb_nuser n
				 	left join tb_person p on (n.NUM_OT = p.NUM_OT)
				 	left join tb_position po on (n.pp=po.position_code)
				 	left join tb_nward nw on (nw.ward_code=n.ward_code)
				   where n.NUM_OT='{$num_ot}' "; //[Ath][18/10/2565][use '{$var}']
			$query=$this->db->query($sql);
			$row=$query->num_rows();
			if($row>0) return $this->db->query($sql)->row(); else return false;
		}

		public function getSEVs($num_ot){
			$sql="SELECT p.*,po.*
				  from sev_person p
					left join sev_position po on (p.position_id = po.position_id)
				  where p.person_id='{$num_ot}' "; //[Ath][18/10/2565][use '{$var}']
			$query=$this->db->query($sql);
			$row=$query->num_rows();
			if($row>0) return $this->db->query($sql)->row(); else return false;
		}

		public function getNuser($num_ot){
			$sql="SELECT * FROM tb_nuser WHERE num_ot='{$num_ot}' "; //[Ath][18/10/2565][use '{$var}']
			$result=$this->db->query($sql)->result();
			$numrow=$result->num_rows();
			
			if($numrow>0)return $result; else return false;
		}

		public function getPerson($num_ot){
			$sql="SELECT * FROM tb_person WHERE num_ot='{$num_ot}' "; //[Ath][18/10/2565][use '{$var}']
			$result=$this->db->query($sql)->result();
			$numrow=$result->num_rows();

			if($numrow>0)return $result; else return false;
		}

		public function getSevPerson($person_id){
			$sql="SELECT * FROM sev_person WHERE person_id=".$person_id;
			$result=$this->db->query($sql)->result();
			$numrow=$result->num_rows();

			if($numrow>0)return $result; else return false;
		}		

		public function getNusers(){
			$sql="SELECT * FROM tb_nuser";
			$result=$this->db->query($sql)->result();
			return $result;
		}

		public function getPersons(){
			$sql="SELECT * FROM tb_person";
			$result=$this->db->query($sql)->result();
			return $result;
		}

		public function getSevPersons(){
			$sql="SELECT * FROM sev_person";
			$result=$this->db->query($sql)->result();
			return $result;
		}

	}
?>