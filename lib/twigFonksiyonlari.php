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
 * =======================================================================*/


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

    $duyurular = Bulut::getirDuyurular($admin_id);
    $data["duyurular"]["okunmamis"] = $duyurular;

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

function sirketMusterilerGetir($limit = 50)
{
    global $DB;
    $musteriler = $DB->query("SELECT id, adi, soyadi, telefon, mail, aktif FROM musteriler");
    $sonuc = $musteriler->fetchAll(PDO::FETCH_ASSOC);
    return $sonuc;
}

function sirketMusterilerIslem($kulid, $islem)
{
    global $DB;
    if ($islem == "aktif") {
        $aktiflik = $DB->prepare("UPDATE `musteriler` SET `aktif` = '1' WHERE id = :id");
    } elseif ($islem == "pasif") {
        $aktiflik = $DB->prepare("UPDATE `musteriler` SET `aktif` = '0' WHERE id = :id");
    } elseif ($islem = "sil") {
        $aktiflik = $DB->prepare("DELETE FROM `musteriler` WHERE id = :id");
    }
        $aktiflik->bindParam(':id', $kulid);
        $aktiflik->execute();
}


/**
 * Haberler sayfaları için şirketin haberlerini getirir.
 *
 * Kategori: 1, 2, 3 vs...
 * Durum: 1 (aktif), 2 (pasif)
 *
 * @param $sirket_id
 * @param bool $kategori_id
 * @param bool $durum
 * @return array|bool
 */
function v_sirketAdminHaberAna($sirket_id, $kategori_id = false, $durum = false)
{
    global $DB;
    $data = array();

    // Kategori ve Durum'un geldiği haller.
    if ($kategori_id and $durum){
        $q = "SELECT * FROM haberler WHERE id_sirket = :id_sirket and kategori_id = :id_kategori and durum = :durum";
        $query = $DB->prepare($q);

        $query->bindParam(":id_sirket", $sirket_id );
        $query->bindParam(":id_kategori",$kategori_id);
        $query->bindParam(":durum",$durum);
        $query->execute();
    }
    elseif ($kategori_id) {
        $q = "SELECT * FROM haberler WHERE id_sirket = :id_sirket and kategori_id = :id_kategori";
        $query = $DB->prepare($q);

        $query->bindParam(":id_sirket", $sirket_id );
        $query->bindParam(":id_kategori",$kategori_id);
        $query->execute();
    }
    elseif ($durum) {
        $q = "SELECT * FROM haberler WHERE id_sirket = :id_sirket and durum = :durum";
        $query = $DB->prepare($q);

        $query->bindParam(":id_sirket", $sirket_id );
        $query->bindParam(":durum",$durum);
        $query->execute();
    }
    else {
        $query = $DB->prepare("SELECT * FROM haberler where id_sirket = :id_sirket");
        $query->bindParam(":id_sirket", $sirket_id);
        $query->execute();
    }

    $sonuclar = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($sonuclar) {
        return $sonuclar;
    }
    else {
        return false;
    }
}


/**
 * Şirkete ait kategorileri getirir.
 *
 * @param $sirket_id
 * @param int $limit
 * @return array|bool
 */
function kategoriGetir($sirket_id, $limit = 50)
{
    global $DB;

    $q = "
    SELECT * FROM haber_kategori WHERE id_sirket = :sirket_id ORDER BY adi LIMIT $limit
    ";
    $sorgu = $DB->prepare($q);
    $sorgu->bindParam(":sirket_id", $sirket_id);
    $sorgu->execute();

    $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

    if ($sonuclar) {
        return $sonuclar;
    }
    else {
        return false;
    }
}


function sirketHaberlerIslem($haber_id, $islem)
{
    global $DB;
    if ($islem == "aktif") {
        $aktiflik = $DB->prepare("UPDATE `haberler` SET `durum` = '1' WHERE id = :haber_id");
    } elseif ($islem == "pasif") {
        $aktiflik = $DB->prepare("UPDATE `haberler` SET `durum` = '2' WHERE id = :haber_id");
    }
    $aktiflik->bindParam(':haber_id', $haber_id);
    $aktiflik->execute();
}


/**
 * Şirketin içeriklerinin listelendiği anasayfa.
 * @param $sirket_id
 * @return bool
 */
function v_icerikAnaSayfa($sirket_id)
{
    $icerik = Icerik::icerikListele($sirket_id);

    return $icerik;
}

/** ======================================================================
 * 2. ANASAYFA FONKSİYONLARI.
 *
 * Ana index.php uzerinden çalışan durumlar için.
 * =======================================================================*/
?>