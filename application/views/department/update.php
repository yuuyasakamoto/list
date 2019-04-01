<!DOCTYPE html>
<head>
<title>部署情報更新</title>
</head>
<body>
<h1>部署名更新ページ</h1><br>
<?php echo form_open(); ?>
部署名:
<input type="text" name="name" value="<?php echo set_value('name', $name); ?>" ><br>
<?php echo form_error('name'); ?>
<input type="hidden" name="id" value='<?php echo set_value('id', $id);?>'>
<input type="submit" value="更新" >
</form>
<a href="/department/index">戻る</a>
</body>
</html>