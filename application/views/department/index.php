<!DOCTYPE html>
<html>
<head>
<title>部署一覧</title>
</head>
<body>
<h1>部署一覧画面</h1>
<!-- 管理者がログインしているログイン状態表示 -->
<?php echo "管理者ID".$_SESSION['id']; ?>
<p style='color:blue;'>管理者ログイン中</p>
<br>
<a href='/department/add'>部署追加</a>
<table  border="1"  width="100%">
    <tr>
    <th>ID</th>
    <th>部署名</th>
    <th>編集</th>
    <th>削除</th>
    <th>登録時間</th>
    <th>更新時間</th>
    </tr>
    <?php foreach($departments as $department){ ?>
    <tr align="center">
    <td><?php echo $department->id ?></td>
    <td><?php echo $department->department_name ?></td>
    <td><a href='/department/update?id=<?php echo $department->id ?>&name=<?php echo $department->department_name ?>'>編集</a></td>
    <td><a href='/department/delete?id=<?php echo $department->id ?>&name=<?php echo $department->department_name ?>' onclick="return confirm('本当に削除してもよろしいですか？');">削除</a></td>
    <td><?php echo $department->created ?></td>
    <td><?php echo $department->modified ?></td>
    </tr>
    <?php } ?> 
</table>
<a href="/admin/member_index">社員一覧ページ</a>
</body>
</html>
