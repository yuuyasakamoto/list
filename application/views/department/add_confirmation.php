<!DOCTYPE html>
<head>
<title>部署名確認画面</title>
</head>
<body>
<h1>部署名確認画面</h1>
<?php echo form_open('/department/add_done'); ?>
<input type="hidden" name="name" value="<?php echo $name; ?>">
<p>新部署はこちらで宜しいでしょうか？</p>
<label>部署名</label>
<p><?php echo $name; ?></p>
<button type="submit" >登録する</button>
</form>
<br>
<a href="javascript:history.back()">内容を修正する</a>
</body>
</html>