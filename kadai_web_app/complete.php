<?php
// セッションを開始する
session_start();
// セッションに保存された情報を取得する。
// 変数名　＝条件式? trueの時：falseの時(条件の設定は必須)
$name= isset($_SESSION['name']) ? $_SESSION['name']:'名無し';
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset ="utf-8">
  <title>webアプリ課題</title>
</head>

<body>
  <h2>登録が完了しました。</h2>
  <p><?php echo $name; ?>様の社員情報がデータベースに保存されました。</p>
  <button id="back-btn" onclick="location='form.php';">戻る</button>
</body>

<html>