<?php
include "config.php";
include "siniflar.php";

if (isset($_POST["sirketAdi"]) && isset($_POST["adres"]) &&
    isset($_POST["tel"]) && isset($_POST["gonder"]) &&
    isset($_POST["kAdi"]) && isset($_POST["kSoyadi"]) &&
    isset($_POST["mail"]) && isset($_POST["sifre"])
    ) {

    $sirketAdi = $_POST["sirketAdi"];
    $adres = $_POST["adres"];
    $tel = $_POST["tel"];
    $ekle_isim = date("YmdHis");
    $sektor = $_POST["id_sektor"];
    $premium = 0;
    $kullaniciAdi = $_POST["kAdi"];
    $kullaniciSoyadi = $_POST["kSoyadi"];
    $sifre = $_POST["sifre"];
    //$sifreTekrar = $_POST["sifreTekrar"];
    $mail = $_POST["mail"];

    // Şirket referansı.
    $ref = Bulut::refOlustur($sirketAdi);

    //$logo = $ekle_isim . "_" . $_FILES["logo"]["name"];
    $date = date("Y.m.d H:i:s");
    $sifrey = md5($sifre);

    //if (copy($_FILES["logo"]["tmp_name"], "images/" . $logo)) {

    //} else {
    //    $logo = "";
    //}

    $sonuc = Bulut::sirketEkle($sirketAdi, $adres, $tel, $sektor, $premium, $ref,$kullaniciAdi,$kullaniciSoyadi,$mail,$sifrey,$date);

    if ($sonuc) {

            $kullaniciKayitSonuc = Bulut::kullaniciEkle($kullaniciAdi, $kullaniciSoyadi, $mail, $sifrey, $date);

            if ($kullaniciKayitSonuc) {
                $kullanici = Bulut::emailSorgu($mail);
                $kullaniciId = $kullanici["id"];
                $sirket = Bulut::GetSirketWithRefCode($ref);
                $sirketId = $sirket["id"];
                $normalizasyonSirketSonuc = Bulut::normalizasyonSirket($kullaniciId, $sirketId);

                if (!$normalizasyonSirketSonuc) {
                    echo "sirket normalizasyon hata";
                }
                $normalizasyonRollerSonuc = Bulut::normalizasyonRoller($kullaniciId, 1);
                if (!$normalizasyonRollerSonuc) {
                    echo "Roller normalizasyon hata";
                }

            } else {
                // $kullaniciKayitSonucu hatası.
                echo "Bir hata oluştu. Kullanıcı Kaydı Gerçekletirilemedi";
            }

        } else {
            // Şifre uyuşmuyor.
            echo "<script>alert('Şifreler uyuşmuyor');</script>";
        }

    } else {
        echo "olmadı laaa";
    }

?>


<!DOCTYPE html>
<html>
<head>
    <title>Kayıt Ol.</title>
</head>
<body>

<form method="post" action="" enctype="multipart/form-data">
    <br>
    Sektör :<select name="id_sektor" style="width: 100px">
        <br>
        <option>1</option>
        <option>Otomotiv</option>
        <option>Sağlık</option>
    </select>
    <br>
    <input type="text" name="sirketAdi" Placeholder="Şirket Adınız..."><br><br>
    <textarea name="adres" placeholder="Şirket Adresi..." style="width:167px"></textarea><br><br>
    <input type="text" name="tel" Placeholder="Şirket GSM..."><br><br>
    <!--<input type="file" name="logo"><br><br>-->
    <input type="text" name="kAdi" placeholder="Yetkili Adı...">
    <input type="text" name="kSoyadi" placeholder="Yetkili Soyadı...">
    <input type="text" name="mail" placeholder="Yetkili Mail Adresi...">
    <input type="password" name="sifre" placeholder="Şifre...">
    <!--<input type="password" name="sifreTekrar" placeholder="Şifrenizi Tekrar Giriniz">-->
    <input type="submit" value="Kayıt" name="gonder">
    <input type="reset"/>
</form>

</body>
</html>