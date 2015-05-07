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
    $ekle = $DB->prepare("INSERT INTO galeriler VALUES (null, :sirketId, :isim, :aciklama, :on_resim, :aktif)");
    $ekle->bindParam(":sirketId", $sirketId);
    $ekle->bindParam(":isim", $isim);
    $ekle->bindParam(":aciklama", $aciklama);
    $ekle->bindParam(":on_resim", 0);
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
        $galerininKacResmiVar = $DB->query("SELECT COUNT(*) FROM galeriler_resimler WHERE id_galeri = " . $galeriler["id"]);
        $galerininResimleri = $galerininKacResmiVar->fetch(PDO::FETCH_ASSOC);
        $onResimGetir = $DB->query(
            "SELECT url FROM galeriler_resimler WHERE id = " . $galeriler["on_resim"]);
        $onResim = $onResimGetir->fetch(PDO::FETCH_ASSOC);
        $galeri[$sayac] = array(
            "id" => $galeriler["id"],
            "id_sirket" => $galeriler["id_sirket"],
            "isim" => $galeriler["isim"],
            "aciklama" => $galeriler["aciklama"]
        );
        $galeri[$sayac]["on_resim"] = $galerininResimleri["COUNT(*)"] > 0 ? $onResim["url"] : base_url("static/images/galeri_bos.png");
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
 * @return bool
 */
function galeriResimEkle($galeriId, $inputname, $alt = null, $imageResize = false)
{
    global $DB;
    $image = ResimIslemleri::imageUpload($inputname, $imageResize);
    if ($image[0] == true) {
        $onResimAtansin = galerininResmiVarMi($galeriId) == false ? true : false;

        $ekle = $DB->prepare("INSERT INTO galeriler_resimler VALUES (null, :galeriId, :url, :alt)");
        $ekle->bindParam(":galeriId", $galeriId);
        $ekle->bindParam(":url", $image[1]);
        $ekle->bindParam(":alt", $alt);
        $ekle->execute();
        if ($ekle->rowCount() > 0) {
            if ($onResimAtansin) {
                $onResimAta = $DB->prepare("UPDATE galeriler SET on_resim = :on_resim WHERE id = :galeriId");
                $onResimAta->bindParam(":on_resim", $DB->lastInsertId());
                $onResimAta->bindParam(":galeriId", $galeriId);
                $onResimAta->execute();
                return $onResimAta->rowCount() > 0 ? true : false;
            } else {
                return true;
            }
        }
    } else {
        return false;
    }
}

/**
 * @param $galeriId
 * @param null $alt
 * @param $resimId
 * @return bool
 */
