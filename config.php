<?php

// DB Connection.
$host = "localhost";
$dbname = "bulut";
$user = "root";
$pass = "";
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $DB = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo "[HATA]: Veritabanı -".$e->getMessage();
}


/** ----------------------------------------------------------------------
 *
 * Site içi kullanılacak değişmez değişkenlerin tanımlanması.
 *
 ------------------------------------------------------------------------*/

// Site içi linklerde GET ile kullanılacak değişken adı.
// localhost/bulut/index.php?sayfa=iletisim   gibi.
define("SAYFA", "sayfa");
define("SITEURL", "http://localhost/proje");
define("UPLOAD_DIR", "upload"); // uploadlarımızı tek bir klasör çatısı altında tutalım diye

// Şifre unuttum için gönderilen mail'de Google'ın otomatik linke
// çevirmesini engellemek için işlemler.
$siteurl = explode(".",SITEURL);
@define("SITEURLSPAN", $siteurl[0].".<span>".$siteurl[1]."</span>.".$siteurl[2]); // mailde link olarak göstermemek için adresi bölüp aralara span koyuyoruz

// Site adı.
// <title> arasında vs kullanma amaçlı.
define("SITE_ADI", "Bulut");

// *.tmpl.php dosyalarında güvenlik için kullanılacak değişken.
// güvenlik gerektiren tmpl dosyalarının kontrol dışı çağırılmasını engellemek için.
// her bir *.tmpl.php dosyası bu değişken var mı kontrol edecek.
define("TMPL_KONTROL", "Kontrol");

/**
 * TWIGGY için değişkenler.
 */

define("TEMP_KLASOR", "templates");
define("CACHE_KLASOR", "cache");


?>
