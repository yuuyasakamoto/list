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
        $member = $query->row();
        if ($member != NULL) {
            $created = $member->created;
            $pass = $member->password;
            //入力されたパスワードと登録時間でハッシュ化した値と保存先のパスワードが合致すれば社員情報を返す
            $hash = $this->utility->hash($password, $created);
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
     * 社員IDに紐づいたレコードの取得
     * @param int $member_id
     * @return type
     */
    public function select($member_id)
    {
        $sql = "SELECT * FROM members WHERE member_id=?";
        $query = $this->db->query($sql, ['member_id' => $member_id]);
        return $query->row();
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
        //入力した値をmembersテーブルに保存
        $this->db->query($sql, [$member_id, $first_name, $last_name, $first_name_kana,
                                $last_name_kana, $gender, $birthday, $home, $hire_date,
                                $department_id, $position_id, $email, $password, $sos]);
        //登録した社員のIDを取得し登録時間と入力されたパスワードでハッシュ化
        $id = $this->db->insert_id();
        $query = $this->db->query("SELECT created FROM members WHERE id={$id}");
        $created = $query->row('created'); 
        $hash = $this->utility->hash($password, $created);
        $pass = ['password'=>$hash];
        //取得したidをもとにパスワードをハッシュ化した値に変更して保存
        $this->db->update('members', $pass, "id = {$id}");
    }
    /**
     * 社員の編集処理
     * @param int $member_id
     * @param string $first_name
     * @param string $last_name
     * @param string $first_name_kana
     * @param string $last_name_kana
     * @param string $birthday
     * @param string $home
     * @param string $email
     * @param int $sos
     * @param string $gender
     * @param string $hire_date
     * @param string $retirement_date
     * @param int $department_id
     * @param int $position_id
     */
    public function update(int $member_id, string $first_name, string $last_name, string $first_name_kana,
                           string $last_name_kana, string $birthday, string $home, string $email, string $sos,   
                           string $gender,string $hire_date, string $retirement_date = null, int $department_id, int $position_id)
    {
        
        $sql = "UPDATE members SET first_name = ?, last_name = ?, first_name_kana =?,
                               last_name_kana = ?, gender = ?, birthday = ?, home = ?, hire_date = ?,
                               retirement_date = ?, department_id = ?, position_id = ?, email = ?, sos = ?,
                               modified = now()
                               WHERE member_id = ?";
        $this->db->query($sql, [ $first_name, $last_name, $first_name_kana, $last_name_kana, $gender, $birthday, $home,
                            $hire_date, $retirement_date, $department_id, $position_id, $email, $sos, $member_id]);

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
     * 入力されたメールアドレスが存在するかチェックしワンタイムトークンと申請した時間を保存
     */
    public function emailCheck(string $email)
    {
        //入力されたemailでレコード検索
        $sql = "SELECT * FROM members WHERE email=?";
        $query = $this->db->query($sql, [$email]);
        $member = $query->row();
        //一致するデータがあればトークンと発行時間を保存し更新したデータを返す
        if ($member) {
            //ワンタイムトークン
            $token = sha1(time());
            //トークン発行時間
            $time = time();
            $updatesql = "UPDATE members SET token = ?, time = ? WHERE id = ?";
            $this->db->query($updatesql, [$token, $time, $member->id]);
            $selectsql = "SELECT * FROM members WHERE id=?";
            $query = $this->db->query($selectsql, [$member->id]);
            return $query->row();
        } else {
            //一致するデータが無ければFALSE
            return FALSE;
        }
    }
     /**
     * トークンのチェック機能
     * @param string $token
     * @return boolean
     */
    public function tokenCheck(string $token = null)
    {
        //トークンの値が一致するデータの検索
        $sql = "SELECT * FROM members WHERE token=?";
        $query = $this->db->query($sql, [$token]);
        $member = $query->row();
        if ($member) {
            $limit_time = $this->utility->limit_time();
            if ($member->time > $limit_time) {
                return $member;
            //30分以上経っていればFALSE
            } else {
                return false;
            }
        //トークンの値が一致しなければFALSE
        return false;
        }
    }
    /**
     * パスワード更新機能
     * @param string $id
     * @param string $password
     * @param string $created
     */
    public function password_update(string $id, string $password, string $created)
    {
        //パスワードをハッシュ化し保存（トークンと発行時間を削除）
        $hash = $this->utility->hash($password, $created);
        $sql = "UPDATE members SET token = ?, time = ?,password = ? WHERE id = ?";
        $this->db->query($sql, [null, null, $hash, $id]);
    }
}