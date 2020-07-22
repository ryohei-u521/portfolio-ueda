<?php session_start(); ?>
<?php $page_title = "ログインページ";?>
<?php require_once "system/common.php";?>
<?php require 'header.php'; ?>

<?php
unset($_SESSION['customer']);

$stmt = $db->prepare('select * from customer where login=? and password=?');
$stmt->execute([$_REQUEST['login'], $_REQUEST['password']]);

//セッションデータの登録
foreach ($stmt->fetchAll() as $row) {
	$_SESSION['customer']=[
		'id'=>$row['id'], 'name'=>$row['name'], 
		'address'=>$row['address'], 'login'=>$row['login'], 
		'password'=>$row['password']];
}
if (isset($_SESSION['customer'])) {
  header("Location:index.php");
} else {
	echo 'ログイン名またはパスワードが違います。';
  echo '<button type="button" onclick=history.back()>ログインする</button>';
}
?>
<?php require 'footer.php'; ?>
