<?php
require_once "../lib/siniflar.php";
require_once "../lib/fonksiyonlar.php";
session_start();

ini_set("post_max_size", 1024*1024*2 );
ini_set("upload_max_filesize ", 1024*1024*2 );
ini_set("memory_limit ", 1024*1024*24 );

if ( isset($_POST["fMail"]) && isset($_POST["fSifre"]) &&
    !empty($_POST["fMail"]) && !empty($_POST["fSifre"]) ) {
    // TODO: Diğer issetler de eklenecek.


    $mail = $_POST["fMail"];
    $sifre = $_POST["fSifre"];
    $hatirla= isset($_POST["fHatirla"]);
    $giris = Bulut::oturumAc($mail, $sifre, $hatirla);
}

if (isset($_SESSION["kulRol"]) or (isset($giris) and $giris == true)) {

    $id = $_SESSION["kulRol"];

    if ($id == 0) {
        include "super/index.php";
    }
    elseif ($id == 1) {
        include "sirket/index.php";
    }
    elseif ($id == 2) {
        include "calisan/index.php";
    }
}
elseif(isset($_COOKIE["hatirla"])){
    // Cookie kontrolü.
    // Cookie mevcutsa verileri $_SESSION'a ata ve sonra
    // admin/index.php'ye yönlendir.
    $_SESSION['kulId'] = idDecode($_COOKIE['kulId']);
    $_SESSION['kulAdi'] = $_COOKIE['kulAdi'];
    $_SESSION['kulMail'] = $_COOKIE['kulMail'];
    $_SESSION['kulRol'] = idDecode($_COOKIE['kulRol']);
    // class.bulut.php'de ki eklemenin uzantısı.
    if (isset($_COOKIE["sirketId"])){
        $_SESSION['sirketId'] = idDecode($_COOKIE['sirketId']);
    }
    echo "<script>window.location.href='index.php';</script>";
}
else {
    echo "
    <script>
    window.location.href = '../index.php?link=giris';
    </script>
    ";
}

?>