<?php
require_once 'db_connect.php';

session_start();

//これはフォームの内容がからじゃなかったらインサートする
if(empty($_POST["name"])){
    $error_flg = 1; 
    
}else if(empty($_POST["pw"])&&($_POST["pw"])!==($_POST["pw2"])){
    $error_flg = 1;
    

}else if(empty($_POST["mail"])){
    $error_flg = 1;
    

}else if(empty($_POST["icon"])){
    $error_flg = 1;
    
}else{
    
    //データベースの中に今から登録をする名前が存在するかどうか
    $sql = 'SELECT name FROM account WHERE name = :name';

    //データベースの中から入力されたあたいをけんんさくする
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':name',$_POST["name"],PDO::PARAM_STR);
    $stm->execute();
    //その結果存在していたらエラーをひょうじする
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    if($result !== false){
        $error_flg = 1;
    }else{
        //その結果が存在していなかったらインサートする
        
        $sql = "insert into account (name,mail,pw,cionid) values (:name, :mail, :pw, :cionid)";
        
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':name',$_POST["name"],PDO::PARAM_STR);
        $stm->bindValue(':mail',$_POST["mail"],PDO::PARAM_STR);
        $stm->bindValue(':pw',$_POST["pw"],PDO::PARAM_STR);
        $stm->bindValue(':cionid',$_POST["icon"],PDO::PARAM_STR);

        $stm->execute();
    }
}

if($error_flg != 1){
    header("Location:login.php");
}

    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/register.css">
    <SCRIPT LANGUAGE="JavaScript">
    // <!--
    var ac_img = new Array();
    ac_img[0] = new Array("img/ac1.png","アイコン１","ac1.png");
    ac_img[1] = new Array("img/ac2.png","アイコン２","ac2.png");
    ac_img[2] = new Array("img/ac3.jpeg","アイコン３","ac3.jpeg");
    ac_img[3] = new Array("img/ac4.jpg","アイコン４","ac4.jpg");
    ac_img[4] = new Array("img/ac5.png","アイコン５","ac5.png");
    ac_img[5] = new Array("img/ac6.jpg","アイコン６","ac6.jpg");
    ac_img[6] = new Array("img/ac7.jpg","アイコン７","ac7.jpg");
    function set_img(sel_val)
    {
    img_area.src = ac_img[sel_val][0];
    }
    //-->
    </SCRIPT>
    <title>Document</title>
</head>
<body>
    <!-- 特定ページのコンテンツをここに追加 -->
    
    
    <div id="register">
        <div class="contents flex-container">
            <a href="top.php" class="prev_button">←</a>
            <h2 class="register">新規登録</h2>
            <form action="register.php" method="post">
            <div class="register_form">
                <h3 class="name_box">ユーザー名<span class="Required">必須</span></h3>
                    <div class="name_box">
                        <input type="text" placeholder="例)お菓子　太郎" name="name" class="form">
                    </div>  
                <h3 class="mail_box">メールアドレス<span class="Required">必須</span></h3>
                <div class="mail_box">
                    <input type="text" placeholder="E-mail" name="mail" class="form">
                </div>
                <h3 class="pw_box">パスワード<span class="Required">必須</span></h3>
                <div class="pw_box">
                    <input type="password" placeholder="Password" name="pw" class="form">
                </div>
                <h3>パスワード(確認用)<span class="Required">必須</span></h3>
                <div class="pw2_box">
                    <input type="password" placeholder="Password" name="pw2" class="form">
                </div>
                <h3>アイコン<span class="Required">必須</span></h3>
                <select onchange="set_img(this.selectedIndex)" name="icon">
                    <SCRIPT language=javascript>
                    for(nn=0;nn<ac_img.length;nn++) {
                        document.write("<option value=" + ac_img[nn][2] + ">" + ac_img[nn][1]);
                    }
                    </SCRIPT>
                </select>
                <br><br>
                    <img name=img_area border=1 style="width:150px; height:	150px; object-fit: cover;">
                <br><br>
            </div>
        
            <div class="high_and_low">
                <label><input type="checkbox" name="Terms" value="Terms"><a href="#">利用規約</a>に同意します。</label>
                <label><input type="checkbox" name="privacy" value="privacy"><a href="#">プライバシーポリシー</a>に同意します。</label>
            </div>
        
            <button class="register-button">登録</button>
            <div class="transition_login">
                <label>アカウントをお持ちの方は<a href="login.php">コチラ</a></label>
            </div>
        </div>
        </form>
    </div>
    </div>
</div>
</body>
</html>