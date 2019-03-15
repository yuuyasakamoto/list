<!DOCTYPE html>
<html>
<head>
<title>管理者新規登録</title>
</head>
<body>
<h1>管理者新規登録</h1>
<p>情報を入力してください</p>
<?php echo form_open(); ?>
<label>メールアドレス</label>
<input type="text" name="email" value="<?php echo set_value('email'); ?>"><br>
<?php echo form_error('email'); ?>
<label>パスワード</label>
<input type="text" name="password" value="<?php echo set_value('password'); ?>" ><br>
<?php echo form_error('password'); ?>
<label>お名前</label>
<input type="text" name="name" value="<?php echo set_value('name'); ?>" ><br>
<?php echo form_error('name'); ?>
<input type="submit" value="登録" >
</form>
<a href="/admin/admin_index">戻る</a>
</body>
</html>

 
