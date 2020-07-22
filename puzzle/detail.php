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
  <p>会員様のレビュー</p>
  <?php
        if (isset($_SESSION['customer'])) { 
          echo '<p>レビューを書く</p>';
          echo '<form method="post" action="detail_insert.php">';
          echo '<input type="hidden" value="'.$row['id'].'" name="id">';
          echo '<div><lavel>レビュー</lavel><br>';
          echo '<textarea cols="50" rows="20" name="customer_review" required></textarea>';
          echo '</div>';
          echo '<div><input type="submit" class="submit" value="投稿する"></div>';
          echo '</form>';
        }
  ?>
  <?php
      
  $stmt = $db->prepare('SELECT * FROM review,customer WHERE product_id = ? AND customer_id = customer.id ORDER BY review_id DESC');
	$stmt->execute([$_REQUEST['id']]);
                         
                    
  while($row = $stmt->fetch()){
    echo"<div class='review_box'>";
    echo"<p class='handlename'>".he($row['login'])."さん</p>";
    echo"<div class='contents'>";
    echo nl2br(he($row['customer_review']));
    echo"</div>";
        if ($_SESSION['customer']['id'] === $row['customer_id']) { 
          echo '<div><a href="detail_delete.php?review_id='.$row['review_id'].'">削除</a></div>';
        }
    echo"</div>";
  }
  ?>
</div>
<?php     }?>

<?php require 'footer.php'; ?>