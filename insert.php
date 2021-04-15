<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
 
    <ul>
        <li><a href="index.php">index.php</a></li>
        <li><a href="insert.php">insert.php</a></li>
        <li><a href="select.php">select.php</a></li>
    </ul>

<?php

require_once("funcs.php");

//1.POSTデータ取得

$b_genre_1 = $_POST['b_genre_1'];
$b_genre_2 = $_POST['b_genre_2'];
$b_name = $_POST['b_name'];
$b_url = $_POST['b_url'];
$b_remarks = $_POST['b_remarks'];

//2.DB接続
$pdo = db_conn();

//3.データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO
                        gs_20210327_table(id, b_genre_1, b_genre_2, b_name, b_url, b_remarks, indate)
                      VALUES(
                        NULL, :b_genre_1, :b_genre_2, :b_name, :b_url, :b_remarks, sysdate())"
                      );
//必ず「:」が必要

//4.バインド変数を用意（定型文）
// 数値の場合 PDO::PARAM_INT
// 数値の場合 PDO::PARAM_STR
$stmt->bindValue(':b_genre_1', $b_genre_1, PDO::PARAM_STR);
$stmt->bindValue(':b_genre_2', $b_genre_2, PDO::PARAM_STR);
$stmt->bindValue(':b_name', $b_name, PDO::PARAM_STR);
$stmt->bindValue(':b_url', $b_url, PDO::PARAM_STR);
$stmt->bindValue(':b_remarks', $b_remarks, PDO::PARAM_STR);

//5.実行
$status = $stmt->execute();

//6.データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("index.php");
}
?>

</body>
</html>