function galeriResimDuzenle($galeriId, $resimId, $alt)
{
    global $DB;
    $eskiOnResimMi = $DB->prepare("SELECT id_galeri FROM galeriler_resimler WHERE id = :resim_id");
    $eskiOnResimMi->bindParam(":resim_id", $resimId);
    $eskiOnResimMi->execute();
    $eskiGalerininBaskaResmiVarMi = $eskiOnResimMi->rowCount() > 1 ? true : false; // üzerinde işlem yaptığımız dosya galerinin ön resmi

    if ($eskiGalerininBaskaResmiVarMi) {
        $eskiGaleri = $eskiOnResimMi->fetch(PDO::FETCH_ASSOC);
        $eskiGaleriId = $eskiGaleri["id_galeri"];
    } else {
        $eskiGaleriId = false;
    }

    $yeniOnResimMi = $DB->prepare("SELECT id FROM galeriler_resimler WHERE id_galeri = :id_galeri");
    $yeniOnResimMi->bindParam(":id_galeri", $galeriId);
    $yeniOnResimMi->execute();
    $yeniGalerininIlkResmiMi = $yeniOnResimMi->rowCount() > 0 ? true : false;

    $duzenle = $DB->prepare("UPDATE galeriler_resimler SET id_galeri = :id_galeri, alt = :alt WHERE id = :id_resim");
    $duzenle->bindParam(":id_galeri", $galeriId);
    $duzenle->bindParam(":alt", $alt);
    $duzenle->bindParam(":id_resim", $resimId);
    $duzenle->execute();

    if ($duzenle->rowCount() > 0) {
        if ($galeriId == $eskiGaleriId["id_galeri"]) {
            return true;
        } else {
            $eskiyeResimAtandi = true;
            $yeniyeResimAtandi = true;
            if ($yeniGalerininIlkResmiMi) {
                $yeniyeResimAtandi = galeriyeOnResimAta($galeriId, $resimId);
            }

            if (!$eskiGalerininBaskaResmiVarMi) {
                $eskiyeResimAtandi = galeriyeOnResimAta($eskiGaleriId, 0);
            } else {
                $eskiAlbum = $DB->prepare("SELECT * FROM galeri WHERE id = :id_galeri AND on_resim = :on_resim");
                $eskiAlbum->bindParam(":id_galeri", $eskiGaleriId);
                $eskiAlbum->bindParam(":on_resim", $resimId);
                $eskiAlbum->execute();
                if ($eskiAlbum->rowCount() > 0) { // bu resim eski albümün ön resmiydi
                    if (galerininResmiVarMi($eskiGaleriId)) {
                        $galerininIlkResmi = galerininIlkResmi($eskiGaleriId);
                        $galerininIlkResimId = $galerininIlkResmi["id"];
                        $yeniyeResimAtandi = galeriyeOnResimAta($eskiGaleriId, $galerininIlkResimId);
                    } else {
                        $yeniyeResimAtandi = galeriyeOnResimAta($eskiGaleriId, 0);
                    }
                }
            }
            return $eskiyeResimAtandi && $yeniyeResimAtandi ? true : false;
        }
    }

}

/**
 * @param $resimId
 * @return bool
 */
function galeriResimSil($resimId, $galeriId)
{
    global $DB;
    $silResimler = $DB->prepare("DELETE FROM galeriler_resimler WHERE id = :id");
    $silResimler->bindParam(":id", $resimId);
    $silResimler->execute();
    if ($silResimler->rowCount() > 0) {
        if (galerininResmiVarMi($galeriId) == false) {
            $onResimAta = $DB->prepare("UPDATE galeriler SET on_resim = '0' WHERE id = :galeriId");
            $onResimAta->bindParam(":galeriId", $galeriId);
            $onResimAta->execute();
            return $onResimAta->rowCount() > 0 ? true : false;
        }
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
 * @param $resimId
 * @return array|bool
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

function galerininResmiVarMi($galeriId)
{
    global $DB;
    $resimVarmi = $DB->prepare("SELECT id FROM galeriler_resimler WHERE id_galeri = :id_galeri");
    $resimVarmi->bindParam(":id_galeri", $galeriId);
    $resimVarmi->execute();
    return $resimVarmi->rowCount() > 0 ? true : false;
}

function galerininIlkResmi($galeriId)
{
    global $DB;
    if (galerininResmiVarMi($galeriId)) {
        $ilkResim = $DB->query("SELECT * FROM galeriler_resimler WHERE id_galeri = :id_galeri LIMIT 1");
        $ilkResim->bindParam(":id_galeri", $galeriId);
        $ilkResim->execute();
        return $ilkResim->rowCount() > 0 ? $ilkResim->fetch(PDO::FETCH_ASSOC) : false;
    } else {
        return false;
    }
}

function galeriyeOnResimAta($galeriId, $resimId)
{
    global $DB;
    $update = $DB->prepare("UPDATE galeriler SET on_resim = :resim_id WHERE id = :galeri_id");
    $update->bindParam(":resim_id", $resimId);
    $update->bindParam(":galeri_id", $galeriId);
    $update->execute();
    return $update->rowCount() > 0 ? true : false;
}

?>