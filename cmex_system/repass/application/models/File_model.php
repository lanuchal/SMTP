<?php

class File_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }

    function getMeetingFiles($meeting_id){
        $sql = "SELECT * 
                FROM met_file f
                WHERE f.meeting_id = '" . $meeting_id . "'
                AND f.meeting_person_id = '0'";
        $result = $this->db->query($sql)->result();
        
        return $result;
    }

    function getMeetingPersonFiles($meeting_id, $meeting_person_id){
        $sql = "SELECT * 
                FROM met_file f
                WHERE f.meeting_id = '" . $meeting_id . "'
                AND f.meeting_person_id = '" . $meeting_person_id . "'";
        $result = $this->db->query($sql)->result();
        
        return $result;
    }

    function getMeetingPersonsFiles($meeting_id, $meeting_person_id){
        $sql = "SELECT * 
                FROM met_file f
                JOIN met_meeting_person mp ON mp.meeting_person_id = f.meeting_person_id
                WHERE f.meeting_id = '" . $meeting_id . "'";
                
        $result = $this->db->query($sql)->result();
        
        return $result;
    }


    function deleteFile($file_id){
        $this->db->where('file_id', $file_id);
        //$result = $this->db->update('form', $data);
        $result = $this->db->delete("met_file");
        return $result;
    }
}
