<?php
$horses0 = [ //テスト用データ
    [
        'id' => 0,
        'name' => 'ぽー',
        'img' => 'img/uma0.png',
        'comment' => '今年はxxを頑張る',
        'direction' => 'right'
    ],
    [
        'id' => 1,
        'name' => 'ぽー１',
        'img' => 'img/uma3.png',
        'comment' => 'ooの展示が好きだった',
        'direction' => 'left'
    ],
    [
        'id' => 2,
        'name' => 'ぽー２',
        'img' => 'img/uma4.png',
        'comment' => 'お腹すいた',
        'direction' => 'left'
    ],
    [
        'id' => 3,
        'name' => 'りこう',
        'img' => 'img/uma5.png',
        'comment' => '慶應理工に合格する！',
        'direction' => 'left'
    ],
    [
        'id' => 4,
        'name' => 'ぴんく',
        'img' => 'img/uma6.png',
        'comment' => '幸せになりたい。',
        'direction' => 'right'
    ],
    [
        'id' => 5,
        'name' => 'すかい',
        'img' => 'img/uma7.png',
        'comment' => '5000兆円欲しい！',
        'direction' => 'right'
    ]
];
// DBからデータ取得
$host = "mysql80.kemco.sakura.ne.jp";
$dbName = "kemco_uma2026";
$username = "kemco_uma2026";
$password = "h76-id_z";
$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    echo $e->getMessage();
}
$sql = 'SELECT * FROM horse';
$stmt = $dbh->prepare($sql);
try {
    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}
$horses = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = count($horses);

if (isset($_GET['ajax'])) {
    header('Content-Type: application/json');
    echo json_encode($horses);
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="houboku_style.css" type="text/css" rel="stylesheet">
    <link rel="preload" href="img/mita.jpg" as="image">
    <link rel="preload" href="img/hiyoshi.jpg" as="image">
    <link rel="preload" href="img/yagami.jpg" as="image">
    <link rel="preload" href="img/shinano.jpg" as="image">
    <link rel="preload" href="img/sfc.jpg" as="image">
</head>
<body>
    <div class="back-switch">
        <p id="back-text">＼放牧するキャンパスを選択／</p>
        <div class="back-btn">
            <button id=btn0 onclick="ChangeToMita()">三田</button>
            <button id=btn0 onclick="ChangeToHiyoshi()">日吉</button>
            <button id=btn0 onclick="ChangeToYagami()">矢上</button>
            <button id=btn0 onclick="ChangeToShinano()">信濃町</button>
            <button id=btn0 onclick="ChangeToSfc()">SFC</button>
        </div>
    </div>
    <div class="field">
        <audio id="crySound" src="audio/cry01.mp3"></audio>
        <?php 
        for ($i=0; $i < count($horses); $i++){ ?>
            <div class="horse
            <?php echo ($horses[$i]['lfrt'] === 0 ? 'walk-left' : 'walk-right'); ?>"
            style="left:<?php echo rand(-100, 100); ?>vw; bottom:<?php echo rand(0, 15); ?>vh;"
            data-name="<?php echo htmlspecialchars($horses[$i]['name']); ?>"
            data-img="<?php echo htmlspecialchars($horses[$i]['path']); ?>" 
            data-comment="<?php echo htmlspecialchars($horses[$i]['cmt']); ?>">

                <div class="bubble">[<?php echo $horses[$i]['name']; ?>]<br><?php echo $horses[$i]['cmt']; ?></div>
                <img src="<?php echo $horses[$i]['path']; ?>" alt="<?php echo $horses[$i]['name']; ?>" class="horse-img"/>
            </div>
        <?php 
        } ?>
    </div>

    <!-- 馬クリック時に表示するモーダル（現在非表示） -->
    <div id="popup" class="modal">
        <div class="modal-content">
            <span id="close-btn">&times;</span>
            <img id="popup-img" src="" alt="">
            <h1 id="popup-name"></h1>
            <h2 id="popup-comment"></h2>
        </div>
    </div>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="houboku.js"></script>    
