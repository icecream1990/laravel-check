<?php
$dsn = 'mysql:dbname=php_book_app;host=localhost;charset=utf8mb4';
$user = 'root';
$password = 'root';

try{
  // データベースに接続する
  $pdo= new PDO($dsn,$user,$password);

  // 並びかえボタンを押した時に、その値を取得する。
  if(isset($_GET['order'])){
    $order =$_GET['order'];
  } else {
    $order = NULL;
  }

  // 検索ボタンを押した時に、その値を取得する
  if(isset($_GET['keyword'])){
    $keyword =$_GET['keyword'];
  } else{
    $keyword =NULL;
  }

  // パラメータの値(昇順・降順)によって、SQL文を変更する
  if($order ==='desc'){
    // LIKEのあとはスペースを用意する
    $sql_select ='SELECT * FROM books WHERE book_name LIKE :keyword ORDER BY updated_at DESC';
  } else{
    // LIKEのあとはスペースを用意する
    $sql_select ='SELECT * FROM books WHERE book_name LIKE :keyword ORDER BY updated_at ASC';
  }

  // SQLを用意する
  $stmt_select = $pdo->prepare($sql_select);

  // SQLのLIKEで使うための変数$keywordの前後を％で囲む
  $partial_match ="%{$keyword}%";

  // キーワードの値$partial_matchをプレースホルダ':keyword'に当てはめる、値は文字型
  $stmt_select->bindValue(':keyword',$partial_match,PDO::PARAM_STR);

  // SQLを実行する
  $stmt_select->execute();

  // SQL文の実行結果を配列で取得する
  $books = $stmt_select->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e){
  exit($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>書籍一覧</title>
  <link rel="stylesheet" href="css/style.css">

  <!-- Google Fontsの読み込み -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>

<body>
  <header>
    <nav>
      <a href="index.php">書籍管理アプリ</a>
    </nav>
  </header>
  <main>
    <article class ="books">
      <h1>書籍一覧</h1>
      <?php
      if(isset($_GET['message'])){
        // 文章は{}で囲む
        echo "<p class='success'>{$_GET['message']}</p>";
      }
      ?>
      <div class ="books-ui">
        <div>
          <!-- aタグで囲う -->
           <!-- ボタンを押した際orderのパラーメータをdescとkeywordに受け渡す -->
          <a href="read.php?order=desc&keyword=<?= $keyword?>">
            <img src="images/desc.png" alt="降順に並び替え" class="sort-img">
          </a>
          <!-- ボタンを押した際orderのパラーメータをascとkeywordに受け渡す -->
          <a href="read.php?order=asc&keyword=<?=$keyword?>">
            <img src="images/asc.png" alt="昇順に並び替え" class="sort-img">
          </a>
          <form action="read.php" method ="get" class="search-form">
            <!-- php埋め込み -->
            <input type="hidden" name="order" value="<?= $order ?>">
            <input type="text" class="search-box" placeholder="商品名で検索" name="keyword" value="<?= $keyword?>">
        </div>
        <a href= 'create.php'class="btn">書籍登録</a>
      </div>
      <table class="books-table">
        <tr>
          <th>書籍コード</th>
          <th>書籍名</th>
          <th>単価</th>
          <th>在庫数</th>
          <th>ジャンルコード</th>
          <th>編集</th>
          <th>削除</th>
        </tr>
        <?php
        foreach($books as $book){
          $table_row="
          <tr>
          <td>{$book['book_code']}</td>
          <td>{$book['book_name']}</td>
          <td>{$book['price']}</td>
          <td>{$book['stock_quantity']}</td>
          <td>{$book['genre_code']}</td>
          <td><a href='update.php?id={$book['id']}'><img src ='images/edit.png' alt='編集' class='edit-icon'></a></td>
          <td><a href='delete.php?id={$book['id']}'><img src ='images/delete.png' alt='削除' class='delete-icon'></a></td>
          </tr>
          ";
         echo $table_row;
        }
        ?>
      </table>
    </article>
  </main>
  <footer>
    <p class="copyright">&copy; 書籍管理アプリ All rights reserved.</p>
  </footer>
</body>
</html>