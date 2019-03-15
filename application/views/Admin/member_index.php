<!DOCTYPE html>
<html>
<head>
<title>社員一覧</title>
</head>
<body>
<h1>社員一覧画面</h1>
<!-- 管理者がログインしているログイン状態表示 -->
<?php echo "管理者ID".$_SESSION['id']; ?>
<p style='color:blue;'>管理者ログイン中</p>
<a href='/admin/member_add'>社員新規登録</a><br>
<br>
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
    <th>退職日</th>
    <th>部署名</th>
    <th>役職名</th>
    <th>緊急連絡先電話番号</th>
    <th>削除</th>
    <th>登録時間</th>
    <th>更新時間</th>
    </tr>
    <?php foreach($members as $member){ ?>
    <tr align="center">
    <td><a href ='/admin/member_update?member_id=<?= $member->member_id ?>'><?= $member->member_id ?></a></td>
    <td><?= $member->first_name ?></td>
    <td><?= $member->last_name ?></td>
    <td><?= $member->first_name_kana ?></td>
    <td><?= $member->last_name_kana ?></td>
    <td><?= $member->gender ?></td>
    <td><?= $member->birthday ?></td>
    <td><?= $member->home ?></td>
    <td><a href="/comment/index?member_id=<?= $member->member_id ?>&first_name=<?=$member->first_name ?>">目標</td>
    <td><?= $member->hire_date?></td>
    <td><?= $member->retirement_date ?></td>
    <td><?= $member->department_id ?></td>
    <td><?= $member->position_id ?></td>
    <td><?= $member->sos ?></td>
    <td><a href='/admin/member_delete?member_id=<?= $member->member_id ?>' onclick="return confirm('本当に削除してもよろしいですか？');">削除</a></td>
    <td><?= $member->created ?></td>
    <td><?= $member->modified ?></td>
    </tr>
    <?php } ?>
</table>
<a href="/admin/admin_index">管理者ページ</a>
</body>
</html>