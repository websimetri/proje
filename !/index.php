<meta charset="utf-8"/>
<a href="?islem=ekle">yeni Anket Ekle</a>
<a href="?olay=secenekekle">Seçenek Ekle</a>
<?php
session_start();
$_SESSION["sirketId"] = 1;
require_once 'class.php';
$anket = new anket();


if (isset($_GET["islem"])) {
    switch ($_GET["islem"]) {
        case "duzenle":

            if (isset($_GET["id"])) {
                $anket->anket_duzenle($_GET["id"]);
                require_once 'ankethtml.php';
            }
            break;
        case "sil":
            $anket->sil($_GET["id"]);
            break;
        case 'ekle':
            require_once 'ankethtml.php';
            $anket->anket_ekle();
            break;


    }
}
if(isset($_GET["olay"])&&isset($_GET["id"])){
    switch ($_GET["olay"]) {
        case 'sil':
            $anket->secenek_sil($_GET["id"]);
            break;
        case 'duzenle':

            $anket->secenek_duzenle($_GET["id"]);
            require_once 'secenekhtml.php';
            break;

    }
}
if(isset($_POST["islem"])){
    switch ($_POST["islem"]) {
        case 'duzenle':
            if(isset($_POST["duzenleid"])){$anket->duzenle_kaydet($_POST["duzenleid"]);}
            break;
    }
}



if(isset($_POST["olay"])&&isset($_POST["yeniid"])){
    switch ($_POST["olay"]) {
        case 'duzenle':
            $anket->secenek_duzenleYaz($_POST["yeniid"]);
            break;
    }
}


if(isset($_GET["olay"])){
    switch ($_GET["olay"]) {
        case 'secenekekle':
            $anket->select();
            require_once 'secenekhtml.php';

    }
}
if(isset($_POST["olay"])){
    switch ($_POST["olay"]) {
        case '':
            $anket->secenek_yaz();
            break;
    }
}


$anket->anket_listele();
$anket->secenek_liste();



?>