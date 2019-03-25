<?php

class Department_model extends CI_Model
{
    /**
     * 役職IDに紐づいた役職名を返す
     * @param int $department_id
     * @return type
     */
    public function findById(int $department_id)
    {
        $query = $this->db->query("SELECT * FROM departments  WHERE id='$department_id'");
        $department = $query->row();
        return $department->department_name;
    }
}