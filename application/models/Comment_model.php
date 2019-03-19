<?php

class Comment_model extends CI_Model
{
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



