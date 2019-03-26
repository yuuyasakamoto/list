<!DOCTYPE html>
<head>
<title>内容確認画面</title>
</head>
<body>
<h1>内容確認画面</h1>
<?php echo form_open('/admin/member_done'); ?>
<input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
<input type="hidden" name="first_name" value="<?php echo $first_name; ?>">
<input type="hidden" name="last_name" value="<?php echo $last_name; ?>">
<input type="hidden" name="first_name_kana" value="<?php echo $first_name_kana; ?>">
<input type="hidden" name="last_name_kana" value="<?php echo $last_name_kana; ?>">
<input type="hidden" name="gender" value="<?php echo $gender; ?>">
<input type="hidden" name="birthday" value="<?php echo $birthday; ?>">
<input type="hidden" name="home" value="<?php echo $home; ?>">
<input type="hidden" name="hire_date" value="<?php echo $hire_date; ?>">
<input type="hidden" name="department_id" value="<?php echo $department_id; ?>">
<input type="hidden" name="position_id" value="<?php echo $position_id; ?>">
<input type="hidden" name="email" value="<?php echo $email; ?>">
<input type="hidden" name="password" value="<?php echo $password; ?>">
<input type="hidden" name="sos" value="<?php echo $sos; ?>">

<p>登録内容はこちらで宜しいでしょうか？</p>
<label>社員ID</label>
<p><?php echo $member_id; ?></p>
<label>氏</label>
<p><?php echo $first_name; ?></p>
<label>名</label>
<p><?php echo $last_name; ?></p>
<label>氏（カタカナ）</label>
<p><?php echo $first_name_kana; ?></p>
<label>名（カタカナ）</label>
<p><?php echo $last_name_kana; ?></p>
<label>性別</label>
<p><?php echo $gender; ?></p>
<label>生年月日</label>
<p><?php echo $birthday; ?></p>
<label>住所</label>
<p><?php echo $home; ?></p>
<label>入社日</label>
<p><?php echo $hire_date; ?></p>
<label>部署名</label>
<p><?php echo $department_name; ?></p>
<label>役職名</label>
<p><?php echo $position_name; ?></p>
<label>メールアドレス</label>
<p><?php echo $email; ?></p>
<label>パスワード</label>
<p><?php echo $password; ?></p>
<label>緊急連絡先</label>
<p><?php echo $sos; ?></p>
<button type="submit" >登録する</button>
</form>
<br>
<a href="javascript:history.back()">内容を修正する</a>
</body>
</html>