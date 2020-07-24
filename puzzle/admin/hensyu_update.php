<?php
//hensyu_confirm.phpからの導線以外は、「login_error.php」へリダイレクト
/*if(empty($_POST['from_hensyu_confirm'])){
  header("Location:http://puzzlesubsc.starfree.jp/puzzle/admin/login_error.php");
}*/
?>
<?php require_once "../system/common_admin.php";?>
<?php

// ホワイトリスト変数の作成
$whitelist = array("send", "mode", "product_name", "product_category", "product_level", "product_picture", "product_comments", "id", "path_filename");

$request = whitelist($whitelist);

// 修正
$db->beginTransaction();
$stmt = $db->prepare("UPDATE product SET product_name = ?, product_category = ?, product_level = ?, product_picture = ?, product_comments = ? WHERE id = ?");

//bindValueメソッドでパラメータをセット
$stmt->bindValue(1,$request['product_name']);
$stmt->bindValue(2,$request['product_category']);
$stmt->bindValue(3,$request['product_level']);
$stmt->bindValue(4,$request['path_filename']);
$stmt->bindValue(5,$request['product_comments']);

$stmt->execute(array($request["product_name"], $request["product_category"], $request["product_level"], $request["path_filename"], $request["product_comments"], $request["id"]));

$db->commit();

header('Location:post_list.php');
?>