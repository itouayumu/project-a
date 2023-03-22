<?php
   session_start();
   require_once ('db/connect.php');
    //エラーフラグが1だった場合はエラーを出す
    $error_flg = 0;
    if(isset($_POST)) {
        if (!empty($_POST["search"])) {
            $keyword="%".$_POST["search"]."%";
            //"."という記号は文字列と文字列を結合するという意味がある
            //"%"ワイルドカードは何でもという意味です。前後ほにゃほにゃ
            $_SESSION["search"]=$_POST["search"];
        } else {
            $error_flg = 1;
            $_SESSION["search"] ="";
        }

        if (isset($keyword)) {
            
            $Connect = new Connect("root","","php_demo","localhost:3308");
            $pdo = $Connect->get_select_user();
    $sql = "SELECT * FROM post WHERE postname LIKE :keyword and releaseid=0 and deleteid=0 ";
    //プレースホルダーは建設予定ち（:keyword）
    $stm = $pdo->prepare($sql);
    //SQL文を今から使いますよ
    $stm->bindValue(':keyword',$keyword,PDO::PARAM_STR);
    //プレースホルダーに値を入れました
    $stm->execute();
    //SQLの実行
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    //結果
        }
    }

    if(isset($_SESSION["search"])){
        $search_word=$_SESSION["search"];
    }else{
        $search_word="";
    }




    
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/article_search.css">
<title>search</title>

</head>
<body>

<h1 class="search">検索画面</h1>
	<h3 class="title">検索する記事の題名を入力してください</h3>
	    <form action="article_search.php" class="search-form-005" method="post">
        <div class="search_box">
            <label class="search_title" for="search">検索欄</label>
        <div>
            <input class="input" id="search" type="text" placeholder="キーワードを入力" name="search" value="<?php echo $search_word; ?>">
            <!--ForとIDで連携する文字を押したら入力表示になる-->
        <button type="submit" aria-label="検索"></button>
        </div>
        </div>

        </form>


       

   <?php
        if(isset($result) && !empty($result))
        //issetは中身があるかempyは中身がはいっているかどうか
        {

            echo"<ul>";
            foreach ($result as $value){
            echo "<li><a href= 'postdata.php?id={$value['id']}' class=\"postname\"]>".$value["postname"]."</a></li>";
              //ダブルコーテーションの中にダブルコーテーションはつかえないからばっくすらっしゅをつかう
              //
              } 
              echo"</ul>";
        }else{
            echo "<p class=\"caveat\">".'検索欄にワードを入れてください'."</p>";
        }
    
    
   ?>
</body>
</html>