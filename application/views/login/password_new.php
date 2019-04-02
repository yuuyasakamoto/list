<!DOCTYPE html>
<html>
<head>
<title>パスワード再設定</title>
</head>
<body>
    <h1>パスワード再設定</h1>
    <p>恐れ入りますが、ご登録いただいたメールアドレスをご入力ください</p>
    <p>受信されたメールの案内に従ってパスワードの再設定をお願いいたします。</p>
    <strong>登録しているメールアドレス</strong><br>
<?php echo form_open(); ?>
<input type="text" size='40' name="email" value="<?php echo set_value('email'); ?>"><br>
<?php echo form_error('email'); ?>
<input type="submit" value="送信する" >
</form> 
<br>
</body>
</html>