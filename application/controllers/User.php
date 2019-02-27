<?php

class User extends CI_Controller {
    /**
     * ユーザー一覧画面
     */        
    public function index(){
        $result = $this->User_model->findAll();
        $data = ['users' => $result];
        $this->load->view('/user/index', $data);
    }
    /**
     * ユーザー登録処理
     */
    public function add(){
        //空白もしくはemailがusersテーブルに被りがあるとバリデーションエラー
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_message('is_unique', '他のユーザーが使用しているメールアドレスです');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('name', '名前', 'required');
        //バリデーションエラーが無ければユーザー新規登録しログイン画面へ
        if ($this->form_validation->run() === TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $name = $this->input->post('name');
            //insertでパスワードをハッシュ化しDBに保存
            $this->User_model->insert($email, $password, $name); 
            redirect('/user/login');
        //リデーションエラーが有れば入力画面に戻る
        } else {
            $this->load->view('/user/add');
        }
        
    }
    /**
     * ログイン画面
     */
    public function login() 
    {
        //getパラメーターがついていればエラーメッセージ表示
        if (isset($_GET['error'])){
            echo "パスワードもしくはメールアドレスが違います";
        }
        //入力フォームが空欄かどうかのバリデーションチェック
        $this->load->library('form_validation');
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        //バリデーションエラーがなければログイン
        if ($this->form_validation->run() === TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->User_model->canLogIn($email, $password);
        //バリデーションエラーがあればもう一度ログイン認証画面
        } else {
             $this->load->view('/user/login');
        }
    } 
    
}