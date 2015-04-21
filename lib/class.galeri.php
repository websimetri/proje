<?php
/**
 * Created by PhpStorm.
 * User: Tekin
 * Date: 19.4.2015
 * Time: 22:51
 */

require_once 'SimpleImage.php';
require_once 'class.image.php';

session_start();

$_SESSION["sirketId"] = 1;

// DB Connection.
$host = "localhost";
$dbname = "bulut";
$user = "root";
$pass = "";
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
	$DB = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
	echo "[HATA]: Veritabanı -" . $e->getMessage();
}

function idEncode($id)
{
	// Base64 ile ID encode işlemi.
	$enc = base64_encode($id);

	return $enc;
}

define("UPLOAD_DIR", "upload");


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
	if ($ekle->rowCount() > 0) {
		return true;
	} else {
		return false;
	}
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
 * @param $galeriId
 * @param $inputname
 * @param null $alt
 * @param bool $imageResize
 * @return bool
 */
function galeriResimEkle($galeriId, $inputname, $alt = null, $imageResize = false)
{
	global $DB;
	if ($image = ResimIslemleri::imageUpload($inputname, $imageResize)) {
		$ekle = $DB->prepare("INSERT INTO galeriler_resimler VALUES (null, :galeriId, :url, :alt)");
		$ekle->bindParam(":galeriId", $galeriId);
		$ekle->bindParam(":url", $image);
		$ekle->bindParam(":alt", $alt);
		$ekle->execute();
		if ($ekle->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
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

galeriResimSil(5);

?>