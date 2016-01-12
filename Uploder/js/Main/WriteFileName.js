// ファイル名を表示させる
$(function() {
  var FileName = null;                                 // 選択されたファイル名を格納

  // ファイル名に変更があれば書き換える
  $('#FileSelect')[0].onchange = function() {
    // ファイル名を取得し、書き込む
    FileName   = $('#FileSelect').prop('files')[0].name;
    $('#WriteFileName').html (FileName);
  }
});

