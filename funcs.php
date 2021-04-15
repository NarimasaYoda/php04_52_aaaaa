<?php
//共通に使う関数を記述

//XSS対応（echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続のFunction
function db_conn(){
    try {
        $db_name = "gs_db_1";    //データベース名 課題では"gs_db_1"使用
        $db_host = "localhost"; //DBホスト
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:' . $e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
}

//ErrorQueryエラー関数：query_error($stmt)
function query_error($stmt){
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . print_r($error, true));
}


//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: ".$file_name);
    exit();
}

//ログインチェック処理 "session_regenerate_id(true);"
function loginCheck(){
    if ($_SESSION["chk_ssid"] != session_id()){
        exit("LOGIN ERROR");
    }else{
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();
    }
}

//Vol_01:複数選択可能項目のaryデータをコンマ区切りに変える
function arySet($str){
    $str_ary ="";
    if(is_array($str)){
        foreach($str as $val){
            $str_ary .= "{$val}, ";
        }
    }
    return $str_ary;   
}

//Vol_02_1:textファイルのデータを2次元配列として取得
function questionnaireMatrixSET($str){    //$str : "data/data1.txt"など
    $q_matrix = array();
    $file = fopen($str,"r");
    while($txt = fgets($file)){
        $q_array = explode('/',$txt);
        array_push($q_matrix, $q_array);
    }
    return $q_matrix;
}

//Vol_02_2:textファイルのデータを2次元配列として取得(福島先生)
//＊＊＊$q_array_1だと、変数が上書きされてしまう。$q_array_1[] = 'hogehoge';と"[]"をいれると＊＊＊
//＊＊＊$q_array_1にガンガン追加されていくので、この方法が良いのかな〜と。＊＊＊
function questionnaireMatrixSET_2($str){    //$str : "data/data1.txt"など
    $q_matrix = [];
    $file = fopen($str,"r");
    while($txt = fgets($file)){
        $q_matrix[] = explode('/',$txt);
    }
    return $q_matrix;
}

// Vol_03:配列の表示方法
// $q = questionnaireMatrixSET_2('data/data1.txt');
// echo '<pre>';
// var_dump($q);
// echo '</pre>';
