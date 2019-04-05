<!DOCTYPE html>
<html>
<head>
<title>社員ログインページ</title>
</head>
<body>
<?php if (isset($_GET['member_error'])):?>
<p style='color:red;'>権限がありません</p>
<?php endif; ?>
<?php if (isset($_GET['error'])):?>
<p style='color:red;'>パスワードもしくはメールアドレスが違います</p>
<?php endif; ?>
<h1>社員ログインページ</h1>
<?php if (isset($_GET['logout'])):?>
<p style='color:blue;'>社員ログアウトしました。</p>
<?php endif; ?>
<?php if (isset($_GET['password'])):?>
<p style='color:blue;'>パスワードの変更が完了しました。</p>
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
<a href='/login/member_forget'>パスワードを忘れた方はこちら</a>
</body>
</html>
