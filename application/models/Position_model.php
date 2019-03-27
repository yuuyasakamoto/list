<?php

class Position_model extends CI_Model
{
    /**
     * 役職IDに紐づいた役職名取得
     * @param int $position_id
     * @return type
     */
    public function findById(int $position_id)
    {
        $query = $this->db->query("SELECT * FROM positions WHERE id='$position_id'");
        $position = $query->row();
        return $position->position_name;
    }
    /**
     * 全データの取得
     * @return type
     */
    public function findPositionAll()
    {
        $query = $this->db->query('SELECT * FROM positions');
        return $query->result();
    }
}