<?php


class User_model extends CI_Model{
    public function can_log_in(){
        //POSTされたemailデータとDB情報を照合する
        $this->db->where("email", $this->input->post("email"));
        $this->db->where("password", ($this->input->post("password")));
        $query = $this->db->get("users");

        if ($query->num_rows() == 1){	//ユーザーが存在した場合の処理
            return true;
	} else {	//ユーザーが存在しなかった場合の処理
            return false;
        }
    }
}