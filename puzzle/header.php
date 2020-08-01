<html lang="ja">
<head>
<meta charset="utf-8">
  
<meta name="robots" content="none" /><!--検索エンジンnoindex,nofollow-->
<title><?=$page_title?></title>
<link rel="canonical" href="<?=$page_canonical?>"><!--カノニカル-->
<meta name="description" content="<?=$page_description?>">
<!--Googleアナリティクス設置-->
  
<link rel="icon" href="#"><!-- ファビコン -->
<meta name="viewport" content="width = device-width, initial-scale=1">
<link rel="stylesheet" media="all" href="reset.css">
<link rel="stylesheet" media="all" href="style.css">
</head>

<body>
  <header>
  <div class="header-logo-menu">

  <div class="logo-area">
    <div class="logo" style="width: 55%;"><a href="./">LOGO</a></div>
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
  <h1><?=$page_title?></h1>