<!DOCTYPE html>
<html>
<head>
<title>社員新規登録</title>
</head>
<body>
<h1>社員情報登録</h1><br>
<?php echo form_open(); ?>
社員ID
<input type="text" name="member_id" value="<?php echo set_value('member_id'); ?>"><br>
氏
<input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>"><br>
<?php echo form_error('first_name'); ?>
名
<input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" ><br>
<?php echo form_error('last_name'); ?>
氏（カタカナ）
<input type="text" name="first_name_kana" placeholder="カタカナで入力下さい"  value="<?php echo set_value('first_name_kana'); ?>" ><br>
名（カタカナ）
<input type="text" name="last_name_kana" placeholder="カタカナで入力下さい"  value="<?php echo set_value('last_name_kana'); ?>" ><br>
性別
<input type="radio" name="gender" value="male" >男
<input type="radio" name="gender" value="female">女<br>
生年月日
<input type="text" name="birthday" value="<?php echo set_value('birthday'); ?>" ><br>
住所
<input type="text" name="home" value="<?php echo set_value('birthday'); ?>" ><br>
入社日
<input type="text" name="hire_date" value="<?php echo set_value('birthday'); ?>" ><br>
退職日
<input type="text" name="retirement_date" value="<?php echo set_value('birthday'); ?>" ><br>
部署ID
<input type="text" name="department_id" value="<?php echo set_value('birthday'); ?>" ><br>
役職ID
<input type="text" name="position_id" value="<?php echo set_value('birthday'); ?>" ><br>
メールアドレス
<input type="text" name="email" value="<?php echo set_value('birthday'); ?>" ><br>
パスワード
<input type="text" name="password" value="<?php echo set_value('birthday'); ?>" ><br>
緊急連絡先
<input type="text" name="sos" value="<?php echo set_value('birthday'); ?>" ><br>
<input type="submit" value="登録" >
</form>  
</body>
</html>

 
