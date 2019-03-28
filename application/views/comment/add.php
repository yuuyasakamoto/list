<!DOCTYPE html>
<html>
<head>
<title>コメント登録</title>
</head>
<body>
<h1>コメント登録</h1>
<?php echo form_open("/comment/add?objective_id=$objective->id"); ?>
<textarea name="comment" rows="12" cols="50" maxlength="600" >コメント入力欄</textarea><br>
<?php echo form_error('comment'); ?>
<input type="hidden" name="objective_id" value="<?php echo set_value('objective_id', $objective->id);?>" >
<input type="submit" value="登録" >
</form>  
<a href="javascript:history.back()">戻る</a>
</body>
</html>

