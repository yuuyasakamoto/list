<?php

class Position_model extends CI_Model{
    /**
     * 役職IDに紐づいた役職名を返す
     * @param type $id2
     * @return type
     */
    public function findById($id2)
    {
        $query = $this->db->query("SELECT * FROM positions where id='$id2'");
        $position_name= $query->row();
        return $position_name->position_name;
    }
}