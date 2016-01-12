<?php
  class DBCon {
    private $Dsn;
    private $Usr;
    private $Pass;

    function __construct() {
      $this->Dsn   = 'mysql:host=localhost;dbname=Album;charset=utf8';
      $this->Usr   = 'root';
      $this->Pass  = ‘root’;
    }

    public function getDsn() {
      return $this->Dsn;
    }
    public function getUsr() {
      return $this->Usr;
    }
    public function getPass() {
      return $this->Pass;
    }
  }
?>
