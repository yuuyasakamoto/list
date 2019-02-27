<!DOCTYPE html>
<html>
<head>
<title>ユーザー一覧</title>
</head>
<body>
<h1>ユーザー一覧画面</h1>
<br>
<a href='/user/add'>ユーザー新規登録</a>
<br>
<table>
    <tr>
    <th>ID</th>
    <th>氏名</th>
    <th>登録日時</th>
    </tr>
    <?php foreach($users as $user){ ?>
    <tr>
    <td><?= $user->id ?></td>
    <td><?= $user->name ?></td>
    <td><?= $user->created ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
