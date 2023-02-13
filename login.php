<?php
session_start();
require_once ('db/connect.php');
//エラーフラグが1だった場合はエラーを出す
$error_flg = 0;
if(isset($_POST) && !empty($_POST)) {
    echo $_POST["username"];
    echo $_POST["password"];
    if (!empty($_POST['username'])) {
        $username = $_POST['username'];
        echo "era-desu";
    } else {
        $error_flg = 1;
    }
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
        echo "nakanihaitteimasu";
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
        echo"<pre>";
        var_dump($result);
        echo"<pre>";
        if($result !== false){
            if($password === $result["pw"]){
                //セッションにユーザー名を入れる         
                if (!isset($_SESSION['username'])) {
                    // キー'count'が登録されていなければ、1を設定
                    $_SESSION['username'] = 1;

                    //home.phpにリダイレクトする1
                    header("Location:home.php");
                    exit();
                }
            }else{
                echo "ログイン失敗";
            }
        }else{
            echo "ログイン失敗";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
</head>
<body>
<div class="logfin">
<p><?php if($error_flg) echo "入力してください"; ?></p>
<form action="login.php" method="POST">
    <label for="id">アカウント名</label>
    <input id="id" name="username" type="text" placeholder="usernameを入力">
    <label for="pw">パスワード</label>
    <input id="pw" name="password" type="password" placeholder="パスワードを入力">
    <button name="login" type="submit">ログインする</button>
</form>
</div>
</body>
</html>