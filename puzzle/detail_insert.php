<?php session_start(); ?>
<?php require_once "system/common.php";?>

<?php

// ホワイトリスト変数の作成
$whitelist = array("customer_id", "product_id", "customer_review", "customer", "id");

$request = whitelist($whitelist);


//プリペアードステートメントでSQL文の型を作る
$stmt = $db->prepare("insert into review (customer_id,product_id,customer_review) values (?, ?, ?)");


//bindValueメソッドでパラメータをセット
$stmt->bindValue(1,$_SESSION['customer']['id']);
$stmt->bindValue(2,$request['id']);
$stmt->bindValue(3,$request['customer_review']);

//executeでクエリを実行
$stmt->execute();
$db = NULL;


header("Location:http://puzzlesubsc.starfree.jp/puzzle/detail.php?id=".$request['id']."#review_link");

?>
