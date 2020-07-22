<?php session_start(); ?>
<?php require_once "system/common.php";?>

<?php

//プリペアードステートメントでSQL文の型を作る
$stmt = $db->prepare("insert into review(	customer_id,product_id,customer_review)values(?,?,?)");


//bindValueメソッドでパラメータをセット
$stmt->bindValue(1,$_SESSION['customer']['id']);
$stmt->bindValue(2,$_POST['id']);
$stmt->bindValue(3,$_POST['customer_review']);

//executeでクエリを実行
$stmt->execute();
$db = NULL;


header("Location:http://puzzlesubsc.starfree.jp/puzzle/detail.php?id=".$_POST['id']."#review_link");

?>
