<?php
/**
 * Twig render'ları öncesinde kullanılacak fonksiyonlar.
 *
 * 1. Admin
 * 2. Anasayfa
 */
require_once "../config.php";
require_once "siniflar.php";

/** ======================================================================
 * 1. ADMIN FONKSIYONLARI
 =======================================================================*/


// 1.1. ŞİRKET ADMİN FONKSİYONLARI ---------------------------------------

/**
 * Bütün Şirket Admin sayfalarında bulunacak ortak veriler.
 *
 * (array) sirket:
 *   id, id_sektor, sektor_adi, adres, tel,
 *   logo, logo_400, premium, yetkili,
 *   yetkili_mail, tarih_kayit, aktif, kullanici_sayisi
 * (array) admin:
 *   id, adi, soyadi, mail, sifre,
 *   tarih_kayit, tarih_son_giris
 *
 * @param $sirket_id
 * @param $admin_id
 * @return array
 */
function v_sirketAdminAnaVeriler($sirket_id, $admin_id)
{

    $data = array();

    // Şirkete ait verilerin çekilmesi.
    $sirket = Bulut::getirSirket($sirket_id);
    $data["sirket"] = $sirket;
    $data["sirket"]["logo_400"] = Bulut::logoGetir($sirket_id, "400");

    // Kullanıcı bilgilerinin getirilmesi.
    $admin = Bulut::getirKullanici($admin_id);
    $data["admin"] = $admin;

    return $data;
}


/**
 * Reklamları listeler.
 *
 * (array) reklamlar
 *   id, id_sirket, adi, gosterim, tiklama, tarih_baslangic, tarih_bitis, tarih_yukleme
 *   dosya, kod, href, aktif
 *
 * @param $sirket_id
 * @param $admin_id
 * @return array
 */
function v_sirketAdminReklamAna($sirket_id, $admin_id)
{
    global $DB;
    $data = array();

    $sorgu = $DB->prepare("
        SELECT * FROM reklamlar WHERE id_sirket = :id_sirket
    ");
    $sorgu->bindParam(":id_sirket", $sirket_id);
    $sorgu->execute();
    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

    return $sonuclar;
}

/**
 * Şirket Admin için Müşteriler ana sayfasında gönderilecek veriler.
 */
function v_sirketAdminMusterilerAna()
{
    // NOT: Config'den $DB çekebilirsiniz.
    // Veya Bulut::getirSirketMusteriler() de çalışıyor.
}


/** ======================================================================
 * 2. ANASAYFA FONKSİYONLARI.
 *
 * Ana index.php uzerinden çalışan durumlar için.
=======================================================================*/
?>