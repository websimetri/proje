<?php
/**
 * Class İçeril
 *
 * Statik İçerik Sınıfı
 */

class Icerik
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
     * Şirket için içerik girme kısmında kullanılır.
     *
     * Default: durum=1 halinde eklenir.
     *
     * @param $sirket_id
     * @param $baslik
     * @param $kisa_aciklama
     * @param $detay
     * @param int $durum
     *
     * @return bool|array
     */
    public static
    function icerikEkle($sirket_id, $baslik, $kisa_aciklama, $detay, $durum=1)
    {
        $obj = new static();
        $db = $obj->DB;

        $q = "
        INSERT INTO icerik_yonetimi VALUES (NULL, :sirket_id, :baslik, :kisa, :detay, now(), :durum)
        ";
        $sorgu = $db->prepare($q);
        $sorgu->bindParam(":sirket_id", $sirket_id);
        $sorgu->bindParam(":baslik", $baslik);
        $sorgu->bindParam(":kisa", $kisa_aciklama);
        $sorgu->bindParam(":detay", $detay);
        $sorgu->bindParam(":durum", $durum);

        $sorgu->execute();

        if($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }

    }


    /**
     * Duruma bakmaksızın bütün içerikleri getirir.
     *
     * @param $sirket_id
     * @return bool|array
     */
    public static
    function icerikListele($sirket_id)
    {
        $obj = new static();
        $db = $obj->DB;

        $q = "SELECT * FROM icerik_yonetimi WHERE sirket_id = :id_sirket";
        $sorgu = $db->prepare($q);
        $sorgu->bindParam(":id_sirket", $sirket_id);
        $sorgu->execute();

        $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuclar) {
            return $sonuclar;
        }
        else {
            return false;
        }
    }

    /**
     * Id'si verilen icerik'in verilen bilgilerinin değiştirilmesi.
     *
     * @param $id
     * @param $baslik
     * @param $kisa_aciklama
     * @param $detay
     * @param $durum
     *
     * @return array|bool
     */
    public static
    function icerikDuzenle($id, $baslik, $kisa_aciklama, $detay, $durum)
    {
        $obj = new static();
        $db = $obj->DB;


        if ($durum == 1) {

            $q = "
            UPDATE icerik_yonetimi
            SET baslik = :baslik, kisa_aciklama = :kisa, detay = :detay, durum = 1
            WHERE id = :id
            ";
        }
        else {
            $q = "
            UPDATE icerik_yonetimi
            SET baslik = :baslik, kisa_aciklama = :kisa, detay = :detay, durum = 0
            WHERE id = :id
            ";
        }

        $sorgu = $db->prepare($q);
        $sorgu->bindParam(":baslik", $baslik);
        $sorgu->bindParam(":kisa", $kisa_aciklama);
        $sorgu->bindParam(":detay", $detay);
        $sorgu->bindParam(":id", $id);

        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * ID'si verilen içeriği sil.
     * @param $id
     * @param $sirket_id    Kontrol için gerekli.
     * @return false
     */
    public static
    function icerikSil($id, $sirket_id)
    {
        $obj = new static();
        $db = $obj->DB;

        $q = "DELETE FROM icerik_yonetimi WHERE id = :id AND sirket_id = :id_sirket";
        $sorgu = $db->prepare($q);
        $sorgu->bindParam(":id", $id);
        $sorgu->bindParam(":id_sirket", $sirket_id);

        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }

    }


    /**
     * Verilen id'deki içeriği getirir.
     *
     * @param $id
     * @param $sirket_id (kontrol amaçlı)
     *
     * @return array|bool
     */
    public static
    function icerikGetir($id, $sirket_id)
    {
        $obj = new static();
        $db = $obj->DB;

        $q = "SELECT * FROM icerik_yonetimi WHERE sirket_id = :id_sirket and id = :id";
        $sorgu = $db->prepare($q);
        $sorgu->bindParam(":id_sirket", $sirket_id);
        $sorgu->bindParam(":id", $id);
        $sorgu->execute();

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc;
        }
        else {
            return false;
        }

    }

}


?>
