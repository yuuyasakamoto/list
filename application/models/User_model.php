<?php


class User_model extends CI_Model{
    public function can_log_in($email, $password){
        //POSTされたemailとpasswordをDB情報と照合する
        $sql = 'SELECT * FROM users WHERE email = ? AND password = ?';
        $query = $this->db->query($sql, [$email, $password]);
        if ($query->num_rows()) {
            $_SESSION['login'] = true;
            redirect('/member/index');
        } else {
            redirect('/login/index');
        }
    }
}