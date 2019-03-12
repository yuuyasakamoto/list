<!DOCTYPE html>
<html>
<body>
<h1><?php echo $_GET["first_name"] ?>さん目標閲覧画面</h1>
<br>
<table border="1">
    <tr>  
    <th>社員名</th>
    <th>年度</th>
    <th>第何四半期</th>
    <th>目標</th>
    <th>コメント</th>
    <th>登録日時</th>
    </tr>
    <?php foreach($objectives as $objective){ ?>
    <tr align="center">
    <td><?php echo $_GET["first_name"]  ?></td>
    <td><?= $objective->year ?>年</td>
    <td><?= $objective->quarter ?></td>
    <td><a href="/comment/contents?member_id=<?= $objective->member_id ?>&created=<?= $objective->created ?>">内容</td>
    <td><a href="/comment/add?year=<?= $objective->year ?>&quarter=<?= $objective->quarter ?>&first_name=<?=$_GET["first_name"] ?>&objective_id=<?= $objective->id ?>">コメント</a></td>
    <td><?= $objective->created ?></td>
    </tr>
    <?php } ?>
</table>
<a href="javascript:history.back()">戻る</a></body>
</body>
</html>
