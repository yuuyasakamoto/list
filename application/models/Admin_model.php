<?php

class Admin_model extends CI_Model{
    /**
     * ユーザー情報の取得
     * @return type
     */
    public function findAll()
    {
        $query = $this->db->query('SELECT * FROM admins ORDER BY id DESC');
        return $query->result();
    }
    /**
     * emailとpasswordが合ってるかの確認
     * @param type $email
     * @param type $password
     */
    public function canLogIn($email, $password)
    {
        //POSTされたemail情報をもとにcreatedとpasswordを取り出す
        $data = $this->db->get_where('admins', ['email' => $email]);
        $created = $data->row('created');
        $pass = $data->row('password');
        //入力されたパスワードとcreatedでハッシュ化したパスワードを取得
        $hash = $this->hash($password, $created);
        //パスワードが一致すればtrueを返す
        if ($pass == $hash) {
            return true;
            //該当なしならfalseを返す
        } else {
            return false;
        }
    }

    /**
     * ユーザー登録（ソルト＋ハッシュ化）
     * @param type $email
     * @param type $password
     * @param type $name
     */ 
    public function insert($email, $password, $name)
    {
        //postされた値をuserテーブルに登録
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

}