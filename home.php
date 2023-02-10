<?php
    require_once 'db_connect.php';

    $sql = "SELECT * FROM post";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home-style.css">
    <title>Home</title>
</head>
<body>
    <header class="header homeheader">
        <ul>
            <li><a href="#">マイページ</a></li>
            <li><a href="#">ログアウト</a></li>
        </ul>
    </header>
    
</body>
</html>