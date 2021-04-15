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
        <li><a href="login.php">login.php</a></li>
        <li><a href="idinput.php">idinput.php</a></li>
    </ul>

    <!-- Head[Start] -->
    <header>
        <p>※※全ユーザが登録可能※※</p>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>書籍DBへ格納</legend>
                <label id="b_genre_1">書籍ジャンル：</label><br>
                <label id="b_genre_2">⇒</label><br>
                <label id="b_name">書籍名：<input type="text" name="b_name"></label><br>
                <label id="b_url">書籍URL：<input type="text" name="b_url"></label><br>
                <label id="b_remarks">コメント：<br><textArea name="b_remarks" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>

    <p>※データ管理用　
    <a href="login.php">ログイン</a></p>

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

    // ※CRUD: Create（生成）、Read（読み取り）、Update（更新）、Delete（削除）
    // ユーザインタフェースが備えるべき機能（情報の参照/検索/更新）を指す用語としても使われる。
    </script>

</body>

</html>
