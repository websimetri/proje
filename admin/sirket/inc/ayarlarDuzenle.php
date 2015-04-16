<?php
require_once "../../../config.php";
session_start();
if (!isset($_SESSION["kulId"])) {
    echo "
    <script>
    window.location.href = '../../../index.php';
    </script>
    ";
}

if (isset($_POST["kulDuzenle"]) and !empty($_POST["kulDuzenle"])) {

    if (isset($_POST["fAdi"]) and !empty($_POST["fAdi"]) and
        isset($_POST["fSoyadi"]) and !empty($_POST["fSoyadi"]) and
        isset($_POST["fMail"]) and !empty($_POST["fMail"])) {

        $adi = $_POST["fAdi"];
        $soyadi = $_POST["fSoyadi"];
        $mail = $_POST["fMail"];
        $id = $_POST["fId"];

        $sorgu = $DB->prepare("
        UPDATE kullanicilar SET adi = ?, soyadi = ?, mail = ?
        WHERE id = ?
        ");

        $islem = $sorgu->execute(array($adi, $soyadi, $mail, $id));

        if ($islem) {
            echo "
            <script>
            window.location.href = '../../index.php?link=ayarlar&sonuc=kd_basarili';
            </script>
            ";
        }
        else {
            echo "
            <script>
            window.location.href = '../../index.php?link=ayarlar&sonuc=kd_basarisiz';
            </script>
            ";
        }
    }
}

?>