<!Doctype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>データ登録処理</title>
  <link rel="stylesheet" href="./css/Album.css">
  <link rel="icon" type="image/vnd.microsoft.icon" href="./BackDesign/AlbumUp.ico">
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
  <?php
    require_once ('./php/Common/DBConnect.php');                                    // DB接続用
    require_once ('./php/Register/RegisterControl.php');
    require_once ('./php/Register/RegisterModel.php');

    echo '<br><br><br>';
    // 変数定義
    $InputName = new InputName;                                                     // アルバム名設定クラス
    $DBCon     = new DBCon;                                                         // DB接続クラス
    $UpList    = new UpList;                                                        // POSTデータ格納クラス
    $DBInsert  = new DBInsert;                                                      // DB格納クラス
    $DBSelect  = new DBSelect;                                                      // DBデータ取得クラス
    $Done      = null;                                                              // DB操作結果

    // DB接続にエラーが発生している場合は、始めに知らせる。
    if ($DBInsert->getError != null) {
      echo $DBInsert->getError();
      require_once ('./php/Common/ExitCode.html');
      exit;
    }

    // 新規または既存アルバム名を取得(Model→Control)
    $InputName->setInputName(htmlspecialchars($_POST['CreateName']), $_POST['AlbumList']);
    $UpList->setAlbumName($InputName->getInputName());

    // 新規アルバム名の場合はディレクトリを作成
    DirCheck($UpList->getFileDirPath(), $UpList->getAlbumName());

    // DBにデータを登録
    /// 登録データをセット
    $DBInsert->setResult(DBIn($DBInsert->getSetDB(), $DBInsert->getSql(), $UpList->getAlbumName(), 
                              $UpList->getFileDirPath(), $UpList->getFileName(), $UpList->getFileSize(), $UpList->getToDate()));
    /// 登録データを実行
    $Done = $DBInsert->getResult();
    $Done->execute();

    // ファイル名をId名にするために、Idを取得する。
    /// Select文の作成
    $DBSelect->setResult(DBSel($DBSelect->getSetDB(), $DBSelect->getSql(), $UpList->getToDate()));

    // 登録されたデータをディレクトリに移動
    MoveData($UpList->getTmpFile(), $UpList->getFileDirPath(), $UpList->getAlbumName(), $DBSelect->getResult(), $UpList->getFileName());
  ?>
  <script type="text/javascript" src="./js/Regist/MainBack.js"></script>
</body>
</html>
