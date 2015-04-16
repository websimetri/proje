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


// 1.1. ŞİRKET ADMİN FONKSİYONLARI

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
function sirketAdminAnaVeriler($sirket_id, $admin_id)
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

?>