<?php
    session_start();

    require_once 'db_connect.php';

    $postid = (int)$_GET['id'];
    $nownum = 0;

    $sql1 = "SELECT * FROM post WHERE id=:pid AND releaseid=0 AND deleteid=0";
    $stm1 = $pdo->prepare($sql1);
    $stm1->bindValue(':pid', $postid, PDO::PARAM_INT);
    $stm1->execute();
    $result1 = $stm1->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result1 as $data1) {
        $acid = $data1['acountid'];
        $content = nl2br($data1['content']);
    }

    if(isset($acid)){
        $sql2 = "SELECT * FROM account WHERE id=:acid";
        $stm2 = $pdo->prepare($sql2);
        $stm2->bindValue(':acid', $acid, PDO::PARAM_INT);
        $stm2->execute();
        $result2 = $stm2->fetchAll(PDO::FETCH_ASSOC);

        //仮の番号付ける
        $sql3 = "SELECT ROW_NUMBER() OVER(ORDER BY id ASC) num,id FROM post WHERE deleteid=0 and releaseid=0";
        $stm3 = $pdo->prepare($sql3);
        $stm3->execute();
        $result3 = $stm3->fetchAll(PDO::FETCH_ASSOC);


        //最後の行取得
        $sql5 = "SELECT COUNT(*) con FROM post WHERE deleteid=0 and releaseid=0";
        $stm5 = $pdo->prepare($sql5);
        $stm5->execute();
        $result5 = $stm5->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result5 as $data5) {
            $maxnum = $data5['con'];
        }

        //番号検索
        for($i = 0;$i < $maxnum;$i++){
            if($postid === $result3[$i]['id']){
                $nownum = $result3[$i]['num'];
            }
        }
        
        //前のページ
        if($nownum !== 1){
            $prevnum = $nownum - 1;
        }else{
            $prevnum = $maxnum;
        }

        //次のページ
        if($nownum !== $maxnum){
            $nextnum = $nownum + 1;
        }else{
            $nextnum = 1;
        }

        for($i = 0;$i < $maxnum;$i++){
            if($nextnum === $result3[$i]['num']){
                $nextid =$result3[$i]['id'];
            }
            if($prevnum === $result3[$i]['num']){
                $previd = $result3[$i]['id'];
            }
        }
    }else{
        $error = 1;
    }


    //コメント追加機能
    /*
    ・１このページに対してポストがあったかどうかを判定する
    ・２ポストがあったらsql文を組み立てる
      (コメントの内容とこの記事のIDをcommentというテーブルに挿入)
    ・３プリペイアドステートメントを作成し値をバインドしてsqlを実行。
    */ 
    if(isset($_POST["content"]) ){
        $sql = "insert into comment (postid,content) values (:postid, :content)";
        
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':postid',$postid,PDO::PARAM_INT);
        
        $stm->bindValue(':content',$_POST["content"],PDO::PARAM_STR);

        $stm->execute();
    }

        //コメント表示機能
        /*記事のIDを基にその記事に対してのコメントを全権取得する*/
    $sql= "select * from comment where postid = :postid";

    //プレースホルダーは建設予定ち（:keyword）
    $stm = $pdo->prepare($sql);
    //SQL文を今から使いますよ
    $stm->bindValue(':postid',$postid,PDO::PARAM_STR);
    //プレースホルダーに値を入れました
    $stm->execute();
    //SQLの実行
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    //結果
    
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/postdata-style.css">
    <title>PostData</title>
</head>
<body>
    <header class="header postheader">
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

    <?php if(isset($error)){ ?>
        <div>
            <p class="huseip">消去された記事、または非公開の記事です</p>
        </div>
    <?php }else{ ?>
        <div class="datapage">
            <div class="acstyle">
                <table style="width:100%;" class="actable">
                    <?php
                    
                        foreach($result2 as $data2){  
                            $pas="img/".$acid.$data2['cionid'];
                        echo <<<"EOD"
                                <td style="width:20%;"><img class="acimg" src=" $pas" alt="アイコン写真"></td>
                                <td style="width:80%;" class="acname">{$data2['name']}</td>
                        EOD;
                        }
                    ?>
                </table>
            </div>

            <div class="data">
                <?php
                    foreach($result1 as $data1){
                        $pas="img/".$data1['id'].$data1['imgid'];
                        if(isset($_SESSION['userid'])){
                            if($_SESSION['userid'] === $data1['acountid']){
                                echo <<<"EOD"
                                <div class="command">
                                    <a href="updateform.php?id={$data1['id']}">編集</a>
                                    <a href="delete.php?id={$data1['id']}">削除</a>
                                </div>
                                EOD;
                            }
                        }
                    echo <<<"EOD"
                            <p class="posttitle">{$data1['postname']}<hr></p>
                            <img class="kijiimg" src=" $pas" alt="記事写真">
                            <div class="databunstyle">
                                <p class="databun">$content</p>
                                <p class="date">{$data1['timestump']}</div>
                            </div>
                    EOD;
                    }
                ?>
            </div>
        </div>
        
        <div class="returnstyle">
            <a href="postdata.php?id=<?php echo $previd; ?>" class="migihidari">←</a>
            <a href="postdata.php?id=<?php echo $nextid; ?>" class="migihidari">→</a><br>
            <div class="returnsoto"><a href="home.php" class="return">戻る</a></div>
        </div>

    </div>

    <div class="comment">
        <h3>コメント</h3>
        <ul>
            <?php
            foreach($result as $reply){
               
                echo "<li>".nl2br(htmlspecialchars($reply["content"],ENT_QUOTES,"UTF-8"))."</li>";
                echo "<br>";
            }
                
            ?>
        </ul>
        <form action="postdata.php?id=<?php echo $postid; ?>" method="post">
            <p>内容<p><textarea name="content"class="com"></textarea><br>
        <input type="submit">
        </form>
    </div>

    <div class="returnstyle">
        <a href="postdata.php?id=<?php echo $previd; ?>" class="migihidari">←</a>
        <a href="postdata.php?id=<?php echo $nextid; ?>" class="migihidari">→</a><br>
        <div class="returnsoto"><a href="home.php" class="return">戻る</a></div>
    </div>

    <?php } ?>

</body>
</html>