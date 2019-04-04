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
            //登録済みのemailと一致すればトークンと発行時間を保存しメール送信（URLにワンタイムトークンをGET変数に記載）
            $admin = $this->Admin_model->emailCheck($email);
            if ($admin) {
                //Gmail 認証情報
                $useradd = 'y.sakamoto.actself@gmail.com'; // example@gmail.com
                $password = 'o|-!IJOM';
                //宛先
                //$to = $admin->email; 本来の宛先はユーザーのアドレス（今回はテスト実行のため宛先は自分のgmail）
                $toname = $admin->name; //登録者名
                //差出人
                $fromname = 'システム ';
                //件名・本文
                $subject = 'パスワード変更URLです';
                $body = "http://local.problem07.com/login/password_add?token={$admin->token}";
                //メール設定
                $mail = new PHPMailer(true);
                //$mail->SMTPDebug = 1; デバッグ用
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Host = 'smtp.gmail.com';
                $mail->From = $useradd;
                $mail->FromName = $fromname;
                $mail->Username = $useradd;
                $mail->Password = $password;
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
                $mail->CharSet = "utf-8";
                $mail->Encoding = "base64";
                //宛先(便宜上自分のgmail宛)
                $mail->addAddress("y.sakamoto.actself@gmail.com", $toname."様");
                $mail->Subject = $subject;
                $mail->Body    = $body;
                //メール送信
                $mail->send();
                //パスワード再設定送信完了画面を表示
                $this->load->view('/login/password_done');
            } else {
                //第三者にメールアドレスが登録してあるか特定されてしまうのを避けるため
                //エラーの際もメールアドレス送信完了ページを表示する
                $this->load->view('/login/password_done');
            }
        //バリデーションエラーが有ればアドレス入力画面に戻る
        } else {
            $this->load->view('/login/password_new');
        }
    }
     /**
     * トークンチェック機能
     */
    public function password_add()
    {
        //トークンの値が一致しトークンが発行されてから30分以内の場合パスワード再設定画面表示
        $token = $this->input->get('token');
        $admin = $this->Admin_model->tokenCheck($token);
        if ($admin) {
            $data['id'] = $admin->id;
            $data['created'] = $admin->created;
            $this->load->view('/login/password_add', $data);
        } else {
            //直接URLを叩かれた場合とトークン発行から30分経過した際はログイン画面に飛ばす
            redirect('/login/admin?admin_error=true');
        }
    }
    /**
     * パスワード再設定機能
     */
    public function password_done()
    {
        //バリデーションエラーが無ければパスワード更新しログイン画面へ
        $this->form_validation->set_message('required', '%s を入力してください。');
        $this->form_validation->set_message('matches', '新パスワードと再入力パスワードが一致しません。');
        $this->form_validation->set_rules('password', 'パスワード', 'required');
        $this->form_validation->set_rules('passconf', 'パスワード確認', 'required|matches[password]');
        if ($this->form_validation->run() === true) {
            $id = $this->input->post('id');
            $created = $this->input->post('created');
            $password = $this->input->post('password');
            $this->Admin_model->password_update($id, $password, $created);
            redirect('/login/admin?password=true');
            //バリデーションエラーの際もう一度入力画面へ
        } elseif ($this->input->post('id')) {
            $data['id'] = $this->input->post('id');
            $data['created'] = $this->input->post('created');
            $this->load->view('/login/password_add', $data);
            //直接URLを叩かれた場合ログイン画面に飛ばす
        } else {
            redirect('/login/admin?admin_error=true');
        }
    }
}