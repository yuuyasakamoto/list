<!DOCTYPE html>
<html>
<head>
<title>役職一覧</title>
</head>
<body>
<h1>役職一覧画面</h1>
<!-- 管理者がログインしているログイン状態表示 -->
<?php echo "管理者ID".$_SESSION['id']; ?>
<p style='color:blue;'>管理者ログイン中</p>
<br>
<a href='/position/add'>役職追加</a>
<table  border="1"  width="100%">
    <tr>
    <th>ID</th>
    <th>役職名</th>
    <th>編集</th>
    <th>削除</th>
    <th>登録時間</th>
    <th>更新時間</th>
    </tr>
    <?php foreach($positions as $position){ ?>
    <tr align="center">
    <td><?php echo $position->id ?></td>
    <td><?php echo $position->position_name ?></td>
    <td><a href='/position/update?id=<?php echo $position->id ?>&name=<?php echo $position->position_name ?>'>編集</a></td>
    <td><a href='/position/delete?id=<?php echo $position->id ?>&name=<?php echo $position->position_name ?>' onclick="return confirm('本当に削除してもよろしいですか？');">削除</a></td>
    <td><?php echo $position->created ?></td>
    <td><?php echo $position->modified ?></td>
    </tr>
    <?php } ?> 
</table>
<a href="/admin/member_index">社員一覧ページ</a>
</body>
</html>
