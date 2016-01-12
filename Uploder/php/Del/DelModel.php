<?php
  // DBのDelete文を実行
  function DeleteDB($SetDB, $Sql, $Num) {
    $Result      = null;                                   // SQLの結果

    $Result      = $SetDB->prepare($Sql);
    $Result->bindValue(1, $Num,            PDO::PARAM_INT);
    $Result->execute();
  }

  // 格納している画像データを削除
  function DeleteFile($Path) {
    system("rm -rf {$Path}");
  }

  // ディレクトリの削除
  function DeleteDir($SetDB, $Sql, $Path) {
    $Relative    = null;                                   // 相対パスの格納
    $Result      = null;                                   // SQLの結果
    $GetData     = null;                                   // Select結果の受け取り
    $Cnt         = 0;                                      // Selectの件数

    // ファイル名まで格納されている変数なので、ファイル名の箇所は削除
    $Path        = explode("/", $Path);
    $Relative    = $Path[0] . "/" . $Path[1] . "/" . $Path[2];

    // Select文を発行して、件数を確認(本当はCountが使えたら便利なのになぁ・・・)
    $Result      = $SetDB->prepare($Sql);
    $Result->bindValue(1, $Relative . "/", PDO::PARAM_STR);
    $Result->execute();

    // 件数確認
    while ($GetData = $Result->fetch(PDO::FETCH_ASSOC)) {
      $Cnt++;
    }
    
    // 0件であれば削除
    if ($Cnt == 0) {
      system("rm -rf {$Relative}");                        // 削除実行
    }
  }

?>
