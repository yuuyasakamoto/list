<!DOCTYPE html>
<html>
<body>
<h1>コメント一覧画面</h1>
<br>
<a href='/comment/add'>新規登録</a>
<br>
<table>
    <tr>
    <th>ID</th>
    <th>タイトル</th>
    <th>投稿者</th>
    <th>コメント</th>
    <th>登録日時</th>
    <th>更新日時</th>
    </tr>
    <?php foreach($comments as $comment){ ?>
    <tr>
    <td><?= $comment->id ?></td>
    <td><?= $comment->title ?></a></td>
    <td><?= $comment->user_id ?></td>
    <td><?= $comment->comment ?></td>
    <td><?= $comment->created ?></td>
    <td><?= $comment->modified ?></td>
    </tr>
    <?php } ?>
</table>
</body>
</html>
