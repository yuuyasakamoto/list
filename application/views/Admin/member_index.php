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
    <td><a href ='/admin/member_update?member_id=<?php echo $member->member_id ?>'><?php echo $member->member_id ?></a></td>
    <td><?php echo $member->first_name ?></td>
    <td><?php echo $member->last_name ?></td>
    <td><?php echo $member->first_name_kana ?></td>
    <td><?php echo $member->last_name_kana ?></td>
    <td><?php echo $member->gender ?></td>
    <td><?php echo $member->birthday ?></td>
    <td><?php echo $member->home ?></td>
    <td><a href="/comment/index?member_id=<?php echo $member->member_id ?>">目標</td>
    <td><?= $member->hire_date ?></td>
    <!-- 無効なデータの場合は空文字　-->
    <td><?php if($member->retirement_date=='0000-00-00'){echo '';} else { echo $member->retirement_date ;}?></td>
    <td><?php echo $member->department_name ?></td>
    <td><?php echo $member->position_name ?></td>
    <td><?php echo $member->sos ?></td>
    <td><a href='/admin/member_delete?member_id=<?php echo $member->member_id ?>' onclick="return confirm('本当に削除してもよろしいですか？');">削除</a></td>
    <td><?php echo $member->created ?></td>
    <td><?php echo $member->modified ?></td>
    </tr>
    <?php } ?> 
</table>
<a href="/admin/admin_index">管理者ページ</a>
</body>
</html>
