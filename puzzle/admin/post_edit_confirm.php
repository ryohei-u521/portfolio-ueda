<?php require_once "../system/common_admin.php";?>

<?php 
mb_internal_encoding("utf8");

//仮保存されたファイル名で画像ファイルを取得(サーバーへ仮アップロード)
$temp_pic_name = $_FILES['upfile']['tmp_name'];

//元のファイル名で画像ファイルを取得。
$original_pic_name = $_FILES['upfile']['name'];
$path_filename = './image/'.$original_pic_name;

//仮保存のファイル名を、image
move_uploaded_file($temp_pic_name,'../image/'.$original_pic_name);

?>

<?php $page_title = "新規商品登録確認";?>
  
<?php require "header.php";?>
<p><a href="post_list.php">一覧へ戻る</a></p>

<div class="wrapper">
  <div class="detail_box">
    <div class="detail_left">
      <label>商品画像<span class="attention">[必須]</span></label>
      <div class="img_picture">
        <img src="../image/<?php echo he($original_pic_name); ?>">
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
        <p class="padding"><?php echo he($_POST["product_level"]); ?></p>
      </div>
      
      <div class="padding">
        商品説明
        <p class="padding"><?php echo nl2br(he($_POST["product_comments"])); ?></p>
      </div>

  <p class="padding">
    <button type="button" onclick=history.back()>戻って修正する</button>
  </p>
  
     <form action="post_edit_insert.php" method="post" class="padding">
       <input type="submit" class="button" value="登録内容を確定する"/>
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