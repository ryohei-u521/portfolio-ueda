<?php require_once "../system/common_admin.php";?>
<?php
// ホワイトリスト変数の作成
$whitelist = array("product_name", "product_category", "product_level", "product_picture", "product_comments", "id", "path_filename");

$_POST = whitelist($whitelist);


$stmt = $db->prepare("INSERT INTO product (product_name, product_category, product_level, product_picture, product_comments) VALUES (?, ?, ?, ?, ?)");
      
 //bindValueメソッドでパラメータをセット
$stmt->bindValue(1,$_POST['product_name']);
$stmt->bindValue(2,$_POST['product_category']);
$stmt->bindValue(3,$_POST['product_level']);
$stmt->bindValue(4,$_POST['path_filename']);
$stmt->bindValue(5,$_POST['product_comments']);

//executeでクエリを実行
$stmt->execute();
$pdo = NULL;

header('Location:edit_insert_after.php');
?>