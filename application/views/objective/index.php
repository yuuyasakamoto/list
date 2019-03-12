<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>目標投稿ページ</title>
</head>
<body>
<h1><?php echo $_SESSION['user_name']; ?>さんの目標投稿ページ</h1>
<?php echo form_open(); ?>
何年度：
<select name="year">
<?php for ($i=2000; $i<=2025; $i++) { ?>
<option value='<?php echo $i ?>' <?php if(set_value('year') == $i){ print "selected";}?> ><?php echo $i.'年' ?></option> 
<?php } ?>
</select><br>
四半期の選択
<input type="radio" name="quarter" value="第1四半期" <?php if(set_value('quarter') == "第1四半期"){ print "checked";}?>>第1四半期
<input type="radio" name="quarter" value="第2四半期" <?php if(set_value('quarter') == "第2四半期"){ print "checked";}?>>第2四半期
<input type="radio" name="quarter" value="第3四半期" <?php if(set_value('quarter') == "第3四半期"){ print "checked";}?>>第3四半期
<input type="radio" name="quarter" value="第4四半期" <?php if(set_value('quarter') == "第4四半期"){ print "checked";}?>>第4四半期<br>
<?php echo form_error('quarter'); ?>
目標投稿（500文字程度）:<br>
<textarea name="objective" rows="12" cols="50" maxlength="600" ><?php echo set_value('objective'); ?></textarea><br>
<?php echo form_error('objective'); ?>
<input type="hidden" name="member_id" value='<?php echo set_value('member_id', $_SESSION['member_id']);?>'>
<input type="submit" value="投稿" >
</form>  
<a href="/member/logout">ログアウト</a>
</body>
</html>
