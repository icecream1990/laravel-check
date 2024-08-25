<!DOCTYPE html>
<html lang ="ja">

<head>
  <meta charset ="utf-8">
  <title>16章課題</title>
</head>

<body>
<p>
  <?php
  class Food{
    // プロパティを設定する
    private $name;
    private $price;

    public function __construct(string $name, int $price){
      $this->name= $name;
      $this->price= $price;
    }
    public function show_price(){
      echo $this->price . '<br>';
    }
  }
 
  class Animal{
    // プロパティを設定する
    private $name;
    private $height;
    private $weight;

    public function __construct(string $name, int $height, int $weight){
      $this->name= $name;
      $this->height= $height;
      $this->weight= $weight;
    }
    public function show_height(){
      echo $this->height . '<br>';
    }
  }
  // インスタンス化する
  $food =new Food('potato',250);
  $animal = new Animal('dog',60,5000);

  print_r($food);
  echo '<br>';
  print_r($animal);
  echo '<br>';

  // メソッドにアクセスする。
  $food->show_price();
  $animal->show_height();
  ?>
</p>

</body>
</html>