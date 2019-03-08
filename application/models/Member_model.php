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
    public function select($member_id)
    {
        $sql = "SELECT * FROM members WHERE member_id=?";
        $query = $this->db->query($sql, ['member_id' => $member_id]);
        return $query;
    }
    /**
     *  memberの新規登録処理
     * @param type $first_name
     * @param type $last_name
     * @param type $birthday
     * @param type $home
     */
    public function insert($member_id, $first_name, $last_name, $first_name_kana,
                           $last_name_kana, $gender, $birthday, $home, $hire_date,
                           $department_id, $position_id, $email, $password, $sos)
    {
        $sql = "INSERT INTO members(member_id, first_name, last_name, first_name_kana,
                                    last_name_kana, gender, birthday, home, hire_date,
                                    department_id, position_id, email, password, sos)
                            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $this->db->query($sql, [$member_id, $first_name, $last_name, $first_name_kana,
                                $last_name_kana, $gender, $birthday, $home, $hire_date,
                                $department_id, $position_id, $email, $password, $sos]);
    }
    
    /**
    * memberの編集処理
     * @param type $first_name
     * @param type $last_name
     * @param type $birthday
     * @param type $home
     * @param type $no
     */
    public function update($member_id, $first_name, $last_name, $first_name_kana,
                           $last_name_kana, $gender, $birthday, $home, $hire_date,
                           $department_id, $position_id, $email, $password, $sos)
    {
        $sql = "UPDATE members SET first_name = ?, last_name = ?, first_name_kana =?,
                                   last_name_kana = ?, gender = ?, birthday = ?, home = ?, hire_date = ?,
                                   department_id = ?, position_id = ?, email = ?, password = ?, sos = ?,
                                   modified = now()
                                   WHERE member_id = ?";
        
        $this->db->query($sql, [ $first_name, $last_name, $first_name_kana,
                                $last_name_kana, $gender, $birthday, $home, $hire_date,
                                $department_id, $position_id, $email, $password, $sos, $member_id]);
                        
    }
    /**
     * IDに紐づいたレコードの削除
     * @param type $no
     */
    public function delete($member_id)
    {
        $sql = 'DELETE FROM members WHERE member_id = ?';
        $this->db->query($sql, ['member_id' => $member_id]);   
    }
}