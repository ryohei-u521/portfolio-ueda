<?php session_start(); ?>
<?php $page_title = "商品詳細";?>
<?php require_once "system/common.php";?>
<?php require 'header.php'; ?>

<?php
$stmt = $db->prepare('select * from product where id=?');
$stmt->execute([$_REQUEST['id']]);
foreach ($stmt as $row) {;?>

<div class="detail_box">
  <div class="detail_left">
    <p class="p_name">カテゴリ：<?php echo he($row["product_category"]);?>系</p>
    <div class="img_picture">
      <img src="<?php echo he($row['product_picture']);?>" alt="<?php echo he($row['product_name']);?>">
    </div>
  </div>
  <div class="detail_right">
    <h2 class="product_name"><?php echo he($row["product_name"]);?></h2>
    <p class="p_name">難易度（Lv.）</p>
    <div class="star-rating">
      <p class="p_level">
        <?php
        $i = $row["product_level"];
          while ($i >= 1) {
            echo "★";
              $i--;
          }
        ?>
      </p>
      <div class="star-rating-back">★★★★★</div>
    </div>
    <p class="p_comments"><?php echo nl2br(he($row["product_comments"]));?></p>
    <p class="img_picture"><a href="favorite-insert.php?id=<?php echo he($row['id']);?>" class="simple_square_btn2">お気に入りに追加</a></p>
  </div>
</div>
<div class="detail_box" id="review_link">
  
  <?php
        //レビュー投稿欄
        if (isset($_SESSION['customer'])) {
          echo '<div class="review_box">';
          echo '<span class="handlename">'.he($row["product_name"]).'のレビューを書く</span>';
          echo '<p><span id="textCount">0</span>文字入力しました。<br>あと<span id="textLest">255</span>文字入力できます。</p>';
          echo '<p id="textAttention" style="display:none; color:red;">入力文字数が制限に達しました。</p>';
          echo '<form method="post" action="detail_insert.php">';
          echo '<input type="hidden" value="'.$row['id'].'" name="id">';
          echo '<div>';
          echo '<textarea id="textArea" cols="100" rows="20" name="customer_review" required></textarea>';
          echo '</div>';
          echo '<div><input type="submit" class="submit" value="投稿する"></div>';
          echo '</form>';
          echo '</div>';
        }
  ?>
  
  <?php
      
  $stmt = $db->prepare('SELECT * FROM review,customer WHERE product_id = ? AND customer_id = customer.id ORDER BY review_id DESC');
	$stmt->execute([$_REQUEST['id']]);
                         
 //レビュー掲示板                   
  while($row = $stmt->fetch()){
    echo"<div class='review_box'>";
    echo"<span class='handlename'>".he($row['login'])."さんのレビュー</span>";
    echo nl2br(he($row['customer_review']));
        if ($_SESSION['customer']['id'] === $row['customer_id']) { 
          echo '<div style="text-align:right;"><a href="detail_delete.php?review_id='.$row['review_id'].'">削除する</a></div>';
        }
    echo"</div>";
  }
  ?>
</div>
<?php     }?>
<script>
  window.addEventListener("DOMContentLoaded", function(){
    var count = null,
    lest = null,
    max = 255,
    input_area = document.getElementById("textArea"),
    output_count = document.getElementById("textCount"),
    output_lest = document.getElementById("textLest"),
    attention = document.getElementById("textAttention");

    input_area.onkeyup = function(){
        var length = input_area.value.length;
        count = length;
        lest =  max - length;
        output_lest.innerText = lest;
        output_count.innerText = count;
        attention.style.display = ( length > max ) ? "block" : "none";
    }
}, false);
</script>
<?php require 'footer.php'; ?>