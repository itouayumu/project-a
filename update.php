<?php
    require_once 'db_connect.php';

    $id = $_GET['id'];
    $name = $_POST['name'];
    $content = $_POST['content'];
    $postimg = $_POST['postimg'];
    $releaseid = $_POST['releaseid'];

    $sql = "UPDATE post SET postname = :postname,content = :content,releaseid = :releaseid,imgid = :imgid WHERE id = :id";

    $stm = $pdo->prepare($sql);
    
    $stm->bindValue(':id', $id, PDO::PARAM_INT);
    $stm->bindValue(':postname', $name, PDO::PARAM_STR);
    $stm->bindValue(':content', $content, PDO::PARAM_INT);
    $stm->bindValue(':releaseid', $releaseid, PDO::PARAM_STR);
    $stm->bindValue(':imgid', $postimg, PDO::PARAM_STR);
    
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>編集しました</p>
    <a href="mypage.php">マイページへ戻る</a>
</body>
</html>