<?php
// SESSION開始、funcs.php、LoginCheck
session_start();
require_once("funcs.php");
loginCheck();

//1.DB接続
$pdo = db_conn();

//2.データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_20210327_table");
$status = $stmt->execute();

//3.データ表示
$result_T = ["id","b_genre_1","b_genre_2","b_name","b_url","b_remarks","indate"]; //tableの簡略化

// $view = "";
if ($status == false) {
    query_error($stmt);
}else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<p>';
        // $view .= '<a href="delete.php?id=' . h($result['id']) . '" onclick = conf()>[削除]';//※
        $view .= '<a href="#id_' . h($result['id']) . '" id ="id_' . h($result['id']) . '">[削除]';
        $view .= '</a>';

        $view .= '<a href="detail.php?id=' . h($result[$result_T[0]]) . '">';

        // $view .= h($result[$re[0]]).' ';
        $view .= h($result[$result_T[1]]).' ';
        $view .= h($result[$result_T[2]]).' ';
        $view .= h($result[$result_T[3]]).' ';
        $view .= h($result[$result_T[4]]).' ';
        $view .= h($result[$result_T[5]]).' ';
        $view .= h($result[$result_T[6]]).' ';
        $view .= '</a>';
        $view .= '</p>';
    }
}

// ＊＊＊ドーナツチャート作成＊＊＊
// ＊(1)まず、書籍のジャンルだけSelectでデータを抽出。b_aryの配列データとして取得
$stmt = $pdo->prepare("SELECT * FROM gs_20210327_table");
$status = $stmt->execute();

$b_ary = array();
if ($status == false) {
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . print_r($error, true));
}else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        array_push($b_ary,$result["b_genre_1"]);
    }
}

// ＊(2)次にindex.phpでラジオボタンを設定した書籍の大項目の配列を設定。
// ＊(3)$book_genre_1_ary =["文芸"＝？件,"実用書"＝？件,"ビジネス書"＝？件,"児童書"＝？件,"学習参考書"＝？件,
// "専門書"＝？件,"コミック・雑誌"＝？件]; を計算する。
// ＊(4)？件の各要素が$C、？、？・・・の配列が$answer_ary。
$book_genre_1_ary =["文芸","実用書","ビジネス書","児童書","学習参考書","専門書","コミック・雑誌"]; //配列0～6
$answer_ary = array(); //配列0～6

for($i=0 ; $i < count($book_genre_1_ary) ; $i++){
    $c=0;
    for($j=0 ; $j < count($b_ary) ; $j++){
        if ($book_genre_1_ary[$i] == $b_ary[$j]){
            $c++;
        }
    }
    array_push($answer_ary,$c);
}

// ＊(5)名称の短縮化(<Script>へ移管しやすいように)
$b = $book_genre_1_ary;
$a = $answer_ary;


// echo '<pre>';
// var_dump($c);
// echo '</pre>';

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>書籍データ表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:14px;}</style>
<script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
</head>
<body id="main">
<!-- Head[Start] -->
    <ul>
        <li><a href="index.php">index.php</a></li>
        <li><a href="insert.php">insert.php</a></li>
        <li><a href="select.php">select.php</a></li>
    </ul>

<header>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">書籍登録へ</a>
        </div>
    </div>
    </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
    <div>
        <div ><?= $view ?></div>
    </div>

    <p>※データ管理用　
    <a href="logout.php">ログアウト</a></p>


    <div class="chart_container" style="position:absolute; top:200px; left:700px; width:500px">
        <canvas id="myChart" style = "border: 1px solid blue"></canvas>
    </div>

