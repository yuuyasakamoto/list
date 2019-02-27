<?php

class User_model extends CI_Model{
    /**
     * ユーザー情報の取得
     * @return type
     */
    public function findAll()
    {
        $query = $this->db->query('SELECT * FROM users ORDER BY id DESC');
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
        $data = $this->db->get_where('users', ['email' => $email]);
        $created = $data->row('created');
        $pass = $data->row('password');
        //入力されたパスワードとcreatedでハッシュ化したパスワードを取得
        $hash = $this->hash($password, $created);
        //パスワードが一致すればログインしmember一覧へ
        if ($pass == $hash) {
            $_SESSION['login'] = true;
            redirect('/member/index');
            //該当なしならgetパラメーターをつけてもう一度ログイン認証画面へ
        } else {
            redirect('/user/login?error=true');
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
        $this->db->insert('users', $data);
        //登録されたidをもとにレコードを取得しcreatedの値取得
        $id = $this->db->insert_id();
        $query = $this->db->query("SELECT created FROM users WHERE id={$id}");
        $created = $query->row('created'); 
        //sha1関数でパスワードにcreatedの値(ソルト)を連結しハッシュ化
        $hash = $this->hash($password,$created);
        $pass = ['password'=>$hash];
        //usersテーブルの取得したidをもとにパスワードをハッシュした値に更新して保存
        $this->db->update('users', $pass, "id = {$id}");
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