<!DOCTYPE html>
<html>
<head>
<title>社員新規登録</title>
</head>
<body>
<h1>社員情報登録</h1>
<p>社員情報を入力してください</p>
<?php echo form_open(); ?>
社員ID:
<input type="number" name="member_id" value="<?php echo set_value('member_id'); ?>"><br>
<?php echo form_error('member_id'); ?>
氏:
<input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>"><br>
<?php echo form_error('first_name'); ?>
名:
<input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" ><br>
<?php echo form_error('last_name'); ?>
氏（カタカナ）:
<input type="text" name="first_name_kana" placeholder="カタカナで氏を入力下さい"  value="<?php echo set_value('first_name_kana'); ?>" ><br>
<?php echo form_error('first_name_kana'); ?>
名（カタカナ）:
<input type="text" name="last_name_kana" placeholder="カタカナで名を入力下さい"  value="<?php echo set_value('last_name_kana'); ?>" ><br>
<?php echo form_error('last_name_kana'); ?>
性別:
<input type="radio" name="gender" value="男" <?php if(set_value('gender') == "男"){ print "checked";}?>>男
<input type="radio" name="gender" value="女" <?php if(set_value('gender') == "女"){ print "checked";}?>>女<br>
<?php echo form_error('gender'); ?>
生年月日:
<input type="text" name="birthday" value="<?php echo set_value('birthday'); ?>" ><br>
<?php echo form_error('birthday'); ?>
住所:
<input type="text" name="home" value="<?php echo set_value('home'); ?>" ><br>
<?php echo form_error('home'); ?>
入社日
<input type="text" name="hire_date" value="<?php echo set_value('hire_date'); ?>" ><br>
<?php echo form_error('hire_date'); ?>
部署ID:
<input type="number" name="department_id" value="<?php echo set_value('department_id'); ?>" ><br>
<?php echo form_error('department_id'); ?>
役職ID:
<input type="number" name="position_id" value="<?php echo set_value('position_id'); ?>" ><br>
<?php echo form_error('position_id'); ?>
メールアドレス:
<input type="text" name="email" value="<?php echo set_value('email'); ?>" ><br>
<?php echo form_error('email'); ?>
パスワード:
<input type="text" name="password" value="<?php echo set_value('password'); ?>" ><br>
<?php echo form_error('password'); ?>
緊急連絡先電話番号:
<input type="number" name="sos" value="<?php echo set_value('sos'); ?>" ><br>
<?php echo form_error('sos'); ?>
<input type="submit" value="登録" >
</form>  
<a href="/admin/member_index">戻る</a>
</body>
</html>

 
