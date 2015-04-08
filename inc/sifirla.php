<?php
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
    include "tmpl/sifirlaMail.tmpl.php";
}


?>