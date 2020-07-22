<?php require_once "../system/common.php";?>


<?php $page_title = " 商品管理";?>
<?php require "header.php";?>

<a style="font-size:20px" href="post_edit_new.php">商品を追加する</a>
<hr>
<form action="post_list.php" method="post">品名キーワード検索
  <input type="text" name="keyword">
  <input type="submit" value="検索">
  <input type="hidden" name="">
  <input type="submit" value="クリア">
</form>
<form name="myFORM">
  <div class="search-box">
    <span class="search-box_label">カテゴリ:</span>
            <label><input type="checkbox" name="kind" value="知恵の輪">知恵の輪</label>
            <label><input type="checkbox" name="kind" value="ルービックキューブ">ルービックキューブ</label>
            <label><input type="checkbox" name="kind" value="木製パズル">木製パズル</label>
            <label><input type="checkbox" name="kind" value="空間認識">空間認識</label>
  </div>
  <div class="search-box">
    <span class="search-box_label">難易度（Lv.）:</span>
            <label><input type="checkbox" name="lv" value="★">1</label>
            <label><input type="checkbox" name="lv" value="★★">2</label>
            <label><input type="checkbox" name="lv" value="★★★">3</label>
            <label><input type="checkbox" name="lv" value="★★★★">4</label>
            <label><input type="checkbox" name="lv" value="★★★★★">5</label>
  </div>
</form>

    <table>
      <tr>
        <th></th>
        <th>商品ID</th>
        <th>品名</th>
        <th>カテゴリ</th>
        <th>難易度</th>
        <th>商品画像</th>
        <th style="width: 40%;">商品説明</th>
        <th></th>
      </tr>
  
<?php
  // データの問い合わせ
  $rows_post = array(); // 配列の初期化
  if (isset($_REQUEST['keyword'])) {
    $stmt = $db->prepare('select * from product where product_name like ?');
    $stmt->execute(['%'.$_REQUEST['keyword'].'%']); // 検索クエリの実行
  } else {
    $stmt = $db->prepare("SELECT * FROM product ORDER BY id DESC");
    $stmt->execute(); // クエリの実行
  }
  $rows_post = $stmt->fetchAll(); // SELECT結果を二次元配列に格納
  
  foreach ($rows_post as $row_post) {
    echo '<tr class="inline-block" data-kind="';
    echo $row_post["product_category"];
    echo '" data-lv="';
    $i = $row_post["product_level"];
    while ($i >= 1) { 
      echo "★";
      $i--;
    }
    echo '">';
    echo '<td><a href="hensyu.php?mode=change&id='.he($row_post["id"]).'">編集</a></td>';
    echo '<td style="text-align: center;">'.$row_post["id"].'</td>';
    echo '<td style="text-align: center;">'.he($row_post["product_name"]).'</td>';
    echo '<td style="text-align: center;">'.he($row_post["product_category"]).'</td>';
    echo '<td style="text-align: center;">'.he($row_post["product_level"]).'</td>';
    echo '<td>'.he($row_post["product_picture"]).'</td>';
    echo '<td style="text-align: left;">'.nl2br(he($row_post["product_comments"])).'</td>';
    echo '<td><a href="hensyu.php?mode=delete&id='.he($row_post["id"]).'">削除</a></td>';
    echo '</tr>';
   }
?>
    </table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../search.js"></script>
<?php require "footer.php";?>