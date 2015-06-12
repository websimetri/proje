<?php
/**
 * Class Duyuru
 *
 * Duyuru işlemlerini halleden sınıf.
 */


class Siparis
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
     * $_POST'dan gelen bilgileri gösterir.
     * @return array
     */
    public function siparisGoster()
    {
        $dizi = $_POST;
        $bilgi = "";

        foreach ($dizi as $key => $val) {
            $bilgi .= $key;
            $bilgi .= " : ";
            $bilgi .= $val;
            $bilgi .= "<br>";
        }
        return print_r($bilgi);

    }

    /**
     * JSON.
     *
     * Mobilden gelen html formu veritabanına kaydeder.
     * @param $sirket_id
     * @param $musteri_id
     * @param $urun_id
     * @param $html
     *
     * @return bool
     */
    public function json_SiparisFormKayit($sirket_id, $musteri_id, $urun_id, $html)
    {
        $q = "
        INSERT INTO siparis VALUES
        (NULL, :sirket, :musteri, :urun_id, :html, now());
        ";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->bindParam(":musteri", $musteri_id);
        $sorgu->bindParam(":urun_id", $urun_id);
        $sorgu->bindParam(":html", $html);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Firmanın siparişlerini listeler.
     *
     * @param $sirket_id
     * @return mixed
     */
    public function siparisListele($sirket_id)
    {
        $q = "SELECT * FROM siparis WHERE sirket_id = :sirket";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->execute();

        $siparisler = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($siparisler) {
            return $siparisler;
        }
        else {
            return false;
        }

    }

    /**
     * Sipariş silme işlemi.
     *
     * @param $sirket_id
     * @param $siparis_id
     * @return bool
     */
    public function siparisSil($sirket_id, $siparis_id)
    {
        $q = "DELETE FROM siparis WHERE id = :id AND sirket_id = :sirket";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":id", $siparis_id);
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
