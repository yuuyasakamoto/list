<html>
<head>
<title>情報更新</title>
</head>
<body>
<h1>社員ID<?php echo $_SESSION['member_id']; ?>情報更新ページ</h1><br>
<?php echo form_open(); ?>
氏:
<input type="text" name="first_name" value='<?php echo set_value('first_name', $member->first_name); ?>'><br>
<?php echo form_error('first_name'); ?>
名:
<input type="text" name="last_name" value='<?php echo set_value('last_name', $member->last_name); ?>'><br>
<?php echo form_error('last_name'); ?>
氏（カタカナ）:
<input type="text" name="first_name_kana" placeholder="カタカナで氏を入力下さい"  value="<?php echo set_value('first_name_kana', $member->first_name_kana); ?>" ><br>
<?php echo form_error('first_name_kana'); ?>
名（カタカナ）:
<input type="text" name="last_name_kana" placeholder="カタカナで名を入力下さい"  value="<?php echo set_value('last_name_kana', $member->last_name_kana); ?>" ><br>
<?php echo form_error('last_name_kana'); ?>
生年月日:
<input type="text" name="birthday" value="<?php echo set_value('birthday', $member->birthday); ?>" ><br>
<?php echo form_error('birthday'); ?>
住所:
<input type="text" name="home" value="<?php echo set_value('home', $member->home); ?>" ><br>
<?php echo form_error('home'); ?>
メールアドレス:
<input type="text" name="email" value="<?php echo set_value('email', $member->email); ?>" ><br>
<?php echo form_error('email'); ?>
緊急連絡先電話番号:
<input type="number" name="sos" value="<?php echo set_value('sos', $member->sos); ?>" ><br>
<?php echo form_error('sos'); ?>
<input type="submit" value="更新" >
</form>
<a href="/member/index">戻る</a>
</body>
</html>