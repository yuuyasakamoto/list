<?php

class Admin_model extends CI_Model
{
    
     /**
     * 管理者のログイン認証
     * @param type $email
     * @param type $password
     */
    public function adminCanLogIn(string $email, string $password)
    {
        //POSTされたemail情報をもとにcreatedとpasswordとidを取り出す
        $sql = "SELECT * FROM admins WHERE email=?";
        $query = $this->db->query($sql, ['email' => $email]);
        //メールアドレスが存在すればパスワード確認
        $admin = $query->row();
        if ($admin != NULL) {
            $created = $admin->created;
            $pass = $admin->password;
            $id = $admin->id;
            //入力されたパスワードとcreatedでハッシュ化したパスワードを取得
            $hash = $this->utility->hash($password, $created); 
            //パスワードが一致すれば管理者IDを返す
            if ($pass == $hash) {
                return $id;
            //パスワード該当なしならNULL
            } else {
                return false;
            }
        //アドレス該当なしならNULL
        } else {
            return false;
        }
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
     * 管理者登録
     * @param type $email
     * @param type $password
     * @param type $name
     */ 
    public function insert(string $email, string $password, string $name)
    {
        //postされた値をadminsテーブルに登録
        $data = ['email' => $email, 'password' => $password, 'name' => $name];
        $this->db->insert('admins', $data);
        //登録されたidをもとにレコードを取得しcreatedの値取得
        $id = $this->db->insert_id();
        $query = $this->db->query("SELECT created FROM admins WHERE id={$id}");
        $created = $query->row('created'); 
        //sha1関数でパスワードにcreatedの値(ソルト)を連結しハッシュ化
        $hash = $this->utility->hash($password, $created);
        $pass = ['password'=>$hash];
        //取得したidをもとにパスワードをハッシュした値に更新して保存
        $this->db->update('admins', $pass, "id = {$id}");
    }
    /**
     * 入力されたメールアドレスが存在するかチェックしワンタイムトークンと申請した時間を保存
     */
    public function emailCheck(string $email)
    {
        //入力されたemailでレコード検索
        $sql = "SELECT * FROM admins WHERE email=?";
        $query = $this->db->query($sql, [$email]);
        $admin = $query->row();
        //一致するデータがあればトークンと発行時間を保存し更新したデータを返す
        if ($admin) {
            //ワンタイムトークン
            $token = sha1(time());
            //トークン発行時間
            $time = time();
            $updatesql = "UPDATE admins SET token = ?, time = ? WHERE id = ?";
            $this->db->query($updatesql, [$token, $time, $admin->id]);
            $selectsql = "SELECT * FROM admins WHERE id=?";
            $query = $this->db->query($selectsql, [$admin->id]);
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
        $sql = "SELECT * FROM admins WHERE token=?";
        $query = $this->db->query($sql, [$token]);
        $admin = $query->row();
        if ($admin) {
            $limit_time = $this->utility->limit_time();
            if ($admin->time > $limit_time) {
                return $admin;
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
        $sql = "UPDATE admins SET token = ?, time = ?,password = ? WHERE id = ?";
        $this->db->query($sql, [null, null, $hash, $id]);
    }
}