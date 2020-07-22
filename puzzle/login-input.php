<?php $page_title = "ログインページ";?>
<?php require_once "system/common.php";?>
<?php require 'header.php'; ?>

<div class="form_box">
  <form action="login-output.php" method="post">
    ログイン名<input type="text" name="login"><br>
    パスワード<input type="password" name="password"><br>
    <input type="submit" value="ログイン">
  </form>
</div>
<p class='form_customer'>
  <a href="customer-input.php" class="simple_square_btn2">新規会員登録はこちら</a>
</p>
<?php require 'footer.php'; ?>
