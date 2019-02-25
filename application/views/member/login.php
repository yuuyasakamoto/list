<!DOCTYPE html>
<html>
<head>
<title>ログインページ</title>
</head>
<body>   
<h1>ログインページ</h1>
<form action="/login/check" method="post"> 
メールアドレス
<input type="text" name="email" ><br>
<?php echo form_error('email'); ?>
パスワード
<input type="password" name="password" ><br>
<?php echo form_error('password'); ?>
<input type="submit" value="ログイン" >
</form>  
</body>
</html>



