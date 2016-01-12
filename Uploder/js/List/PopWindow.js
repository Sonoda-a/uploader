$(function() {
  $(".Photo").click(function(){
    // 画像のオリジナルサイズを取得
    var Img = new Image();
    Img.src = this.src;
    var Hei = Img.height;
    var Wid = Img.width;

    // 別窓を開く(第二引数については、後ほど調べる)
    window.open(this.src,
                "",
                "width=" + Wid + ",height=" + Hei + ",resizable=no, scrollbars=no, location=no");
  });
});
