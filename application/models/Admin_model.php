<?php

class Admin_model extends CI_Model{
    
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
    public function memberInsert($member_id, $first_name, $last_name, $first_name_kana,
                           $last_name_kana, $gender, $birthday, $home, $hire_date,
                           $department_id, $position_id, $email, $password, $sos)
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
    * 社員の編集処理
     * @param type $first_name
     * @param type $last_name
     * @param type $birthday
     * @param type $home
     * @param type $no
     */
    public function update($member_id, $first_name, $last_name, $first_name_kana,
                           $last_name_kana, $gender, $birthday, $home, $hire_date,
                           $department_id, $position_id, $email, $sos)
    {
        $sql = "UPDATE members SET first_name = ?, last_name = ?, first_name_kana =?,
                                   last_name_kana = ?, gender = ?, birthday = ?, home = ?, hire_date = ?,
                                   department_id = ?, position_id = ?, email = ?, sos = ?,
                                   modified = now()
                                   WHERE member_id = ?";
        $this->db->query($sql, [ $first_name, $last_name, $first_name_kana,
                                $last_name_kana, $gender, $birthday, $home, $hire_date,
                                $department_id, $position_id, $email, $sos, $member_id]);
                        
    }
    /**
     * 社員IDに紐ずいたレコードの削除
     * @param type $member_id
     */
    public function delete($member_id)
    {
        $sql = 'DELETE FROM members WHERE member_id = ?';
        $this->db->query($sql, ['member_id' => $member_id]);   
    }
    /**
     * 全管理者データの取得
     * @return type
     */
    public function findAdminAll()
    {
        $query = $this->db->query('SELECT * FROM admins ORDER BY id DESC');
        return $query->result();
    }

    /**
     * 管理者登録（ソルト＋ハッシュ化）
     * @param type $email
     * @param type $password
     * @param type $name
     */ 
    public function insert($email, $password, $name)
    {
        //postされた値をadminsテーブルに登録
        $data = ['email' => $email, 'password' => $password, 'name' => $name];
        $this->db->insert('admins', $data);
        //登録されたidをもとにレコードを取得しcreatedの値取得
        $id = $this->db->insert_id();
        $query = $this->db->query("SELECT created FROM admins WHERE id={$id}");
        $created = $query->row('created'); 
        //sha1関数でパスワードにcreatedの値(ソルト)を連結しハッシュ化
        $hash = $this->hash($password,$created);
        $pass = ['password'=>$hash];
        //usersテーブルの取得したidをもとにパスワードをハッシュした値に更新して保存
        $this->db->update('admins', $pass, "id = {$id}");
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
     * member_idに紐づいた社員レコードを取得する
     * @param type $no
     * @return type
     */
    public function select($member_id)
    {
        $sql = "SELECT * FROM members WHERE member_id=?";
        $query = $this->db->query($sql, ['member_id' => $member_id]);
        return $query;
    }
}