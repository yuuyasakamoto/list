<!DOCTYPE html>
<html>
<head>
<title>ユーザー新規登録</title>
</head>
<body>
<h1>ユーザー新規登録</h1>
<form action="/user/add" method="post">  
メールアドレス
<input type="text" name="email" value="<?php echo set_value('email'); ?>"><br>
<?php echo form_error('email'); ?>
パスワード
<input type="text" name="password" value="<?php echo set_value('password'); ?>" ><br>
<?php echo form_error('password'); ?>
名前
<input type="text" name="name" value="<?php echo set_value('name'); ?>" ><br>
<?php echo form_error('name'); ?>
<input type="submit" value="登録" >
</form>  
</body>
</html>

 
