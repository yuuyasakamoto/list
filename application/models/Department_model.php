<?php

class Department_model extends CI_Model{
    /**
     * 役職IDに紐づいた役職名を返す
     * @param type $id1
     * @return type
     */
    public function findById($id1)
    {
        $query = $this->db->query("SELECT * FROM departments where id='$id1'");
        $department_name= $query->row();
        return $department_name->department_name;
    }
}