<?php
/**
 * fonksiyonlar.php
 * ~~~~~~~~~~~~~~~~
 */
@include "config.php";

/**
 * $_GET ile adres çubuğundan alınan linke uygun include
 * gerçekleştirir.
 *
 * @not: index.tmpl.php ile kullanım için.
 */
function templateEkle()
{

    if (!isset($_GET[SAYFA]) or empty($_GET[SAYFA])) {
        // ?sayfa boş ise veya hiç gelmemiş ise anasayfayı ekle.
        include "inc/anasayfa.php";
    }
    else {
        if ($_GET[SAYFA] == "iletisim") {
            include "inc/iletisim.php";
        }
        elseif ($_GET[SAYFA] == "giris") {
            include "inc/login.php";
        }
        elseif ($_GET[SAYFA] == "sifirla") {
            include "inc/sifirla.php";
        }
        elseif ($_GET[SAYFA] == "404") {
            include "inc/404.php";
        }
        else {
            // Aranan link bulunamazsa 404'e yönlendir.
            include "inc/404.php";
        }

    }
}


/**
 *
 * Cookie de kullanım için id'leri encode eder.
 *
 * @param $id
 * @return string
 */
function idEncode($id)
{
    // Base64 ile ID encode işlemi.
    $enc = base64_encode($id);

    return $enc;
}

/**
 *
 * Cookie de kullanım için id'leri decode eder.
 *
 * @param $id
 * @return string
 */
function idDecode($id)
{
    // Base64 ile ID encode işlemi.
    $dec = base64_decode($id);

    return $dec;
}

?>
