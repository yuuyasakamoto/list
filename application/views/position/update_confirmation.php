<!DOCTYPE html>
<head>
<title>役職名変更確認画面</title>
</head>
<body>
<h1>役職名変更確認画面</h1>
<?php echo form_open('/position/update_done'); ?>
<input type="hidden" name="name" value="<?php echo $name; ?>">
<input type="hidden" name="id" value="<?php echo $id; ?>">
<p>役職名の変更はこちらで宜しいでしょうか？</p>
<label>役職名</label>
<p><?php echo $name; ?></p>
<button type="submit" >更新する</button>
</form>
<br>
<a href="javascript:history.back()">内容を修正する</a>
</body>
</html>