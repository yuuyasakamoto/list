<!DOCTYPE html>
<html>
<body>
<h1>社員ID<?php echo $_GET["member_id"] ?>目標一覧画面</h1>
<br>
<table border="1">
    <tr>  
    <th>年度</th>
    <th>第何四半期</th>
    <th>目標</th>
    <th>コメント</th>
    <th>登録日時</th>
    </tr>
    <?php foreach($objectives as $objective){ ?>
    <tr align="center">
    <td><?= $objective->year ?>年</td>
    <td><?= $objective->quarter ?></td>
    <td><a href="/comment/contents?objective_id=<?= $objective->id ?>">内容</td>
    <td><a href="/comment/add?objective_id=<?= $objective->id ?>">コメント</a></td>
    <td><?= $objective->created ?></td>
    </tr>
    <?php } ?>
</table>
<a href="javascript:history.back()">戻る</a>
</body>
</html>
