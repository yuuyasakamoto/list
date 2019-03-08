<!DOCTYPE html>
<html>
<head>
<title>管理者一覧</title>
</head>
<body>
<h1>管理者一覧画面</h1>
<br>
<a href='/admin/add'>管理者新規登録</a>
<br>
<br>
<a href='/admin/login'>ログインページへ</a>
<table>
    <tr>
    <th>ID</th>
    <th>氏名</th>
    <th>登録日時</th>
    </tr>
    <?php foreach($admins as $admin){ ?>
    <tr>
    <td><?= $admin->id ?></td>
    <td><?= $admin->name ?></td>
    <td><?= $admin->created ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
