<?php
//hensyu.phpからの導線以外は、「login_error.php」へリダイレクト
if(empty($_POST['from_hensyu'])){
  header("Location:http://puzzlesubsc.starfree.jp/puzzle/admin/login_error.php");
}
?>
<?php require_once "../system/common_admin.php";?>

<?php

mb_internal_encoding("utf8");
//ファイルが新たにアップロードされたか確認
if(empty($_FILES['upfile']['tmp_name'])) {
$path_filename = $_POST['product_picture'];
} else {
//仮保存されたファイル名で画像ファイルを取得(サーバーへ仮アップロード)
$temp_pic_name = $_FILES['upfile']['tmp_name'];

//元のファイル名で画像ファイルを取得。
$original_pic_name = $_FILES['upfile']['name'];
$path_filename = './image/'.$original_pic_name;

//仮保存のファイル名を、image
move_uploaded_file($temp_pic_name,'../image/'.$original_pic_name);
}

?>

<?php $page_title = "商品登録確認";?>
  
<?php require "header.php";?>
<p><a href="post_list.php">一覧へ戻る</a></p>

<div class="wrapper">
    
  <p>
    商品ID[<?php echo $_POST["id"]; ?>]を修正しています
  </p>
  
  <div class="detail_box">
    <div class="detail_left">
      <label>商品画像</label>
      <div class="img_picture">
        <?php 
        if(empty($_FILES['upfile']['tmp_name'])) {
        echo '<img src=".'. he($_POST['product_picture']) .'">';
        } else {
        echo '<img src="../image/'. he($original_pic_name) .'">';
        }
        ?>
      </div>
    </div>
    <div class="detail_right">
      <div class="padding">
        品名<span class="attention">[必須]</span><br>
        <p class="padding"><?php echo he($_POST["product_name"]); ?></p>
      </div>
      <div class="padding">
        カテゴリ<span class="attention">[必須]</span><br>
        <p class="padding"><?php echo he($_POST["product_category"]); ?></p>
      </div>
      <div class="padding">
        難易度(Level)<span class="attention">[必須]</span><br>
        <p class="padding"><?php echo $_POST["product_level"]; ?></p>
        </select>
      </div>
      <div class="padding">
        商品説明<br>
        <p class="padding"><?php echo nl2br(he($_POST["product_comments"])); ?></p>
      </div>
    
    <p class="padding">
      <button type="button" onclick=history.back()>戻って修正する</button>
    </p>
  
     <form action="hensyu_update.php" method="post" class="padding">
       <input type="hidden" value="<?php echo rand(1,10);?>" name="from_hensyu_confirm">
       <input type="submit" class="button2" value="登録する"/>
       <input type="hidden" value="<?php echo $_POST['id'];?>" name="id">
       <input type="hidden" value="<?php echo he($_POST['product_name']);?>" name="product_name">
       <input type="hidden" value="<?php echo $_POST['product_category'];?>" name="product_category">
       <input type="hidden" value="<?php echo $_POST['product_level'];?>" name="product_level">

       <input type="hidden" value="<?php echo he($path_filename); ?>" name="path_filename">

       <input type="hidden" value="<?php echo he($_POST['product_comments']);?>" name="product_comments">
     </form>
    </div>
  </div> 
</div>
<?php require "footer.php";?>