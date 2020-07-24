<?php require_once "../system/common_admin.php";?>

<?php
// ホワイトリスト変数の作成
$whitelist = array("mode", "id");
$request = whitelist($whitelist);

$mode = $request["mode"]; // 動作モード（お気に入り-change/削除-delete）


// お気に入りモード
if ($mode == "change") {

$rows_post = array(); // 配列の初期化

  //テーブルの結合
  $db->beginTransaction();
	$stmt =$db->prepare(
		'select * from favorite, product '.
		'where customer_id=? and product_id=product.id');
	$stmt->execute(array($request["id"]));
  $rows_post = $stmt->fetchAll(); // SELECT結果を二次元配列に格納

}
    
// 削除モード
if ($mode == "delete") {
    try {
        $db->beginTransaction();
        $stmt = $db->prepare("DELETE FROM customer WHERE id = ?");
        $stmt->execute(array($request["id"]));
        $db->commit();
    } catch (PDOException $e) {
        // エラー発生時
        $db->rollBack();
        exit("(お気に入り機能を使用しているユーザーは削除できません)");
    }
    header("Location: customer_list.php");
    exit;
}

?>

<?php $page_title = "お気に入り一覧";?>
<?php require "header.php";?>
<p><a href="customer_list.php">顧客一覧へ戻る</a></p>

<p style="padding: 15px;">顧客ID[<?php echo he($request["id"]); ?>]のお気に入り</p>

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
<hr>
    <table class="favorite">
      <tr>
        <th>商品ID</th>
        <th>商品名</th>
        <th>難易度</th>
        <th>カテゴリ</th>
      </tr>
<?php
    foreach ($rows_post as $row_post) { ?>
     <tr class="inline-block" data-kind="<?php echo $row_post['product_category']; ?>" data-lv="<?php $i = $row_post['product_level'];
    while ($i >= 1) { 
      echo '★';
      $i--;
    }?>" style="text-align: center;">
        <td><?php echo $row_post["id"];?></td>
        <td><?php echo he($row_post["product_name"]);?></td>
        <td><?php echo he($row_post["product_level"]);?></td>
        <td><?php echo he($row_post["product_category"]);?></td>
     </tr>

<?php }?>
    </table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../search.js"></script>
<?php require "footer.php"; ?>