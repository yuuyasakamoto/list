<!DOCTYPE html>
<head>
<title>役職情報更新</title>
</head>
<body>
<h1>役職名更新ページ</h1><br>
<?php echo form_open(); ?>
役職名:
<input type="text" name="name" value="<?php echo set_value('name', $name); ?>" ><br>
<?php echo form_error('name'); ?>
<input type="hidden" name="id" value='<?php echo set_value('id', $id);?>'>
<input type="submit" value="更新" >
</form>
<a href="/position/index">戻る</a>
</body>
</html>