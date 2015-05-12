<?php
/**
 * Created by PhpStorm.
 * User: Tekin
 * Date: 19.4.2015
 * Time: 22:51
 */

/**
 * @param $sirketId
 * @param $isim
 * @param null $aciklama
 * @param string $aktif
 * @return int|bool
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
    return $ekle->rowCount() > 0 ? $DB->lastInsertId() : false;
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
        $galerininResimleri = $DB->query("SELECT url FROM galeriler_resimler WHERE id_galeri = $galeriId");

        $silResimler = $DB->prepare("DELETE FROM galeriler_resimler WHERE id_galeri = :id");
        $silResimler->bindParam(":id", $galeriId);
        $silResimler->execute();

        while ($silinecek = $galerininResimleri->fetch(PDO::FETCH_ASSOC)) {
            unlink($silinecek["url"]);
        }

        return true; // buraya sorgu koşulu koymadım çünkü galerinin içinde resim olmayabilir
    } else {
        return false;
    }
}

/**
 * @param bool $limit
 * @return array
 */
function galeriGetir($limit = false)
{
    global $DB;
    $limitQuery = $limit == false ? "" : "LIMIT $limit";
    $sirketId = $_SESSION["sirketId"];
    $getirGaleri = $DB->query("SELECT * FROM galeriler $limitQuery WHERE id_sirket = $sirketId");
    if ($getirGaleri->rowCount() == 0) {
        return false;
    }
    $galeri = array();
    $sayac = 1;
    while ($galeriler = $getirGaleri->fetch(PDO::FETCH_ASSOC)) {

        $galeri[$sayac] = array(
            "id" => $galeriler["id"],
            "id_sirket" => $galeriler["id_sirket"],
            "isim" => $galeriler["isim"],
            "aciklama" => $galeriler["aciklama"]
        );

        if (galerininResmiVarMi($galeriler["id"])) {
            $ilkResim = galerininIlkResmi($galeriler["id"]);
            $galeri[$sayac]["on_resim"] = $ilkResim["url"];
        } else {
            $galeri[$sayac]["on_resim"] = base_url("static/images/galeri_bos.png");
        }
        $sayac++;
    }
    return $galeri;
}

/**
 * @param bool $aktifleriGetir
 * @return array|bool
 */
function galeriListele($aktifleriGetir = false)
{
    global $DB;
    $sirketId = $_SESSION["sirketId"];
    $aktifQuery = $aktifleriGetir == true ? "AND aktif = 1" : "";
    $getirGaleri = $DB->query("SELECT id,isim FROM galeriler WHERE id_sirket = '$sirketId' $aktifQuery");
    if ($getirGaleri && $getirGaleri->rowCount() > 0) {
        return $getirGaleri->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return false;
    }
}

/**
 * @param $galeriId
 * @param $inputname
 * @param null $alt
 * @param bool $imageResize
 * @return bool|string
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
        if ($ekle->rowCount() > 0) {
            return $DB->lastInsertId();
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * @param $galeriId
 * @param $resimId
 * @param $alt
 * @return bool
 */
function galeriResimDuzenle($galeriId, $resimId, $alt)
{
    global $DB;

    $duzenle = $DB->prepare("UPDATE galeriler_resimler SET id_galeri = :id_galeri, alt = :alt WHERE id = :id_resim");
    $duzenle->bindParam(":id_galeri", $galeriId);
    $duzenle->bindParam(":alt", $alt);
    $duzenle->bindParam(":id_resim", $resimId);
    $duzenle->execute();

    if ($duzenle->rowCount() > 0) {
        return true;
    } else {
        return false;
    }

}


/**
 * @param $resimId
 * @return bool
 */
function galeriResimSil($resimId)
{
    global $DB;
    $silinecekResim = $DB->query("SELECT url FROM galeriler_resimler WHERE id = $resimId");
    $silinecek = $silinecekResim->fetch(PDO::FETCH_ASSOC);
    $sil = $silinecek["url"];
    $silResimler = $DB->prepare("DELETE FROM galeriler_resimler WHERE id = :id");
    $silResimler->bindParam(":id", $resimId);
    $silResimler->execute();
    if ($silResimler->rowCount() > 0) {
        unlink($sil);
        return true;
    } else {
        return false;
    }
}

/**
 * @param $galeriId
 * @param null $limit
 * @return array|bool
 */
function galeriResimGetir($galeriId, $limit = null)
{
    global $DB;
    $limitQuery = $limit == null ? "" : "LIMIT $limit";
    $getirResimler = $DB->query("SELECT * FROM galeriler_resimler WHERE id_galeri = $galeriId $limitQuery");
    if ($getirResimler && $getirResimler->rowCount() > 0) {
        $resimler = $getirResimler->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $resimler = false;
    }
    return $resimler;
}

/**
 * @param $galeriId
 * @param $haricId
 * @return array|bool
 */
function galerininDigerResimleriListele($galeriId, $haricId)
{
    global $DB;
    $getirResimler = $DB->query("SELECT * FROM galeriler_resimler WHERE id_galeri = $galeriId AND id != $haricId");
    if ($getirResimler && $getirResimler->rowCount() > 0) {
        $resimler = $getirResimler->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $resimler = false;
    }
    return $resimler;
}

/**
 * @param $resimId
 * @param $galeriId
 * @return bool|mixed
 */
function galeriTekilResimGetir($resimId, $galeriId)
{
    global $DB;
    $getirResim = $DB->query("SELECT * FROM galeriler_resimler WHERE id = $resimId AND id_galeri = $galeriId");
    if ($getirResim && $getirResim->rowCount() > 0) {
        $resimDetay = $getirResim->fetch(PDO::FETCH_ASSOC);
    } else {
        $resimDetay = false;
    }
    return $resimDetay;
}


/**
 * @param $link
 * @param $boyut
 * @return bool|string
 */
function resimBoyutunaGoreGetir($link, $boyut)
{
    $rep = "." . strrev($boyut) . "_";
    $ters = str_replace(".", $rep, strrev($link));
    $file = strrev($ters);
    if (file_exists($file)) {
        return strrev($ters);
    } else {
        return false;
    }
}

/**
 * @param $galeriId
 * @return bool
 */
function galerininResmiVarMi($galeriId)
{
    global $DB;
    $resimVarmi = $DB->prepare("SELECT id FROM galeriler_resimler WHERE id_galeri = :id_galeri");
    $resimVarmi->bindParam(":id_galeri", $galeriId);
    $resimVarmi->execute();
    return $resimVarmi->rowCount() > 0 ? true : false;
}

/**
 * @param $galeriId
 * @return bool|mixed
 */
function galerininIlkResmi($galeriId)
{
    global $DB;
    if (galerininResmiVarMi($galeriId)) {
        $ilkResim = $DB->prepare("SELECT * FROM galeriler_resimler WHERE id_galeri = :id_galeri LIMIT 1");
        $ilkResim->bindParam(":id_galeri", $galeriId);
        $ilkResim->execute();

        return $ilkResim->rowCount() > 0 ? $ilkResim->fetch(PDO::FETCH_ASSOC) : false;
    } else {
        return false;
    }
}

?>