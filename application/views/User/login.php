<!DOCTYPE html>
<html>
<head>
<title>ユーザーログインページ</title>
</head>
<body>   
<h1>ユーザーログインページ</h1>
<form action="/user/login" method="post"> 
メールアドレス
<input type="text" name="email" value="<?php echo set_value('email'); ?>"><br>
<?php echo form_error('email'); ?>
パスワード
<input type="password" name="password" value="<?php echo set_value('password'); ?>"><br>
<?php echo form_error('password'); ?>
<input type="submit" value="ログイン" >
</form> 
<a href="/user/index">戻る</a>
</body>
</html>



