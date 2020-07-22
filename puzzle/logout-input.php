<?php session_start(); ?>
<?php $page_title = "お客様情報ページ";?>
<?php require_once "system/common.php";?>
<?php require 'header.php'; ?>

<div class="form_box">
  <p class='form_customer'>
    <a href="customer-input.php" class="simple_square_btn2">会員情報更新</a>
  </p>
  <p class='form_customer'>
    <a href="logout-output.php">ログアウト</a>
  </p>
</div>

<?php require 'footer.php'; ?>
