<?php

class Admin extends CI_Controller {
    /**
     * ユーザー一覧画面
     */        
    public function index(){
        $result = $this->Admin_model->findAll();
        $data['admins'] = $result;       
        $this->load->view('/admin/index', $data);
    }
    /**
     * ユーザー登録処理
     */
    public function add(){
        //空白もしくはemailがusersテーブルに被りがあるとバリデーションエラー
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_message('is_unique', '他のユーザーが使用しているメールアドレスです');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|is_unique[admins.email]');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('name', '名前', 'required');
        //バリデーションエラーが無ければユーザー新規登録しログイン画面へ
        if ($this->form_validation->run() === true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $name = $this->input->post('name');
            //insertでパスワードをハッシュ化しDBに保存
            $this->Admin_model->insert($email, $password, $name); 
            redirect('/admin/login');
        //リデーションエラーが有れば入力画面に戻る
        } else {
            $data['csrf_token_name'] = $this->security->get_csrf_token_name();
            $data['csrf_token_hash'] = $this->security->get_csrf_hash();
            $this->load->view('/admin/add', $data);
        }
        
    }
    /**
     * ログイン画面
     */
    public function login() 
    {
        //getパラメーターがついていればエラーメッセージ表示
        //入力フォームが空欄かどうかのバリデーションチェック
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        //バリデーションエラーがなければログイン
        if ($this->form_validation->run() === true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            //canLogInメソッドでemailとpasswordが正しければtrue
            $login = $this->Admin_model->canLogIn($email, $password);
            //正しければログイン
            if ($login == true) {
                $_SESSION['login'] = true;
                redirect('/member/index');
            } else {
                redirect('/admin/login?error=true');
            }     
        //バリデーションエラーがあればもう一度ログイン認証画面
        } else {
            $this->load->view('/admin/login');
        }
              
    } 

}
    