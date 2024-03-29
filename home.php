<?php
    session_start();

    require_once 'db_connect.php';


    $sql = "SELECT * FROM post WHERE deleteid=0 and releaseid=:selectid";

    $stm = $pdo->prepare($sql);
    $stm->bindValue(':selectid', 0, PDO::PARAM_INT);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="node_modules/ress/ress.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home-style.css">
    <link rel="icon" href="img/favicon.ico">
    <title>Home</title>
</head>
<body>
    <header class="header homeheader">
        <?php if(empty($_SESSION)){ ?>
            <ul  class="homeul2">
                <li><a href="login.php">ログイン</a></li>
            </ul>
        <?php }else{ ?>
            <ul class="homeul1">
                <li><a href="mypage.php">マイページ</a></li>
                <li><a href="logout.php">ログアウト</a></li>
            </ul>
        <?php } ?>
    </header>

    <div class="wrapper">
    <?php

    foreach($result as $data){  
        $pas="img/".$data['id'].$data['imgid'];
        echo <<<"EOD"
            <a href="postdata.php?id={$data['id']}" class="posta">
            <div>
                <img class="postimg" src="$pas" alt="記事写真"></p>
                
                <!-- <img class="postimg" src="$pas" alt="記事写真"style="width: 100%; height: 200px;"></p> -->
                <!-- <img class="postimg" src="img/{$data['imgid']}" alt="記事写真"></p> -->
                <p>{$data['postname']}</p>
            </div>
            </a>
        EOD;
            }
        ?>
    </div>
    <?php if(empty($_SESSION)){ ?>
        <?php }else{ ?>
    <a href="post.php">
    <div class="homepost">
        <div class="homepura">＋</div>
        <div class="mask">
            <div class="caption">投稿する</div>
        </div>
    </div>
    </a>
    <?php } ?>
  
</body>
</html>
