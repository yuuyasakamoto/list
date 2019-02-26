<?php

class User extends CI_Controller {
    /**
     * ユーザー新規登録画面
     */        
    public function index(){
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('name', '名前', 'required');
        if ($this->form_validation->run() == TRUE)
        {
            redirect('/user/add');
        }
        else
        {
            $this->load->view('/user/index');
        }
    }
    /**
     * ユーザー登録処理
     */
    public function add(){
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('name', '名前', 'required');
        if ($this->form_validation->run() === TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $name = $this->input->post('name');
            //insertでパスワードをハッシュ化しDBに保存
            $this->User_model->insert($email, $password, $name); 
            redirect('/user/login');
        } else {
            redirect('/user/index');
        }
        
    }
    /**
     * ログイン画面
     */
    public function login() 
    {
        $this->load->view('/user/login');
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