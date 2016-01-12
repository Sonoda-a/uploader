<?php
  class DBControl {
    private $DBCon;
    private $SetDB;
    private $Sql;
    private $Result;
    private $Error;

    function __construct() {
      try {
        $DBCon = new DBCon;
        $this->SetDB   = new PDO($DBCon->getDsn(), $DBCon->getUsr(), $DBCon->getPass());
      } catch(PDOException $e) {
        $this->Error   = $e->getMessage();
      }
      $this->Sql       = 'Select AlbumName From List Group By AlbumName';
      $this->Result    = null;
    }

    // DB接続時にエラーが発生した場合はこの中にエラーコードが格納される
    public function getError() {
      return $this->Error;
    }

    // DB接続情報(setResultとセットで使う)
    public function getSetDB() {
      return $this->SetDB;
    }

    // 接続情報を$Queryにしてqueryを実行(このままだとアロー演算子が2つになってエラーとなるため)
    public function setResult($SqlResult) {
      $this->Result = $SqlResult->query($this->Sql);
    }

    // 実行されたqueryを渡す
    public function getResult() {
      return $this->Result;
    }
  }
?>
