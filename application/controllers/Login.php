<?php

class Login extends CI_Controller {
    /**
     * ログイン画面
     */
    public function index() 
    {
        $this->load->view('/member/login');
    }
    /**
     * Postされた値がusersテーブルの値と一致すればログイン
     */
    public function check()
    { 
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->User_model->can_log_in($email, $password);
        
    } 
}