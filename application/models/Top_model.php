<?php

class Top_model extends CI_Model{
     /**
     * 管理者のログイン認証
     * @param type $email
     * @param type $password
     */
    public function adminCanLogIn($email, $password)
    {
        //POSTされたemail情報をもとにcreatedとpasswordとidを取り出す
        $data = $this->db->get_where('admins', ['email' => $email]);
        $created = $data->row('created');
        $pass = $data->row('password');
        $id = $data->row('id');
        //入力されたパスワードとcreatedでハッシュ化したパスワードを取得
        $hash = $this->hash($password, $created);
        //パスワードが一致すれば管理者IDを返す
        if ($pass == $hash) {
            return $id;
            //該当なしならfalseを返す
        } else {
            return NULL;
        }
    }
    /**
     * 社員のログイン認証
     * @param type $email
     * @param type $password
     * @return boolean
     */
    public function memberCanLogIn($email, $password)
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