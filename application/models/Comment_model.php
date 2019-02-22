<?php

    class Comment_model extends CI_Model{
        /**
         * commentsテーブルの全データ取得
         * @return type
         */
        public function findAll(){
            $query = $this->db->query('SELECT * FROM comments ORDER BY id DESC');
            return $query->result();
        }
    }



