<?php
	class Recruit_model extends CI_model{
		function __contruct(){
			parent::__contruct();
		}

		function addRecruitAudience($hdid,$formArrayHD){
			if(!empty($hdid)){
				$sql_where="publish_hd_id=".$hdid;
				$this->db->update("rc_publish_hd",$formArrayHD,$sql_where);
				return true;
			}else return false;
		}

		function updateRecruitHd($formArrayHD,$hdid){
			if(!empty($hdid)){
				$sql_where="publish_hd_id=".$hdid;
				$this->db->update("rc_publish_hd",$formArrayHD,$sql_where);
				return true;
			}else return false;
		}

		function deleteRecruit($hdid,$formArrayHD,$formArrayDT){
			if(!empty($hdid)){
				$sql_where="publish_hd_id=".$hdid;
				$this->db->update("rc_publish_dt",$formArrayDT,$sql_where);
				$this->db->update("rc_publish_hd",$formArrayHD,$sql_where);
				return true;
			}else return false;
		}

		function deleteRecruitDt($hdid,$dtid,$formArrayDT){
			$sql_where="publish_hd_id=".$hdid." and publish_dt_id=".$dtid;
			$this->db->update("rc_publish_dt",$formArrayDT,$sql_where);
			return true;
		}

		function getRecruitHds(){
			$sql="SELECT * FROM rc_publish_hd WHERE deleted=0";
			// $sql="SELECT * FROM rc_publish_hd WHERE deleted=0 ORDER BY publish_hd_id DESC";
			$result = $this->db->query($sql)->result();
			return $result;
		}

		function getRecruitDts(){
			$sql="SELECT * FROM rc_publish_dt WHERE deleted=0 ORDER BY publish_dt_id DESC";
			$result=$this->db->query($sql)->result();
			return $result;
		}

		function getRecruitFiles(){
			$sql="SELECT * FROM rc_publish_file ORDER BY file_date DESC";
			$result=$this->db->query($sql)->result();
			return $result;
		}

		function getRecruitHd($id){
			$sql="SELECT * FROM rc_publish_hd WHERE deleted=0 and publish_hd_id=$id";
			$result = $this->db->query($sql)->row();
			return $result;
		}

		function getRecruitDt($id){
			$sql="SELECT * FROM rc_publish_dt WHERE publish_hd_id=$id and deleted=0 ORDER BY create_date ASC";
			$result = $this->db->query($sql)->result();
			return $result;
		}

		function getRecruitFile($id){
			$sql="SELECT * FROM rc_publish_file WHERE publish_hd_id=".$id;
			$result = $this->db->query($sql)->result();
			return $result;
		}

		function addRecruitHd($formHds){
			$this->db->insert('rc_publish_hd',$formHds);
			return true;
		}

		function addRecruitDt($formDts){
			$this->db->insert('rc_publish_dt',$formDts);
			return true;
		}

		function addRecruitFile($formFiles){
			$this->db->insert('rc_publish_file',$formFiles);
			return true;
		}

	}
?>