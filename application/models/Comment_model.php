<?php

    class Comment_model extends CI_Model{
       
        /**
         * member_idの目標データ取得
         * @param type $member_id
         * @return type
         */
        public function getObjectives($member_id)
        {
            $query = $this->db->query("SELECT * FROM objectives where member_id='$member_id' ORDER BY year DESC");
            return $query->result();
        }
        /**
         * IDで目標内容を取得
         * @param type $member_id
         * @param type $created
         * @return type
         */
        public function getContents($objective_id)
        {
            $query = $this->db->query("SELECT * FROM objectives where id='$objective_id'");
            return $query->row_array();
        }
        /**
         * 投稿されたコメントと管理者IDと目標IDをcommentsテーブルに保存
         * @param type $comment
         * @param type $admin_id
         * @param type $objective_id
         */
        public function insert($comment, $admin_id, $objective_id)
        {
            $data = ['comment' => $comment, 'admin_id' => $admin_id, 'objective_id' => $objective_id];
            $this->db->insert('comments', $data);
        }
    }



