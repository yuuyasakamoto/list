<!DOCTYPE html>
<html>
<head>
<title>管理者一覧</title>
</head>
<body>
<h1>管理者一覧画面</h1>
<?php if (isset($_GET['error'])):?>
<p style='color:red;'>管理者権限がありません</p>
<p style='color:red;'>管理者としてログインして下さい</p>
<?php endif; ?>
<br>
<a href='/admin/add'>管理者新規登録</a>
<br>
<br>
<a href='/admin/login'>管理者ログインページへ</a>
<table border="1">
<tr>
<th>ID</th>
<th>氏名</th>
<th>登録日時</th>
</tr>
<?php foreach($admins as $admin){ ?>
<tr align="center">
<td><?= $admin->id ?></td>
<td><?= $admin->name ?></td>
<td><?= $admin->created ?></td>
</tr>
<?php } ?>
</table>
<a href='/member/index'>社員一覧画面へ</a>
</body>
</html>
