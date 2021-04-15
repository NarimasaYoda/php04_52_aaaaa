<?php
//ほぼ定型文です。

//必ずsession_startは最初に記述
session_start();

//SESSIONを初期化（空っぽにする）
//空の配列を作成する
$_SESSION = array();

//Cookieに保存してある"SessionIDの保存期間を過去にして破棄
//マイナス42000は即座に対応するということ。
if (isset($_COOKIE[session_name()])) { //session_name()は、セッションID名を返す関数
    setcookie(session_name(), '', time() - 42000, '/');
}

//サーバ側でのセッションIDの破棄
//$SESSIONの中身、サーバーのセッションの中身をともにないものにして、削除を行う。
session_destroy();

//処理後、index.phpへリダイレクト
header("Location: login.php");
exit();
