<?php

class Admin extends CI_Controller {
    /**
     * 管理者一覧画面
     */        
    public function index(){
        $result = $this->Admin_model->findAll();
        $data['admins'] = $result;       
        $this->load->view('/admin/index', $data);
    }
    /**
     * 管理者登録画面
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
            redirect('/admin/index');
        //リデーションエラーが有れば入力画面に戻る
        } else {
            $data['csrf_token_name'] = $this->security->get_csrf_token_name();
            $data['csrf_token_hash'] = $this->security->get_csrf_hash();
            $this->load->view('/admin/add', $data);
        }
        
    }
    /**
     * 管理者ログイン画面
     */
    public function login() 
    {
        //入力フォームが空欄かどうかのバリデーションチェック
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        //バリデーションエラーがなければログイン
        if ($this->form_validation->run() === true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            //canLogInメソッドでemailとpasswordが正しければidを返す
            $id = $this->Admin_model->canLogIn($email, $password);
            //正しければログイン
            if (isset($id)) {
                $_SESSION['admin'] = true;
                $_SESSION['id'] = $id;
                redirect('/member/index');
            //パスワードが違っていればgetパラメーターを付けてログイン画面へ
            } else {
                redirect('/admin/login?error=true');
            }     
            //バリデーションエラーがあればもう一度ログイン認証画面
        } else {
            $this->load->view('/admin/login');
        }
    }
    /**
     * 管理者ログアウト
     */
    public function logout()
    {
        unset($_SESSION['admin']);
        unset($_SESSION['id']);
        redirect('/member/index');
    }
}
    
