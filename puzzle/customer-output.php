<?php session_start(); ?>
<?php $page_title = "お客様情報ページ";?>
<?php require_once "system/common.php";?>
<!--共通ヘッダー読み込みなし-->
<html lang="ja">
<head>
<meta charset="utf-8">
  
<meta name="robots" content="noindex" /><!--検索エンジンから除外-->
<title><?=$page_title?></title>
<!--Googleアナリティクス設置-->

<meta name="viewport" content="width = device-width, initial-scale=1">
<link rel="stylesheet" media="all" href="reset.css">
<link rel="stylesheet" media="all" href="style.css">
</head>

<body>
  <header>
  <div class="header-logo-menu">

  <div class="logo-area">
    <div class="logo"><a href="./">LOGO</a></div>
    <div class="icon-area">
      <div class="icon">
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
<?php

// ホワイトリスト変数の作成
$whitelist = array("name", "address", "login", "password", "customer", "id");

$request = whitelist($whitelist);

$id=$_SESSION['customer']['id'];

//顧客情報の更新
    $db->beginTransaction();
		$stmt = $db->prepare("UPDATE customer SET login=?, password=?, name=?, address=? WHERE id=?");
		
    //bindValueメソッドでパラメータをセット
    $stmt->bindValue(1,$request['login']);
    $stmt->bindValue(2,$request['password']);
    $stmt->bindValue(3,$request['name']);
    $stmt->bindValue(4,$request['address']);
    
    $stmt->execute(array($request['login'], $request['password'], $request['name'], $request['address'], $id));
    $db->commit();
    
		$_SESSION['customer']=[
			'id'=>$id, 'login'=>$request['login'], 'password'=>$request['password'], 'name'=>$request['name'], 
			'address'=>$request['address']];
		echo 'お客様情報を更新しました。';
    
?>

<?php require 'footer.php'; ?>