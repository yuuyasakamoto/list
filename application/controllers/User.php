<?php

class User extends CI_Controller {
    /**
     * ユーザー登録画面
     */
            
    public function index(){
        $this->load->view('/User/index');
    }
    /**
     * ユーザー登録処理
     */
    public function add(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $name = $this->input->post('name');
        $this->User_model->insert($email, $password, $name); 
    }
}