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
        public function getContents($member_id, $created){
            $query = $this->db->query("SELECT objective FROM objectives where member_id='$member_id' and created='$created'");
            return $query->row()->objective;
        }
        public function insert($comment, $admin_id, $objective_id)
        {
            //postされた値をcommentsテーブルに登録
            $data = ['comment' => $comment, 'admin_id' => $admin_id, 'objective_id' => $objective_id];
            $this->db->insert('comments', $data);
        }
    }



