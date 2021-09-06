<?php
  include("../funcs.php");
?>
<?php include("html/header.html");?>
<!-- Main[Start] -->

    <div class="container pt-4">
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
            <form method="POST" action="userinsert.php">
              <fieldset>
                <label>名前：<input type="text" name="name"></label><br>
                <br>
                <label>Email：<input type="text" name="lmail"></label><br>
                <br>
                <label>パスワード：<input type="text" name="lpw"></label><br>
                <br>
                <label>管理権限：
                  <select class="browser-default custom-select" name="kanri_flg">
                    <option selected>権限を選択してください</option>
                    <option value="0">0(管理者)</option>
                    <option value="1">1(スーパー管理者)</option>
                  </select>
                </label><br>
                <br>
                <label>入退会種別：
                  <select class="browser-default custom-select" name="life_flg">
                    <option selected>入退会種別を選択してください</option>
                    <option value="0">0(退会)</option>
                    <option value="1">1(入会)</option>
                  </select>
                </label><br>
                <br>
                <input class="btn btn-outline-info btn-rounded" type="submit" value="送信">
              </fieldset>
              <br>
              <a href="../manage.php" class="btn btn-outline-info btn-rounded">元の画面に戻る</a>
            </form>
          </div>
      </div>
    </div>

<!-- Main[End] -->

<?php include("html/footer.html");?>
