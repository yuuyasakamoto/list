<!DOCTYPE html>
<html>
<body>
<h1><?php echo $_GET["first_name"] ?>さん目標閲覧画面</h1>
<br>
<br>
<table border="1">
    <tr style="width:200px;">
    <th>社員名</th>
    <th>年度</th>
    <th>第何半期</th>
    <th>目標</th>
    <th>コメント</th>
    <th>登録日時</th>
    </tr>
    <?php foreach($objectives as $objective){ ?>
    <tr align="center">
    <td><?php echo $_GET["first_name"]  ?></td>
    <td><?= $objective->year ?>年</td>
    <td><?= $objective->quarter ?></td>
    <td><a href="#">内容</td>
    <td><a href="#">コメント</a></td>
    <td><?= $objective->created ?></td>
    </tr>
    <?php } ?>
</table>
<a href="/comment/logout">戻る</a>
</body>
</html>
