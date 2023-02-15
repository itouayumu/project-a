<?php
 require_once 'db_connect.php';
 $d=$_POST["d"];
    $id=$_POST["id"];
    echo $d;
      $sql = "UPDATE post SET deleteid = 1  WHERE id = '" . $id . "'";
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      header("Location:mypage.php.php");
      exit();
  ?>