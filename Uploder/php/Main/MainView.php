<?php
  // SQLの結果を格納
  class DBView {
    private $SqlList;

    function __construct() {
      $this->SqlList = null;
    }
    public function setSqlList($List) {
      $this->SqlList = $List;
    }
    public function getSqlList() {
      return $this->SqlList;
    }
  }
?>
