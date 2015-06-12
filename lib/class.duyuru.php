<?php
/**
 * Class Duyuru
 *
 * Duyuru işlemlerini halleden sınıf.
 */


class Duyuru
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
     * Duyuru eklenir.
     *
     * @param $sirket_id
     * @param $baslik
     * @param $detay
     * @param $durum
     * @return bool
     */
    public function duyuruEkle($sirket_id, $baslik, $detay, $durum)
    {
        $q = "
        INSERT INTO duyuru VALUES
        (NULL, :sirket, :baslik, :detay, :durum, now())
        ";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->bindParam(":baslik", $baslik);
        $sorgu->bindParam(":detay", $detay);
        $sorgu->bindParam(":durum", $durum);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Şirkete ait duyuruları listeler.
     *
     * @param $sirket_id
     * @return bool|
     */
    public function duyuruListele($sirket_id)
    {
        $q = "SELECT * FROM duyuru WHERE sirket_id = :sirket";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":sirket", $sirket_id);
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
     * Şirkete ait duyuruyu getirir.
     *
     * @param $sirket_id
     * @return bool|
     */
    public function duyuruGetir($sirket_id, $duyuru_id)
    {
        $q = "SELECT * FROM duyuru WHERE id = :id AND sirket_id = :sirket";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":id", $duyuru_id);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->execute();

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc;
        }
        else {
            return false;
        }
    }



    /**
     * Duyuru düzenleme işlemleri.
     *
     * @param $duyuru_id
     * @param $sirket_id
     * @param $baslik
     * @param $detay
     * @param $durum
     * @return bool
     */
    public function duyuruDuzenle($duyuru_id, $sirket_id, $baslik, $detay, $durum)
    {
        $q = "
        UPDATE duyuru
        SET duyuru_baslik = :baslik, duyuru_detay = :detay, durum = :durum
        WHERE id = :id AND sirket_id = :sirket
        ";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":baslik", $baslik);
        $sorgu->bindParam(":detay", $detay);
        $sorgu->bindParam(":durum", $durum);
        $sorgu->bindParam(":id", $duyuru_id);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0){
            return true;
        }
        else {
            return false;
        }

    }

    /**
     * Şirketin verilen ID'li duyurusunu siler.
     *
     * @param $duyuru_id
     * @param $sirket_id
     * @return bool
     */
    public function duyuruSil($duyuru_id, $sirket_id)
    {
        $q = "
        DELETE FROM duyuru WHERE id = :id AND sirket_id = :sirket
        ";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":id", $duyuru_id);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

}

?>
