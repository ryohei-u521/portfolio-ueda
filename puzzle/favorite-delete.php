<?php session_start(); ?>
<?php $page_title = "お気に入りページ";?>
<?php require_once "system/common.php";?>
<?php require 'header.php'; ?>

<?php
if (isset($_SESSION['customer'])) {
	
	$stmt = $db->prepare(
		'delete from favorite where customer_id=? and product_id=?');
	$stmt->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo 'お気に入りから商品を削除しました。';
	echo '<hr>';
} else {
	echo 'お気に入りから商品を削除するには、ログインしてください。';
}
require 'favorite.php';
?>
<?php require 'footer.php'; ?>
