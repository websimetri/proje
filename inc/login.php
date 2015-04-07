<?php

//cookie kontrolü
if(isset($_COOKIE["hatirla"])){
    // oturum aÃ§Ä±lÄ±yor
    $_SESSION['kulId'] = $_COOKIE['kulId'];
    $_SESSION['kulAdi'] = $_COOKIE['kulAdi'];
    $_SESSION['kulMail'] = $_COOKIE['kulMail'];
    $_SESSION['kulRol'] = $_COOKIE['kulRol'];
    echo "<script>window.location.href='admin/index.php';</script>";

}



include "login.tmpl.php";
?>
