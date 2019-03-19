<?php

class Admin_model extends CI_Model
{
    
     /**
     * 管理者のログイン認証
     * @param type $email
     * @param type $password
     */
    public function adminCanLogIn($email, $password)
    {
        //POSTされたemail情報をもとにcreatedとpasswordとidを取り出す
        $sql = "SELECT * FROM admins WHERE email=?";
        $query = $this->db->query($sql, ['email' => $email]);
        //メールアドレスが存在すればパスワード確認
        if($query != NULL)
        {
            $admin = $query->row();
            $created = $admin->created;
            $pass = $admin->password;
            $id = $admin->id;
            //入力されたパスワードとcreatedでハッシュ化したパスワードを取得
            $hash = $this->hash($password, $created);
            //パスワードが一致すれば管理者IDを返す
            if ($pass == $hash) 
            {
                return $id;
            //パスワード該当なしならNULL
            } else {
                return NULL;
            }
        //アドレス該当なしならNULL
        } else {
            return NULL;
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
}