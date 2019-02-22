<!DOCTYPE html>
<html>
<head>
<title>社員一覧</title>
</head>
<body>
<h1>社員一覧画面</h1>
<br>
<a href='/member/add'>新規登録</a>
<br>
<table>
    <tr>
    <th>ID</th>
    <th>氏名</th>
    <th>出身</th>
    <th>コメント</th>
    <th>削除</th>
    <th>登録日時</th>
    <th>更新日時</th>
    </tr>
    <?php foreach($members as $member){ ?>
    <tr>
    <td><?= $member->id ?></td>
    <td><a href = '/member/updata?id=<?= $member->id ?>'><?= $member->first_name ?></a></td>
    <td><?= $member->home ?></td>
    <td>コメント</td>
    <td><a href = '/member/delete?id=<?= $member->id ?>&name=<?= $member->first_name ?>' onclick="return confirm('本当に削除してもよろしいですか？');">削除</a></td>
    <td><?= $member->created ?></td>
    <td><?= $member->modified ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
