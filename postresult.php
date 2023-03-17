<?php
session_start();
$acountid = $_SESSION['userid'];
 require_once 'db_connect.php';

 $postname=$_POST["title"];
 $content=$_POST["content"];
 if(isset($_POST["Release"])){
    $releaseid=0;
 }else{
    $releaseid=1;
 }
 $filename = $_FILES['image']['name'];

$sql = "INSERT INTO post (acountid,postname,content,releaseid,imgpas) values (:acountid,:postname,:content,:releaseid,:imgpas)";
$stm = $pdo->prepare($sql);
$stm->bindValue(':acountid',$acountid , PDO::PARAM_INT);
$stm->bindValue(':postname',$postname , PDO::PARAM_STR);
$stm->bindValue(':content',$content , PDO::PARAM_STR);
$stm->bindValue(':releaseid',$releaseid , PDO::PARAM_INT);
$stm->bindValue(':imgpas',$filename , PDO::PARAM_INT);
      $stm->execute();
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);

      $postid = $pdo -> lastInsertId();
echo $postid;

 var_dump($_FILES);
 if(!empty($_FILES)){


 $uploaded_path = 'img/'.$postid.$filename;
 echo $uploaded_path;
 $result = move_uploaded_file($_FILES['image']['tmp_name'],$uploaded_path);
 }
 /*１記事をインサートする
    ２今インサートした記事のIDを取得
    ３取得したIDをファイル名につけてアップロード*/

    
        header("Location:home.php");
       exit(); 
  ?>