<?php session_start(); ?>
<?php $page_title = "お気に入りページ";?>
<?php require_once "system/common.php";?>
<?php require 'header.php'; ?>

<?php

try {
  if (isset($_SESSION['customer'])) {
	$stmt = $db->prepare('insert into favorite values(?,?)');
	$stmt->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo 'お気に入りに商品を追加しました。';
	echo '<hr>';
	require 'favorite.php';
  } else {
	echo 'お気に入りに商品を追加するには、ログインしてください。';
  }
} catch (PDOException $e) {
  // エラー発生時
  echo 'お気に入り登録済みの商品です。';
  echo '<hr>';
	require 'favorite.php';
}
?>
<?php require 'footer.php'; ?>
