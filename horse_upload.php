<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="horse-upload.css">
    <link href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700;900&display=swap">
</head>
<body>
    <div class="container">
        <div class="title-section">
            <div class="subtitle">
                ＼KeMCoM企画／
            </div>
            <h1 class="title">
                みんなのマキバ
            </h1>
        </div>

        <h3 class="notice1">
            描いた馬をアップロードしよう！
        </h3>
        
        <form action="horse_uploaded.php" method="post" name="upload" enctype="multipart/form-data">
            <div class="upload">
                <input type="text" id="namebox" placeholder = "名前を入力 " name="name" size="40"><br><br>
                <input type="text" id="cmtbox" placeholder = "コメントを入力 " name="cmt" size="40"><br><br>
                <div>
                    <input type="radio" id="lf" name="lfrt" value="0" checked />
                    <label for="lf">左向き</label>
                    <input type="radio" id="rt" name="lfrt" value="1" />
                    <label for="lf">右向き</label>
                </div><br><br>
                <input type="file" id="file" name="image"><br><br>
                <button type="submit" class="button" name="upload">送信</button>
            </div>
        </form>
    </div>
</body>