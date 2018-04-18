<?php
\session_start();

require_once __DIR__ . "/../vendor/autoload.php";
use Zaky\Auth\Preauth;

if (!$_SESSION['AUTH']){
    \header("Location: login.php");
}

if($_GET['satellite']){
    $preauth = new Preauth();

    $preauth->preauthentication($_GET['satellite']);
}

echo "Halaman tidak ditemukan; Error 404.";
return false;