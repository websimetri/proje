<?php
session_start();
$_SESSION["sirketId"] = 1;

require_once 'duyuruclass.php';

$duyuru = new duyuru();
$duyuru->duyuruListele();

if (isset($_POST["islem"])) {
    switch ($_POST["islem"]) {
        case "duzenle":
            if (isset($_POST["duzenleid"])) {
                $duyuru->duyuruDuzenleKaydet($_POST["duzenleid"]);
            }
            break;
        case "ekle":
            $ekle = $duyuru->duyuruEkle();
            break;
    }
}

if (isset($_GET["islem"])) {
    switch ($_GET["islem"]) {
        case "duzenle":
            if (isset($_GET["id"])) {
                $duyuru->duyuruDuzenle($_GET["id"]);
                require_once 'duyuruformtmpl.php';
            }
            break;
        case "sil":
            if (isset($_GET["id"])) {
                $duyuru->duyuruSil($_GET["id"]);
            }
            break;
        case "yeniekle": 
        require_once 'duyuruformtmpl.php';
        $ekle = $duyuru->duyuruEkle();    
        break;  
    }
}






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