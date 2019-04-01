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
    /**
     * 新役職登録機能
     * @param string $name
     */
    public function insert(string $name)
    {
        $sql = "INSERT INTO positions (position_name) VALUES(?)";
        //入力した値をpositionsテーブルに保存
        $this->db->query($sql, [$name]);
    }
    /**
     * 役職名更新機能
     * @param string $id
     * @param string $name
     */
    public function update(string $id, string $name)

    {
        $sql = "UPDATE positions SET position_name =?,
                               modified = now()
                               WHERE id = ?";
        $this->db->query($sql, [$name, $id]);  
    }
    /**
     * 役職削除機能
     * @param string $id
     */
    public function delete(string $id)
    {
        $sql = 'DELETE FROM positions WHERE id = ?';
        $this->db->query($sql, ['id' => $id]);   
    }
}