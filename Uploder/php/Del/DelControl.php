<?php
  class DelPhoto {
    private $PhotoNum;                                                          // 削除対象の番号
    private $PhotoPath;                                                         // 削除対象のパス
    private $DBCon;                                                             // DBクラスを定義
    private $SetDB;                                                             // DBに接続
    private $DeleteSql;                                                         // SQL文を格納
    private $SelectSql;                                                         // SQL文を格納
    private $Result;                                                            // SQL結果の格納
    private $Error;                                                             // DBのエラーコードを格納

    function __construct() {
      $this->PhotoNum  = $_GET['Id'];                                           // 削除対象のIDを取得
      $this->PhotoPath = $_GET['Path'];                                         // 削除対象のPathを取得
      try {
        $DBCon         = new DBCon;
        $this->SetDB   = new PDO($DBCon->getDsn(), $DBCon->getUsr(), $DBCon->getPass());
      } catch(PDOException $e) {
        $this->Error   = $e->getMessage();
      }
      $this->DeleteSql = 'Delete From List Where Id = ?';
      $this->SelectSql = 'Select Path From List Where Path = ?';
      $this->Result    = null;
    }

    // DB接続エラーの場合に返す
    public function getError() {
      return $this->Error;
    }

    // 削除対象のファイル名
    public function getPhotoNum() {
      return $this->PhotoNum;
    }
    // 削除対象ファイルのパス
    public function getPhotoPath() {
      return $this->PhotoPath;
    }

    // DB接続情報
    public function getSetDB() {
      return $this->SetDB;
    }

    // SQL文
    // Delete文
    public function getDelSql() {
      return $this->DeleteSql;
    }
    // Select文
    public function getSelSql() {
      return $this->SelectSql;
    }

  }
?>
