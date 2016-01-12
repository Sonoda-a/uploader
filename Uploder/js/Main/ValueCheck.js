// アルバム名入力のテキストボックス値を取得
$('#InputValue').keyup(function() {
  if ($(this).val().match(/(<|>|&|"|'|;|:|~|`|!|@|#|\$|%|\^|\*|-|\+|=|\||,|\?|\(|\)|\/|\u005c|\u0020)/) || 
  $(this).val().length >= 30) {
    $('#OutputValue').html ("入力確認:NG");
  } else if ($(this).val().length == 0) {
    $('#OutputValue').html ("");
  } else {
    $('#OutputValue').html ("入力確認:OK");
  }
});
