<!DOCTYPE html>
<head>
<title>社員編集確認画面</title>
</head>
<body>
<h1>社員編集内容確認画面</h1>
<?php echo form_open('/member/done'); ?>
<input type="hidden" name="first_name" value="<?php echo $first_name; ?>">
<input type="hidden" name="last_name" value="<?php echo $last_name; ?>">
<input type="hidden" name="first_name_kana" value="<?php echo $first_name_kana; ?>">
<input type="hidden" name="last_name_kana" value="<?php echo $last_name_kana; ?>">
<input type="hidden" name="birthday" value="<?php echo $birthday; ?>">
<input type="hidden" name="home" value="<?php echo $home; ?>">
<input type="hidden" name="email" value="<?php echo $email; ?>">
<input type="hidden" name="sos" value="<?php echo $sos; ?>">
 
<p>編集内容はこちらで宜しいでしょうか？</p>
<label>氏</label>
<p><?php echo $first_name; ?></p>
<label>名</label>
<p><?php echo $last_name; ?></p>
<label>氏（カタカナ）</label>
<p><?php echo $first_name_kana; ?></p>
<label>名（カタカナ）</label>
<p><?php echo $last_name_kana; ?></p>
<label>生年月日</label>
<p><?php echo $birthday; ?></p>
<label>住所</label>
<p><?php echo $home; ?></p>
<label>メールアドレス</label>
<p><?php echo $email; ?></p>
<label>緊急連絡先</label>
<p><?php echo $sos; ?></p>
<button type="submit" >編集する</button>
</form>
<br>
<a href="javascript:history.back()">内容を修正する</a>
</body>
</html>