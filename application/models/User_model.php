<?php


class User_model extends CI_Model{
    public function can_log_in($email, $password){
        //POSTされたemailとpasswordをDB情報と照合する
        $sql = 'SELECT * FROM users WHERE email = ? AND password = ?';
        $query = $this->db->query($sql, [$email, $password]);
        if ($query->num_rows()) {
            session_save_path('/vagrant/src/session');
            $this->load->library('session');
            $_SESSION['login'] = 'ログイン';
            redirect('/member/index');
        } else {
            redirect('/login/index');
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
        $hash = sha1($password.$created);
        $pass = ['password'=>$hash];
        //usersテーブルの取得したidをもとにパスワードをハッシュした値に更新して保存
        $this->db->update('users', $pass, "id = {$id}");
    }
}