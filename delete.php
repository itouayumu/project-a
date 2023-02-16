<?php
    require_once 'db_connect.php';
    $id=$_GET['id'];
    $sql = "SELECT * FROM `post` WHERE id='" . $id . "'";
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
    <link rel="stylesheet" href="path/to/reset.css">
    <link rel="stylesheet" href="css/delete-style.css">
    <link rel="stylesheet" href="css/style.css">
    <title>delete</title>
</head>
<body>
  <div>
<header class="deleteheader">
        <ul>
           <p class="delete-title">投稿削除ページ</p>
           
        </ul>
    </header>
<div class="delete-pan">
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
        <span itemprop="name">消去確認ページ</span>
    </a>
    <meta itemprop="position" content="3" />
  </li>
</ol>
</div>
<div class="delete-contenta">
    <p class="delete-check" >この記事を本当に削除しますか？</p>
  
    <?php
    foreach($result as $data){
  echo <<<"EOD"
  

    <div class="delete-contentb">

    <p>{$data['postname']}</p>
    </div>
    <p class="delete-contentc">{$data['content']}</p>
    <img class="" src="img/{$data['imgid']}" alt="記事写真"</p>
EOD;
}
?>

</div>
<form action="deleteresult.php"method="POST">
			  		
			  			<input type="hidden" name="d" value="1">
              <input type="hidden" name="id" value="<?php $id=$_GET['id']; echo $id; ?>">

			  			<input type="submit" class="shakin1" value="確定">
			  		</form>	
            <a href="mypage.php" class="shakin2">キャンセル</a>
            <div>
</body>
</html>