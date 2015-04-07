<?php
session_start();
include "../siniflar.php";

// -----------------------------------------------------------------------
// Fonksiyonlar
// -----------------------------------------------------------------------


/**
 * Gelen kulRol'e göre admin template ekleniyor.
 *
 * @param $rolId
 * @return bool
 */
function adminTemplate($rolId)
{
    if($_SESSION) {

        if ($_SESSION["kulRol"] == "0") {
            include "adminSuper.php";
        }
        elseif ($_SESSION["kulRol"] = "1") {
            include "adminSirket.tmpl.php";
        }
    }
    else {
        return false;
    }
}

// Session kontrolleri.
if ($_SESSION) {

    adminTemplate($_SESSION["kulRol"]);
}

// Formla ilgili kontroller buraya.
elseif (isset($_POST["girisTip"]) and !empty($_POST["girisTip"])) {
    // TODO: Diğer issetler de eklenecek.

    $mail = $_POST["fMail"];
    $sifre = $_POST["fSifre"];
    $giris = Bulut::oturumAc($mail, $sifre);

    if ($giris) {
        adminTemplate($_SESSION["kulRol"]);
    }
    else {
        header("Location: ../index.php?sayfa=giris");
    }

}

// Session ve form'da sorun var.
else {
    header("Location: ../index.php?sayfa=giris");
}
?>