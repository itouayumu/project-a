<?php
    session_start();
    require_once 'db_connect.php';

    $acid = $_SESSION['userid'];

    $sql1 = "SELECT * FROM account WHERE id=:acid";
    $stm1 = $pdo->prepare($sql1);
    $stm1->bindValue(':acid', $acid, PDO::PARAM_INT);
    $stm1->execute();
    $result1 = $stm1->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/reset.css">
    <link rel="stylesheet" href="css/accountup-style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/favicon.ico">
    <title>アカウント編集</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>
<body>
    <header class="acheader">
    <ul>
        <p class="ac-title">アカウントページ</p>
    </ul>
    </header>
    
    <div class="formdiv">
        <form class="acform" action="accountup.php" method="POST" enctype="multipart/form-data">
            <div class="acname">
                <p>名前</p>
                <input type="text" class="acname" placeholder="アカウント名" name="acname" value="<?php echo $result1['name']; ?>">
            </div>
            <p>アイコン画像</p>
            <div id="app">
                <div class="preview_zone">
                    <img :src="url" alt="ここにプレビューが表示されます">
                </div>
                <div class="upload_zone">
                    <input type="file" class="input_file" ref="preview" @change="previewImage"name="image">  
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
            <input type="submit" value="変更" name="botan"><br>
        </form>
        <a href="mypage.php">戻る</a>
    </div>
</body>
</html>