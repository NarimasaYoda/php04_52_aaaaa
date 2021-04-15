<?php
session_start();
require_once("funcs.php");
loginCheck();

//1.POSTデータ取得
$b_genre_1 = $_POST['b_genre_1'];
$b_genre_2 = $_POST['b_genre_2'];
$b_name = $_POST['b_name'];
$b_url = $_POST['b_url'];
$b_remarks = $_POST['b_remarks'];
$id = $_POST["id"];

//2.DB接続します
$pdo = db_conn();

//3.データ登録SQL作成
$stmt = $pdo->prepare(
                "UPDATE 
                    gs_20210327_table 
                SET 
                b_genre_1 = :b_genre_1,
                b_genre_2 = :b_genre_2,
                b_name = :b_name,
                b_url = :b_url,
                b_remarks = :b_remarks,
                indate = sysdate()
                WHERE
                    id = :id 
                ; ");

// 数値の場合 PDO::PARAM_INT
// 文字の場合 PDO::PARAM_STR
$stmt->bindValue(':b_genre_1', $b_genre_1, PDO::PARAM_STR);
$stmt->bindValue(':b_genre_2', $b_genre_2, PDO::PARAM_STR);
$stmt->bindValue(':b_name', $b_name, PDO::PARAM_STR);
$stmt->bindValue(':b_url', $b_url, PDO::PARAM_STR);
$stmt->bindValue(':b_remarks', $b_remarks, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//4.データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect("select.php");
}
