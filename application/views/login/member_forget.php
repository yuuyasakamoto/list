<!DOCTYPE html>
<html>
<head>
<title>パスワード再設定</title>
</head>
<body>
<h1>パスワード再設定</h1>
<p>恐れ入りますが、ご登録いただいたメールアドレスをご入力ください</p>
<strong>登録しているメールアドレス</strong><br>
<?php echo form_open(); ?>
<input type="text" size='40' name="email" value="<?php echo set_value('email'); ?>"><br>
<?php echo form_error('email'); ?>
<input type="submit" value="送信する" >
</form> 
<br>
<a href="/login/member">戻る</a>
</body>
</html>