<script>
	// 削除確認

    function deleteConfirm(num){
    let j = num
    let btn = document.getElementById('id_'+j);
        btn.addEventListener('click', function() {
        let result = window.confirm('OK?');
        if( result ) {
            window.location.href = "delete.php?id="+j;
        }
        else {
        }
    })
    }

    deleteConfirm(8);
    deleteConfirm(9);
    deleteConfirm(10);
    deleteConfirm(11);
    deleteConfirm(12);
    deleteConfirm(13);
    deleteConfirm(14);
    deleteConfirm(15);
    deleteConfirm(16);
    deleteConfirm(17);
    deleteConfirm(18);
    deleteConfirm(19);
    deleteConfirm(20);
    deleteConfirm(21);
    deleteConfirm(22);
    deleteConfirm(23);
    deleteConfirm(24);
    deleteConfirm(25);
    deleteConfirm(26);
    deleteConfirm(27);
    deleteConfirm(28);
    deleteConfirm(29);
    deleteConfirm(30);
    deleteConfirm(31);
    deleteConfirm(32);
    deleteConfirm(33);
    deleteConfirm(34);
    deleteConfirm(35);
    deleteConfirm(36);
    deleteConfirm(37);
    deleteConfirm(38);
    deleteConfirm(39);
    deleteConfirm(40);
    deleteConfirm(41);
    deleteConfirm(42);
    deleteConfirm(43);
    deleteConfirm(44);
    deleteConfirm(45);
    deleteConfirm(46);
    deleteConfirm(47);
    deleteConfirm(48);
    deleteConfirm(49);
    deleteConfirm(50);
    deleteConfirm(51);
    deleteConfirm(52);
    deleteConfirm(53);
    deleteConfirm(54);
    deleteConfirm(55);
    deleteConfirm(56);
    deleteConfirm(57);
    deleteConfirm(58);
    deleteConfirm(59);
    deleteConfirm(60);
    deleteConfirm(61);
    deleteConfirm(62);
    deleteConfirm(63);
    deleteConfirm(64);
    deleteConfirm(65);
    deleteConfirm(66);
    deleteConfirm(67);
    deleteConfirm(68);
    deleteConfirm(69);
    deleteConfirm(70);
    deleteConfirm(71);
    deleteConfirm(72);
    deleteConfirm(73);
    deleteConfirm(74);
    deleteConfirm(75);
    deleteConfirm(76);
    deleteConfirm(77);
    deleteConfirm(78);
    deleteConfirm(79);
    deleteConfirm(80);
    deleteConfirm(81);
    deleteConfirm(82);
    deleteConfirm(83);
    deleteConfirm(84);
    deleteConfirm(85);
    deleteConfirm(86);
    deleteConfirm(87);
    deleteConfirm(88);
    deleteConfirm(89);
    deleteConfirm(90);
    deleteConfirm(91);
    deleteConfirm(92);
    deleteConfirm(93);
    deleteConfirm(94);
    deleteConfirm(95);
    deleteConfirm(96);
    deleteConfirm(97);
    deleteConfirm(98);
    deleteConfirm(99);
    deleteConfirm(100);

// ※本当は下記のようにForループで書きたい。でも、Qiitaで「即時関数」といった記載があり、試してみるが
// どうしてもできない。
// ※また、deleteConfirmを実行すると、256行目のChartを読み込まない。
    for(let i=0; i <= 100; i++){
        // (function(n){
        //     deleteConfirm(n);
        // })(i);
        
    }
 



    // Chart
	const can = $("#myChart");
	
    //＊(6)phpの配列そのものを、scriptに持ち込めない。各要素毎にphp⇒scriptに受け渡す。
    const label_ary = ["<?= h($b[0]) ?>","<?= h($b[1]) ?>","<?= h($b[2]) ?>","<?= h($b[3]) ?>",
                        "<?= h($b[4]) ?>","<?= h($b[5]) ?>","<?= h($b[6]) ?>"];
    const data_ary  = [<?= h($a[0]) ?>,<?= h($a[1]) ?>,<?= h($a[2]) ?>,<?= h($a[3]) ?>,
                        <?= h($a[4]) ?>,<?= h($a[5]) ?>,<?= h($a[6]) ?>];

    // カラーの設定
    const color_ary = ["#ff4b00","#fff100","#03af7a","#005aff","#4dc4ff","#ff8082","#f6aa00"]
    
    new Chart(can, {
  	type: "doughnut",
		data: {
            labels: label_ary,  //例として["赤", "青", "黄色"],
            datasets: [{
					data: data_ary, //[50, 50, 100],
					backgroundColor: color_ary
				}]
		},
        options: {
            title: {
                display: true,
                text: '書籍ジャンルの分布'
            }
        }
	});
    
</script>

<!-- Main[End] -->

</body>
</html>
