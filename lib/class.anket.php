<?php


class Anket
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
     * Anket ekleme fonksiyonu.
     *
     * @param $sirket_id
     * @param $baslik
     * @return bool
     */
    public function anketEkle($sirket_id, $baslik)
    {

        $q = "
        INSERT INTO anket_yonetimi VALUES
        (NULL, :sirket_id, :baslik)
        ";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":sirket_id", $sirket_id);
        $sorgu->bindParam(":baslik", $baslik);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }


    /**
     * Bütün anket başlıklarını getirir.
     *
     * @return array|bool
     */
    public function anketListele()
    {
        $q = "SELECT * FROM anket_yonetimi";
        $sorgu = $this->DB->prepare($q);
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
     * Verilen anketi düzenler.
     * @param $id
     * @return bool
     */
    public function anketDuzenle($id, $baslik)
    {
        $q = "
        UPDATE anket_yonetimi
        SET anket_baslik = :baslik
        WHERE anket_id = :id
        ";

        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":id", $id);
        $sorgu->bindParam(":baslik", $baslik);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }


    /**
     * Verilen id'li anketi siler.
     *
     * NOT: sirket_id kontrol için kullanılıyor.
     *
     * @param $id
     * @param $sirket_id
     * @return bool
     */
    public function anketSil($id, $sirket_id)
    {
        $q = "
        DELETE FROM anket_yonetimi WHERE anket_id = :id AND sirket_id = :sirket_id
        ";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":id", $id);
        $sorgu->bindParam(":sirket_id", $sirket_id);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }


    /**
     * Anket seçenek ekle.
     *
     * @return bool|array
     */
    public function anketSecenekEkle($sirket_id, $anket_id, $secenek){

        $q = "
        INSERT INTO anket_secenek VALUES
        (NULL, :sirket, :anket, :secenek)
        ";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->bindParam(":anket", $anket_id);
        $sorgu->bindParam(":secenek", $secenek);

        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Verilen anketin seçeneklerini getir.
     *
     * @param $anket_id
     * @param $sirket_id (kontrol)
     * @return bool|array
     */
    public function anketSecenekListele($anket_id, $sirket_id)
    {
        $q = "SELECT * FROM anket_secenek WHERE anket_id = :anket AND sirket_id = :sirket";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":anket", $anket_id);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->execute();

        $secenekler = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($secenekler) {
            return $secenekler;
        }
        else {
            return false;
        }
    }


    /**
     * Sadece seçenek id üzerinden tekil silim işlemleri için
     * kullanılır.
     *
     * @param $secenek_id
     * @param $sirket_id
     * @return bool|array
     */
    public function anketSecenekSil($secenek_id, $sirket_id)
    {
        $q = "DELETE FROM anket_secenek WHERE id = :id AND sirket_id = :sirket";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":id", $secenek_id);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Anket ID üzerinden anketi bütün seçenekleri silinir.
     *
     * @param $anket_id
     * @param $sirket_id
     * @return bool|array
     */
    public function anketSecenekSilToplu($anket_id, $sirket_id)
    {
        $q = "DELETE FROM anket_secenek WHERE anket_id = :anket AND sirket_id = :sirket";

        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":anket", $anket_id);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }


    /**
     * Verilen seçeneğin düzenlenmesi.
     *
     * @param $secenek_id
     * @param $sirket_id
     * @return bool|array
     */
    public function anketSecenekDuzenle($secenek_id, $sirket_id, $secenek)
    {
        $q = "
        UPDATE anket_secenek
        SET secenek = :secenek
        WHERE id = :id AND sirket_id = :sirket
        ";

        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":id", $secenek_id);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->bindParam(":secenek", $secenek);
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
