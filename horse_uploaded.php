<link rel="stylesheet" href="horse-upload.css">
<div class="title-section">
    <div class="subtitle">
        ＼KeMCoM企画／
    </div>
    <h1 class="title">
        みんなのマキバ
    </h1>
</div>

<!--送信ボタンが押された場合-->
<?php if (isset($_POST['upload']) && !empty($_FILES['image']['name'])): ?>
<?php 
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

    if (is_null($_FILES["image"])){
        echo "error: nullです";
        $message = '画像が選択されていません。';
    }else{
        $name = $_POST["name"];
        $cmt = $_POST["cmt"];
        $lfrt = $_POST["lfrt"];

        // 画像保存
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $image = uniqid(mt_rand(), true) . '.' . $fileExtension;
        $file = "img/$image";
        switch ($fileExtension) {
            case 'png':
                $img = imagecreatefrompng($fileTmpName);
                break;
            default:
                $message = '対応していない画像形式です。';
                break;
        }
        switch ($fileExtension) {
            case 'png':
                imagesavealpha($img, TRUE);
                imagepng($img, $file);
                break;
            default:
                break;
        }
        imagedestroy($img); //メモリ解放

        $sql = "INSERT INTO horse (path, name, cmt, lfrt) VALUES (:path, :name, :cmt, :lfrt)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':path', $file, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':cmt', $cmt, PDO::PARAM_STR);
        $stmt->bindValue(':lfrt', $lfrt, PDO::PARAM_STR);
        $stmt->execute();
        $message = 'アップロードが完了しました';
    }
    echo '<div class="text">';
    echo $message;
    echo '</div>';
?>
<?php endif;?>
<a href="horse_upload.php" class="btn">戻る</a>