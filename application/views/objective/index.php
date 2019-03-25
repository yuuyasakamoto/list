<!DOCTYPE html>
<html>
<body>
<h1>社員ID<?php echo $_SESSION["member_id"] ?>目標閲覧画面</h1>
<br>
<table border="1">
    <tr>  
    <th>年度</th>
    <th>第何四半期</th>
    <th>目標</th>
    <th>編集</th>
    <th>登録日時</th>
    <th>更新日時</th>
    </tr>
    <?php foreach($objectives as $objective){ ?>
    <tr align="center">
    <td><?php echo $objective->year ?>年</td>
    <td><?php echo $objective->quarter ?></td>
    <td><a href="/objective/contents?objective_id=<?php echo $objective->id ?>">内容</td>
    <td><a href="/objective/update?objective_id=<?php echo $objective->id ?>">編集</a></td>
    <td><?php echo $objective->created ?></td>
    <td><?php echo $objective->modified ?></td>
    </tr>
    <?php } ?>
</table>
<a href="/member/index">戻る</a></body>
</body>
</html>
