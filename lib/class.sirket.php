<?php
/**
 * Class Şirket
 *
 * Statik Şirket Sınıfı
 */

class Sirket
{
    public $DB;

    function __construct()
    {
        $host = "localhost";
        $dbname = "bulut";
        $user = "root";
        $pass = "";
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            $this->DB = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            echo "[HATA]: Veritabanı -" . $e->getMessage();
        }
    }

    /**
     * Rastgele şifre oluşturulur.
     * @return bool|array
     */
    public static
    function sifreOlustur()
    {
        $key = "";
        $katar = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $katar = str_split($katar);
        $katar_uzunluk = count($katar) - 1;

        for ($sinir = 0; $sinir < 10; $sinir ++) {
            $rand = rand(0, $katar_uzunluk);
            $key .= $katar[$rand];
        }

        return $key;
    }


    /**
     * Sadece calisanKayit için destek fonksiyonu.
     *
     * @param $sirket_id
     * @return array|bool
     */
    public static
    function calisanaSirketAta($sirket_id, $kul_id)
    {
        $obj = new static();
        $db = $obj->DB;

        $q = "
        INSERT kullanicilar_sirket VALUES
        (NULL, :kul_id, :sirket_id)";
        $sonuc = $db->prepare($q);
        $sonuc->bindParam(":kul_id", $kul_id);
        $sonuc->bindParam(":sirket_id", $sirket_id);
        $sonuc->execute();

        if ($sonuc->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * ID'si verilen kullanıcıyı direkt rol:2 olarak atar.
     *
     * @param $kul_id
     * @return bool
     */
    public static
    function calisanRolAta($kul_id)
    {
        $obj = new static();
        $db = $obj->DB;

        $q = "
        INSERT INTO kullanicilar_roller VALUES
        (NULL, :id_kul, 2)
        ";
        $sorgu = $db->prepare($q);
        $sorgu->bindParam(":id_kul", $kul_id);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Çalışan kaydı yapar.
     *
     * @param $adi
     * @param $soyadi
     * @param $mail
     * @return bool|array
     */
    public static
    function calisanKayit($adi, $soyadi, $mail, $sirket_id)
    {
        $obj = new static();
        $db = $obj->DB;

        $sifre = self::sifreOlustur();
        $sifreMd5 = md5($sifre);

        $q = "
        INSERT INTO kullanicilar VALUES
        (NULL, :adi, :soyadi, :mail, :sifre, now(), now())
        ";
        $sorgu = $db->prepare($q);
        $sorgu->bindParam(":adi", $adi);
        $sorgu->bindParam(":soyadi", $soyadi);
        $sorgu->bindParam(":mail", $mail);
        $sorgu->bindParam(":sifre", $sifreMd5);

        $sorgu->execute();

        $kul_id = $db->lastInsertId();

        if ($sorgu->rowCount() > 0) {
            $sirket = self::calisanaSirketAta($sirket_id, $kul_id);
            $rol = self::calisanRolAta($kul_id);

            $email = new BulutMail($db);
            $emailYolla = $email->calisanKayitMail($mail, $sifre);

            if ($sirket and $rol and $emailYolla) {
                return true;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

}


?>
