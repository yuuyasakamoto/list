<!DOCTYPE html>
<html>
<head>
<title>目標投稿ページ</title>
</head>
<body>
<h1>社員ID<?php echo $_SESSION['member_id']; ?>目標投稿ページ</h1>
<?php if (isset($objective)):?>
<p style='color:red;'><?php echo $year.'年の'.$quarter."は既に目標投稿済みです。"?></p>
<p style='color:red;'>編集</p>
<?php endif; ?>
<?php echo form_open('/objective/done'); ?>
目標投稿（500文字程度）:<br>
<textarea name="objective" rows="12" cols="50" maxlength="600" ><?php if(isset($objective)){echo $objective;} ?></textarea><br>
<?php echo form_error('objective'); ?>
<input type="hidden" name="year" value='<?php echo set_value('year', $_POST['year']);?>'>
<input type="hidden" name="quarter" value='<?php echo set_value('quarter', $_POST['quarter']);?>'>
<input type="submit" value="投稿" >
</form>
<a href="javascript:history.back()">戻る</a>
</body>
</html>
