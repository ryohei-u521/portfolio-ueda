<?php session_start(); ?>
<?php require_once "system/common.php";?>
<?php $page_title = "パズルサブスクTOP";?>
<html lang="ja">
<head>
<meta charset="utf-8">
 
<meta name="robots" content="none" /><!--検索エンジンnoindex,nofollow-->
<title><?=$page_title?></title>
<link rel="canonical" href="#"><!--カノニカル-->
<meta name="description" content="#">
<!--Googleアナリティクス設置-->
  
<link rel="icon" href="#"><!-- ファビコン -->
<meta name="viewport" content="width = device-width, initial-scale=1">
<link rel="stylesheet" media="all" href="reset.css">
<link rel="stylesheet" media="all" href="style.css">
<link rel="stylesheet" media="all" href="image.css"><!--スクロール-->
</head>

<body>
<header>
  <div class="header-logo-menu">
  <div id="nav-drawer">
      <input id="nav-input" type="checkbox" class="nav-unshown">
      <label id="nav-open" for="nav-input"><span></span></label>
      <label class="nav-unshown" id="nav-close" for="nav-input"></label>
      <div id="nav-content">
        <form class="myFORM">
          <ul class="search-box" style="padding-bottom:10px;">
            <li style="padding-bottom:5px;"><span class="search-box_label">カテゴリ</span></li>
            <li><label><input type="checkbox" id="sp" name="kind" value="知恵の輪">知恵の輪</label></li>
            <li><label><input type="checkbox" id="sp" name="kind" value="ルービックキューブ">ルービック<br>キューブ</label></li>
            <li><label><input type="checkbox" id="sp" name="kind" value="木製パズル">木製パズル</label></li>
            <li><label><input type="checkbox" id="sp" name="kind" value="空間認識">空間認識</label></li>
          </ul>
          <ul class="search-box">
            <li style="padding-bottom:5px;"><span class="search-box_label">難易度（Lv.）</span></li>
            <li><label class="star"><input type="checkbox" id="sp" name="lv" value="★">★<span>★★★★</span></label></li>
            <li><label class="star"><input type="checkbox" id="sp" name="lv" value="★★">★★<span>★★★</span></label></li>
            <li><label class="star"><input type="checkbox" id="sp" name="lv" value="★★★">★★★<span>★★</span></label></li>
            <li><label class="star"><input type="checkbox" id="sp" name="lv" value="★★★★">★★★★<span>★</span></label></li>
            <li><label class="star"><input type="checkbox" id="sp" name="lv" value="★★★★★">★★★★★</label></li>
          </ul>
        </form>
    　</div>
  </div>
  <div class="logo-area">
    <div class="logo">LOGO</div>
    <div class="icon-area">
      <div class="icon">
        <?php
        if (isset($_SESSION['customer'])) {
          echo '<a href="logout-input.php">'.he($_SESSION['customer']['login']).'様</a>';
        } else {
          echo '<a href="login-input.php">ログイン</a>';
        }
        ?>
      </div>
      <div class="icon_img">
      <a href="favorite-show.php"><img src="img/favorite_white.png" alt="お気に入り"></a>
    </div>
    </div>
  </div>
  </div>
</header>
  
<div id="header"></div>
  
<div class="wrapper">
  <div id="h1" class = "left"><h1><?=$page_title?></h1></div>
  
  <div id="menu" class = "right">
    <a href="https://toysub.net/" target="_blank">参考サービスへ（トイサブ！）</a>
  </div>
  
  <div class = "left">
    <form action="index.php" method="post">キーワード検索<br>
      <input type="text" name="keyword">
      <input type="submit" value="検索">
      <input type="hidden" name="">
      <input type="submit" value="クリア">
    </form>
    
			<div id="parent" class="list"><!-- 画像・テキスト横並べ -->
      <?php
        // データの問い合わせ
        $rows_post = array(); // 配列の初期化
        if (isset($_REQUEST['keyword'])) {
          $stmt = $db->prepare('select * from product where product_name like ?');
          $stmt->execute(['%'.$_REQUEST['keyword'].'%']); // 検索クエリの実行
        } else {
          $stmt = $db->prepare("SELECT * FROM product ORDER BY id DESC");
          $stmt->execute(); // クエリの実行
        }
        $rows_post = $stmt->fetchAll(); // SELECT結果を二次元配列に格納
        
        foreach ($rows_post as $row_post) {
          echo '<div class="inline-block" data-kind="';
          echo $row_post["product_category"];
          echo '" data-lv="';
          $i = $row_post["product_level"];
              while ($i >= 1) {
                echo "★";
                $i--;
              }
          echo '">';
          echo '<a href="detail.php?id='.he($row_post["id"]).'">';
          echo '<div class="img_picture">';
          echo '<img src="'.he($row_post["product_picture"]).'" alt="'.he($row_post["product_name"]).'">';
          echo '</div>';
          echo '<h2 class="p_name">'.he($row_post["product_name"]).'</h2>';
          echo '<div class="star-rating"><p class="p_level">';
          $i = $row_post["product_level"];
              while ($i >= 1) {
                echo "★";
                $i--;    
              }
          echo '<div class="star-rating-back">★★★★★</div></div>';
          echo '</p>';
          echo '</a>';
          echo '</div>';
        }
        ?>        
			</div>
  </div>
  
  <div class = "right">
    <h2 class="h2">絞り込み検索</h2>
    <form name="myFORM">
          <ul class="search-box">
            <li><span class="search-box_label">カテゴリ</span></li>
            <li><label><input type="checkbox" id="pc" name="kind" value="知恵の輪">知恵の輪</label></li>
            <li><label><input type="checkbox" id="pc" name="kind" value="ルービックキューブ">ルービックキューブ</label></li>
            <li><label><input type="checkbox" id="pc" name="kind" value="木製パズル">木製パズル</label></li>
            <li><label><input type="checkbox" id="pc" name="kind" value="空間認識">空間認識</label></li>
          </ul>
          <ul class="search-box">
            <li><span class="search-box_label">難易度（Lv.）</span></li>
            <li><label class="star"><input type="checkbox" id="pc" name="lv" value="★">★<span>★★★★</span></label></li>
            <li><label class="star"><input type="checkbox" id="pc" name="lv" value="★★">★★<span>★★★</span></label></li>
            <li><label class="star"><input type="checkbox" id="pc" name="lv" value="★★★">★★★<span>★★</span></label></li>
            <li><label class="star"><input type="checkbox" id="pc" name="lv" value="★★★★">★★★★<span>★</span></label></li>
            <li><label class="star"><input type="checkbox" id="pc" name="lv" value="★★★★★">★★★★★</label></li>
          </ul>
    </form>
  </div>
</div>
<a id="scrollUp" href="#top" style="position: fixed;z-index: 2147483647; display: none;"></a>
<footer>
  <p>(c)copy right</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script><!--CDN-->
<script type="text/javascript" src="search.js"></script><!--絞り込み検索-->
<script type="text/javascript" src="sp.js"></script><!--スマホ用連動-->
<script type="text/javascript" src="jquery.scrollUp.min.js"></script><!--スクロール-->
<script type="text/javascript" src="scroll.js"></script><!--スクロール-->
</body>
</html>