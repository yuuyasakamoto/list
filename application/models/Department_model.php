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
        $query = $this->db->query("SELECT * FROM departments WHERE id='$department_id'");
        $department = $query->row();
        return $department->department_name;
    }
    /**
     * 全データの取得
     * @return type
     */
    public function findDepartmentAll()
    {
        $query = $this->db->query('SELECT * FROM departments');
        return $query->result();
    }
    /**
     * 新部署登録機能
     * @param string $name
     */
    public function insert(string $name)
    {
        $sql = "INSERT INTO departments (department_name) VALUES(?)";
        //入力した値をdepartmentsテーブルに保存
        $this->db->query($sql, [$name]);
    }
    /**
     * 部署名更新機能
     * @param string $id
     * @param string $name
     */
    public function update(string $id, string $name)

    {
        $sql = "UPDATE departments SET department_name =?,
                               modified = now()
                               WHERE id = ?";
        $this->db->query($sql, [$name, $id]);  
    }
    /**
     * 部署削除機能
     * @param string $id
     */
    public function delete(string $id)
    {
        $sql = 'DELETE FROM departments WHERE id = ?';
        $this->db->query($sql, ['id' => $id]);   
    }
}