<?php
\session_start();

if(!$_SESSION['AUTH'])
{
    \header("Location:login.php");
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
    <link href="assets/css/custom-index.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/fontawesome/4.7.0/css/font-awesome.min.css"/>
    <title>Dashboard - Portal Layanan Dummy</title>
</head>
<body>
<div class="container text-center">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="service-heading-block">
                <h2 class="text-center text-primary title">Hallo, <?= $_SESSION['USER_DETAILS']['cn'] ?><br>Silahkan Pilih Layanan Dibawah Ini</h2>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="text-center feature-block">
                <span class="fb-icon color-info">
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
                <h4 class="color-info">Izin Penyelenggaran POS</h4>
                <a href="./preauth.php?satellite=izin-penyelenggaraan-pos" target="_blank" class="btn btn-info btn-custom">Masuk</a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="text-center feature-block">
                <span class="fb-icon color-warning">
                  <i class="fa fa-phone" aria-hidden="true"></i>
                </span>
                <h4 class="color-warning">Izin Jasa Telekomunikasi</h4>
                <a href="javascript:void(0)" class="btn btn-warning btn-custom">Masuk</a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="text-center feature-block">
                <span class="fb-icon color-success">
                  <i class="fa fa-rss" aria-hidden="true"></i>
                </span>
                <h4 class="color-success">Izin Stasiun Radio</h4>
                <a href="javascript:void(0)" class="btn btn-success btn-custom">Masuk</a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="text-center feature-block">
                <span class="fb-icon color-danger">
                  <i class="fa fa-ship" aria-hidden="true"></i>
                </span>
                <h4 class="color-danger">Hak Labuh</h4>
                <a href="javascript:void(0)" class="btn btn-danger btn-custom">Masuk</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="">
                <a href="./logout.php" class="btn btn-default">Logout</a>
            </div>
        </div>
    </div>

</div>
</body>
<script src="./assets/js/jquery-1.11.1.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
</html>
