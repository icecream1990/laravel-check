<?php

// セッションを開始する
session_start();

// POSTのメソッドでデータを取得する
$name=$_POST['employee_name'];
$age=$_POST['employee_age'];
$department=$_POST['department'];

// エラーメッセージを格納する。
$errors=[];

if(empty($name)){
  $errors[]='社員名を入力してください';
}

if(empty($age)){
  $errors[]='年齢を入力してください';
}

if(empty($errors)){
  $_SESSION['name']=$name;
  $_SESSION['age']=$age;
  $_SESSION['department']=$department;

  setcookie('name', $name, time() + 3600 );
  setcookie('email', $age, time() + 3600 );
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset ="utf-8">
  <title>webアプリ課題</title>
</head>

<body>
  <h2>入力内容をご確認ください</h2>
  <p>問題なければ「確定」、修正する場合は「キャンセル」をクリックしてください。</p>

  <table border="1">
    <tr>
      <th>項目</th>
      <th>入力内容</th>
    </tr>

    <tr>
      <td>社員名</td>
      <td><?php echo $name; ?></td>
    </tr>

    <tr>
      <td>年齢</td>
      <td><?php echo $age; ?></td>
    </tr>

    <tr>
      <td>所属部署</td>
      <td><?php echo $department; ?></td>
    </tr>

  </table>
  <p>
  <button id="confirm-btn" onclick="location.href='complete.php';">確定</button>
  <button id="cancel-btn" onclick="history.back();">キャンセル</button>
  </p>

  <?php
  if(!empty($errors)){
    // $errosに格納された配列を出力する。
    foreach($errors as $error){
      echo '<font color="red">' . $error . '</font>' . '<br>';
    }
    echo '<script> document.getElementById("confirm-btn").disabled = true; </script>';
  }
  ?>
</body>
</html>