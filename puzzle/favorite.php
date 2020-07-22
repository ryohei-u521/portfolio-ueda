<?php require_once "system/common.php";?>

<div class="parent">
<?php
// データの問い合わせ
$rows_post = array(); // 配列の初期化

if (isset($_SESSION['customer'])) {
  //テーブルの結合
	$stmt =$db->prepare(
		'select * from favorite, product '.
		'where customer_id=? and product_id=product.id');
	$stmt->execute([$_SESSION['customer']['id']]);
  $rows_post = $stmt->fetchAll(); // SELECT結果を二次元配列に格納
  
	foreach ($rows_post as $row_post) {
          echo '<div class="inline-block">';
          echo '<a href="detail.php?id='.he($row_post["id"]).'">';
          echo '<div class="img_picture">';
          echo '<img src="'.he($row_post["product_picture"]).'" alt="'.he($row_post["product_name"]).'">';
          echo '</div>';
          echo '<p class="p_name">'.he($row_post["product_name"]).'</p>';
          echo '<div class="star-rating"><p class="p_level">';
          $i = $row_post["product_level"];
              while ($i >= 1) {
                echo "★";
                $i--;    
              }
          echo '<div class="star-rating-back">★★★★★</div></div>';
          echo '</p>';
          echo '</a>';
          echo '<div class="p_name"><a href="favorite-delete.php?id='.$row_post["id"]. '">お気に入り解除</a></div>';
          echo '</div>';
  }
}
  else {
	echo 'お気に入りを表示するには、ログインしてください。';
}
?>
</div>