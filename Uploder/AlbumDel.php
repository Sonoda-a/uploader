<!Doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>アルバムデータ</title>
  <link rel="stylesheet" href="./css/Album.css">
  <link rel="icon" type="image/vnd.microsoft.icon" href="./BackDesign/AlbumUp.ico">
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>

  <?php
    require_once ('./php/Common/DBConnect.php');                             // DB接続用
    require_once ('./php/Del/DelControl.php');
    require_once ('./php/Del/DelModel.php');
    echo '<br><br><br>';

    // DBエラーの場合は終了させる。
    if ($DelPhoto->getError != null) {
      echo $DelPhoto->getError;
      require_once ('./php/Common/ExitCode.html');
      exit;
    }
    $DelPhoto = new DelPhoto();                                              // データ削除系クラス
    $Judge    = false;                                                       // 遷移先判定

    // デバッグ(番号)
    //var_dump($DelPhoto->getPhotoNum());

    // 削除系 ////////////////////////////////
    // DBデータ削除
    DeleteDB($DelPhoto->getSetDB(), $DelPhoto->getDelSql(), $DelPhoto->getPhotoNum());
    // 画像データ削除
    DeleteFile($DelPhoto->getPhotoPath());
    // ディレクトリに画像がなければディレクトリも削除
    DeleteDir($DelPhoto->getSetDB(), $DelPhoto->getSelSql(), $DelPhoto->getPhotoPath());
    
  ?>

  <script type="text/javascript" src="./js/Del/MainBack.js"></script>
</body>
</html>
