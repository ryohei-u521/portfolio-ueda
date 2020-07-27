<?php require_once "../system/common_admin.php";?>

<?php
// ホワイトリスト変数の作成
$whitelist = array("mode", "product_name", "product_category", "product_level", "product_picture", "product_comments", "id", "path_filename");
$request = whitelist($whitelist);

$mode = $request["mode"]; // 動作モード（修正-change/削除-delete）

// フォーム初期値のセット
$form = array();
$form["id"] = $request["id"];
$form["product_name"] = $request["product_name"];
$form["product_category"] = $request["product_category"];
$form["product_level"] = $request["product_level"];
$form["product_picture"] = $request["product_picture"];
$form["product_comments"] = $request["product_comments"];


// 修正モード
if ($mode == "change") {
$stmt = $db->prepare("SELECT * FROM product WHERE id = ? LIMIT 1");
$stmt->execute(array($request["id"])); // クエリの実行
$row_post = $stmt->fetch(PDO::FETCH_ASSOC); // SELECT結果を配列に格納
  
  if ($row_post) {
    // データ取得成功時は、フォーム初期値をセット
    if ($mode == "change") {
      $form["product_name"] = $row_post["product_name"];
      $form["product_category"] = $row_post["product_category"];
      $form["product_level"] = $row_post["product_level"];
      $form["product_picture"] = $row_post["product_picture"];
      $form["product_comments"] = $row_post["product_comments"];
    }
  }
}

// 削除モード
if ($mode == "delete") {
    try {
        $db->beginTransaction();
        $stmt = $db->prepare("DELETE FROM product WHERE id = ?");
        $stmt->execute(array($request["id"]));
        $db->commit();
    } catch (PDOException $e) {
        // エラー発生時
        $db->rollBack();
        exit("クエリの実行に失敗しました（hensyu)");
    }
    header("Location: post_list.php");
    exit;
}

?>

<?php $page_title = "登録商品編集";?>
<?php require "header.php";?>
<p><a href="post_list.php">一覧へ戻る</a></p>

<div class="wrapper">
  
    <p>
      商品ID[<?php echo he($form["id"]); ?>]を修正しています
    </p>

    <form action="hensyu_confirm.php" method="post" enctype="multipart/form-data">
      <div class="detail_box">
      <input type="hidden" name="id" size="30" value="<?php echo he($form["id"]); ?>">
      <div class="detail_left">
        <label>商品画像</label><br>
          <input type="hidden" name="max_file_size" value="1000000" />
          <input type="file" size="40" name="upfile">
          <input type="hidden" name="product_picture" value="<?php echo he($form["product_picture"]); ?>">
       <p class="padding"><span class="attention">現在登録されている画像です</span></p>
        <p><?php echo he($form["product_picture"]); ?></p>
        <div class="img_picture">
          <img src=".<?php echo he($form["product_picture"]); ?>">
        </div>
      </div>
      <div class="detail_right">
      <div class="padding">
        品名<span class="attention">[必須]</span><br>
        <input type="text" name="product_name" size="30" value="<?php echo he($form["product_name"]); ?>" required>
      </div>
      <div class="padding">
        カテゴリ<span class="attention">[必須]</span><br>
        <select name="product_category" required>
          <option><?php echo he($form["product_category"]); ?></option>
          <option value="知恵の輪">知恵の輪</option>
          <option value="ルービックキューブ">ルービックキューブ</option>
          <option value="木製パズル">木製パズル</option>
          <option value="空間認識">空間認識</option>
        </select>
      </div>
      <div class="padding">
        難易度(Level)<span class="attention">[必須]</span><br>
        <select name="product_level" required>
          <option><?php echo he($form["product_level"]); ?></option>
          <script>
          for(var i = 1; i <= 5; i++){
            document.write("<option>");
            document.write(i);
            document.write("</option>");
          }
          </script>
        </select>
      </div>
      
      <div class="padding">
        商品説明<br>
        <textarea name="product_comments" rows="5" cols="20"><?php echo he($form["product_comments"]); ?></textarea>
      </div>
      <div class="padding">
        <input type="hidden" value="<?php echo rand(1,10);?>" name="from_hensyu">
        <input type="submit" name="send" value="この内容に変更する">
      </div>
      </div>
      </div>  
    </form>
  
</div>
<?php require "footer.php";?>