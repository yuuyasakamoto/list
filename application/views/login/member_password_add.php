<!DOCTYPE html>
<html>
<head>
<title>パスワード再登録画面</title>
</head>
<body>
<h1>パスワード再登録</h1>
<p>情報を入力してください</p>
<?php echo form_open('/login/member_password_done'); ?>
<label>新パスワード</label>
<input type="password" name="password" value="<?php echo set_value('password'); ?>"><br>
<?php echo form_error('password'); ?>
<label>新パスワード（再入力）</label>
<input type="password" name="passconf" value="<?php echo set_value('passconf'); ?>" ><br>
<?php echo form_error('passconf'); ?>
<input type="hidden" name="id" value="<?php echo set_value('id', $id);?>">
<input type="hidden" name="created" value="<?php echo set_value('created', $created);?>">
<input type="submit" value="登録" >
</form>
</body>
</html>

