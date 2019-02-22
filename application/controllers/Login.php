<?php

class Login extends CI_Controller {
    /**
     * ログイン画面
     */
    public function index() 
    {
        $this->load->view('/login/index');
    }
    /**
     * Postされた値のバリデーションチェック
     */
    public function check()
    { 
        $this->load->library("form_validation");
        $this->form_validation->set_rules("email", "メール", "required|trim|xss_clean|callback_validate_credentials");	
	$this->form_validation->set_rules("password", "パスワード", "required|trim");
        //バリデーションエラーが無かった時
        if ($this->form_validation->run()) {	
        redirect('/member/index');
        //バリデーションエラーがあったとき
	} else {							
            $this->load->view("/login/index");
        }
    } 
    //Email情報がPOSTされたときに呼び出されるコールバック機能
    public function validate_credentials(){		
        //ユーザーがログインできたあとに実行する処理
	if ($this->User_model->can_log_in()){	
            return true;
        //ユーザーがログインできなかったときに実行する処理
	} else {					
            $this->form_validation->set_message("validate_credentials", "ユーザー名かパスワードが異なります。");
            return false;
	}
    }
}