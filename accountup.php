<?php
    session_start();
    require_once 'db_connect.php';

    $acid = $_SESSION['userid'];
    $acname = $_POST['acname'];
    $filename = $_FILES['image']['name'];
  
    $sql = "UPDATE account SET name = :acname,cionid = :imgid WHERE id = :id";

    $stm = $pdo->prepare($sql);

    $stm->bindValue(':id', $acid, PDO::PARAM_INT);
    $stm->bindValue(':acname', $acname, PDO::PARAM_STR);
    $stm->bindValue(':imgid',  $filename, PDO::PARAM_STR);
    
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);

    
   
     if(!empty($_FILES)){
         $uploaded_path = 'img/'.$acid.$filename;
         $result = move_uploaded_file($_FILES['image']['tmp_name'],$uploaded_path);
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/update-style.css">
    <link rel="icon" href="img/favicon.ico">
    <title>update</title>
</head>
<body>
    <div class="update">
        <p>編集しました</p>
        <a href="mypage.php">マイページへ戻る</a>
    </div>
</body>
</html>