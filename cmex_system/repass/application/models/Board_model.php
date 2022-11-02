<?php

class Board_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    function getBoards(){
        
        $sql = "SELECT * 
                FROM bod_board b
                ORDER BY b.board_name ASC";
        $result = $this->db->query($sql)->result();
        
        return $result;
    }
    
    function getBoard($board_id){
        
        $sql = "SELECT * 
                FROM bod_board b
                WHERE b.board_id = '" . $board_id . "'";
        $result = $this->db->query($sql);

        return $result->row();
    }
    
}
