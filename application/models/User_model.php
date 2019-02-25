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
        $data = ['email' => $email, 'password' => $password, 'name' => $name];
        $query = $this->db->insert('users', $data);
        $id = $this->db->insert_id();
        $this->db->where('id', $id);
        //createdカラムの値がまだ取得できてません
        $created =
        $hash = sha1($password.$created);
        $pass =['password'=>$hash];
        $this->db->update('users', $data);
    }
}