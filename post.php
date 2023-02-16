

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
<!--
var list_img = new Array();
list_img[0] = new Array("img/k-autodoa.jpeg","アウトドア");
list_img[1] = new Array("img/k-diy.jpg","DIY");
list_img[2] = new Array("img/k-game.png","ゲーム");
list_img[3] = new Array("img/k-ivennto.png","イベント");
list_img[4] = new Array("img/k-myhome.jpg","マイホーム");
list_img[5] = new Array("img/k-osyare.jpg","おしゃれ");
list_img[6] = new Array("img/k-syoku.jpg","食");
list_img[7] = new Array("img/k-syopping.jpg","ショッピング");
list_img[8] = new Array("img/k-syumi.png","趣味");
list_img[9] = new Array("img/k-zatudann.png","雑談");
function set_img(sel_val)
{
  img_area.src = list_img[sel_val][0];
}
//-->
</SCRIPT>
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
                    <div class="postimg">
                    <select onchange="set_img(this.selectedIndex)"name="img">

<SCRIPT language=javascript>
  for(nn=0;nn<list_img.length;nn++) {
    document.write("<option>" + list_img[nn][1]);
  }
</SCRIPT>

</select>
<br><br>
<img name=img_area border=1 class="img">
<br><br>
<div class="post-radio">
<input type="radio" name="Release" value="0"default>公開

<input type="radio" name="Release" value="1">非公開
</div>

                    </div>
                    <input type="submit"class="shakin1" value="投稿する">
    </form>
  <a href="home.php"class="shakin2">戻る</a>
               

</body>

</html>
