<!DOCTYPE html>
<head>
<title>内容確認画面</title>
</head>
<body>
<h1>内容確認画面</h1>
<?php echo form_open('/admin/admin_done'); ?>
<input type="hidden" name="email" value="<?php echo $email; ?>">
<input type="hidden" name="password" value="<?php echo $password; ?>">
<input type="hidden" name="name" value="<?php echo $name; ?>">
<p>登録内容はこちらで宜しいでしょうか？</p>
<label>メールアドレス</label>
<p><?php echo $email; ?></p>
<label>パスワード</label>
<p><?php echo $password; ?></p>
<label>お名前</label>
<p><?php echo $name; ?></p>
<button type="submit" >登録する</button>
</form>
<br>
<a href="javascript:history.back()">内容を修正する</a>
</body>
</html>