<?php
    session_start();
    require_once 'db_connect.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM post WHERE id = :id";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id', $id, PDO::PARAM_INT);
    $stm->execute();
    
    $result = $stm->fetch(PDO::FETCH_ASSOC);

    $release_y = "";
    $release_n = "";
    $postimg = [
        "アウトドア" => "",
        "DIY" => "",
        "ゲーム" => "",
        "イベント" => "",
        "マイホーム" => "",
        "おしゃれ" => "",
        "食" => "",
        "ショッピング" => "",
        "趣味" => "",
        "雑談" => "",
    ];

    if($result['releaseid'] === 0){
        $release_y= "checked";
    }elseif($result['releaseid'] === 1){
        $release_n = "checked";
    }

    if($result['imgid'] === "k-autodoa.jpeg"){
        $postimg['アウトドア'] = "selected";
    }
    if($result['imgid'] === "k-diy.jpg"){
        $postimg['DIY'] = "selected";
    }
    if($result['imgid'] === "k-game.png"){
        $postimg['ゲーム'] = "selected";
    }
    if($result['imgid'] === "k-ivennto.png"){
        $postimg['イベント'] = "selected";
    }
    if($result['imgid'] === "k-myhome.jpg"){
        $postimg['マイホーム'] = "selected";
    }
    if($result['imgid'] === "k-osyare.jpg"){
        $postimg['おしゃれ'] = "selected";
    }
    if($result['imgid'] === "k-syoku.jpg"){
        $postimg['食'] = "selected";
    }
    if($result['imgid'] === "k-syopping.jpg"){
        $postimg['ショッピング'] = "selected";
    }
    if($result['imgid'] === "k-syumi.png"){
        $postimg['趣味'] = "selected";
    }
    if($result['imgid'] === "k-zatudann.png"){
        $postimg['雑談'] = "selected";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/update-style.css">

    <SCRIPT LANGUAGE="JavaScript">
    // <!--
    var list_img = new Array();
    list_img[0] = new Array("img/k-autodoa.jpeg","アウトドア","k-autodoa.jpeg");
    list_img[1] = new Array("img/k-diy.jpg","DIY","k-diy.jpg");
    list_img[2] = new Array("img/k-game.png","ゲーム","k-game.png");
    list_img[3] = new Array("img/k-ivennto.png","イベント","k-ivennto.png");
    list_img[4] = new Array("img/k-myhome.jpg","マイホーム","k-myhome.jpg");
    list_img[5] = new Array("img/k-osyare.jpg","おしゃれ","k-osyare.jpg");
    list_img[6] = new Array("img/k-syoku.jpg","食","k-syoku.jpg");
    list_img[7] = new Array("img/k-syopping.jpg","ショッピング","k-syopping.jpg");
    list_img[8] = new Array("img/k-syumi.png","趣味","k-syumi.png");
    list_img[9] = new Array("img/k-zatudann.png","雑談","k-zatudann.png");
    function set_img(sel_val)
    {
    img_area.src = list_img[sel_val][0];
    }
    //-->
    </SCRIPT>

    <title>change</title>
</head>
<body>
<header class="changeheader">
    <ul>
        <p class="change-title">投稿変更ページ</p>
    </ul>
</header>
<div class="change-pan">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
  <li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem">
    <a itemprop="item" href="home.php">
        <span itemprop="name">ホーム</span>
    </a>
    <meta itemprop="position" content="1" />
  </li>

  <li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem">
    <a itemprop="item" href="mypage.php">
        <span itemprop="name">マイページ</span>
    </a>
    <meta itemprop="position" content="2" />
  </li>

  <li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem">
    <a itemprop="item" href="#">
        <span itemprop="name">投稿編集ページ</span>
    </a>
    <meta itemprop="position" content="3" />
  </li>
</ol>
</div>
<form action="update.php?id=<?php echo $id; ?>" method="post">
    <p>記事タイトル</p>
    <input type="text" name="name" value="<?php echo $result['postname'] ?>"><br>
    <p>内容</p>
    <textarea name="content"><?php echo $result['content'] ?></textarea><br>
    <p>記事画像</p>
    <select onchange="set_img(this.selectedIndex)"name="postimg">
        <SCRIPT language=javascript>
            for(nn=0;nn<list_img.length;nn++) {
                document.write("<option value=" + list_img[nn][2] + ">" + list_img[nn][1]);
            }
        </SCRIPT>
    </select>
    <br><br>
        <img name=img_area border=1 style="width: 500px; height: 200px; object-fit: cover;">
    <br><br>

    <label><input type="radio" name="releaseid" value="0" <?php echo $release_y; ?>>公開</label>
    <label><input type="radio" name="releaseid" value="1" <?php echo $release_n; ?>>非公開</label><br><br>
    <input type="submit" value="変更" name="botan"><br>
    <a href="mypage.php" name="a">戻る</a>
</form>
</body>
</html>