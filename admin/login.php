<?php  
 session_start();
 require_once('config/connection.php');
 $error= array();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VietproShop | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="public/plugins/index2.html"><b>Administrator</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Vui lòng đăng nhập!</p>
      <form action="" method="post">
        <?php
            error_reporting(E_ALL & ~E_NOTICE);
            if(isset($_POST['submit'])){
              if(!empty($_POST['email'])){
                $email = $_POST['email'];
              }else{
                $error['email'] = "Email không được để trống";
              }
              if(!empty($_POST['password'])){
                $password = md5($_POST['password']);
              }else{
                $error['password'] = "Mật khẩu không được để trống";
              }
              if($email && $password){
                $sql = "SELECT * FROM account WHERE email = '$email' AND password = '$password' AND level = 1 ";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($result);
                if($row == 1) {
                      $data = mysqli_fetch_array($result);
                      $_SESSION['admin_login'] = $data;
                      header("location: index.php");
                      if(!empty($_POST['remember'])){
                        setcookie('email', $_POST['email'], time() + 3600);
                        setcookie('password', $_POST['password'], time() + 3600);
                      }else{
                          if(isset($_COOKIE['email'])){
                            setcookie('email','');
                          }
                          if(isset($_COOKIE['password'])){
                            setcookie('password', '');
                          }
                      }
                }else{
                    $error['login'] = "Email hoặc Mật khẩu không chính xác";               }
                }
            }

          ?>
        <span style="color: red;"><?php if(isset($error['login'])) echo $error['login']; ?></span>
        <span style="color: red;"><?php if(isset($error['email'])) {echo $error['email'];} ?></span>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" value="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <span style="color: red;"><?php if(isset($error['password'])) {echo $error['password'];} ?></span>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Mật khẩu" value="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password'] ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember" <?php if(isset($_COOKIE['email']) && isset($_COOKIE['password'])) echo "checked=checked"; ?>>
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="#">Quên mật khẩu</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Tôi chưa có tài khoản!</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="public/dist/js/adminlte.min.js"></script>

</body>
</html>
