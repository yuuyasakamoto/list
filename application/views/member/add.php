<!DOCTYPE html>
<html>
<head>
<title>社員新規登録</title>
</head>
<body>
<h1>社員情報登録</h1><br>
<?php echo form_open(); ?>
氏
<input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>"><br>
<?php echo form_error('first_name'); ?>
名
<input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" ><br>
<?php echo form_error('last_name'); ?>
生年月日
<input type="text" name="birthday" value="<?php echo set_value('birthday'); ?>" ><br>
<?php echo form_error('birthday'); ?>
出身地
<input type="text" name="home" value="<?php echo set_value('home'); ?>" ><br>
<?php echo form_error('home'); ?>
<input type="submit" value="登録" >
</form>  
</body>
</html>

 
