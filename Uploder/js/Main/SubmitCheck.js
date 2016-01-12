// テキストに正常な値が入力された時に送信できるようにする。
$('#FormCheck').submit(function() {
  var CheckFile    = $('#WriteFileName').text();                                     // ファイル名を取得
  var DirPath      = null;                                                           // パスとファイル名を格納

  // アルバムパスを取得。Path + FileName
  DirPath = GetListPath(CheckFile);

  // 下記エラー確認後、問題がなければPostされる
  // アルバム名の入力がOKまたは、既存のリストからアルバム名を選択した場合
  if ($('#OutputValue').html() != "入力確認:OK" && $('#SelectList option:selected').val() == "NoList") {
    alert("アルバム名を選択して下さい。");
    return false;
  } else if ($('#OutputValue').html() == "入力確認:OK" && $('#SelectList option:selected').val() != "NoList") {
    alert("既存のアルバム名もしくは新規のアルバム名を1つ選択・入力して下さい。");
    return false;
  // ファイルが選択されていない場合はエラー終了
  } else if ($('#WriteFileName').text() == "") {
    alert("ファイルを選択して下さい");
    return false;
  // 拡張子の確認・禁止された文字列になっていないか？
  } else if (UploadFileName(CheckFile) == false) {
    alert("ファイル名に空白や記号は入れないで下さい");
    return false;
  // 拡張子の確認を行う。
  } else if (FileExt(CheckFile) == false) {
    alert("拡張子は[jpg],[jpeg],[png],[gif]に設定して下さい。");
    return false;
  // アップロード対象のファイルサイズを確認
  } else if (FileSize() == false) {
    alert("アップロードするファイル容量は2M以下に設定して下さい。");
    return false;
  // ファイル名の長さを確認
  } else if (FileLength() == false) {
    alert("ファイル名は30文字までにして下さい。");
    return false;
  } else {
    return true;
  }

});

// アルバムパスを取得
function GetListPath(CheckFile) {
  var CheckPath    = null;

  if ($('#OutputValue').html() == "入力確認:OK") {
    CheckPath = './List/' + $('#InputValue').val() + '/' + CheckFile;
//alert("hoge1");
    return CheckPath;
  } else {
    CheckPath = './List/' + $('#SelectList option:selected').val() + '/' + CheckFile;
    return CheckPath;
  }
}


// 問題のないファイル名かを確認
function UploadFileName(CheckFile) {
  var CheckFileName = CheckFile.split('.');

  // 拡張子の確認を行う。
  // ファイル名にドットが2つ以上または、ファイル名に記号がある場合はエラー
  if (CheckFileName.length != 2 || 
  CheckFileName[0].match(/(<|>|&|"|'|;|:|~|`|!|@|#|\$|%|\^|\*|-|\+|=|\||,|\?|\(|\)|\/|\u005c|\u0020)/)) {
    return false;
  } else {
    return true;
  }
}

// 問題のない拡張子かを確認
function FileExt(CheckFile) {
  // 拡張子の確認を行う。
  var CheckExt = CheckFile.split('.');
  
  // 4つの拡張子のみアップロードできるものとする。
  if (CheckExt[1] == "jpg" || CheckExt[1] == "jpeg" || CheckExt[1] == "png" || CheckExt[1] == "gif"){
    return true;
  } else {
    return false;
  }
}

// アップロード選択されたファイルの容量を確認
function FileSize() {
  // オブジェクトからファイル容量を取得
  var CheckFile = $('#FileSelect')[0].files[0].size;

  // 2Mを越えるとNG
  if (CheckFile <= 2000000) {
    return true;
  } else {
    return false;
  }
}

// ファイル名の長さを確認(30文字以上はエラー)
function FileLength() {
  var CheckLength = $('#FileSelect').prop('files')[0].name.length;

  // 30文字までOK
  if (CheckLength < 31) {
    return true;
  } else { 
    return false;
  }
}

