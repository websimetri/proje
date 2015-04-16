<?php
session_start();
$_SESSION["sirketId"] = 1;

require_once 'class.php';

$icerikYonetimi = new icerikYonetimi();

if (isset($_POST["islem"])) {
    switch ($_POST["islem"]) {
        case "duzenle":
            if (isset($_POST["duzenleid"])) {
                $icerikYonetimi->icerikDuzenleKaydet($_POST["duzenleid"]);
            }
            break;
        case "ekle":
            $icerikYonetimi->icerikEkle();
            break;
    }
}

if (isset($_GET["islem"])) {
    switch ($_GET["islem"]) {
        case "duzenle":
            if (isset($_GET["id"])) {
                $icerikYonetimi->icerikDuzenle($_GET["id"]);
            }
            break;
        case "sil":
            if (isset($_GET["id"])) {
                $icerikYonetimi->icerikSil($_GET["id"]);
            }
            break;
    }
}

if (! isset($_POST["islem"]) && ! isset($_GET["islem"])) {
    $islem = "ekle";
}

require_once 'formtmpl.php';
$icerikYonetimi->icerikListele();

/**
 * **
 * $islembaslik
 * $islem
 * $duzenleid
 * $basliktmpl
 * $kisa_aciklamatmpl
 * $detaytmpl
 * $checked1
 * $checked2
 */

?>

