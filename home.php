<?php
    require_once 'db_connect.php';

    $sql = "SELECT * FROM post WHERE deleteid=0";
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
    <link rel="stylesheet" href="node_modules/ress/ress.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/home-style.css">
    <title>Home</title>
</head>
<body>
    <header class="header homeheader">
        <?php if(isset($_SESSION['user'])){ ?>
        <ul class="homeul1">
            <li><a href="#">マイページ</a></li>
            <li><a href="#">ログアウト</a></li>
        </ul>
        <?php }else{ ?>
        <ul  class="homeul2">
            <li><a href="#">ログイン</a></li>
        </ul>
        <?php } ?>
    </header>

    <div class="wrapper">
    <?php
    foreach($result as $data){  
        echo <<<"EOD"
            <a href="delete.php?id={$data['id']}" class="posta">
            <div>
                <img class="" src="img/{$data['imgid']}" alt="記事写真" style="width: 100%; height: 200px;"></p>
                <p>{$data['postname']}</p>
            </div>
            </a>
        EOD;
            }
        ?>
    </div>

    <a href="#">
    <div class="homepost">
        <div class="homepura">＋</div>
        <div class="mask">
            <div class="caption">投稿する</div>
        </div>
    </div>
    </a>

</body>
</html>
