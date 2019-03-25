<!DOCTYPE html>
<html>
<head>
<title>管理者一覧</title>
</head>
<body>
<h1>管理者一覧画面</h1>
<?php echo "管理者ID".$_SESSION['id']; ?>
<p style='color:blue;'>ログイン中</p>
<a href='/admin/admin_add'>管理者新規登録</a><br><br>
<table border="1">
<tr>
<th>ID</th>
<th>氏名</th>
<th>登録日時</th>
</tr>
<?php foreach($admins as $admin){ ?>
<tr align="center">
<td><?php echo $admin->id ?></td>
<td><?php echo $admin->name ?></td>
<td><?php echo $admin->created ?></td>
</tr>
<?php } ?>
</table>
<a href='/admin/member_index'>社員一覧画面へ</a><br>
<a href='/login/admin_logout'>管理者ログアウト</a>
</body>
</html>
