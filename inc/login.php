<?php
session_start();


if (isset($_SESSION["kulId"]) and isset($_SESSION["kulAdi"]) and
!empty($_SESSION["kulId"]) and !empty($_SESSION["kulAdi"])) {
    echo "<script>window.location.href='admin/index.php';</script>";
}

elseif(isset($_COOKIE["hatirla"])){
    // Cookie kontrolü.
    // Cookie mevcutsa verileri $_SESSION'a ata ve sonra
    // admin/index.php'ye yönlendir.
    $_SESSION['kulId'] = idDecode($_COOKIE['kulId']);
    $_SESSION['kulAdi'] = $_COOKIE['kulAdi'];
    $_SESSION['kulMail'] = $_COOKIE['kulMail'];
    $_SESSION['kulRol'] = idDecode($_COOKIE['kulRol']);
    echo "<script>window.location.href='admin/index.php';</script>";

}
else {
    include "login.tmpl.php";
}

?>
