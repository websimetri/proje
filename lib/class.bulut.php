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
            echo "[HATA]: Veritabanı -" . $e->getMessage();
        }
    }

    /**
     * Kullanıcı ve Şirket arasında normalizasyon işlemi.
     *
     * @not: parametreler vs $_COOKIE'den alınacak kayıt işlemi
     * sırasında.
     *
     * @param $id_kullanici (int) Kullanıcı id'si.
     * @param $id_sirket (int) Şirket id'si.
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
        } else {
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
     * @param $id_rol (int) Cookie'den alınan rol id'si
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
        } else {
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
    function kullaniciRolu($id_kullanici, $aciklama = false)
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
                foreach ($sonuc as $son) {
                    $roller[] = $aciklama ? Bulut::rolIsim($son["id_rol"]) : $son["id_rol"];
                }

                return $roller;
            } else {
                $rol = $aciklama ? Bulut::rolIsim($sonuc[0]["id_rol"]) : $sonuc[0]["id_rol"];
                return $rol;
            }

        } else {
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

        if ($sonuc) {
            return $sonuc["rol"];
        } else {
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
    function oturumAc($mail, $sifre, $hatirla = false) //default false olsun. gelince değiştiririz.
    {
        // Statik sınıf işlemleri.
        $obj = new static();
        $db = $obj->DB;

        $mail = trim($mail);
        $sifre = md5(trim($sifre));

        $sorgu = $db->prepare("SELECT * FROM kullanicilar WHERE mail = :mailAdres and sifre = :sifre LIMIT 1");
        $sorgu->bindValue(':mailAdres', $mail);
        $sorgu->bindValue(':sifre', $sifre);
        $sorgu->execute();
        $kontrol = $sorgu->fetch(PDO::FETCH_ASSOC);

        if (!empty($kontrol)) {
            $row_id = $kontrol['id'];
            $mail = $kontrol["mail"];
            $adi = $kontrol["adi"] . " " . $kontrol["soyadi"];

            // Session oluşturumu.
            $_SESSION['kulId'] = $row_id;
            $_SESSION['kulAdi'] = $adi;
            $_SESSION['kulMail'] = $mail;
            $_SESSION['kulRol'] = Bulut::kullaniciRolu($row_id);
            // Kullanıcı'nın ait olduğu şirket id'sinin tutulması.
            $_SESSION['sirketId'] = self::kullaniciSirket($row_id);

            if ($hatirla) {
                //include "fonksiyonlar.php";
                // NOT: Cookie'ler "/" path'i altında tanımlanması gerekiyor.
                // sonra sitenin kalan kısımlarında ulaşamıyoruz.
                setcookie("hatirla", true, time() + 60 * 60 * 24, "/");
                setcookie("kulId", idEncode($row_id), time() + 60 * 60 * 24, "/");
                setcookie("kulAdi", $adi, time() + 60 * 60 * 24, "/");
                setcookie("kulMail", $mail, time() + 60 * 60 * 24, "/");
                // Ekstradan bir veritaban sorgusu yapmıyoruz.
                setcookie("kulRol", idEncode($_SESSION["kulRol"]), time() + 60 * 60 * 24, "/");
                // Cookie'de kullanıcının ait olduğu şirket id'sinin saklanması.
                setcookie("sirketId", idEncode($_SESSION["sirketId"]), time() + 60 * 60 * 24, "/");
            }

            return true;

        } else {
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

        for ($sinir = 0; $sinir < 50; $sinir++) {
            $rand = rand(0, $katar_uzunluk);
            $key .= $katar[$rand];
        }
        $url = SITEURL . '/?sayfa=sifirla&key=' . $key;
        $prelink = SITEURLSPAN . '/?sayfa=sifirla&key=' . $key;
        $link = '<a href="' . SITEURL . '/?sayfa=sifirla&key=' . $key . '">' . $url . '</a>';

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
    function sirketEkle($adi, $adres, $tel, $sektor, $premium, $ref_kod, $kullaniciAdi, $kullaniciSoyadi, $mail, $sifre, $tarih)
    {

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // Sorgunun hazırlanması.
        $sorgu = $db->prepare("INSERT INTO sirket  VALUES (NULL, ?,?,?,?,?,?,?,?,?,?,?,?)");
        $islem = $sorgu->execute(array($sektor, $adi, $adres, $tel, "", $premium, $ref_kod, $kullaniciAdi, $kullaniciSoyadi, $mail, $sifre, $tarih));

        if ($islem) {
            return true;
        } else {
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
    function kullaniciEkle($adi, $soyadi, $mail, $sifre, $tarih)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // Sorgunun hazırlanması.
        $sorgu = $db->prepare("INSERT INTO kullanicilar  VALUES (NULL,?,?,?,?,?,?)");
        $islem = $sorgu->execute(array($adi, $soyadi, $mail, $sifre, $tarih, $tarih));

        if ($islem) {
            return true;
        } else {
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
        $key = "";
        $tarih = date("YFlHis");

        $katar = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $katar = str_split($katar);
        $katar_uzunluk = count($katar) - 1;

        for ($sinir = 0; $sinir < 5; $sinir++) {
            $rand = rand(0, $katar_uzunluk);
            $key .= $katar[$rand];
        }

        $ref = md5($sirketAdi . $key . $tarih);

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
        } else {
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
        } else {
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
        } elseif ($sonuc == null) {
            return false;
        } else {
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

        if (!file_exists($klasoryolu)) {
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
                for ($i = 0; $i < count($izinVerilenTurler); $i++) {
                    if (("image/" . $izinVerilenTurler[$i]) == $dosyaTipi) {
                        $dosyaUzanti = $izinVerilenTurler[$i];
                        $durum = true;
                        break;
                    }
                }

                if ($durum) {
                    $path = $_FILES[$inputname]["tmp_name"];
                    if (!getimagesize($_FILES[$inputname]["tmp_name"]) & is_executable($_FILES[$inputname]["tmp_name"])) {
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
     * Verilen id'den kullanıcı bilgilerini getirir.
     *
     * @param $kul_id
     * @return array
     */
    public static
    function getirKullanici($kul_id)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
            SELECT * FROM kullanicilar WHERE id = :kul_id
        ");
        $sorgu->bindParam("kul_id", $kul_id);
        $sorgu->execute();

        $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($kullanici) {
            $kullanici["id_enc"] = idEncode($kullanici["id"]);
            return $kullanici;
        } else {
            return false;
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
        s.yetkili_mail, s.tarih_kayit, s.aktif, COUNT(ks.id_kullanici) AS kullanici_sayisi
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
        SELECT s.id, s.id_sektor, (SELECT sektor_adi FROM sektor WHERE id = s.id_sektor) AS sektor_adi,
        s.adi, s.adres, s.tel, s.logo, s.premium, CONCAT(s.yetkili_adi, ' ', s.yetkili_soyadi) AS yetkili,
        s.yetkili_mail, s.tarih_kayit, s.aktif, COUNT(ks.id_kullanici) AS kullanici_sayisi
        FROM sirket AS s
        INNER JOIN
        kullanicilar_sirket AS ks WHERE id_sirket = s.id AND s.id = :sirket GROUP BY (id_sirket)
        ");

        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->execute();
        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        $sonuc["id_enc"] = idEncode($sonuc["id"]);
        return $sonuc;
    }


    /**
     * Verilen şirketteki butun kullanıcılar ve
     * rollerini getirir, bilgileriyle birlikte.
     *
     * @param $sirket_id
     * @return string
     */
    public static
    function getirSirketKullanicilar($sirket_id)
    {
        // Sadece şirket çalışanlarını getirir.
        // $sayi = true is count yapar.

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
        SELECT ks.id_kullanici AS id, kr.id_rol, k.adi, k.soyadi, k.mail, k.tarih_kayit, k.tarih_son_giris
        FROM kullanicilar_sirket AS ks
        INNER JOIN
        kullanicilar AS k
        INNER JOIN
        kullanicilar_roller AS kr
        WHERE ks.id_sirket = ? AND k.id = ks.id_kullanici AND kr.id_kullanici = ks.id_kullanici
        ");

        $sorgu->execute(array($sirket_id));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc;
        } else {
            return false;
        }
    }


    /**
     * Verilen şirketteki butun ROL=1 kullanıcıları ve
     * i getirir, bilgileriyle birlikte.
     *
     * @param $sirket_id
     * @return string
     */
    public static
    function getirSirketCalisanlar($sirket_id)
    {
        // Sadece şirket çalışanlarını getirir.
        // $sayi = true is count yapar.

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
        SELECT ks.id_kullanici AS id, kr.id_rol, k.adi, k.soyadi, k.mail, k.tarih_kayit, k.tarih_son_giris
        FROM kullanicilar_sirket AS ks
        INNER JOIN
        kullanicilar AS k
        INNER JOIN
        kullanicilar_roller AS kr
        WHERE ks.id_sirket = ? AND k.id = ks.id_kullanici AND kr.id_kullanici = ks.id_kullanici
        AND kr.id_rol = 2
        ");

        $sorgu->execute(array($sirket_id));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc;
        } else {
            return false;
        }
    }


    public static
    function getirSirketMusteriler($sirket_id, $sayi = false)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
        SELECT * FROM musteriler WHERE id_sirket = ?
        ");
        $sorgu->execute(array($sirket_id));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuc) {
            if ($sayi) {
                return count($sonuc);
            } else {
                return $sonuc;
            }
        } else {
            return false;
        }
    }


    /**
     * Şirketlerin logolarını getirir.
     *
     * KULLANIM:
     * 1. Eğer şirket id'si ile işlem yapılacaksa.
     *    SQL sorgusu yapar.
     *      Bulut::logoGetir(1, "200");
     *
     * 2. Eğer daha önce şirket ile yapılmış bir SQL sorgusu varsa
     *    Burada elde edilen $sirket["logo"] da kullanılabilir.
     *      Bulut::logoGetir($sirket["logo"], "200", true);
     *
     * @param $sirket_id
     * @param string $boyut
     * @param bool $link_ref
     */
    public static
    function logoGetir($sirket_id, $boyut = "400", $link_ref = false)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // orj: orijinal boyut logo
        // kucuk: 100x50
        // orta: 200x100
        // buyuk: 400x200
        // global $DB;

        if ($link_ref) {
            // logoGetir("link", "200", true);
            // Böyle kullanımlarda daha önce veritabanı sorgusu
            // yapıldıysa tekrar yapılmıyor.
            // onun yerine $sirket_id ile daha önce alınmış link
            // iletiliyor.
            $link = $sirket_id;
        } else {
            $sorgu = $db->prepare("SELECT logo FROM sirket WHERE id = ?");
            $sorgu->execute(array($sirket_id));

            $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

            if ($sonuc) {
                $link = $sonuc["logo"];
            } else {
                $link = "";
            }
        }

        // Logo boyuta gore getirme islemi.
        if ($boyut != "100" and $boyut != "200" and $boyut != "400") {
            // echo $link;
            return $link;
        } else {
            $rep = "." . strrev($boyut) . "_";
            $ters = str_replace(".", $rep, strrev($link));
            //echo strrev($ters);
            return strrev($ters);
        }

    }


    public static
    function getirSirketReklamlar($sirket_id)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;


    }


    /**
     * Tüm kullanıcılara veya tüm şirket adminlerine
     * duyuru yollamakta kullanılır.
     *
     * $kul = true is bütün kullanıcılara, false ise bütün
     * şirket adminlerine gönderilir.
     *
     * @param bool $kul
     * @return bool
     */
    public static
    function duyuruYolla($konu, $mesaj, $kul = true)
    {

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // Kullanıcı listesinin alınması.
        if ($kul) {
            $sorgu = $db->prepare("
            SELECT id FROM kullanicilar
            ");
        } else {
            $sorgu = $db->prepare("
            SELECT id_kullanici AS id FROM kullanicilar_roller WHERE id_rol = 1");
        }

        $sorgu->execute();
        $idler = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        $duyuru = $db->prepare("
        INSERT INTO duyurular VALUES(NULL, :id_kul, 0, :konu, :mesaj, now())
        ");
        $duyuru->bindParam(":konu", $konu);
        $duyuru->bindParam(":mesaj", $mesaj);

        foreach ($idler as $id) {
            $duyuru->bindParam(":id_kul", $id["id"]);
            $sonuc = $duyuru->execute();

            if (!$sonuc) {
                return false;
            }
        }

        return true;
    }

    /**
     * Kullanıcıya ait bütün okunmamış duyurları getirir.
     *
     * @param $kul_id
     * @return bool, array
     */
    public static
    function getirDuyurular($kul_id)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
        SELECT * FROM duyurular WHERE id_kullanici = :kul_id AND okunma = 0
        ");
        $sorgu->bindParam(":kul_id", $kul_id);
        $sorgu->execute();

        $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuclar) {
            return $sonuclar;
        } else {
            return false;
        }
    }

    /**
     * Duyuruyu getirir, kullanıcı kontrolü de yapar.
     *
     * @param $duyuru_id
     * @param $kul_id
     * @return bool, array
     */
    public static
    function getirDuyuru($duyuru_id, $kul_id)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
        SELECT * FROM duyurular WHERE id = :duyuru AND id_kullanici = :kul
        ");
        $sorgu->bindParam(":duyuru", $duyuru_id);
        $sorgu->bindParam(":kul", $kul_id);
        $sorgu->execute();

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc;
        } else {
            return false;
        }
    }

    /**
     * Verilen duyuru kullanıcıya mı ait kontrolünü
     * yapar.
     *
     * @param $duyuru_id
     * @param $kul_id
     * @return bool
     */
    public static
    function duyuruKontrol($duyuru_id, $kul_id)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        // Duyuru kullanıcıya mı ait kontrolü.
        $sorgu = $db->prepare("SELECT id_kullanici FROM duyurular WHERE id = ?");
        $sorgu->execute(array($duyuru_id));

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc["id_kullanici"] == $kul_id;
        }
    }


    /**
     * Duyuru siler.
     *
     * NOT: Kontrol yapıyor öncelikle.
     *
     * @param $duyuru_id
     * @param $kul_id
     * @return bool
     */
    public static
    function duyuruSil($duyuru_id, $kul_id)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        if (self::duyuruKontrol($duyuru_id, $kul_id)) {
            $sorgu = $db->prepare("
            DELETE FROM duyurular WHERE id = ?
            ");
            $sonuc = $sorgu->execute(array($duyuru_id));

            if ($sonuc) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    /**
     * Duyuru okur
     *
     * NOT: Kontrol yapıyor öncelikle.
     *
     * @param $duyuru_id
     * @param $kul_id
     * @return bool
     */
    public static
    function duyuruOku($duyuru_id, $kul_id)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        if (self::duyuruKontrol($duyuru_id, $kul_id)) {
            $sorgu = $db->prepare("
            UPDATE duyurular SET okunma = 1 WHERE id = ?
            ");
            $sonuc = $sorgu->execute(array($duyuru_id));

            if ($sonuc) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }


    /**
     * @param $ustCatId
     * @param $sirketId
     * @return array|bool
     */
    public static
    function getCategory($ustCatId, $sirketId)
    {
        $obj = new static();
        $db = $obj->DB;
        try {
            $sorgu = $db->prepare("SELECT * FROM kategoriler WHERE id_sirket=?");
            $sorgu->execute(array($sirketId));
            $list = $sorgu->fetchAll(PDO::FETCH_ASSOC);
            if (count($list) > 0) {
                $tree = array();
                $Kategori_Id = $ustCatId;
                foreach ($list as $id => $item) {
                    if ($Kategori_Id > 0) {
                        // Eğer kategori id set edilmiş ise birincil düzey yap...
                        $kontrol = $Kategori_Id;
                    } else {
                        // Eğer kategori birincil düzey ise... (yani alt kategorileri almıyoruz!)
                        $kontrol = 0;
                    }

                    if ($item['id_ust_kategori'] == $kontrol) {
                        // $tree değişekeninde birincil düzey olarak ekledik.
                        $tree[$item['id']] = $item;

                        // Bu kategoriyi kaydettiğimiz için de (yani işimiz bitti!) $list dizisinden kaldırıyoruz.
                        unset($list[$id]);

                        // Ve şimdi can alıcı nokta! Bu ana kategorinin alt kategorisi var mı diye alt kategorilerine bakıyoruz...
                        self::Kategori_Find_Sub_Cats($list, $tree[$item['id']]);
                    }
                }

                return $tree;
            } else {
                return false;
            }

        } catch (Exception $ex) {
            echo "hata:" . $ex->getMessage();
        }
    }

    /**
     * @param $list
     * @param $selected
     */
    public static
    function Kategori_Find_Sub_Cats(&$list, &$selected)
    {
        /*  Kategori_List() fonksiyonu ile beraber çalışır.
         *  Alt kategorileri arayan yardımcı fonksiyonumuz.
         *  &$list: Veritabanından çektiğimiz ham kategorileri içeriyor.
         *  &$selected: Üzerinde işlem yapılacak (varsa alt kategorisi eklenecek) kategoriyi içeriyor.
         */

        // Her bir kategoriyi tek tek döndür...
        foreach ($list as $id => $item) {
            // Eğer babasının kimliğiyle kendi kimliği aynıysa... (yani alt kategori ise!)
            if ($item['id_ust_kategori'] == $selected['id']) {
                // Seçimin "sub_cats"ına alt kategorisini ekle.
                $selected['sub_cats'][$item['id']] = $item;

                // Babasını bulduğuna göre artık $list'eden kaldırabiliriz.
                unset($list[$id]);

                // Alt kategorinin de çocuğu olabilme ihtimali için aynı işlemleri ona da yapıyoruz...
                self::Kategori_Find_Sub_Cats($list, $selected['sub_cats'][$item['id']]);
            }
        }
    }

    /**
     * @param $sirketId
     * @param $topCatId
     * @param $catName
     * @return bool|string
     */
    public static
    function  addCategory($sirketId, $topCatId, $catName)
    {
        $obj = new static();
        $db = $obj->DB;
        try {
            $sorgu = $db->prepare("INSERT INTO kategoriler  VALUES (NULL, ?,?,?)");
            $islem = $sorgu->execute(array($sirketId, $topCatId, $catName));

            if ($islem) {
                return true;
            } else {
                return false;
            }

        } catch (Exception $ex) {
            return "Kategori Ekleme Hatası:" . $ex->getMessage();
        }
    }

    /**
     * @param $sirketId
     * @param $urunAdi
     * @param $kisaAciklama
     * @param $aciklama
     * @param $categoriler
     * @return bool|string
     */
    public static
    function  addProduct($sirketId, $urunAdi, $kisaAciklama, $aciklama, $categoriler)
    {
        $obj = new static();
        $db = $obj->DB;
        try {
            $categori = $categoriler[0];
            $count = count($categoriler);
            for ($i = 1; $i < $count; $i++) {
                $categori .= "," . $categoriler[$i];
            }
            $tarih = date("Y.m.d H:i:m");

            $sorgu = $db->prepare("INSERT INTO urunler  VALUES (NULL, ?,?,?,?,?,? )");
            $sorgu->execute(array($sirketId, $categori, $urunAdi, $kisaAciklama, $aciklama, $tarih));

            if ($sorgu->rowCount() > 0) {
                $id = $db->lastInsertId();
                return $id;
            } else {
                return false;
            }


        } catch (Exception $ex) {
            return "Ürün Ekleme Hatası:" . $ex->getMessage();
        }
    }


    /**
     * Şirketin müşterilerine sunması için form oluşturulması.
     *
     * @param $sirket_id
     * @param $adi
     * @param $html
     * @param $json
     * @return bool
     */
    public static
    function formEkle($sirket_id, $adi, $html, $json)
    {
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
        INSERT INTO formlar VALUES(NULL, :id, :adi, :html, :json, now())
        ");
        $sorgu->bindParam(":id", $sirket_id);
        $sorgu->bindParam(":adi", $adi);
        $sorgu->bindParam(":html", $html);
        $sorgu->bindParam(":json", $json);
        $islem = $sorgu->execute();

        if ($islem) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Şirketin formlarını getirir.
     *
     * @param $sirket_id
     * @return bool
     */
    public static
    function formGetir($sirket_id, $id = false)
    {
        $obj = new static();
        $db = $obj->DB;

        if ($id) {

            $sorgu = $db->prepare("
            SELECT * FROM formlar WHERE id_sirket = :id AND id = :form_id
            ");
            $sorgu->bindParam(":id", $sirket_id);
            $sorgu->bindParam(":form_id", $id);
            $sorgu->execute();

            $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

            if ($sonuc) {
                return $sonuc;
            } else {
                return false;
            }

        } else {
            $sorgu = $db->prepare("
            SELECT * FROM formlar WHERE id_sirket = :id
            ");
            $sorgu->bindParam(":id", $sirket_id);
            $sorgu->execute();

            $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

            if ($sonuclar) {
                return $sonuclar;
            } else {
                return false;
            }
        }
    }


    /**
     * Verilen şirket'e ait, id'li form'u siler.
     *
     * @param $form_id
     * @param $sirket_id
     * @return bool
     */
    public static
    function formSil($form_id, $sirket_id)
    {
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("
        DELETE FROM formlar WHERE id = :id AND id_sirket = :sirket_id
        ");
        $sorgu->bindParam(":id", $form_id);
        $sorgu->bindParam(":sirket_id", $sirket_id);

        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        } else {
            return false;
        }

    }


    /**
     * Verilen key'in zamanını kontrol eder.
     *
     * @param $key
     * @return bool
     */
    public static
    function keyKontrol($key)
    {
        $obj = new static();
        $db = $obj->DB;

        // Şifre değiştirme key'ler 1h için geçerli.
        $limit = 3600; // saniye.

        $sorgu = $db->prepare("
        SELECT * FROM kullanicilar_sifre_reset WHERE reset_key = :rkey
        ");
        $sorgu->bindParam(":rkey", $key);
        $sorgu->execute();

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            // sn olarak.
            $reset_time = strtotime($sonuc["reset_time"]);
            $now = time();

            return (($now - $reset_time) < $limit) and $sonuc["kullanildi"] == 0;
        } else {
            return false;
        }
    }


    /**
     * Key ile şifre değiştirm için kullanılıyor.
     *
     * @param $key
     * @param $sifre
     * @return bool
     */
    public static
    function keyIleSifreDegistir($key, $sifre)
    {
        $obj = new static();
        $db = $obj->DB;

        if (Bulut::keyKontrol($key)) {

            // Kullanıcı ID'sinin bulunması.
            $sorgu = $db->prepare("
            SELECT * FROM kullanicilar_sifre_reset WHERE reset_key = :rkey
            ");
            $sorgu->bindParam(":rkey", $key);
            $sorgu->execute();

            $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

            if ($sonuc) {
                $id = $sonuc["kul_id"];
                $sifre = md5($sifre);

                // Update işleminin yapılması.
                $guncelleme = $db->prepare("
                UPDATE kullanicilar SET sifre = :sif WHERE id = :kul_id
                ");
                $guncelleme->bindParam(":sif", $sifre);
                $guncelleme->bindParam(":kul_id", $id);
                $guncelleme->execute();

                if ($guncelleme->rowCount() > 0) {
                    // Key güncelleme yapalım ki, kullanıcı aynı token ile
                    // tekrar şifre değiştiremesin.
                    Bulut::keyGuncelle($key);
                    return true;
                } else {
                    return false;
                }

            } else {
                return false;
            }


        } else {
            return false;
        }
    }

    /**
     * Key kullanıldıysa güncelleme yap.
     *
     * @param $key
     * @return false
     */
    public static
    function keyGuncelle($key)
    {
        $obj = new static();
        $db = $obj->DB;

        $guncelleme = $db->prepare("
        UPDATE kullanicilar_sifre_reset SET kullanildi = 1 WHERE reset_key = :rkey
        ");
        $guncelleme->bindParam(":rkey", $key);
        $guncelleme->execute();

        if ($guncelleme->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * Verilen kullanıcıyı admin olarak atar.
     *
     * @param $kul_id
     * @return bool
     */
    public static
    function kulAdminAta($kul_id)
    {
        $obj = new static();
        $db = $obj->DB;

        $q = "
        UPDATE kullanicilar_roller SET id_rol = 1 WHERE id_kullanici = :id_kul
        ";
        $sorgu = $db->prepare($q);
        $sorgu->bindParam(":id_kul", $kul_id);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Şirkete ait beğenileri getirir.
     *
     * NOT: Şu an için müşteri adı vs getirmiyor.
     */
    public static
    function getirBegeniler($sirket_id)
    {
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("SELECT * FROM begenme_yonetimi WHERE sirket_id = :id_sirket");
        $sorgu->bindParam(":id_sirket", $sirket_id);
        $sorgu->execute();

        $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuclar) {
            return $sonuclar;
        } else {
            return false;
        }

    }

    /**
     * Beğeniler tablosunu getirir fakat,
     * oylamaları toplar.
     */
    public static
    function getirUrunBegeniler($sirket_id)
    {
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("SELECT urun_id, SUM(oylama) AS toplam_oylama FROM `begenme_yonetimi` WHERE sirket_id = :id_sirket GROUP BY urun_id ");
        $sorgu->bindParam(":id_sirket", $sirket_id);
        $sorgu->execute();

        $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuclar) {
            return $sonuclar;
        } else {
            return false;
        }

    }

    /**
     * Ürün beğenide kullanılacak olan fonksiyon.
     */
    public static
    function urunBegen($kul_id, $sirket_id, $urun_id, $puan)
    {
        $obj = new static();
        $db = $obj->DB;

        // Kontrol.
        $kontrol = $db->prepare("SELECT * FROM begenme_yonetimi WHERE urun_id = :urun_id AND kul_id = :kul_id");
        $kontrol->bindParam(":urun_id", $urun_id);
        $kontrol->bindParam(":kul_id", $kul_id);
        $kontrol->execute();
        $kontrolSonuc = $kontrol->fetchAll(PDO::FETCH_ASSOC);

        if (!$kontrolSonuc) {
            $q = "
            INSERT INTO begenme_yonetimi VALUES
            (NULL, :sirket_id, :kul_id, :urun_id, now(), :puan)
            ";

            $islem = $db->prepare($q);
            $islem->bindParam(":sirket_id", $sirket_id);
            $islem->bindParam(":kul_id", $kul_id);
            $islem->bindParam(":urun_id", $urun_id);
            $islem->bindParam(":puan", $puan);

            $islem->execute();

            if ($islem->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

}


?>