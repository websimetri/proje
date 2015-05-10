<?php


class Reklam
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


    public function reklamEkle($id_sirket, $adi, $gosterim,$dosya,$kod,$href)
    {


        $q = "
        INSERT INTO reklamlar VALUES
        (NULL,:id_sirket, :adi, :gosterim,null,now(),null,NULL ,:dosya,:kod,:href,1)
        ";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":sirket_id", $id_sirket);
        $sorgu->bindParam(":adi", $adi);
        $sorgu->bindParam(":gosterim", $gosterim);
        $sorgu->bindParam(":dosya", $dosya);
        $sorgu->bindParam(":dosya", $kod);
        $sorgu->bindParam(":dosya", $href);

        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }
    }


    public function reklamListele($id_sirket)
    {
        $q = "SELECT * FROM reklamlar WHERE id_sirket = :sirket";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":sirket", $id_sirket);
        $sorgu->execute();

        $sonuclar = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sonuclar) {
            return $sonuclar;
        }
        else {
            return false;
        }
    }


    public function reklamGetir($id_sirket, $reklam_id)
    {
        $q = "SELECT * FROM reklamlar WHERE id = :id AND id_sirket = :sirket";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":id", $reklam_id);
        $sorgu->bindParam(":sirket", $id_sirket);
        $sorgu->execute();

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc;
        }
        else {
            return false;
        }
    }



      public function reklamDuzenle($reklam_id, $id_sirket, $adi, $dosya, $kod,$href,$aktif)
    {
        $q = "
        UPDATE reklamlar
        SET adi = :adi, dosya = :dosya, kod = :kod, href = :href, aktif = :aktif
        WHERE id = :id AND id_sirket = :sirket
        ";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":adi", $adi);
        $sorgu->bindParam(":dosya", $dosya);
        $sorgu->bindParam(":kod", $kod);
        $sorgu->bindParam(":href", $href);
        $sorgu->bindParam(":aktif", $aktif);
        $sorgu->bindParam(":id", $reklam_id);
        $sorgu->bindParam(":sirket", $id_sirket);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0){
            return true;
        }
        else {
            return false;
        }

    }


    public function reklamSil($reklam_id, $id_sirket)
    {
        $q = "
        DELETE FROM reklamlar WHERE id = :id AND id_sirket = :sirket
        ";
        $sorgu = $this->DB->prepare($q);
        $sorgu->bindParam(":id", $reklam_id);
        $sorgu->bindParam(":sirket", $id_sirket);
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