<!DOCTYPE html>
<head>
<title>コメント確認画面</title>
</head>
<body>
<h1>コメント内容確認画面</h1>
<?php echo form_open('/comment/done'); ?>
<input type="hidden" name="comment" value="<?php echo $comment; ?>">
<input type="hidden" name="objective_id" value="<?php echo set_value('objective_id', $_POST["objective_id"]);?>" 
<p>コメント内容はこちらで宜しいでしょうか？</p>
<p><?php echo $comment; ?></p>
<button type="submit" >登録する</button>
</form>
<br>
<a href="javascript:history.back()">内容を修正する</a>
</body>
</html>