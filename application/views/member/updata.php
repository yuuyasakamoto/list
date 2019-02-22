<html>
<head>
<title>社員情報更新</title>
</head>
<body>
<h1>社員情報更新</h1><br>
<form action="/member/updata" method="post">  
氏
<input type="text" name="first_name" value='<?php echo set_value('first_name', $data['first_name']); ?>'><br>
<?php echo form_error('first_name'); ?>
名
<input type="text" name="last_name" value='<?php echo set_value('last_name', $data['last_name']); ?>'><br>
<?php echo form_error('last_name'); ?>
生年月日
<input type="date" name="birthday" value='<?php echo set_value('birthday', $data['birthday']); ?>'><br>
<?php echo form_error('birthday'); ?>
出身地
<input type="text" name="home" value='<?php echo set_value('home', $data['home']); ?>'><br>
<?php echo form_error('home'); ?>
<input type="hidden" name="id" value='<?php echo $data['id']?>'>
<input type="submit" value="更新" >
</form>
</body>
</html>
