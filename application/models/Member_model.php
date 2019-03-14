<?php

    class Member_model extends CI_Model{
    /**
     * 社員情報取得
     * @return type
     */
    public function find($member_id)
    {
        $query = $this->db->query("SELECT * FROM members where member_id='$member_id'");
        return $query->row();
    }
    /**
    * membの編集処理
     * @param type $first_name
     * @param type $last_name
     * @param type $birthday
     * @param type $home
     * @param type $no
     */
    public function update($member_id, $first_name, $last_name, $first_name_kana,
                           $last_name_kana, $gender, $birthday, $home, 
                           $email, $password, $sos)
    {
        $sql = "UPDATE members SET first_name = ?, last_name = ?, first_name_kana =?,
                                   last_name_kana = ?, gender = ?, birthday = ?, home = ?, 
                                   email = ?, password = ?, sos = ?,
                                   modified = now()
                                   WHERE member_id = ?";
        //編集したパスワードと緊急連絡先の値でハッシュ化しパスワード保存
        $hash = sha1($password . $sos);
        $this->db->query($sql, [ $first_name, $last_name, $first_name_kana,
                                $last_name_kana, $gender, $birthday, $home, 
                                $email, $hash, $sos, $member_id]);                      
    }
}