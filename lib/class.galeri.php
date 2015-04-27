<?php
/**
 * Created by PhpStorm.
 * User: Tekin
 * Date: 19.4.2015
 * Time: 22:51
 */

// Burada session_start yapınca, bütün sitedeki session'lar da zaten açıldı
// diye hata veriyor. Lazımsa başına @ koyalım, yoksa kaldıralım.
//session_start();




/**
 * @param $sirketId
 * @param $isim
 * @param null $aciklama
 * @param string $aktif
 * @return bool
 */
function galeriEkle($sirketId, $isim, $aciklama = null, $aktif = "1")
{
    global $DB;
    $ekle = $DB->prepare("INSERT INTO galeriler VALUES (null, :sirketId, :isim, :aciklama, :aktif)");
    $ekle->bindParam(":sirketId", $sirketId);
    $ekle->bindParam(":isim", $isim);
    $ekle->bindParam(":aciklama", $aciklama);
    $ekle->bindParam(":aktif", $aktif);
    $ekle->execute();
    return $ekle->rowCount() > 0 ? true : false;
}

/**
 * @param $sirketId
 * @param $isim
 * @param null $aciklama
 * @param string $aktif
 * @param $galeriId
 * @return bool
 */
function galeriDuzenle($sirketId, $isim, $aciklama = null, $aktif = "1", $galeriId)
{
    global $DB;
    $duzenle = $DB->prepare("UPDATE galeriler SET id_sirket = :sirketId, isim = :isim, aciklama = :aciklama, aktif = :aktif WHERE id = :galeriId");
    $duzenle->bindParam(":sirketId", $sirketId);
    $duzenle->bindParam(":isim", $isim);
    $duzenle->bindParam(":aciklama", $aciklama);
    $duzenle->bindParam(":aktif", $aktif);
    $duzenle->bindParam(":galeriId", $galeriId);
    $duzenle->execute();
    return $duzenle->rowCount() > 0 ? true : false;
}

/**
 * @param $galeriId
 * @return bool
 */
function galeriSil($galeriId)
{
    global $DB;
    $silGaleri = $DB->prepare("DELETE FROM galeriler WHERE id = :id");
    $silGaleri->bindParam(":id", $galeriId);
    $silGaleri->execute();
    if ($silGaleri->rowCount() > 0) { // galeri silindiyse içindeki resimler de silinsin
        $silResimler = $DB->prepare("DELETE FROM galeriler_resimler WHERE id_galeri = :id");
        $silResimler->bindParam(":id", $galeriId);
        $silResimler->execute();
        return true; // buraya sorgu koşulu koymadım çünkü galerinin içinde resim olmayabilir
    } else {
        return false;
    }
}

function galeriGetir($limit = null)
{
    global $DB;
    $limitQuery = $limit == null ? "" : "LIMIT $limit";
    $getirGaleri = $DB->query("SELECT * FROM galeriler $limitQuery");
    return $getirGaleri->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @param $galeriId
 * @param $inputname
 * @param null $alt
 * @param bool $imageResize
 * @return bool
 */
function galeriResimEkle($galeriId, $inputname, $alt = null, $imageResize = false)
{
    global $DB;
    $image = ResimIslemleri::imageUpload($inputname, $imageResize);
    if ($image[0] == true) {
        $ekle = $DB->prepare("INSERT INTO galeriler_resimler VALUES (null, :galeriId, :url, :alt)");
        $ekle->bindParam(":galeriId", $galeriId);
        $ekle->bindParam(":url", $image[1]);
        $ekle->bindParam(":alt", $alt);
        $ekle->execute();
        return $ekle->rowCount() > 0 ? true : false;
    } else {
        return false;
    }
}

function galeriResimDuzenle($galeriId, $alt = null, $resimId)
{
    global $DB;
    $duzenle = $DB->prepare("UPDATE galeriler_resimler SET id_galeri = :id_galeri, alt = :alt WHERE id = :id_resim");
    $duzenle->bindParam(":id_galeri", $galeriId);
    $duzenle->bindParam(":alt", $alt);
    $duzenle->bindParam(":id_resim", $resimId);
    $duzenle->execute();
    return $duzenle->rowCount() > 0 ? true : false;
}

/**
 * @param $resimId
 */
function galeriResimSil($resimId)
{
    global $DB;
    $silResimler = $DB->prepare("DELETE FROM galeriler_resimler WHERE id = :id");
    $silResimler->bindParam(":id", $resimId);
    $silResimler->execute();
}

function galeriResimGetir($galeriId, $limit = null)
{
    global $DB;
    $limitQuery = $limit == null ? "" : "LIMIT $limit";
    $getirResimler = $DB->query("SELECT * FROM galeriler_resimler WHERE id_galeri = $galeriId LIMIT $limitQuery");
    return $getirResimler->fetchAll(PDO::FETCH_ASSOC);
}

?>