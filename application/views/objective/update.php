<!DOCTYPE html>
<html>
<head>
<title>目標内容編集</title>
</head>
<body>
<h1>社員ID<?php echo $_SESSION['member_id']; ?>目標編集ページ</h1>
<?php echo form_open(); ?>
何年度：
<select name="year">
<?php for ($i=2000; $i<=2025; $i++) { ?>
<option value='<?php echo $i ?>' <?php if(set_value('year') == $i || $contents['year'] == $i ){ print "selected";}?> ><?php echo $i.'年' ?></option> 
<?php } ?>
</select><br>
四半期の選択
<input type="radio" name="quarter" value="第1四半期" <?php if(set_value('quarter') == "第1四半期" || $contents['quarter'] == "第1四半期"){ print "checked";}?>>第1四半期
<input type="radio" name="quarter" value="第2四半期" <?php if(set_value('quarter') == "第2四半期" || $contents['quarter'] == "第2四半期"){ print "checked";}?>>第2四半期
<input type="radio" name="quarter" value="第3四半期" <?php if(set_value('quarter') == "第3四半期" || $contents['quarter'] == "第3四半期"){ print "checked";}?>>第3四半期
<input type="radio" name="quarter" value="第4四半期" <?php if(set_value('quarter') == "第4四半期" || $contents['quarter'] == "第4四半期"){ print "checked";}?>>第4四半期<br>
<?php echo form_error('quarter'); ?>
目標投稿編集 :<br>
<textarea name="objective" rows="12" cols="50" maxlength="600" ><?php echo set_value('objective', $contents['objective']) ?></textarea><br>
<?php echo form_error('objective'); ?>
<input type="hidden" name="member_id" value='<?php echo set_value('member_id', $_SESSION['member_id']);?>'>
<input type="hidden" name="objective_id" value='<?php echo set_value('objective_id', $_GET['objective_id']);?>'>
<input type="submit" value="編集" >
</form>  
<a href="javascript:history.back()">戻る</a>
</body>
</html>
