

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/reset.css">
    <link rel="stylesheet" href="css/post.css">
    <link rel="stylesheet" href="css/style.css">
    <title>投稿ページ</title>
    <SCRIPT LANGUAGE="JavaScript">


</SCRIPT>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>
<body>
  <div>
<header class="deleteheader">
        <ul>
           <p class="post-title">投稿ページ</p>
           
        </ul>
    </header>
<div class="delete-pan">
    <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
  <li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem">
    <a itemprop="item" href="home.php">
        <span itemprop="name">ホーム</span>
    </a>
    <meta itemprop="position" content="1" />
  </li>

  <li itemprop="itemListElement" itemscope
      itemtype="https://schema.org/ListItem">
    <a itemprop="item" href="#">
        <span itemprop="name">投稿ページ</span>
    </a>
    <meta itemprop="position" content="2" />
  </li>


  </li>
</ol>
</div>
<div class="delete-contenta">
    <p class="post-subtitle" >記事投稿</p>
    <form class="postform" action="postresult.php" method="POST">
                    <div class="title">
                        <p>タイトル</p>
                        <input type="text" class="title" placeholder="記事タイトル" name="title">
                    </div>
                    <div class="content">
                        <p>内容</p>
                        <textarea class="content" name="content"rows="5" cols="33"placeholder="内容"></textarea>
                    </div>
                    <div id="app">
         <div class="preview_zone">
           
            <img :src="url" alt="ここにプレビューが表示されます">
         </div>
         <div class="upload_zone">
          
            <input type="file" class="input_file" ref="preview" @change="previewImage"name="imgid">
             <div class="drop_zone">
             </div>

     </div>
     <div class="post-radio">
<input type="radio" name="Release" value="0"default>公開
<input type="radio" name="Release" value="1">非公開
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

<input type="submit"class="shakin1" value="投稿する">
</form>
<form class="postform" action="home.php" method="POST">
<input type="submit"class="shakin2" value="戻る">
</form>
</body>

</html>
