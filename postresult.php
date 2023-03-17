<?php
session_start();
$acountid = $_SESSION['userid'];
 require_once 'db_connect.php';
//  var_dump($_POST);
//  var_dump($_SESSION);
 $postname=$_POST["title"];
 $content=$_POST["content"];
 if(isset($_POST["Release"])){
    $releaseid=0;
 }else{
    $releaseid=1;
 }
 $imgid=$_POST["img"];





 switch ($imgid) {
    case "アウトドア":
        $imgid="k-autodoa.jpeg";
        break;
    case "DIY":
        $imgid="k-diy.jpg";
        break;
    case "ゲーム":
        $imgid="k-game.png";
        break;
    case "イベント":
        $imgid="k-ivennto.png";
        break;
    case "マイホーム":
        $imgid="k-myhome.jpg";
        break;
    case "おしゃれ":
        $imgid="k-osyare.jpg";
        break;
        case "食":
            $imgid="k-syoku.jpg";
            break;
            case "ショッピング":
                $imgid="k-syopping.jpg";
                break;
                case "趣味":
                    $imgid="k-syumi.png";
                    break;
                    case "雑談":
                        $imgid="k-zatudann.png";
                        break;
    }
      $sql = "INSERT INTO post (id,acountid,postname,content,releaseid,timestump,imgid,deleteid) VALUES(default,'" .$acountid . "', '" .$postname . "', '" .$content . "','" .$releaseid . "',default,'" .$imgid . "',default)";
      $stm = $pdo->prepare($sql);
      $stm->execute();
      $result = $stm->fetchAll(PDO::FETCH_ASSOC);
      header("Location:home.php");
      exit();
  ?>