<!DOCTYPE html>
<html>
<head>
<title>ログインページ</title>
</head>
<body>   
<h1>ログインページ</h1>
<form action="/login/check" method="post"> 
<?php echo validation_errors(); ?>
メールアドレス
<input type="text" name="email" ><br>
パスワード
<input type="text" name="password" ><br>
<input type="submit" value="ログイン" >
</form>  
</body>
</html>



