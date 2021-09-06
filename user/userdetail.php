<?php
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
include("../main/funcs.php");
session_start();
$pdo = db_conn();

//GET受信
$id = $_SESSION['user_id']; 


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM user_table WHERE user_id=:user_id");
$stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  $r = $stmt->fetch();
}
?>
<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->
<?php include("html/header.html");?> 
<!-- Main[Start] -->

    <div class="container pt-4 main" data-mdb-spy="scroll" data-mdb-target="#sidebar-list" data-mdb-offset="0">
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
          <div class="card">
              <div class="card-header text-center py-3 bg-info d-flex justify-content-evenly">
                <h5 class="mb-0 text-center">
                  <strong>更新画面</strong>
                </h5>
              </div>
              <div class="card-body text-center">
                <form class="needs-validation" method="POST" action="userupdate.php" enctype="multipart/form-data" novalidate>
                  <fieldset>
                    <label>名前：<input type="text" name="name" value="<?=$r["name"]?>"></label><br>
                    <div class="valid-feedback">OK!</div>
                    <div class="invalid-feedback">名前を入力してください</div>
                    <br>
                    <label>メールアドレス：<input type="text" name="lmail" value="<?=$r["lmail"]?>"></label><br>
                    <div class="valid-feedback">OK!</div>
                    <div class="invalid-feedback">メールアドレスを入力してください</div>
                    <br>
                    <label>パスワード：<input type="password" name="lpw"></label><br>
                    <div class="valid-feedback">OK!</div>
                    <div class="invalid-feedback">を入力してください</div>
                    <br>
                    <?php if(!isset($r["fname"])||$r["fname"]=""){
                        echo '<p class="cms-thumb"><img src="https://placehold.jp/c9c9c9/ffffff/600×600.png?text=登録画像" width="200"></p>';
                      }else{ 
                        echo '<label for="formFileMultiple" class="form-label">サムネイル：</label>';
                        echo '<input class="cms-item" type="file" name="fname" id="formFileMultiple" accept="image/*" value="<?=$r["fname"]?>"/>';
                      }
                    ?>
                    <!-- <label>サムネイル：<input type="file" name="fname" class="cms-item" accept="image/*"></label><br>
                    <br> -->
                    <br>
                    <br>
                    
                    <input type="hidden" name="kanri_flg" value="0">
                    <input type="hidden" name="life_flg" value="1">
                    <br>
                    <input class="btn btn-outline-info btn-rounded" type="submit" value="登録">
                  </fieldset>
                  <br>
                  <a href="../toppage.php" class="btn btn-outline-info btn-rounded">ログイン画面に戻る</a>
                </form>
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


<?php include("html/footer.html");?>















    <!-- <div class="container pt-4 main" data-mdb-spy="scroll" data-mdb-target="#sidebar-list" data-mdb-offset="0">
      <div class="card">
          <div class="card-header text-center py-3 bg-info d-flex justify-content-evenly">
            <h5 class="mb-0 text-center">
              <strong>ユーザー登録</strong>
            </h5>
            <h5 class="mb-0 text-center">
              <a href="userselect.php"><strong>ユーザー一覧へ</strong></a>
            </h5>
          </div>
          <div class="card-body">
            <form method="POST" action="userupdate.php">
              <fieldset>
                <label>名前：<input type="text" name="name" value="<?=$r["name"]?>"></label><br>
                <br>
                <label>ID：<input type="text" name="lmail" value="<?=$r["lmail"]?>"></label><br>
                <br>
                <label>パスワード：<input type="text" name="lpw" value="<?=$r["lpw"]?>"></label><br>
                <br>
                <label>管理権限：
                  <select class="browser-default custom-select" name="kanri_flg" >
                    <option selected><?=$r["kanri_flg"]?></option>
                    <option value="0">0(管理者)</option>
                    <option value="1">1(スーパー管理者)</option>
                  </select>
                </label><br>
                <br>
                <label>入退会種別：
                  <select class="browser-default custom-select" name="life_flg">
                    <option selected><?=$r["kanri_flg"]?></option>
                    <option value="0">0(退会)</option>
                    <option value="1">1(入会)</option>
                  </select>
                </label><br>
                <br>
                <input type="hidden" name="id" value="<?=$r["user_id"]?>">
                <input type="submit" value="送信">
              </fieldset>
            </form>
          </div>
      </div>
    </div>

<!-- Main[End] -->






