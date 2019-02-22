<?php



class Member_model extends CI_Model{
    /**
     * membersテーブルの全データ取得
     */
    public function findAll()
    {
        $query = $this->db->query('SELECT * FROM members ORDER BY id DESC');
        return $query->result();
    }
    /**
     * idに紐づいたレコード行を取得する
     * @param type $no
     * @return type
     */
    public function select($no)
    {
        $sql = "SELECT * FROM members WHERE id=?";
        $query = $this->db->query($sql, ['id' => $no]);
        return $query;
    }
    /**
     *  memberの新規登録処理
     * @param type $first_name
     * @param type $last_name
     * @param type $birthday
     * @param type $home
     */
    public function insert($first_name, $last_name, $birthday, $home)
    {
        $sql = "INSERT INTO members(first_name, last_name, birthday, home)
                VALUES(?, ?, ?, ?)";
        $this->db->query($sql, [$first_name, $last_name, $birthday, $home]);
    }
    
    /**
    * memberの編集処理
     * @param type $first_name
     * @param type $last_name
     * @param type $birthday
     * @param type $home
     * @param type $no
     */
    public function updata($first_name, $last_name, $birthday, $home, $no)
    {
        $sql = "UPDATE members SET first_name = ?,
                                   last_name = ?,
                                   birthday = ?,
                                   home = ?,
                                   modified = now()
                                   WHERE id = ?";
        $this->db->query($sql, [$first_name, $last_name, $birthday, $home, $no]);
                        
    }
    /**
     * IDに紐づいたレコードの削除
     * @param type $no
     */
    public function delete($no)
    {
        $sql = 'DELETE FROM members WHERE id = ?';
        $this->db->query($sql, ['id' => $no]);   
    }
}