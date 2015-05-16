<?php
require_once "../config.php";
require_once "../lib/siniflar.php";

if (isset($_POST["sirketAdi"]) and !empty($_POST["sirketAdi"]) and
    isset($_POST["adres"]) and !empty($_POST["adres"]) and
    isset($_POST["sektor"]) and
    isset($_POST["tel"]) and !empty($_POST["tel"]) and
    isset($_POST["kAdi"]) and !empty($_POST["kAdi"]) and
    isset($_POST["kSoyadi"]) and !empty($_POST["kSoyadi"]) and
    isset($_POST["mail"]) and !empty($_POST["mail"]) and
    isset($_POST["sifre"]) and !empty($_POST["sifre"]) and
    isset($_POST["sifreTekrar"]) and !empty($_POST["sifreTekrar"]) and
    $_POST["sifre"] == $_POST["sifreTekrar"] and
    isset($_POST["gonder"])) {


    $sirketAdi = $_POST["sirketAdi"];
    $adres = $_POST["adres"];
    $tel = $_POST["tel"];
    $sektor = $_POST["sektor"];
    $premium = 0;
    $kullaniciAdi = $_POST["kAdi"];
    $kullaniciSoyadi = $_POST["kSoyadi"];
    $sifre = md5($_POST["sifre"]);
    $mail = $_POST["mail"];
    $ekle_isim = date("YmdHis");

    // Şirket referansı.
    $ref = Bulut::refOlustur($sirketAdi);

    $date = date("Y.m.d H:i:s");

    $sonuc = Bulut::sirketEkle($sirketAdi, $adres, $tel, $sektor, $ref, $kullaniciAdi, $kullaniciSoyadi, $mail, $sifre);

    if ($sonuc) {

        $kullaniciKayitSonuc = Bulut::kullaniciEkle($kullaniciAdi, $kullaniciSoyadi, $mail, $sifre, $date);

        if ($kullaniciKayitSonuc) {
            $kullanici = Bulut::emailSorgu($mail);
            $kullaniciId = $kullanici["id"];
            $sirket = Bulut::GetSirketWithRefCode($ref);
            $sirketId = $sirket["id"];
            $normalizasyonSirketSonuc = Bulut::normalizasyonSirket($kullaniciId, $sirketId);

//            if (!$normalizasyonSirketSonuc) {
//                echo "sirket normalizasyon hata";
//            }

            $normalizasyonRollerSonuc = Bulut::normalizasyonRoller($kullaniciId, 1);

//            if (!$normalizasyonRollerSonuc) {
//                echo "Roller normalizasyon hata";
//            }


            echo "
            <script>
            window.location.href = '../index.php?link=kayit&sonuc=basarili';
            </script>
            ";

        } else {
            echo "
            <script>
            window.location.href = '../index.php?link=kayit&sonuc=basarisiz';
            </script>
            ";
        }

    } else {
        echo "
        <script>
        window.location.href = '../index.php?link=kayit&sonuc=basarisiz';
        </script>
        ";
    }

} else {
    echo "
    <script>
    window.location.href = '../index.php?link=kayit&sonuc=basarisiz';
    </script>
    ";
}

?>
