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
     * idに紐づいたレコードを取得する
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
        //入力されたパスワードと緊急連絡先の値でハッシュ化しパスワード保存
        $hash = sha1($password . $sos);
        $this->db->query($sql, [$member_id, $first_name, $last_name, $first_name_kana,
                                $last_name_kana, $gender, $birthday, $home, $hire_date,
                                $department_id, $position_id, $email, $hash, $sos]);
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
        //編集したパスワードと緊急連絡先の値でハッシュ化しパスワード保存
        $hash = sha1($password . $sos);
        $this->db->query($sql, [ $first_name, $last_name, $first_name_kana,
                                $last_name_kana, $gender, $birthday, $home, $hire_date,
                                $department_id, $position_id, $email, $hash, $sos, $member_id]);
                        
    }
    /**
     * 社員IDに紐づいたレコードの削除
     * @param type $no
     */
    public function delete($member_id)
    {
        $sql = 'DELETE FROM members WHERE member_id = ?';
        $this->db->query($sql, ['member_id' => $member_id]);   
    }
    /**
     * 社員のメールアドレスとパスワードが一致すればログイン
     * @param type $email
     * @param type $password
     * @return boolean
     */
    public function canLogIn($email, $password)
    {
        //POSTされたemail情報をもとに緊急連絡先とハッシュ化したパスワードとmember_idを取り出す
        $data = $this->db->get_where('members', ['email' => $email]);
        $sos = $data->row('sos');
        $pass = $data->row('password');
        $member_id = $data->row('member_id');
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
        $data = $this->db->get_where('members', ['member_id' => $member_id]);
        $user_name = $data->row('first_name');
        return $user_name;
    }
}