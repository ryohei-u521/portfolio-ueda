<?php session_start(); ?>
<?php $page_title = "お客様情報ページ";?>
<?php require_once "system/common.php";?>
<?php require 'header.php'; ?>

<?php

// ホワイトリスト変数の作成
$whitelist = array("name", "address", "login", "password", "customer", "id");

$request = whitelist($whitelist);

//ログイン名重複チェック
$stmt = $db->prepare('select * from customer where login=?');
$stmt->execute([$request['login']]);

//顧客情報の更新・登録
if (empty($stmt->fetchAll())) {
		$stmt = $db->prepare('insert into customer values(null,?,?,?,?)');
		$stmt->execute([
      $request['name'], $request['address'],
      $request['login'], $request['password']]);
		echo 'お客様情報を登録しました。';
} else {
	echo 'ログイン名がすでに使用されていますので、変更してください。';
  echo '<button type="button" onclick=history.back()>戻って修正する</button>';
}
?>

<?php require 'footer.php'; ?>