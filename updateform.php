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
  

    if($result['releaseid'] === 0){
        $release_y= "checked";
    }elseif($result['releaseid'] === 1){
        $release_y = "";
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
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
<form action="update.php?id=<?php echo $id; ?>" method="post"enctype="multipart/form-data">
    <p>記事タイトル</p>
    <input type="text" name="name" value="<?php echo $result['postname'] ?>"><br>
    <p>内容</p>
    <textarea name="content"><?php echo $result['content'] ?></textarea><br>
    <p>記事画像</p>
    <div id="app">
      <div class="preview_zone">
        <img :src="url" alt="ここにプレビューが表示されます">
      </div>
      <div class="upload_zone">
        <input type="file" class="input_file" ref="preview" @change="previewImage"name="image">  
      </div>
    </div>
      <div class="switchArea">
        <input type="checkbox" id="switch1" name="Release" value="0" checked>
        <label for="switch1"><span></span></label>
        <div id="swImg"></div>
      </div>
      
     <script>
       const app = new Vue({
           el: '#app',
           data: {
               url: '',
           },
           methods: {
               previewImage() {
                   let image = this.$refs.preview.files[0];
                   this.url = URL.createObjectURL(image);
               }
           }
       })
     </script>

    <input type="submit" value="変更" name="botan"><br>
    <a href="mypage.php" name="a">戻る</a>
</form>
</body>
</html>