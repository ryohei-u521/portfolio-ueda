<?php require_once "../system/common_admin.php";?>
<?php

// ホワイトリスト変数の作成
$whitelist = array("product_name", "product_category", "product_level", "product_picture", "product_comments", "id", "path_filename");

$request = whitelist($whitelist);


$stmt = $db->prepare("INSERT INTO product (product_name, product_category, product_level, product_picture, product_comments) VALUES (?, ?, ?, ?, ?)");
      
 //bindValueメソッドでパラメータをセット
$stmt->bindValue(1,$request['product_name']);
$stmt->bindValue(2,$request['product_category']);
$stmt->bindValue(3,$request['product_level']);
$stmt->bindValue(4,$request['path_filename']);
$stmt->bindValue(5,$request['product_comments']);

//executeでクエリを実行
$stmt->execute();
$pdo = NULL;

header('Location:edit_insert_after.php');
?>