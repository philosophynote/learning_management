<?php include("funcs.php");?>

<?php
  session_start();
  $token = bin2hex(openssl_random_pseudo_bytes(16));
  $_SESSION['token'] = $token;
?>
<!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Learning Management</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="../css/mdb.min.css" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
      <!-- Main Navigation-->
  <header class="topheader">
    <div class="header-text">
      <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.3);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <div class="text-white">
                <h1 class="mb-2 text-center">学習時間管理アプリ<br>
                －Learning Management－</h1>
                <h5 class="mb-4"></h5>
              </div>
              <br>
              <form class="bg-white rounded shadow-5-strong p-5 needs-validation" action="login_act.php" method="post" novalidate>
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="form1Example1" class="form-control" name="lmail" required/>
                  <label class="form-label" for="form1Example1">メールアドレス</label>
                  <div class="valid-feedback">OK!</div>
                  <div class="invalid-feedback">メールアドレスを入力してください</div>
                </div>
                <br>
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="form1Example2" class="form-control" name="lpw" required/>
                  <label class="form-label" for="form1Example2">パスワード</label>
                  <div class="valid-feedback">OK!</div>
                  <div class="invalid-feedback">パスワードを入力してください</div>
                </div>
                <br>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">ログイン</button>
                <br>
                <br>
                <div class="text-center">
                  <a href="../user/signin.php" >アカウント新規作成はこちら</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <video src="../img/code.mp4"  autoplay loop muted ></video>
  </header>
  <!--Main Navigation-->

    <!-- MDB -->
    <script type="text/javascript" src="../js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript" src="../js/script.js"></script>
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
</body>
</html>