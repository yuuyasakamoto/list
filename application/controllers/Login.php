<?php

use PHPMailer\PHPMailer\PHPMailer;

class Login extends CI_Controller
{

    
    /**
     * 管理者ログイン画面
     */
    public function admin()
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
            $id = $this->Admin_model->adminCanLogIn($email, $password);
            //正しければログイン
            if (false != $id) {
                $_SESSION['admin'] = true;
                $_SESSION['id'] = $id;
                redirect('/admin/member_index');
            //正しくなければもう一度
            } else {
                redirect('/login/admin?error=true');
            }     
        } else {
            $this->load->view('/login/admin');
        }
    }
    /**
     * 社員ログイン画面
     */   
    public function member()
    {
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        //バリデーションエラーが無ければメールアドレスとパスワード確認
        if ($this->form_validation->run() === true) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            //canLogInメソッドでemailとpasswordが正しければ社員ID取得
            $member = $this->Member_model->memberCanLogIn($email, $password);
            //社員情報が取得されていればログイン
            if (false != $member) {
                $_SESSION['login'] = true;
                $_SESSION['member_id'] = $member->member_id;
                redirect('/member/index');
            //正しく無ければもう一度ログイン入力画面へ
            } else {
                redirect('/login/member?error=true');
            }   
        } else {
            $this->load->view('/login/member');
        }   
    }
    /**
     * 管理者ログアウト
     */
    public function admin_logout()
    {
        unset($_SESSION['admin']);
        unset($_SESSION['id']);
        redirect('/login/admin?logout=true');
    }
     /**
     * 社員ログアウト
     */
    public function member_logout()
    {
        unset($_SESSION['login']);
        unset($_SESSION['member_id']);
        redirect('/login/member?logout=true');
    }
     /**
     * パスワードリマインダー機能
     */
    public function password_new()
    {
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_message('valid_email', 'Emailの形式で記入してください');
        $this->form_validation->set_rules('email', 'メールアドレス', 'required|valid_email');
        if ($this->form_validation->run() === true) {
            $email = $this->input->post('email');
            $oneTimeToken = sha1(time());
            $time = date("Y/m/d H:i:s");
            $mail = new PHPMailer(true);

            //Gmail 認証情報
              $host = 'smtp.gmail.com';
              $username = 'y.sakamoto.actself@gmail.com'; // example@gmail.com
              $password = 'o|-!IJOM';

              //差出人
              $fromname = '社員管理';

              //宛先
              $to = 'ccnfxrx2@i.softbank.jp';
              $toname = 'test';

              //件名・本文
              $subject = 'test';
              $body = 'test';

              //メール設定
              $mail->SMTPDebug = 2; //デバッグ用
              $mail->isSMTP();
              $mail->SMTPAuth = true;
              $mail->Host = $host;
              $mail->Username = $username;
              $mail->Password = $password;
              $mail->SMTPSecure = 'tls';
              $mail->Port = 587;
              $mail->CharSet = "utf-8";
              $mail->Encoding = "base64";
              $mail->addAddress($to, $toname);
              $mail->Subject = $subject;
              $mail->Body    = $body;

              //メール送信
              $mail->send();
            
        
                   
            //$admin = $this->Admin_model->adminEmailCheck($oneTimeToken, $time, $email);
            exit;
            if ($admin) {
                echo 'ok';
                $this->load->view('/login/password_done');
            } else {
                $this->load->view('/login/password_done');
            }
        //バリデーションエラーが有ればアドレス入力画面に戻る
        } else {
            $this->load->view('/login/password_new');
        }
    }
}