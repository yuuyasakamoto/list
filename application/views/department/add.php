<!DOCTYPE html>
<html>
<head>
<title>部署新規登録</title>
</head>
<body>
<h1>新部署登録</h1>
<p>部署名を入力してください</p>
<?php echo form_open(); ?>
<label>部署名</label>
<input type="text" name="name" value="<?php echo set_value('name'); ?>" ><br>
<?php echo form_error('name'); ?>
<input type="submit" value="登録" >
</form>
<a href="/department/index">戻る</a>
</body>
</html>

