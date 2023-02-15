<?php
    session_start();
    require_once 'db_connect.php';
    $acid = $_SESSION['userid'];

    $sql1 = "SELECT * FROM account WHERE id=:acid";
    $stm1 = $pdo->prepare($sql1);
    $stm1->bindValue(':acid', $acid, PDO::PARAM_INT);
    $stm1->execute();
    $result1 = $stm1->fetchAll(PDO::FETCH_ASSOC);

    $sql2 = "SELECT * FROM post WHERE acountid=:acid and deleteid = 0";
    $stm2 = $pdo->prepare($sql2);
    $stm2->bindValue(':acid', $acid, PDO::PARAM_INT);
    $stm2->execute();
    $result2 = $stm2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mypage-style.css">
    <title>MyPage</title>
</head>
<body>
    <header class="header myheader">
        <ul class="mypul">
            <li><a href="home.php">トップへ</a></li>
            <li><a href="logout.php">ログアウト</a></li>
        </ul>
    </header>
    
    <div class="mypage">
        <div class="acstyle">
            <table style="width:100%;" class="actable">
            <?php
                foreach($result1 as $data1){  
            echo <<<"EOD"
                    <td style="width:20%;"><img class="acimg" src="img/{$data1['cionid']}" alt="アイコン写真" style="width: 200px; height: 200px;"></td>
                    <td style="width:80%;" class="acname">{$data1['name']}</td>
            EOD;
                }
            ?>
            </table>
        </div>

        <div class="poststyle">
            <table style="width:100%;" class="posttable">
                <?php
                    foreach($result2 as $data2){  
                echo <<<"EOD"

                    <tr>
                        <th colspan="2" class="posttitle">{$data2['postname']}<hr></th>
                    </tr>
                    <tr>
                        <td rowspan="2" style="width:50%;" class="postlink">
                            <a href="#">
                                <img class="" src="img/{$data2['imgid']}" alt="記事写真" style="width: 100%; height: 200px; object-fit: cover;">
                                <div class="mask">
                                    <div class="caption">詳細へ</div>
                                </div>
                            </a>
                        </td>
                        <td><a href="" class="botan">編集</a></td>
                    </tr>
                    <tr>
                        <td><a href="delete.php?id={$data2['id']}" class="botan">削除</a></td>
                    </tr>
                EOD;
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>