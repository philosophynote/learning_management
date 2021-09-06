<?php
  include("../funcs.php");
?>
<?php include("html/header.html");?>
<!-- Main[Start] -->

    <div class="container pt-4">
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
          <div class="card">
              <div class="card-header text-center py-3 bg-info d-flex justify-content-evenly">
                <h5 class="mb-0 text-center">
                  <strong>ユーザー登録</strong>
                </h5>
              </div>
              <div class="card-body text-center">
                <form class="needs-validation" method="POST" action="createuser.php" enctype="multipart/form-data" novalidate>
                  <table class="table table-borderless">
                    <tr>
                      <td>名前：</td>
                      <td>
                        <input type="text" name="name">
                        <div class="valid-feedback">OK!</div>
                        <div class="invalid-feedback">メールアドレスを入力してください</div>
                      </td>
                    </tr>
                    <tr>
                      <td>メールアドレス：</td>
                      <td>
                        <input type="text" name="lmail"></><br>
                        <div class="valid-feedback">OK!</div>
                        <div class="invalid-feedback">メールアドレスを入力してください</div>
                      </td>
                    </tr>
                    <tr>
                      <td>パスワード：</td>
                      <td>
                        <input type="password" name="lpw"></パスワード：><br>
                        <div class="valid-feedback">OK!</div>
                        <div class="invalid-feedback">パスワードを入力してください</div>
                      </td>
                    </tr>
                    <tr>
                      <td>サムネイル：</td>
                      <td><input class="cms-item" type="file" name="fname" id="formFileMultiple" accept="image/*" /></td>
                    </tr>
                  </table>
                  <p class="cms-thumb"><img src="https://placehold.jp/c9c9c9/ffffff/600×600.png?text=登録画像" width="200"></p>
                  <!-- <label>サムネイル：<input type="file" name="fname" class="cms-item" accept="image/*"></label><br>
                  <br> -->
                  <!-- <div class="form-outline mb-4"> -->
                    <img id="captcha" src="../securimage/securimage_show.php">
                    <br>
                    <br>
                    <input type="text" class="form-control" name="captcha_code" placeholder="表示されている文字を入力してください" required>
                    <br>
                    <button class="btn btn-outline-secondary btn-block" type="button" id="button">画像再生成</button>
                  <!-- </div> -->
                  <br>
                  <input type="hidden" name="kanri_flg" value="0">
                  <input type="hidden" name="life_flg" value="1">
                  <br>
                  <input class="btn btn-info btn-block" type="submit" value="登録">
                  <br>
                </form>
                <br>
                <a href="../toppage.php" class="btn btn-outline-danger btn-block">ログイン画面に戻る</a>
              </div>
          </div>
        </div>
        <div class="col-3"></div>
      </div>
    </div>

<!-- Main[End] -->
<script>
//---------------------------------------------------
//画像サムネイル表示
//---------------------------------------------------
// アップロードするファイルを選択
$('input[type=file]').change(function() {
  //選択したファイルを取得し、file変数に格納
  var file = $(this).prop('files')[0];
  // 画像以外は処理を停止
  if (!file.type.match('image.*')) {
    // クリア
    $(this).val(''); //選択されてるファイルを空にする
    $('.cms-thumb > img').html(''); //画像表示箇所を空にする
    return;
  }
  // 画像表示
  var reader = new FileReader(); //1
  reader.onload = function() {   //2
    $('.cms-thumb > img').attr('src', reader.result);
  }
  reader.readAsDataURL(file);    //3
});
</script>
<script>
  'use strict';
  const forms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(forms).forEach((form) => {
    form.addEventListener('submit', (event) => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
</script>
<script>
  const button = document.getElementById('button');
  button.addEventListener('click', function() {
      const captcha = document.getElementById('captcha');
      captcha.src = '../securimage/securimage_show.php?' + Math.random();
  }, false);

</script>
<?php include("html/footer.html");?>