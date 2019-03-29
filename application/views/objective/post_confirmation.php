<!DOCTYPE html>
<head>
<title>目標投稿確認画面</title>
</head>
<body>
<h1>目標投稿内容確認画面</h1>
<?php echo form_open('/objective/post_done'); ?>
<input type="hidden" name="year" value="<?php echo $year; ?>">
<input type="hidden" name="quarter" value="<?php echo $quarter; ?>">
<input type="hidden" name="objective" value="<?php echo $objective; ?>">
 
<p>投稿内容はこちらで宜しいでしょうか？</p>
<p><?php echo $year."年度"; ?></p>
<p><?php echo $quarter; ?></p>
<label>目標内容</label>
<p><?php echo $objective; ?></p>
<button type="submit" >投稿する</button>
</form>
<br>
<a href="/objective/add">内容を修正する</a>
</body>
</html>