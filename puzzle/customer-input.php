<?php session_start(); ?>
<?php $page_title = "お客様情報ページ";?>
<?php require_once "system/common.php";?>
<?php require 'header.php'; ?>

<?php

// フォーム初期値のセット
if (isset($_SESSION['customer'])) {
$form = array();
$form["id"] = $_SESSION['customer']['id'];
$form["login"] = $_SESSION['customer']['login'];
$form["password"] = $_SESSION['customer']['password'];
$form["name"] = $_SESSION['customer']['name'];
$form["address"] = $_SESSION['customer']['address'];
}
?>
 
<form action="<?php
        if (isset($_SESSION['customer'])) { 
          echo 'customer-output.php';//編集
        } else {
          echo 'customer-output-new.php';//新規
        }
        ?>" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" size="30" value="<?php echo he($form["id"]); ?>">

    <div class="form_box">
    <?php
        if (isset($_SESSION['customer'])) { 
          echo '<div class="form_left">ログイン名</div>';
          echo '<div class="form_right" style="padding:5px;font-size: 20px;">'.he($form["login"]).'様';
          echo '<input type="hidden" name="login" value="';
          echo he($form["login"]);
          echo '"></div>';
        } else {
          echo '<div class="form_left">ログイン名（半角英数字10文字以下）<span class="attention">[必須]</span><br>※ログイン名は登録後に変更できません！</div>';
          echo '<div class="form_right"><input type="text" name="login" value="';
          echo he($form["login"]);
          echo '" maxlength="10" pattern="^[0-9A-Za-z]+$" title="半角英数字で入力して下さい。" required>';
          echo '</div>';
        }
        ?>   
    <div class="form_left">
    パスワード（半角英数字3文字以上）<span class="attention">[必須]</span>
    </div>
    <div class="form_right">
      <input type="password" name="password" id="password" value="<?php echo $form["password"];?>" maxlength="10" pattern="^[a-zA-Z0-9]{3,}$" required>
      
    </div>
    <!--<tr><td>（必須）パスワード確認
      <input type="password" name="confirm_password" value="<?php //echo $_SESSION['customer']['password'];?>" id="confirm" oninput="ConfirmPassword(this)" required>
      </td></tr>-->
    <?php
    //if (isset($_SESSION['customer'])) {
      echo '<div class="form_left">お名前</div>';
      echo '<div class="form_right"><input type="text" name="name" value="'.he($form["name"]). '">';
      echo '</div>';
      echo '<div class="form_left">ご住所</div>';
      echo '<div class="form_right"><input type="text" name="address" value="'.he($form["address"]). '">';
      echo '</div>';
   //}
    ?>
      <div class="form_right">
        <input type="submit" value="登録する">
      </div>
    </div> 
</form>

<?php require 'footer.php'; ?>
<!--<script>
    function ConfirmPassword(confirm){
      var input1 = password.value;
      var input2 = confirm.value;
      if(input1 != input2){
        confirm.setCustomValidity("パスワードが一致しません。");
      }else{
        confirm.setCustomValidity("");
      }
    }
  </script>-->