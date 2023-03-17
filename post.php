

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

</SCRIPT>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
</head>
<body>
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
      </div>
    </div>
      <div class="switchArea">
        <input type="checkbox" id="switch1" name="Release" value="0" checked>
        <label for="switch1"><span></span></label>
        <div id="swImg"></div>
      </div>
      <style type="text/css">

        /* === ボタンを表示するエリア ============================== */
        .switchArea {
          line-height    : 60px;                /* 1行の高さ          */
          letter-spacing : 0;                   /* 文字間             */
          text-align     : center;              /* 文字位置は中央     */
          font-size      : 27px;                /* 文字サイズ         */

          position       : relative;            /* 親要素が基点       */
          margin         : auto;                /* 中央寄せ           */
          margin-top     : 50px;
          width          : 150px;               /* ボタンの横幅       */
          background     : #AAECFC;                /* デフォルト背景色   */
        }

        /* === チェックボックス ==================================== */
        .switchArea input[type="checkbox"] {
          display        : none;            /* チェックボックス非表示 */
        }

        /* === チェックボックスのラベル（標準） ==================== */
        .switchArea label {
          display        : block;               /* ボックス要素に変更 */
          box-sizing     : border-box;          /* 枠線を含んだサイズ */
          height         : 60px;                /* ボタンの高さ       */
          border         : 4px solid rgba(134, 160, 222, 0.70);   /* 未選択タブの枠線 */
          border-radius  : 30px;                /* 角丸               */
        }

        /* === チェックボックスのラベル（ONのとき） ================ */
        .switchArea input[type="checkbox"]:checked +label {
          border-color   : #86a0de;             /* 選択タブの枠線     */
        }

        /* === 表示する文字（標準） ================================ */
        .switchArea label span:after{
          content        : "非公開";               /* 表示する文字       */
          padding        : 0 0 0 45px;          /* 表示する位置       */
          color          : rgba(134, 160, 222, 0.55);             /* 文字色             */
        }

        /* === 表示する文字（ONのとき） ============================ */
        .switchArea  input[type="checkbox"]:checked + label span:after{
          content        : "公開";                /* 表示する文字       */
          padding        : 0 36px 0 0;          /* 表示する位置       */
          color          : #86a0de;             /* 文字色             */
        }

        /* === 丸部分のSTYLE（標準） =============================== */
        .switchArea #swImg {
          position       : absolute;            /* 親要素からの相対位置*/
          width          : 52px;                /* 丸の横幅           */
          height         : 52px;                /* 丸の高さ           */
          background     : rgba(134, 160, 222, 0.55);             /* カーソルタブの背景 */
          top            : 4px;                 /* 親要素からの位置   */
          left           : 4px;                 /* 親要素からの位置   */
          border-radius  : 26px;                /* 角丸               */
          transition     : .2s;                 /* 滑らか変化         */
        }

        /* === 丸部分のSTYLE（ONのとき） =========================== */
        .switchArea input[type="checkbox"]:checked ~ #swImg {
          transform      : translateX(90px);    /* 丸も右へ移動       */
          background     : #86a0de;             /* カーソルタブの背景 */
        }
      </style>

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

  <input type="submit"class="shakin1" value="投稿する" id="checkButton">
</form>
<form class="postform" action="home.php" method="POST">
  <input type="submit"class="shakin2" value="戻る">
</form>
</body>

</html>
