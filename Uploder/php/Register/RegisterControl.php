<?php
  class UpList {
    private $AlbumName;                                                         // 新規または既存のアルバム名を取得
    private $FileName;                                                          // アップロード対象のアルバム名を取得
    private $FileSize;                                                          // アップロード対象のファイルサイズを取得
    private $TmpFile;                                                           // 一次的な画像データを格納
    private $FileDirPath;                                                       // 格納するディレクトリのパスを格納
    private $ToDate;                                                            // 投稿する日付を格納

    public function __construct() {
      $this->AlbumName   = null;
      $this->FileName    = $_FILES['UpFile']['name'];
      $this->FileSize    = $_FILES['UpFile']['size'];
      $this->TmpFile     = $_FILES['UpFile']['tmp_name'];
      $this->FileDirPath = './List/';
      $this->ToDate      = date('Y-m-d H:i:s');
    }
    
    // アルバム名の設定
    public function setAlbumName($ChooseAlbum) {
      $this->AlbumName = $ChooseAlbum;
    }
    public function getAlbumName() {
      return $this->AlbumName;
    }
    
    // ファイル名の取得
    public function getFileName() {
      return $this->FileName;
    }

    // ファイルサイズの取得
    public function getFileSize() {
      return $this->FileSize;
    }

    // 一次ファイル名の取得
    public function getTmpFile() {
      return $this->TmpFile;
    }

    // ファイルパスの取得
    public function getFileDirPath() {
      return $this->FileDirPath;
    }

    // DBに投稿する日付
    public function getToDate() {
      return $this->ToDate;
    }
  }

  class DBInsert {
    private $DBCon;                                                             // DBクラスを定義
    private $SetDB;                                                             // DBに接続
    private $Sql;                                                               // SQL文を格納
    private $Result;                                                            // SQL結果の格納
    private $Error;                                                             // 接続時にエラーが発生した場合はこちら

    function __construct() {
      try {
        $DBCon = new DBCon;
        $this->SetDB   = new PDO($DBCon->getDsn(), $DBCon->getUsr(), $DBCon->getPass());
      } catch(PDOException $e) {
        $this->Error   = $e->getMessage();
      }
      $this->Sql       = "Insert Into List (AlbumName, Path, PhotoName, Size, PostTime) values (?, ?, ?, ?, ?)";
      $this->Result    = null;
      $this->Error     = null;
    }
    
    // エラーコードの格納
    public function getError() {
      return $this->Error;
    }

    // DB接続情報
    public function getSetDB() {
      return $this->SetDB;
    }

    // SQL文
    public function getSql() {
      return $this->Sql;
    }

    // 作成されたクエリを受け取り・渡し
    public function setResult($Result) {
      $this->Result = $Result;
    }
    public function getResult() {
      return $this->Result;
    }

  }

  class DBSelect {
    private $DBCon;                                                             // DBクラスを定義
    private $SetDB;                                                             // DBに接続
    private $Sql;                                                               // SQL文を格納
    private $Result;                                                            // SQL結果の格納

    function __construct() {
      $DBCon         = new DBCon;
      $this->SetDB   = new PDO($DBCon->getDsn(), $DBCon->getUsr(), $DBCon->getPass());
      $this->Sql     = "Select Id From List Where PostTime = ?";
      $this->Result  = null;
    }

    // DB接続情報
    public function getSetDB() {
      return $this->SetDB;
    }

    // SQL文
    public function getSql() {
      return $this->Sql;
    }

    // Select結果
    public function setResult($Result) {
      $this->Result = $Result;
    }
    public function getResult() {
      return $this->Result;
    }
  }
?>
