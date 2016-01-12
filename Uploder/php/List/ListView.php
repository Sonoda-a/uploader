<?php
  class ViewData {
    Private $PageTitle;
    private $AlbumData;

    function __construct() {
      $this->PageTitle = null;
      $this->AlbumData = null;
    }

    // ページのタイトルを決定(アルバム名)
    public function setTitle($AlbumName) {
      $this->PageTitle = $AlbumName;
    }
    public function getTitle() {
      return $this->PageTitle;
    }

    // SQLの実行結果データ
    public function setAlbumData($Data) {
      $this->AlbumData = $Data;
    }
    public function getAlbumData() {
      return $this->AlbumData;
    }



  }
?>
