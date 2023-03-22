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
    
}else if(empty($_FILES)){
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
        $filename = $_FILES['cionid']['name'];
        $sql = "insert into account (name,mail,pw,cionid) values (:name, :mail, :pw, :cionid)";
        
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':name',$_POST["name"],PDO::PARAM_STR);
        $stm->bindValue(':mail',$_POST["mail"],PDO::PARAM_STR);
        $stm->bindValue(':pw',$_POST["pw"],PDO::PARAM_STR);
        $stm->bindValue(':cionid',$filename,PDO::PARAM_STR);

        $stm->execute();

        $id = $pdo -> lastInsertId();
        echo $id;
         $uploaded_path = 'img/'.$id.$filename;
         echo $uploaded_path;
         $result = move_uploaded_file($_FILES['cionid']['tmp_name'],$uploaded_path);
    }}
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
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>
<body>
    <!-- 特定ページのコンテンツをここに追加 -->
    <div class="contents flex-container">
        <a href="login.php" class="prev_button">←</a>
        <h2 class="register">新規登録</h2>

        <form action="register.php" method="post"enctype="multipart/form-data">
            <div class="register_form">
                <h3 class="box">ユーザー名<span class="Required">必須</span></h3>
                <div class="inputbox">
                    <input type="text" placeholder="例)お菓子　太郎" name="name" class="form">
                </div>

                <h3 class="box">メールアドレス<span class="Required">必須</span></h3>
                <div class="inputbox">
                    <input type="text" placeholder="E-mail" name="mail" class="form">
                </div>

                <h3 class="box">パスワード<span class="Required">必須</span></h3>
                <div class="inputbox">
                    <input type="password" placeholder="Password" name="pw" class="form">
                </div>

                <h3>パスワード(確認用)<span class="Required">必須</span></h3>
                <div class="inputbox">
                    <input type="password" placeholder="Password" name="pw2" class="form">
                </div>

                <h3>アイコン<span class="Required">必須</span></h3>
                <div id="app">
      <div class="preview_zone">
        <img :src="url" alt="ここにプレビューが表示されます">
      </div>
      <div class="upload_zone">
        <input type="file" class="input_file" ref="preview" @change="previewImage"name="cionid">  
      </div>
    </div>
    <script>
       const app = new Vue({
           el: '#app',
           data: {
               url: '',
           },
           methods: {
               previewImage() {
                   let image = this.$refs.preview.files[0];
                   this.url = URL.createObjectURL(image);
               }
           }
       })
     </script>
  </div>

               
            </div>
            
            <div class="transition_login">
                <button class="register-button">登録</button><br>
                <label>アカウントをお持ちの方は<a href="login.php">コチラ</a></label>
            </div>
        </form>
    </div>
</body>
</html>