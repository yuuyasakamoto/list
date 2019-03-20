<!DOCTYPE html>
<head>
<title>目標編集確認画面</title>
</head>
<body>
<h1>目標内容編集確認画面</h1>
<?php echo form_open('/objective/update_done'); ?>
<input type="hidden" name="year" value="<?php echo $year; ?>">
<input type="hidden" name="quarter" value="<?php echo $quarter; ?>">
<input type="hidden" name="objective" value="<?php echo $objective; ?>">
<input type="hidden" name="objective_id" value="<?php echo $objective_id; ?>">
 
<p>編集内容はこちらで宜しいでしょうか？</p>
<p><?php echo $year."年度"; ?></p>
<p><?php echo $quarter; ?></p>
<label>目標内容</label>
<p><?php echo $objective; ?></p>
<button type="submit" >編集する</button>
</form>
<br>
<a href="javascript:history.back()">内容を修正する</a>
</body>
</html>