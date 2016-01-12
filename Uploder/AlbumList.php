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
    require_once ('./php/Common/DBConnect.php');                // DB接続用
    require_once ('./php/List/ListControl.php');
    require_once ('./php/List/ListView.php');
    require_once ('./php/List/ListModel.php');

    $DBCon      = new DBCon;                                    // DB接続クラス
    $View       = new ViewData;                                 // HTML出力系クラス
    $DBSel      = new DBSelect;                                 // Selectクラス
    $AlbumData  = null;                                         // 配列データ
    $i          = 0;                                            // カウンタ

    // DB接続エラーがあれば中断
    if ($DBSel->getError() != null) {
      echo $DBSel->getError();
      require_once ('./php/Common/ExitCode.html');
      exit;
    }

    // ページのタイトル名を渡す。
    $View->setTitle($_GET['AlbumName']);

    // 出力するデータを選定する。
    $DBSel->setResult(SelectData($DBSel->getSetDB(), $DBSel->getSql(), $View->getTitle()));

    // ControlからViewへ移動
    $View->setAlbumData($DBSel->getResult());
  ?>
  <a href="./AlbumMain.php"><img src="./BackDesign/MainLogo.png" alt="トップページへ戻る" class="MainLogo"></a>
  <h2 id="Title"><?php echo $View->getTitle() ?>のアップロード一覧</h2>

  <div id="PageMain">
    <table class="TableDesign">
      <tr>
        <th>サムネイル</th>
        <th>ファイル名</th>
        <th>サイズ(Byte)</th>
        <th>アップロード時間</th>
        <th>削除</th>
      </tr>
      <form method="GET" action="./AlbumDel.php" enctype="multipart/form-data">
      <?php
        // 出力する配列を変数に渡す。
        $AlbumData = $View->getAlbumData();
        for ($i=0; $i<count($AlbumData); $i++) {
      ?>
      <tr>
        <td><img src=" <?php echo $AlbumData[$i][1]; ?>" id="<?php echo $AlbumData[$i][2]; ?>" 
                 width="50" height="50" class="Photo"</td>
        <td><?php echo $AlbumData[$i][2]; ?></td>
        <td><?php echo $AlbumData[$i][3]; ?> Byte</td>
        <td><?php echo $AlbumData[$i][4]; ?></td>
        <td><a href="./AlbumDel.php?Id=<?php echo $AlbumData[$i][0]; ?>&Path=<?php echo $AlbumData[$i][1]; ?>">
            <?php echo $AlbumData[$i][2]; ?></a></td>
      </tr>
      <?php
        }
      ?>
      </form>
    </table>
  </div>

  <script type="text/javascript" src="./js/list/PopWindow.js"></script>

</body>
</html>
