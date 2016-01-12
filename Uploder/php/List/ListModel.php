<?php
  function SelectData($SetDB, $Sql, $AlbumName) {
    $Result    = null;                                                // SQL実行結果
    $GetData   = null;                                                // SQL結果受け取り
    $AlbumData = null;                                                // SQL結果の格納
    $Cnt       = 0;                                                   // ループカウンタ
    $Path      = null;                                                // 画像パス
    $Ext       = null;                                                // 拡張子

    // SQLの実行
    $Result  = $SetDB->prepare($Sql);
    $Result->bindValue(1, $AlbumName, PDO::PARAM_STR);
    $Result->execute();

    // 結果を受け取る
    while ($GetData = $Result->fetch(PDO::FETCH_ASSOC)) {
      // 拡張子を取得し、画像ファイルまでのパスを作成
      $Ext = explode(".", $GetData[PhotoName]);
      $Path = $GetData[Path] . $GetData[Id] . "." . $Ext[1];
      // データ格納
      $AlbumData[$Cnt][0] = $GetData[Id];                             // Id(画像ファイル名)
      $AlbumData[$Cnt][1] = $Path;                                    // 画像ファイルが格納されているパス
      $AlbumData[$Cnt][2] = $GetData[PhotoName];                      // 画像ファイル名変換前(格納時にファイル名をIdにしている)
      $AlbumData[$Cnt][3] = $GetData[Size];                           // 画像サイズ
      $AlbumData[$Cnt][4] = $GetData[PostTime];                       // アップロードした日時
      $Cnt++;
    }

    // 結果を返す
    return $AlbumData;
  }
?>
