<?php

class Member_model extends CI_Model
{
    /**
     * 社員のログイン認証
     * @param type $email
     * @param type $password
     * @return boolean
     */
    public function memberCanLogIn($email, $password)
    {
        //POSTされたemail情報をもとに緊急連絡先とハッシュ化したパスワードとmember_idを取り出す
        $sql = "SELECT * FROM members WHERE email=?";
        $member = $this->db->query($sql, ['email' => $email]);
        $sos = $member->row('sos');
        $pass = $member->row('password');
        $member_id = $member->row('member_id');
        //入力されたパスワードと緊急連絡先でハッシュ化した値と合致すれば社員IDを返す
        $hash = sha1($password . $sos);
        if ($pass == $hash) {
            return $member_id;
        //該当なしならfalseを返す
        } else {
            return false;
        }
    }
    /**
     * ログインする際ログインした社員の名前を取得する関数
     * @param type $member_id
     * @return type
     */
    public function getUserName($member_id)
    {
        $sql = "SELECT * FROM members WHERE member_id=?";
        $member = $this->db->query($sql, ['member_id' => $member_id]);
        $user_name = $member->row('first_name');
        return $user_name;
    }
    
    /**
     * パスワードのハッシュ化
     * @param type $password
     * @param type $created
     */       
    public function hash($password, $created)
    {
        $hash = sha1($password . $created);
        return $hash;
    }
    /**
     * 社員情報取得
     * @return type
     */
    public function find($member_id)
    {
        $sql = "SELECT * FROM members WHERE member_id=?";
        $query = $this->db->query($sql, ['member_id' => $member_id]);
        return $query->row();
    }
    /**
    * 社員の編集処理
     * @param type $first_name
     * @param type $last_name
     * @param type $birthday
     * @param type $home
     * @param type $no
     */
    public function update($member_id, $first_name, $last_name, $first_name_kana,
                           $last_name_kana, $birthday, $home, 
                           $email, $password, $sos)
    {
        $sql = "UPDATE members SET first_name = ?, last_name = ?, first_name_kana =?,
                                   last_name_kana = ?, birthday = ?, home = ?, 
                                   email = ?, password = ?, sos = ?,
                                   modified = now()
                                   WHERE member_id = ?";
        //編集したパスワードと緊急連絡先の値でハッシュ化しパスワード保存
        $hash = sha1($password . $sos);
        $this->db->query($sql, [ $first_name, $last_name, $first_name_kana,
                                $last_name_kana, $birthday, $home, 
                                $email, $hash, $sos, $member_id]);                      
    }
}