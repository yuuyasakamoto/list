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
住所:
<input type="text" name="home" value="<?php echo set_value('home'); ?>" ><br>
<?php echo form_error('home'); ?>
生年月日：<br>
<select name="year">
    <option value="">--</option>
    <?php foreach(range(1950, 2016) as $year): ?>
    <option value="<?php echo $year ?>-" <?php if(set_value('year') == $year){ print "selected";} ?>><?php echo $year ?></option>
    <?php endforeach; ?>
</select>
年
<select name="month">
    <option value="">--</option>
    <?php foreach(range(1, 12) as $month): ?>
    <option value="<?php echo str_pad($month, 2, 0, STR_PAD_LEFT)?>-" <?php if(set_value('month') == $month){ print "selected";} ?>><?php echo $month?></option>
    <?php endforeach; ?>
</select>
月
<select name="day">
    <option value="">--</option>
    <?php foreach(range(1, 31) as $day): ?>
    <option value="<?php echo str_pad($day, 2, 0, STR_PAD_LEFT)?>" <?php if(set_value('day') == $day){ print "selected";} ?>><?php echo $day?></option>
    <?php endforeach; ?>
</select>
日<br>
<?php echo form_error('year'); ?>
<?php echo form_error('month'); ?>
<?php echo form_error('day'); ?>
入社日：<br>
<select name="hire_year">
    <option value="">--</option>
    <?php foreach(range(1950, 2016) as $year): ?>
    <option value="<?php echo $year ?>-" <?php if(set_value('hire_year') == $year){ print "selected";} ?>><?php echo $year ?></option>
    <?php endforeach; ?>
</select>
年
<select name="hire_month">
    <option value="">--</option>
    <?php foreach(range(1, 12) as $month): ?>
    <option value="<?php echo str_pad($month, 2, 0, STR_PAD_LEFT)?>-" <?php if(set_value('hire_month') == $month){ print "selected";} ?>><?php echo $month?></option>
    <?php endforeach; ?>
</select>
月
<select name="hire_day">
    <option value="">--</option>
    <?php foreach(range(1, 31) as $day): ?>
    <option value="<?php echo str_pad($day, 2, 0, STR_PAD_LEFT)?>" <?php if(set_value('hire_day') == $day){ print "selected";} ?>><?php echo $day?></option>
    <?php endforeach; ?>
</select>
日<br>
<?php echo form_error('hire_year'); ?>
<?php echo form_error('hire_month'); ?>
<?php echo form_error('hire_day'); ?>
部署名:
<select name="department_id">
<option value="">選択して下さい</option>
<?php foreach($departments as $department): ?>
<option value="<?php echo $department->id ?>" <?php if(set_value('department_id') == $department->id){ print "selected";}?>><?php echo $department->department_name ?></option>
<?php endforeach ?>
</select>
<?php echo form_error('department_id'); ?>
<br>
役職名:
<select name="position_id">
<option value="">選択して下さい</option>
<?php foreach($positions as $position): ?>
<option value="<?php echo $position->id ?>" <?php if(set_value('position_id') == $position->id){ print "selected";}?>><?php echo $position->position_name ?></option>
<?php endforeach ?>
</select>
<?php echo form_error('position_id'); ?>
<br>
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

 
