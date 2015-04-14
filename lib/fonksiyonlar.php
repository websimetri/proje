<?php
/**
 * fonksiyonlar.php
 * ~~~~~~~~~~~~~~~~
 */
@include "config.php";
require_once "siniflar.php";

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
        // TODO: İleride bunu kaldırmamız gerekecek. Çünkü
        // logo değiştirme admin üzerinden çalışacak. Admini
        // oturtunca değiştirmek lazım.
		elseif ($_GET["sayfa"] == "logoDegistir") {
			include "inc/logoDegistir.php";
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


/** ----------------------------------------------------------------------
 * RENDER için gerekli fonksiyonlar.
 * - template'lere gidecek olan veriler buradan gelecek.
 -----------------------------------------------------------------------*/

// Süper Admin > ?link = sirketler
function superAdminGetirSirketler()
{
    /**
     * DÖNEN DEĞERLER:
     *  - id
     *  - id_sektor
     *  - sektor_adi
     *  - adres
     *  - tel
     *  - logo
     *  - premium
     *  - yetkili
     *  - yetkili mail
     *  - tarih_kayit
     *  - kullanici_sayisi
     *  - musteri sayisi
     *
     */
    $data = array();

    $sirketler = Bulut::getirSirketler();

    // gelen verilere müşteri sayısının eklenmesi.
    foreach ($sirketler as $sirket) {
        $sirket["musteri_sayisi"] = Bulut::getirSirketMusteriler($sirket["id"], true);
        $sirket["logo"] = Bulut::logoGetir($sirket["id"], 200);
        array_push($data, $sirket);
    }

    return $data;
}

// Super Admin > index.php?link=sirket&id=1
function superAdminGetirSirket($id)
{
    /**
     * DÖNEN VERİLER
     * - id
     * - id_sektor
     * - sektor adı
     * - adi
     * - adres
     * - tel
     * - logo
     * - premium
     * - yetkili
     * - yetkili_mail
     * - tarih_kayit
     * - kullanici_sayisi
     * - kullanicilar (array)
     *      - id, id_rol, adi, soyadi, mail, tarih_kayit
     *      - tarih_son_giris
     * - musteri_sayisi
     * - musteriler (array)
     *      - id, id_sirket, adi, soyadi, mail, sifre, tarih_kayit
     *      - tarih_son_giris
     */
    $data = array();

    $musteriler = Bulut::getirSirketMusteriler($id);
    $data["musteriler"] = $musteriler;
    $data["musteri_sayisi"] = count($musteriler);

    $kullanicilar = Bulut::getirSirketKullanicilar($id);
    $data["kullanicilar"] = $kullanicilar;

    $sirket = Bulut::getirSirket($id);

    foreach ($sirket as $k => $v) {
        $data[$k] = $v;
    }

    $data["logo"] = Bulut::logoGetir($data["id"], "200");
    return $data;
}


?>
