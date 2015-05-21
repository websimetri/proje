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
    public function anketListele($sirket_id)
    {
        $q = "SELECT * FROM anket_yonetimi WHERE sirket_id = :sirket";
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
     * Verilen anketi ve seçeneklerini getirir.
     *
     * @param $anket_id
     * @param $sirket_id
     * @return bool|array
     */
    public function anketGetir($anket_id, $sirket_id)
    {
        $data = array();

        $q = "SELECT * FROM anket_yonetimi WHERE anket_id = :anket AND sirket_id = :sirket";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":anket", $anket_id);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->execute();

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            $data["detay"] = $sonuc;
        }
        else {
            $data["detay"] = array();
        }

        // Gelen seçenekler.
        $q = "SELECT * FROM anket_secenek WHERE anket_id = :anket AND sirket_id = :sirket";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":anket", $anket_id);
        $sorgu->bindParam(":sirket", $sirket_id);
        $sorgu->execute();

        $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuclar) {
            $data["secenekler"] = $sonuclar;
        }
        else {
            $data["secenekler"] = array();
        }

        return $data;
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
        (NULL, :sirket, :anket, :secenek, 0)
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


    /*müşterinini daha önce oy kullanıp kullanmadığına bakmak*/
    public function kontrol($anket_id, $must_id){
        $q = " SELECT * FROM anket_oy_kontrol where anket_id=:anketid and must_id=:mustid";
        $sor = $this->DB->prepare($q);
        $sor->bindParam(":anketid",$anket_id);
        $sor->bindParam(":mustid",$must_id);
        $sor->execute();
        if($sor->rowCount()>0){
            return false;
        }else {
            return true;
        }
    }

    /**
     * Müşterinin oy kullandığı anketin kayıt edilmesi.
     * @param $anketid
     * @param $mustid
     * @return bool
     */
    public function anketOyKontrolinsert($anketid, $mustid)
    {
        // Kontrol sonrası kullanıldığı için tekrar kontrole ihtiyaç yok.

        $oy = "INSERT INTO anket_oy_kontrol VALUES (NULL, :anketId, :mustId)";

        $sorgu = $this->DB->prepare($oy);
        $sorgu->bindParam(":anketId", $anketid);
        $sorgu->bindParam(":mustId", $mustid);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    /*yukarıdaki iki fonksiyon burada kullanılacak
    önce anket_oy_kontrol tablosunu kontrol edip müşterinin bu ankete oy kullanıp kullanmadığını belirler
    kullanmadıysa anket_secenek tablosundaki tercih_sayısı update edilir ve bu işlemden sonrada anketOyKontrolinsert()fonksiyonu çağırılarak
    anket_oy_kontrol tablosuna da bu müşterinin bu ankete oy kullandığı kayıt edilir bu sayede bu ankete başka oy veremez*/
    public function yanitTopla($secim, $anketid, $mustid){

        $kontrol = $this->kontrol($anketid, $mustid);

        if ($kontrol){

            $q = "SELECT * FROM anket_secenek where id = :secenekid";

            $sor = $this->DB->prepare($q);
            $sor->bindParam(":secenekid", $secim);
            $sor->execute();
            $row = $sor->fetch(PDO::FETCH_ASSOC);

            if ($sor->rowCount()>0){
                $row["tercih_sayisi"]++;

                $update = "
                UPDATE anket_secenek
                SET tercih_sayisi = :tercihsayisi
                WHERE id = :id AND anket_id = :anket
                 ";

                $sorgu = $this->DB->prepare($update);
                $sorgu->bindParam(":id", $secim);
                $sorgu->bindParam(":anket", $anketid);
                $sorgu->bindParam(":tercihsayisi", $row["tercih_sayisi"]);
                $sorgu->execute();

                if ($sorgu->rowCount() > 0) {
                    $insert = $this->anketOyKontrolinsert($anketid, $mustid);
                    return true;
                }
                else {
                    return false;
                }

            }else{
                return false;
            }
        }else{
            return false;
        }
    }



}

?>