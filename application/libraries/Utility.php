<?php

use PHPMailer\PHPMailer\PHPMailer;

Class Utility
{
    /**
     * パスワードのハッシュ化
     * @param type $password
     * @param type $created
     * @return type
     */
    public function hash(string $password, string $created)
    {
        $hash = sha1($password . $created);
        return $hash;
    }
    /**
     * メール送信機能
     * @param type $toname
     * @param type $fromname
     * @param type $subject
     * @param type $body
     */
    public function mail_send($to, $toname, $fromname, $subject, $body)
    {
        //Gmail 認証情報
        $useradd = 'y.sakamoto.actself@gmail.com'; // example@gmail.com
        $password = 'o|-!IJOM';
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
        //宛先
        $mail->addAddress($to, $toname."様");
        $mail->Subject = $subject;
        $mail->Body    = $body;
        //メール送信
        $mail->send();
    }
    /**
     * 制限時間機能
     * @return type
     */
    public function limit_time()
    {
        //制限時間変更の際はここを変更(今回は30分なので1800秒)
        $set_time = 1800;
        $now_time = time();
        $limit_time = $now_time - $set_time;
        return $limit_time;
    }
}