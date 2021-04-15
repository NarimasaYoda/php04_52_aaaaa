<?php
require_once('funcs.php');

//1.DB接続
$pdo = db_conn();

$id = $_GET['id'];

//2.データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_20210327_table WHERE id=' . $id . ';');
$status = $stmt->execute();

//3.データ表示
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}
?>

<!--以下はindex.phpと同じもの(入力項目は「登録/更新」はほぼ同じになる為)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
        <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
</head>

<body>
    <ul>
        <li><a href="index.php">index.php</a></li>
        <li><a href="insert.php">insert.php</a></li>
        <li><a href="select.php">select.php</a></li>
    </ul>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>書籍DBへUpdate格納</legend>
                <label>※ 当初データ情報 :　<?= h($result['b_genre_1'])?>  ->  <?= h($result['b_genre_2'])?></label><br>
                <label id="b_genre_1">書籍ジャンル：</label><br>
                <label id="b_genre_2">⇒</label><br>
                <label id="b_name">書籍名：<input type="text" name="b_name" value="<?= h($result['b_name'])?>"></label><br>
                <label id="b_url">書籍URL：<input type="text" name="b_url" value="<?= h($result['b_url'])?>"></label><br>
                <label id="b_remarks">コメント：<br><textArea name="b_remarks" rows="4" cols="40"><?= h($result['b_remarks'])?></textArea></label><br>
                <label><input type="hidden" name="id" value="<?= $result['id']?>"></label>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>

    <!-- Main[End] -->

    <script>
    
    // ＊(1)書籍のジャンルは大分類と小分類（詳細）に分ける
    // ＊(2)大分類ジャンルをセットしたら、小分類ジャンルのラジオボタンが出現するように設定。

    // ＊(3)まず、ジャンルを配列で持つこととする。
    // ary[*][0]は大分類ジャンル、ary[*][1,2,3‥‥]は小分類ジャンル。
    // [大項目⇒"文芸",小項目1⇒"小説",小項目2⇒"エッセイ",小項目3⇒"評論"‥‥]ということ。

    let book_genre_ary =[
        ["文芸","小説","エッセイ","評論","詩","短歌","俳句","戯曲"],
        ["実用書","料理","育児","スポーツ","趣味","旅行","地図"],
        ["ビジネス書","経済学","経営学","マーケティング","税務会計","金融"],
        ["児童書","絵本","学習図鑑","学習漫画","学習用の教材"],
        ["学習参考書","小・中学生の学習参考書","高校生の学習参考書","大学受験参考書","各試験","各資格取得"],
        ["専門書","医学書","学術書","美術書","アート関連"],
        ["コミック・雑誌","単行本","月刊雑誌","週刊雑誌"]
    ]; 

    // ＊(4)ラジオボタンの設定のFunction。大分類と小分類のFunctionはまとめられないので、二つ作成。
    function selectionCreate_1(type_name,name,items){
        let str ="";
        for(let i=0; i<items.length ;i++){
            str += '<input type="'+type_name+'" name="'+name+'" value="'+items[i][0]+'" id="id_'+i+'">'+items[i][0];
        }
        return str;
    }

    function selectionCreate_2(type_name,name,items,num){
        let str ="⇒書籍ジャンル（詳細）：";
        for(let i=0; i<items[num].length-1 ;i++){
            str += '<input type="'+type_name+'" name="'+name+'" value="'+items[num][i+1]+'">'+items[num][i+1];
        }
        return str;
    }


    // ＊(5)大分類ジャンルのラジオボタンが変化したときに、小分類のラジオボタンが出現する。
    let b_genre_1_h = selectionCreate_1("radio","b_genre_1",book_genre_ary);
    $("#b_genre_1").append(b_genre_1_h);


    $('input[name="b_genre_1"]').change(function(){
        let j = 0;
        while(j < book_genre_ary.length){
            if($('[id=id_'+j+']').prop('checked')){
                let b_genre_2_h = selectionCreate_2("radio","b_genre_2",book_genre_ary,j);
                $("#b_genre_2").html(b_genre_2_h);
            }
            j++;
            }
    })

    // ＊(6)大分類のラジオボタンを現状のデータでチェックする
    // book_genre_ary[*][0];
    let book_genre_1_sql = 0;
    for(let i=0; i<book_genre_ary.length ;i++){
        if (book_genre_ary[i][0] == "<?= $result['b_genre_1']?>"){
            book_genre_1_sql = i;
        }
    }
    let elements = document.getElementsByName("b_genre_1");
    elements[book_genre_1_sql].checked = true;
    
    // ＊(7)小分類のラジオボタンを現状のデータでチェックする
    // book_genre_ary[*][1,2,3‥‥]
    let bg1s = book_genre_1_sql;
    let b_genre_2_h_sql = selectionCreate_2("radio","b_genre_2",book_genre_ary,bg1s);
    $("#b_genre_2").html(b_genre_2_h_sql);

    let book_genre_2_sql = 0;
    for(let i=0; i<book_genre_ary[bg1s].length-1 ;i++){
        if (book_genre_ary[bg1s][i+1] == "<?= $result['b_genre_2']?>"){
            book_genre_2_sql = i;
        }
    }
    let elements_2 = document.getElementsByName("b_genre_2");
    elements_2[book_genre_2_sql].checked = true;
    
    </script>

</body>

</html>

