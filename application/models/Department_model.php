<?php

class Department_model extends CI_Model{
    /**
     * 役職IDに紐づいた役職名を返す
     * @param type $id1
     * @return type
     */
    public function findById(int $department_id)
    {
        $query = $this->db->query("SELECT * FROM departments where id='$department_id'");
        $department = $query->row();
        return $department->department_name;
    }
}