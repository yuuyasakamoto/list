<!DOCTYPE html>
<html>
<head>
<title>管理者ログインページ</title>
</head>
<body>
<?php if (isset($_GET['admin_error'])):?>
<p style='color:red;'>管理者権限がありません</p>
<p style='color:red;'>ログインして下さい</p>
<?php endif; ?>
<?php if (isset($_GET['error'])):?>
<p style="color:red;">パスワードもしくはメールアドレスが違います</p>
<?php endif; ?>
<h1>管理者ログインページ</h1>
<?php if (isset($_GET['logout'])):?>
<p style='color:blue;'>管理者ログアウトしました。</p>
<?php endif; ?>
<?php echo form_open(); ?>
メールアドレス
<input type="text" name="email" value="<?php echo set_value('email'); ?>"><br>
<?php echo form_error('email'); ?>
パスワード
<input type="password" name="password" value="<?php echo set_value('password'); ?>"><br>
<?php echo form_error('password'); ?>
<input type="submit" value="ログイン" >
</form> 
<br>
</body>
</html>