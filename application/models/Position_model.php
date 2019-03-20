<?php

class Position_model extends CI_Model{
    /**
     * 役職IDに紐づいた役職名を返す
     * @param type $id2
     * @return type
     */
    public function findById(int $position_id)
    {
        $query = $this->db->query("SELECT * FROM positions where id='$position_id'");
        $position = $query->row();
        return $position->position_name;
    }
}