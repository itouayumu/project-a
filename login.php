<?php
session_start();
require_once ('db/connect.php');
//エラーフラグが1だった場合はエラーを出す
$error_flg = 0;
if(isset($_POST) && !empty($_POST)) {
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        $error_flg = 1;
    }
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    }else{
        $error_flg = 1;
    }

    if (isset($username) && isset($password)) {
        
        $Connect = new Connect("root","","php_demo","localhost:3308");
        $pdo = $Connect->get_select_user();
        $sql = "select * from account where name = :username";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':username',$username,PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        if($result !== false){
            if($password === $result["pw"]){
                //セッションにユーザー名を入れる         
                
                // キー'count'が登録されていなければ、1を設定
                $_SESSION['username'] = $username;
                //セッションにユーザーidを入れる
                $_SESSION['userid'] = $result['id'];

                //home.phpにリダイレクトする1
                header("Location:home.php");
                exit();
                
            }else{
                $error_flg = 1;
            }
        }else{
            $error_flg = 1;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="./css/login.css">
<title>Document</title>
</head>
<body>
<div class="wrapper">
 
    <div class="contents flex">
            <div class="flex-container">
                <a href="home.php" class="prev_button">←</a>
                <h2 class="login">ログイン</h2>

                <!--エラーが出たらここに書く⇩-->
                <p class="error"><?php if($error_flg) echo "もう一度入力してください"; ?></p>

                <form class="login_form flex" action="login.php" method="POST">
                    <div class="box">
                        <input type="text" placeholder="ユーザー名" name="username" class="boxstyle">
                    </div>
                    <div class="box">
                        <input type="password" placeholder="パスワード" name="password"  class="boxstyle">
                    </div>
                    <input type="submit" value="ログイン">
                </form>
            <div class="transition_login">
                <p>アカウントをお持ちでない方は<a href="register.php">コチラ</a></p>
            </div>
    </div>
</div>
</body>
</html>