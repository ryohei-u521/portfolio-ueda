<?php session_start(); ?>

<?php
if (isset($_SESSION['customer'])) {
	unset($_SESSION['customer']);
	header("Location:index.php");
} else {
  require 'header.php';
	echo 'すでにログアウトしています。';
}
?>

<?php require 'footer.php'; ?>
