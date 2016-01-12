<?php
  // アルバム名格納用のクラス
  class InputName {
    private $SelectName;

    public function __construct() {
      $this->SelectName = null;
    }

    // 新規または既存アルバム名を取得
    public function setInputName($NewAlbum, $SelectAlbum) {
      // 既存アルバム名から選ばれているか確認(NoListは未選択)
      if ($SelectAlbum == "NoList") {
        $this->SelectName = $NewAlbum;
      } else {
        $this->SelectName = $SelectAlbum;
      }
    }
    public function getInputName() {
      return $this->SelectName;
    }
  }


  // アルバム名ディレクトリが既に登録されているか判断し、未登録の場合は作成
  function DirCheck($Path, $AlbumName) {
    $RegistName = $Path . $AlbumName;                                            // List + 設定されたアルバム名
    $Mask       = null;                                                          // Umask値の取得

    // 存在していない場合は、ディレクトリを作成
    if (!file_exists($RegistName)) {
      $Mask = umask();                                                           // ディレクトリを作成するためにumaskの値を一時的に変更
      umask(000);
      mkdir ($RegistName, 0777);
      umask($Mask);
    }
  }

  // DBにInsertする。
  function DBIn($SetDB, $Sql, $AlbumName, $FileDirPath, $FileName, $FileSize, $ToDate) {
    $Result      = null;                                                         // SQLの結果
    $Path        = $FileDirPath . $AlbumName . '/';                              // 画像パス

    $Result      = $SetDB->prepare($Sql);
    $Result->bindValue(1, $AlbumName, PDO::PARAM_STR);
    $Result->bindValue(2, $Path,      PDO::PARAM_STR);
    $Result->bindValue(3, $FileName,  PDO::PARAM_STR);
    $Result->bindValue(4, $FileSize,  PDO::PARAM_STR);
    $Result->bindValue(5, $ToDate,    PDO::PARAM_STR);
    // 結果を返す
    return $Result;
  }

  //Seect文を発行し、格納するファイル名を決める
  function DBSel($SetDB, $Sql, $ToDate) {
    $Result      = null;                                                         // SQLの結果
    $GetRow      = null;                                                         // ファイル名(Id)
    $IdNum       = null;                                                         // データ取得用

    $Result      = $SetDB->prepare($Sql);
    $Result->bindValue(1, $ToDate,    PDO::PARAM_STR);
    $Result->execute();
    
    while ($IdNum = $Result->fetch(PDO::FETCH_ASSOC)) {
      $GetRow = $IdNum[Id];
    }
    // 結果を返す
    return $GetRow;
  }

  // 登録されたデータをディレクトリに移動
  function MoveData($TmpFile, $Path, $AlbumName, $FileName, $FileExt) {
    //拡張子のみ抜き出して、ドットを付け加える。
    $FileExt = explode(".", $FileExt);
    $FileExt[1] = "." . $FileExt[1];

    // 移動処理
    move_uploaded_file($TmpFile, $Path . $AlbumName . '/' . $FileName . $FileExt[1]);
  }

?>
