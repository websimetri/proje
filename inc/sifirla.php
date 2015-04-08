<?php
@include "config.php";
/**
 * Altındaki tmpl'lerin kontrolü için değişken tanımlıyor
 * en alttaki tmpl dosyaları config içerisinde tanımlanmı
 * değişkenleri almıyor.
 *
 * define ile tanımlanmış değişkenlerde sadece defined ile kontrol
 * edilebiliyor. Bu da kontrol sırada hata veriyor.
 *
 * En orta yolu bu oldu gibi gözüküyor şimdilik.
 */
$kontrol = TMPL_KONTROL;

if (isset($_GET["key"]) and !empty($_GET["key"])){
    include "tmpl/sifirlaSifre.tmpl.php";
}
else {
    if (isset($_GET["durum"]) and $_GET["durum"] == "mail") {

        if (Bulut::emailSorgu($_POST["fMail"])) {
            $mail = new BulutMail($DB);
            $yolla = $mail->sifreUnuttum($_POST["fMail"]);

            if ($yolla) {
                $durum = "Şifre değiştirme linkiniz belirttiğiniz mail adresinze gönderilmiştir.";
            }
            else {
                $durum = "Mail yollama sırasında bir hata oluştu.";
            }

        }
        else {
            $durum = "Yanlış email girdiniz veya email'iniz sistemimizde bulunmamaktadır.";
        }

        $mesaj = "<div class='mail-sifir-mesaj'>".$durum."</div>";
    }
    else {
        $mesaj = "";
    }
    include "tmpl/sifirlaMail.tmpl.php";
}


?>