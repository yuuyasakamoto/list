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
    <th>社員ID</th>
    <th>氏</th>
    <th>名</th>
    <th>氏（カナ)</th>
    <th>名（カナ）</th>
    <th>性別</th>
    <th>生年月日</th>
    <th>住所</th>
    <th>入社日</th>
    <th>退職日</th>
    <th>部署ID</th>
    <th>役職ID</th>
    <th>緊急連絡先</th>
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
<a href="/member/logout">ログアウト</a>
</body>
</html>
