<?php
  class DBSelect {
    private $DBCon;                                                             // DBクラスを定義
    private $SetDB;                                                             // DBに接続
    private $Sql;                                                               // SQL文を格納
    private $Result;                                                            // SQL結果の格納
    private $Error;                                                             // DBのエラーコードを格納

    function __construct() {
      try {
        $DBCon         = new DBCon;
        $this->SetDB   = new PDO($DBCon->getDsn(), $DBCon->getUsr(), $DBCon->getPass());
      } catch(PDOException $e) {
        $this->Error   = $e->getMessage();
      }
      $this->Sql       = "Select Id, Path, PhotoName, Size, PostTime From List Where AlbumName = ?";
      $this->Result    = null;
    }

    // DB接続エラー情報
    public function getError() {
      return $this->Error;
    }

    // DB接続情報(setResultとセットで使う)
    public function getSetDB() {
      return $this->SetDB;
    }
    
    // SQL文
    public function getSql() {
      return $this->Sql;
    }

    // DB実行結果
    public function setResult($AllData) {
      $this->Result = $AllData;
    }
    public function getResult() {
      return $this->Result;
    }


  }
?>
