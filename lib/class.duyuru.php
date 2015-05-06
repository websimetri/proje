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
        (NULL, :sirket, :baslik, :detay, :durum)
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

    }

}

$x = new Duyuru();

var_dump();

?>