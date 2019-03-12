<!DOCTYPE html>
<html>
<head>
<title>コメント登録</title>
</head>
<body>
<h1>コメント登録</h1><br>
<?php echo form_open(); ?>
<?php echo $_GET["first_name"]."さんの".$_GET["year"]."年".$_GET["quarter"]."に対するコメント" ?><br>
<input type="text" name="comment" ><br>
<input type="hidden" name="admin_id" value="<?php echo set_value('admin_id', $_SESSION['id']);?>" >
<input type="hidden" name="objective_id" value="<?php echo set_value('objective_id', $_GET['objective_id']);?>" >
<input type="submit" value="登録" >
</form>  
<a href="javascript:history.back()">戻る</a></body>
</body>
</html>

