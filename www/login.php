<?php
\session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Zaky\Auth\Login;

if (@$_SESSION['AUTH']){
    \header("Location: index.php");
}

if ($_POST){

    $login = new Login();
    $tryLogin = $login->authenticate($_POST['username'], $_POST['password']);

    if ($tryLogin){
        $_SESSION['AUTH'] = true;
        $_SESSION['USER_DETAILS'] = $login->getUser();

        \header("Location: index.php");
    }else{
        $message = "Login gagal!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="assets/css/custom-login.css" rel="stylesheet">
    <title>Login - Portal Layanan Dummy</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Dummy Portal Layanan</h1>
            <div class="account-wall">
                <img class="profile-img" src="./assets/images/photo.png" alt="">
                <form class="form-signin" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <?php if (@$message) : ?>
                    <div class="alert alert-danger">
                        <strong>Oopss!</strong> username atau password salah
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                        Login</button>
                    <label class="checkbox pull-left">
                        <input type="checkbox" value="remember-me">
                        Ingat Saya
                    </label>
                    <a href="#" class="pull-right need-help">Butuh Bantuan?</a><span class="clearfix"></span>
                </form>
            </div>
            <a href="#" class="text-center new-account">Buat Akun</a>
        </div>
    </div>
</div>
</body>
<script src="./assets/js/jquery-1.11.1.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
</html>