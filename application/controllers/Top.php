<?php

class Top extends CI_Controller {
    
    /**
     * 管理者ログイン画面
     */
    public function admin_login()
    {
         //入力フォームが空欄かどうかのバリデーションチェック
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        //バリデーションエラーがなければメールアドレスとパスワードチェック
        if ($this->form_validation->run() === true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            //canLogInメソッドでemailとpasswordが正しければidを返す
            $id = $this->Top_model->adminCanLogIn($email, $password);
            //正しければログイン
            if (isset($id)) {
                $_SESSION['admin'] = true;
                $_SESSION['id'] = $id;
                redirect('/admin/member_index');
            //正しく無ければもう一度
            } else {
                redirect('/top/admin_login?error=true');
            }     
        } else {
            $this->load->view('/top/admin_login');
        }
    }
    /**
     * 社員ログイン画面
     */   
    public function member_login()
    {
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        if ($this->form_validation->run() === true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            //canLogInメソッドでemailとpasswordが正しければtrue
            $member_id = $this->Top_model->memberCanLogIn($email, $password);
            $user_name = $this->Top_model->getUserName($member_id);
            //正しければログイン
            if (false != $member_id) {
                $_SESSION['login'] = true;
                $_SESSION['member_id'] = $member_id;
                $_SESSION['user_name'] = $user_name;
                redirect('/member/index');
            //正しく無ければもう一度
            } else {
                redirect('/top/member_login?error=true');
            }   
        } else {
        $this->load->view('/top/member_login');
        }   
    }
}