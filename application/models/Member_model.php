<?php

class Member_model extends CI_Model
{
    /**
     * 社員のログイン認証
     * @param type $email
     * @param type $password
     * @return boolean
     */
    public function memberCanLogIn(string $email, string $password)
    {
        //POSTされたemail情報をもとに緊急連絡先とハッシュ化したパスワードとmember_idを取り出す
        $sql = "SELECT * FROM members WHERE email=?";
        $query = $this->db->query($sql, ['email' => $email]);
        //もしメールアドレスが存在すればパスワードの確認
        if($query != NULL)
        {
            $member = $query->row();
            $sos = $member->sos;
            $pass = $member->password;
            //入力されたパスワードと緊急連絡先でハッシュ化した値と合致すれば社員IDを返す
            $hash = sha1($password . $sos);
            if ($pass == $hash) {
               return $member;
            //パスワード該当なしならfalse
            } else {
               return false;
            }
        //アドレス該当なしならfalse
        } else {
            return false;
        }
    }
    /**
     * 全社員データ取得
     */
    public function findMemberAll()
    {
        $query = $this->db->query('SELECT * FROM members ORDER BY id DESC');
        return $query->result();
    }
    /**
     * 社員の新規登録処理
     * @param type $first_name
     * @param type $last_name
     * @param type $birthday
     * @param type $home
     */
    public function memberInsert(int $member_id, string $first_name, string $last_name, string $first_name_kana,
                           string $last_name_kana, string $gender, string $birthday, string $home, string $hire_date,
                           int $department_id, int $position_id, string $email, string $password, string $sos)
    {
        $sql = "INSERT INTO members(member_id, first_name, last_name, first_name_kana,
                                    last_name_kana, gender, birthday, home, hire_date,
                                    department_id, position_id, email, password, sos)
                            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        //入力されたパスワードと緊急連絡先の値でハッシュ化しパスワード保存
        $hash = sha1($password . $sos);
        $this->db->query($sql, [$member_id, $first_name, $last_name, $first_name_kana,
                                $last_name_kana, $gender, $birthday, $home, $hire_date,
                                $department_id, $position_id, $email, $hash, $sos]);
    }
    /**
    *  管理者による社員の編集処理
     * @param type $first_name
     * @param type $last_name
     * @param type $birthday
     * @param type $home
     * @param type $no
     */
    public function adminUpdate(int $member_id, string $first_name, string $last_name, string $first_name_kana,
                           string $last_name_kana, string $gender, string $birthday, string $home, string $hire_date,
                           string $retirement_date, int $department_id, int $position_id, string $email, string $sos)
    {
        $sql = "UPDATE members SET first_name = ?, last_name = ?, first_name_kana =?,
                                   last_name_kana = ?, gender = ?, birthday = ?, home = ?, hire_date = ?,
                                   retirement_date = ?, department_id = ?, position_id = ?, email = ?, sos = ?,
                                   modified = now()
                                   WHERE member_id = ?";
        $this->db->query($sql, [ $first_name, $last_name, $first_name_kana,
                                $last_name_kana, $gender, $birthday, $home, $hire_date,
                                $retirement_date, $department_id, $position_id, $email, $sos, $member_id]);                     
    }
    /**
     * 社員IDに紐ずいたレコードの削除
     * @param type $member_id
     */
    public function delete(int $member_id)
    {
        $sql = 'DELETE FROM members WHERE member_id = ?';
        $this->db->query($sql, ['member_id' => $member_id]);   
    }
    /**
     * member_idに紐づいた社員レコードを取得する
     * @param type $no
     * @return type
     */
    public function select(int $member_id)
    {
        $sql = "SELECT * FROM members WHERE member_id=?";
        $query = $this->db->query($sql, ['member_id' => $member_id]);
        return $query->row();
    }
    /**
     * 社員情報取得
     * @return type
     */
    public function find(int $member_id)
    {
        $sql = "SELECT * FROM members WHERE member_id=?";
        $query = $this->db->query($sql, ['member_id' => $member_id]);
        return $query->row();
    }
    /**
    * 社員自身の編集処理
     * @param type $first_name
     * @param type $last_name
     * @param type $birthday
     * @param type $home
     * @param type $no
     */
    public function memberUpdate(int $member_id, string $first_name, string $last_name, string $first_name_kana,
                           string $last_name_kana, string $birthday, string $home, 
                           string $email, string $password, int $sos)
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