<!Doctype html>
<html lang="ja">
<head>
  <meta charset = "utf-8">
  <title>アルバムアップローダ</title>
  <link rel="stylesheet" href="./css/Album.css">
  <link rel="icon" type="image/vnd.microsoft.icon" href="./BackDesign/AlbumUp.ico">
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body>
  <?php
    require_once ('./php/Common/DBConnect.php');                             // DB接続用
    require_once ('./php/Main/MainControl.php');
    require_once ('./php/Main/MainView.php');

    $DBControl = new DBControl;                                              // アルバム名一覧取得クラス(Model)
    $DBView    = new DBView;
    $GetData   = null;                                                       // アルバム名の一覧を取得
    $PullData  = null;                                                       // 取得したアルバム名を1つずつ繰り返し処理で行うときの受け
    // DBエラーの場合は終了
    if ($DBControl->getError() != null) {
      echo $DBControl->getError();
      require_once ('./php/Common/ExitCode.html');
      exit;
    }

    $DBControl->setResult($DBControl->getSetDB());                           // 接続設定を取得し、Queryを投げる
    $DBView->setSqlList($DBControl->getResult());                            // Queryの結果をViewに渡す
  ?>

  <a href="./AlbumMain.php"><img src="./BackDesign/MainLogo.png" alt="トップページへ戻る" class="MainLogo"></a>
  <h2 id="Title">アルバムアップローダ</h3>
  <div style="float:left">
    <fieldset>
      <legend>登録する画像を選んでください</legend>
      <form method="POST" action="./AlbumRegister.php" enctype="multipart/form-data" id="FormCheck">
        <div class="File">
          ファイル選択
          <input type="file" value="ファイルを選択" name="UpFile" id="FileSelect">
        </div>
        <br>
        <span id="WriteFileName"></span>
        <br><br>
        アルバム名
        <div class="Custom">
          <select name="AlbumList" id="SelectList">
            <option value="NoList">アルバム名が設定されていません。</option>
              <?php
                // アルバム名の一覧をリストに格納
                $GetData = $DBView->getSqlList();
                while ($PullData = $GetData->fetch(PDO::FETCH_ASSOC)) {
              ?>
            <option value="<?php echo $PullData['AlbumName']; ?>">
              <?php echo $PullData['AlbumName']; ?></option>
                <?php } ?>
          </select>
        </div>
        <br>
        新しいアルバムを作成する場合はこちらに入力(記号不可)<br>
        <input type="text" placeholder="アルバム名を入力" name="CreateName" id="InputValue">
        <br>
        <span id="OutputValue"></span>
        <br><br><br>
        <input class="MainButton" type="submit" value="DBに登録">
      </form>
    </fieldset>
  </div>

  <fieldset>
    <legend>アップロード一覧</legend>
      <?php  
        $DBControl->setResult($DBControl->getSetDB());
        $DBView->setSqlList($DBControl->getResult());
        $GetData = $DBView->getSqlList();
        while ($PullData = $GetData->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <a href="./AlbumList.php?AlbumName=<?php echo $PullData['AlbumName']; ?>">
      <?php echo $PullData['AlbumName']; ?></a><br>
      <?php  } ?>
  </fieldset>

  <script type="text/javascript" src="./js/Main/ValueCheck.js"></script>
  <script type="text/javascript" src="./js/Main/SubmitCheck.js"></script>
  <script type="text/javascript" src="./js/Main/WriteFileName.js"></script>

</body>
</html>
