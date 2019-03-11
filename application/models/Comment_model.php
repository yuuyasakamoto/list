<?php

    class Comment_model extends CI_Model{
       
        /**
         * member_idの目標データ取得
         * @param type $member_id
         * @return type
         */
        public function getObjectives($member_id){
            $query = $this->db->query("SELECT * FROM objectives where member_id='$member_id'");
            return $query->result();
        }
    }



