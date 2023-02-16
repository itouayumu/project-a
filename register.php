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
                <select name="icon" >
                    <option value="">デフォルト</option>
                    <option value="ac1">アイコン１</option>
                    <option value="ac2">アイコン２</option>
                    <option value="ac3">アイコン３</option>
                    <option value="ac4">アイコン４</option>
                    <option value="ac5">アイコン５</option>
                    <option value="ac6">アイコン６</option>
                    <option value="ac7">アイコン７</option>
                </select>
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