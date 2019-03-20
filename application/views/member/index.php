<!DOCTYPE html>
<html>
<head>
<title>社員情報閲覧</title>
</head>
<body>
<h1>社員ID<?php echo $_SESSION['member_id']; ?>情報画面</h1>
<a href="/objective/add">目標投稿</a><br>
<table  border="1" >
    <tr>
    <th>社員ID</th>
    <th>氏</th>
    <th>名</th>
    <th>氏（カナ)</th>
    <th>名（カナ）</th>
    <th>性別</th>
    <th>生年月日</th>
    <th>住所</th>
    <th>目標</th>
    <th>入社日</th>
    <th>部署名</th>
    <th>役職名</th>
    <th>緊急連絡先電話番号</th>
    <th>登録時間</th>
    <th>更新時間</th>
    </tr>
    <tr align="center">
    <td><a href = '/member/update'><?= $member->member_id ?></a></td>
    <td><?= $member->first_name ?></td>
    <td><?= $member->last_name ?></td>
    <td><?= $member->first_name_kana ?></td>
    <td><?= $member->last_name_kana ?></td>
    <td><?= $member->gender ?></td>
    <td><?= $member->birthday ?></td>
    <td><?= $member->home ?></td>
    <td><a href="/objective/index">目標</td>
    <td><?= $member->hire_date?></td>
    <td><?= $member->department_name ?></td>
    <td><?= $member->position_name ?></td>
    <td><?= $member->sos ?></td>
    <td><?= $member->created ?></td>
    <td><?= $member->modified ?></td>
    </tr>
</table>
<br>
<a href="/login/member_logout">社員ログアウト</a>
</body>
</html>
