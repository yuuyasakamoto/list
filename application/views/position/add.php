<!DOCTYPE html>
<html>
<head>
<title>役職新規登録</title>
</head>
<body>
<h1>新役職登録</h1>
<p>役職名を入力してください</p>
<?php echo form_open(); ?>
<label>役職名</label>
<input type="text" name="name" value="<?php echo set_value('name'); ?>" ><br>
<?php echo form_error('name'); ?>
<input type="submit" value="登録" >
</form>
<a href="/position/index">戻る</a>
</body>
</html>
