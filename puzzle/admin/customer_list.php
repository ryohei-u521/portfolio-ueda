<?php require_once "../system/common_admin.php";?>
<?php
// データの問い合わせ
$rows_post = array(); // 配列の初期化
try {
    if (isset($_REQUEST['keyword'])) {
    $stmt = $db->prepare("SELECT * FROM customer where login like ?");
    $stmt->execute(['%'.$_REQUEST['keyword'].'%']); // 検索クエリの実行
  } else {
    $stmt = $db->prepare("SELECT * FROM customer ORDER BY id DESC");
    $stmt->execute(); // クエリの実行
  }
  $rows_post = $stmt->fetchAll(); // SELECT結果を二次元配列に格納
} catch (PDOException $e) {
    // エラー発生時
    exit("クエリの実行に失敗しました(customer_list)");
}

?>
<?php $page_title = " 顧客管理";?>
<?php require "header.php";?>

<form action="customer_list.php" method="post">ログイン名検索
  <input type="text" name="keyword">
  <input type="submit" value="検索">
  <input type="hidden" name="">
  <input type="submit" value="クリア">
</form>
<hr>

    <table>
      <tr>
        <th></th>
        <th>顧客ID</th>
        <th>ログイン名</th>
        <th>パスワード</th>
        <th>名前</th>
        <th>住所</th>
        <th></th>
      </tr>
<?php
      foreach ($rows_post as $row_post) {;?>
      <tr>
        <td><a href="customer_favorite.php?mode=change&id=<?php echo he($row_post["id"]);?>">お気に入り</a></td>
        <td style="text-align: center;"><?php echo $row_post["id"];?></td>
        <td><?php echo he($row_post["login"]);?></td>
        <td><?php echo he($row_post["password"]);?></td>
        <td><?php echo he($row_post["name"]);?></td>
        <td><?php echo he($row_post["address"]);?></td>
        <!--<td><a href="customer_favorite.php?mode=delete&id=<?php// echo he($row_post["id"]);?>">削除</a></td>-->
      </tr>
<?php     }?>
    </table>

<?php require "footer.php";?>
