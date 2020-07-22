<?php session_start(); ?>
<?php require_once "system/common.php";?>

<?php

//プリペアードステートメントでSQL文の型を作る
$stmt = $db->prepare("SELECT * FROM review,product WHERE review_id = ? AND product_id = product.id");
$stmt->execute([$_REQUEST['review_id']]);

$row = $stmt->fetch();

//レビュー削除
$stmt = $db->prepare("delete from review where review_id=?");
$stmt->execute([$_REQUEST['review_id']]);


$db = NULL;


header("Location:http://puzzlesubsc.starfree.jp/puzzle/detail.php?id=".$row['id']."#review_link");

?>
