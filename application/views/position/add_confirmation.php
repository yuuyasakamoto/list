<!DOCTYPE html>
<head>
<title>役職名確認画面</title>
</head>
<body>
<h1>役職名確認画面</h1>
<?php echo form_open('/position/add_done'); ?>
<input type="hidden" name="name" value="<?php echo $name; ?>">
<p>新しい役職はこちらで宜しいでしょうか？</p>
<label>役職名</label>
<p><?php echo $name; ?></p>
<button type="submit" >登録する</button>
</form>
<br>
<a href="javascript:history.back()">内容を修正する</a>
</body>
</html>