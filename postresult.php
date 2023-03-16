<?php
session_start();
$acountid = $_SESSION['userid'];
 require_once 'db_connect.php';
 var_dump($_FILES);
 if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    // 画像を取得

} else {
    // 画像を保存
    if (!empty($_FILES['image']['name'])) {
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $content = file_get_contents($_FILES['image']['tmp_name']);
        $size = $_FILES['image']['size'];

        $sql = 'INSERT INTO images(image_name, image_type, image_content, image_size, created_at)
                VALUES (:image_name, :image_type, :image_content, :image_size, now())';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
        $stmt->execute();
    }
  
}

$sql = 'SELECT id FROM images WHERE image_name='".$name."';

$stm2 = $pdo->prepare($sql);
$stm2->bindValue(':id', $id, PDO::PARAM_INT);
$stm2->execute();
$result2 = $stm2->fetchAll(PDO::FETCH_ASSOC);

  $postname = $_POST["title"];
  $content = $_POST["content"];
  $releaseid = $_POST["Release"];


        $sql3 = "INSERT INTO post (id,acountid,postname,content,releaseid,timestump,imgid,deleteid) VALUES(default,'" .$acountid . "', '" .$postname . "', '" .$content . "','" .$releaseid . "',default,'" .$result2['imgid']. "',default)";
       $stm = $pdo->prepare($sql3);
       $stm->execute();
       $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      header("Location:home.php");
     exit(); 
  ?>