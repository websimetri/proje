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

elseif (isset($_POST["kulSifre"]) and !empty($_POST["kulSifre"])) {

    // Boşluk kontrolü.
    if (!empty($_POST["fSifre"]) and !empty($_POST["fSifreTekrar"])) {

        if (trim($_POST["fSifre"]) == trim($_POST["fSifreTekrar"])) {

            $id = $_POST["fId"];
            $sifre = md5($_POST["fSifre"]);

            $sorgu = $DB->prepare("
            UPDATE kullanicilar SET sifre = ?
            WHERE id = ?
            ");
            $islem = $sorgu->execute(array($sifre, $id));

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
        else {
            echo "
            <script>
            window.location.href = '../../index.php?link=ayarlar&sonuc=kd_basarisiz';
            </script>
            ";
        }
    }

    else {
        echo "
        <script>
        window.location.href = '../../index.php?link=ayarlar&sonuc=kd_basarisiz';
        </script>
        ";
    }

}

?>