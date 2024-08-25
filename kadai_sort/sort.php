<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>PHP基礎編</title>
</head>

<body>
    <p>
        <?php

        $nums = [15,4,18,23,10];

        // 関数名 sort_2way, 引数$array,$orderに設定
        function sort_2way($array,$order){
        if($order){
            echo '昇順にソートします。<br>';
            sort($array);
        }else{
            echo '降順にソートします。<br>';
            rsort($array);
        }
        foreach ($array as $arr){
         echo $arr . '<br>';
        }
        }
        
        // 関数の呼び出しを記述する
        sort_2way($nums,true);
        sort_2way($nums,false);
        ?>
    </p>
</body>

</html>

