<?php session_start(); ?>
<?php $page_title = "お気に入りページ";?>
<?php require_once "system/common.php";?>
<?php require 'header.php'; ?>
<p>商品詳細ページからお気に入り追加できます。</p>
<hr>
<?php
require 'favorite.php';
?>
<?php require 'footer.php'; ?>
