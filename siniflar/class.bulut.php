<?php
/**
 * Class Bulut
 *
 * Statik Bulut sınıfı ve metodları.
 */

class Bulut
{
    public $DB;

    function __construct()
    {
        $host = "localhost";
        $dbname = "bulut";
        $user = "root";
        $pass = "";
        //$dsn = "mysql:host=$host;dbname=$dbname";
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            $this->DB = new PDO($dsn, $user, $pass);
            //$this->DB->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            echo "[HATA]: Veritabanı -".$e->getMessage();
        }
    }

    /**
     * Kullanıcı ve Şirket arasında normalizasyon işlemi.
     *
     * @not: parametreler vs $_COOKIE'den alınacak kayıt işlemi
     * sırasında.
     *
     * @param $id_kullanici     (int) Kullanıcı id'si.
     * @param $id_sirket        (int) Şirket id'si.
     * @return bool
     */
    public static
    function normalizasyonSirket($id_kullanici, $id_sirket)
    {

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // Sorgunun hazırlanması.
        $sorgu = $db->prepare("INSERT INTO kullanicilar_sirket (id, id_kullanici, id_sirket) VALUES (NULL, ?, ?)");
        $islem = $sorgu->execute(array($id_kullanici, $id_sirket));

        if ($islem) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Kullanıcı ve Roller arasında normalizasyon işlemi.
     *
     * @not: parametreler vs $_COOKIE'den alınacak kayıt işlemi
     * sırasında.
     *
     * @param $id_kullanici (int) Cookie'den alınan kullanıcı id'si.
     * @param $id_rol       (int) Cookie'den alınan rol id'si
     * @return bool
     */
    public static
    function normalizasyonRoller($id_kullanici, $id_rol)
    {


        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // Sorgunun hazırlanması.
        $sorgu = $db->prepare("INSERT INTO kullanicilar_roller(id, id_kullanici, id_rol) VALUES (NULL, ?, ?)");
        // !!!: Bir sebepten bindParam çalışmıyor.
        $islem = $sorgu->execute(array($id_kullanici, $id_rol));

        if ($islem) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     *
     * Verilen kullanıcı id'si ile kullanıcı rolünün getirilmesi.
     * Eğer kullaniciRol(1, $DB, true) şeklinde kullanılırsa
     * rol'ün id'si yerine açık ismini getirir.
     *
     *
     * ÖNEMLİ:
     * ~~~~~~~
     * Bu fonksiyonun return ile kontroller de if(true) vs
     * yerine if($rol>=0) gibi bir kullanım gerekli. SüperAdmin rolü
     * "0" dönüyor. if($rol)'de bu durum FALSE a sebep olacaktır.
     *
     * @param $id_kullanici     Kullanıcı id'si
     * @param $DB               Veritabanı bağlantısı.
     * @param $aciklama bool    Rol id'si sayi yerine isim olarak mı gelsin?
     * @return array|string
     */
    public static
    function kullaniciRolu($id_kullanici, $aciklama=false)
    {

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // Kullanıcı rolunun veritabanından çekilmesi.
        $sorgu = $db->prepare("SELECT id_rol FROM kullanicilar_roller WHERE id_kullanici = :id_kullanici");
        $sorgu->bindParam(":id_kullanici", $id_kullanici);
        $sorgu->execute();

        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuc) {
            // İleride bir kullanıcıya birden fazla rol verme ihtimali
            // doğmasına karşın.

            if (count($sonuc) > 1) {
                // Eğer birden fazla rol döner ise array dön.
                $roller = array();
                foreach($sonuc as $son) {
                    $roller[] = $aciklama ? Bulut::rolIsim($son["id_rol"]): $son["id_rol"];
                }

                return $roller;
            }
            else {
                $rol = $aciklama ? Bulut::rolIsim($sonuc[0]["id_rol"]): $sonuc[0]["id_rol"];
                return $rol;
            }

        }
        else {
            // !ÖNEMLİ: false değil -1 dönüyor.
            return "-1";
        }

    }

    /**
     * Verilen rol id'si ile rol'ün tam ismini getirir.
     *
     * NOT: kullaniciRol() ile kullanmak içen özellikle.
     * @param $id_rol       Rol id'si
     * @return bool|string
     */
    public static
    function rolIsim($id_rol)
    {

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // sorgu işlemi.
        $sorgu = $db->prepare("SELECT rol FROM roller WHERE id= :id_rol");
        $sorgu->bindParam(":id_rol", $id_rol);
        $sorgu->execute();

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if($sonuc) {
            return $sonuc["rol"];
        }
        else {
            return false;
        }
    }

    /**
     * Oturum açılımında kullanılıyor. Parametreleri formdan
     * alıyor.
     *
     * Başarısız olması durumunda false döner.
     *
     * @param $mail
     * @param $sifre
     * @param bool $hatirla
     * @return bool
     */
    public static
    function oturumAc($mail, $sifre, $hatirla=false) //default false olsun. gelince değiştiririz.
    {
        // Statik sınıf işlemleri.
        $obj=new static();
        $db=$obj->DB;

        $mail = trim($mail);
        $sifre = md5(trim($sifre));

        $sorgu = $db->prepare("SELECT * FROM kullanicilar WHERE mail = :mailAdres and sifre = :sifre LIMIT 1");
        $sorgu->bindValue(':mailAdres', $mail);
        $sorgu->bindValue(':sifre',  $sifre);
        $sorgu->execute();
        $kontrol = $sorgu->fetch(PDO::FETCH_ASSOC);

        if (!empty($kontrol)){
            $row_id = $kontrol['id'];
            $mail=$kontrol["mail"];
            $adi=$kontrol["adi"]." ".$kontrol["soyadi"];

            // Session oluşturumu.
            $_SESSION['kulId'] = $row_id;
            $_SESSION['kulAdi'] = $adi;
            $_SESSION['kulMail'] = $mail;
            $_SESSION['kulRol'] = Bulut::kullaniciRolu($row_id);
            // Kullanıcı'nın ait olduğu şirket id'sinin tutulması.
            $_SESSION['sirketId'] = self::kullaniciSirket($row_id);

            if($hatirla) {
                include "../fonksiyonlar.php";
                // NOT: Cookie'ler "/" path'i altında tanımlanması gerekiyor.
                // sonra sitenin kalan kısımlarında ulaşamıyoruz.
                setcookie("hatirla", true, time() + 60 * 60 * 24, "/");
                setcookie("kulId", idEncode($row_id), time()+60*60*24, "/");
                setcookie("kulAdi", $adi, time()+60*60*24, "/");
                setcookie("kulMail", $mail, time()+60*60*24, "/");
                // Ekstradan bir veritaban sorgusu yapmıyoruz.
                setcookie("kulRol", idEncode($_SESSION["kulRol"]), time()+60*60*24, "/");
                // Cookie'de kullanıcının ait olduğu şirket id'sinin saklanması.
                setcookie("sirketId", idEncode($_SESSION["sirketId"]), time()+60*60*24, "/");
            }

            return true;

        }else{
            return false;
        }

    }

    /**
     * Cookie içinde tanımlanmış beni hatırla var mı diye bakar.
     *
     * Duruma göre false veya true döner.
     *
     * @return bool
     */
    public static
    function beniHatirlaKontrol()
    {
        // return isset($_COOKIE["hatirla"]) && $_COOKIE[hatirla] ? true : false;
        return isset($_COOKIE["hatirla"]) && $_COOKIE["hatirla"];
        ///asdasdasdasdasd
        // sadece return demek yeterli. Çünkü buradan direkt true veya false gelecek.
    }

    /** Sifre sıfırlama işlemi için key oluşturur.
     *
     * Array geri döner.
     *  [0] -> veri tabanına girilmek üzere key'i içerir.
     *
     * @return array
     */
    public static
    function sifreSifirlamaKeyOlustur()
        // function sifre_sifirlama_key_olustur ()
    {

        $key = "";

        $katar = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $katar = str_split($katar);
        $katar_uzunluk = count($katar) - 1;

        for ($sinir = 0; $sinir < 50; $sinir ++) {
            $rand = rand(0, $katar_uzunluk);
            $key .= $katar[$rand];
        }
        $url = SITEURL.'/?sayfa=sifirla&key='.$key;
        $prelink = SITEURLSPAN.'/?sayfa=sifirla&key='.$key;
        $link = '<a href="'.SITEURL.'/?sayfa=sifirla&key=' . $key . '">' . $url . '</a>';

        return array(
            $key,
            $link,
            $prelink
        );
        // Sonuç array döner.
        // [0]. eleman veritabanına girilmek üzere sadece key i verir.
        // [1]. eleman da mailde gönderilmek üzere link haline getirilmiş değeri verir.
        // [2]. eleman da mailde gönderilmek üzere string halde link i verir.
    }

    /**
     * Şirket tablosuna şirket eklenmesi.
     *
     * @param $adi
     * @param $adres
     * @param $tel
     * @param $logo
     * @param $sektor
     * @param $premium
     * @param $ref_kod
     * @param $tarih
     * @return bool
     */
    public static
    function sirketEkle($adi, $adres, $tel, $logo, $sektor, $premium, $ref_kod, $tarih){

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // Sorgunun hazırlanması.
        $sorgu = $db->prepare("INSERT INTO sirket  VALUES (NULL, ?,?,?,?,?,?,?,?)");
        $islem = $sorgu->execute(array($sektor,$adi,$adres,$tel,$logo,$premium,$ref_kod,$tarih));

        if ($islem) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Kullanicilar tablosuna kayıt ekleme işlemi.
     *
     * @param $adi
     * @param $soyadi
     * @param $mail
     * @param $sifre
     * @param $tarih
     * @return bool
     */
    public static
    function kullaniciEkle($adi, $soyadi, $mail, $sifre, $tarih){
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // Sorgunun hazırlanması.
        $sorgu = $db->prepare("INSERT INTO kullanicilar  VALUES (NULL,?,?,?,?,?,?)");
        $islem = $sorgu->execute(array($adi,$soyadi,$mail,$sifre,$tarih,$tarih));

        if ($islem) {
            return true;
        }
        else {
            return false;
        }
    }


    /**
     * Şirket kaydı sırasında şirket'in hesabı için kullanılmak için benzersiz md5'li
     * bir referans kodu oluşturulması.
     *
     * @param $sirketAdi
     * @return string
     */
    public static
    function refOlustur($sirketAdi)
    {
        $key="";
        $tarih = date("YFlHis");

        $katar = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $katar = str_split($katar);
        $katar_uzunluk = count($katar) - 1;

        for ($sinir = 0; $sinir < 5; $sinir ++) {
            $rand = rand(0, $katar_uzunluk);
            $key .= $katar[$rand];
        }

        $ref = md5($sirketAdi.$key.$tarih);

        return $ref;
    }

    /**
     * Girilen email veritabanında mevcut mu?
     *
     * Varsa verileri döner, yoksa false döner.
     *
     * @param $email
     * @return bool
     */
    public static
    function emailSorgu($email)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("SELECT `id`,`adi`,`soyadi`,`mail` FROM kullanicilar WHERE mail = :mail");
        $sorgu->bindParam(":mail", $email);
        $sorgu->execute();
        $emailBilgileri = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if (count($emailBilgileri) > 0) {
            return $emailBilgileri[0];
        }
        else {
            return false;
        }
    }

    /**
     * Referans kodundan şirketin sorgulanması.
     *
     * @param $ref
     * @return bool
     */
    public static
    function GetSirketWithRefCode($ref)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;
        $sorgu = $db->prepare("SELECT * FROM sirket WHERE ref_kod = :ref");
        $sorgu->bindParam(":ref", $ref);
        $sorgu->execute();
        $sirketBilgileri = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        if (count($sirketBilgileri) > 0) {
            return $sirketBilgileri[0];
        }
        else {
            return false;
        }
    }


    /**
     * Kullanıcı id'sinden kullanıcının ait olduğu şirketin id'sinin
     * elde edilmesi.
     *
     * NOT: kullanıcı id'si tabloda bulunamadığı takdirde de false
     * döner.
     *
     * @param $kulId
     * @return string
     */
    public static
    function kullaniciSirket($kulId)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("SELECT * FROM kullanicilar_sirket WHERE id_kullanici=:id_kul");
        $sorgu->bindParam(":id_kul", $kulId);
        $sorgu->execute();

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc["id_sirket"];
        }
        elseif ($sonuc == null) {
            return false;
        }
        else {
            false;
        }
    }


    /**
     * Kullanıcı resim yükleme işlemleri için.
     *
     * @param $inputname
     * @param bool $maximum_dosya_boyutu
     * @return bool|int
     */
    public static
    function imageUpload($inputname, $maximum_dosya_boyutu = false)
    {
        $obj = new static();
        $db = $obj->DB;

        /**
         * *
         * dosya isimleri bu şekilde olsun ki dosyalara site dışından erişimimiz de kolay ve anlamlı olsun.
         * aynı kullanıcının resimleri ard arda görünsün..
         * *
         */

        $dosyaAdi = idEncode($_SESSION["sirketId"]) . "_" . date("YmdHis");

        // $izinverilenDosyalar = array("jpg","jpeg","png","gif","bmp");
        $izinVerilenTurler = array(
            "jpg",
            "jpeg",
            "png"
        ); // sadece bunlara izin verelim.

        // TODO: Bu kısım, eğer fonksiyon index dışında bir yerden çağırılırsa direkt o kısma
        // klasör açabilir.
        // Yani admin/login.php'de çağırdık diyelim. "upload" ve altındaki klasörleri orada
        // açabilir.
        // $_SERVER["DOCUMENT_ROOT"]
        // Sorun çıkarırsa bunu kullanırız.
        $klasoryolu = UPLOAD_DIR . "/" . date("Y-m");
        $maximum_dosya_boyutu = $maximum_dosya_boyutu == false ? 1024 * 1024 * 2 : $maximum_dosya_boyutu;

        if (! file_exists($klasoryolu)) {
            mkdir($klasoryolu, 0777, true);
        }

        $dosyaHatasi = $_FILES[$inputname]["error"]; // integer değer döner.
        if ($dosyaHatasi != 0) {
            // echo "Dosya yüklemesinde bir hata oluştu";
            return 2; // file upload sırasında bir hata
        } else {
            $boyut = $_FILES[$inputname]["size"];
            if ($boyut > ($maximum_dosya_boyutu)) {
                return 3; // "Dosya boyutu 2 MB'tan daha büyük olamaz!";
            } else {
                $dosyaTipi = $_FILES["dosya"]["type"];

                $durum = false;
                for ($i = 0; $i < count($izinVerilenTurler); $i ++) {
                    if (("image/" . $izinVerilenTurler[$i]) == $dosyaTipi) {
                        $dosyaUzanti = $izinVerilenTurler[$i];
                        $durum = true;
                        break;
                    }
                }

                if ($durum) {
                    $path = $_FILES[$inputname]["tmp_name"];
                    if (! getimagesize($_FILES[$inputname]["tmp_name"]) & is_executable($_FILES[$inputname]["tmp_name"])) {
                        return 4; // Dosya resim değil
                    } else {
                        if (copy($path, $klasoryolu . "/" . $dosyaAdi . "." . $dosyaUzanti)) {
                            $update = $db->exec("UPDATE sirket SET logo = '" . $klasoryolu . "/" . $dosyaAdi . "." . $dosyaUzanti . "' WHERE id = " . $_SESSION["sirketId"]);
                            if ($update) {
                                return true;
                            } else {
                                return 5; // update hatası
                            }
                        } else {
                            return 6; // copy fonksiyonu hatası
                        }
                    }
                } else {
                    return 7; // "İzin verilmeyen dosya türü
                }
            }
        }
    }

    /**
     * Şirket bilgileri ve toplam kullanıcı sayısını geri döner.
     * Dönen indisler:
     *  id, id_sektor, sektor_adi, adi,
     *  adres, tel, logo, premium, yetkili, yetkili_mail
     *  tarih_kayit, kullanici_sayisi.
     *
     *  NOT: Ayrıntılı kullanıcı sayılarına getirSirketKullanıcılar() ile
     *  ulaşabilirsiniz.
     * @return mixed
     */
    public static
    function getirSirketler()
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
        SELECT s.id, s.id_sektor, (SELECT sektor_adi FROM sektor WHERE id = s.id) AS sektor_adi,
        s.adi, s.adres, s.tel, s.logo, s.premium, CONCAT(s.yetkili_adi, ' ', s.yetkili_soyadi) AS yetkili,
        s.yetkili_mail, s.tarih_kayit, COUNT(ks.id_kullanici) AS kullanici_sayisi
        FROM sirket AS s
        INNER JOIN
        kullanicilar_sirket AS ks WHERE id_sirket = s.id GROUP BY (id_sirket)
        ");

        $sorgu->execute();
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        return $sonuc;
    }


    /**
     * getirSirketler gibi çalışıyor. Ama sadece
     * bir şirket getiriyor.
     *
     * @param $sirket_id
     * @return mixed
     */
    public static
    function getirSirket($sirket_id)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
        SELECT s.id, s.id_sektor, (SELECT sektor_adi FROM sektor WHERE id = s.id) AS sektor_adi,
        s.adi, s.adres, s.tel, s.logo, s.premium, CONCAT(s.yetkili_adi, ' ', s.yetkili_soyadi) AS yetkili,
        s.yetkili_mail, s.tarih_kayit, COUNT(ks.id_kullanici) AS kullanici_sayisi
        FROM sirket AS s
        INNER JOIN
        kullanicilar_sirket AS ks WHERE id_sirket = s.id AND s.id = :sirket GROUP BY (id_sirket)
        ");

        $sorgu->bindParam(":sirket", $sirket_id );
        $sorgu->execute();
        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        return $sonuc;
    }


    /**
     * Verilen şirketteki verilen kullanıcı rolüne ait
     * kullanici sayısını getirir. Veya o tipte kullanıcı
     * yoksa 0 getirir.
     *
     * @param $rol_id
     * @param $sirket_id
     * @return string
     */
    public static
    function getirSirketKullanicilar($rol_id, $sirket_id)
    {
        // Şirket admin: 1
        // Sirket çalışanı: 2
        // Şirket müşterisi: 3

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
        SELECT COUNT(ks.id_kullanici) AS kullanici_sayisi, ks.id_sirket, kr.id_rol
        FROM kullanicilar_sirket AS ks
        INNER JOIN
        kullanicilar_roller AS kr WHERE kr.id_kullanici = ks.id_kullanici
        AND kr.id_rol = ? AND ks.id_sirket = ?
        GROUP BY ks.id_sirket
        ");

        $sorgu->execute(array($rol_id, $sirket_id));
        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc["kullanici_sayisi"];
        }
        else {
            return "0";
        }
    }


}

?>