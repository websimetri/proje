<?php

class Mesaj
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

    public static
    function Forum_Mesaj($gonderen_id, $konu, $mesaj){

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;


        $query = $db->prepare("INSERT INTO forum VALUES (null,:gonderen_id,:konu,:mesaj,now())");

        $query->bindParam(':gonderen_id', $gonderen_id);

        $query->bindParam(':konu', $konu);

        $query->bindParam(':mesaj', $mesaj);
        $query->execute();

        if($query->rowCount() > 0 ){
            return true;
        }else{
            return false;
        }

    }

    public static
    function Ozel_Mesaj($sirket_id,$gonderen_id,$alan_id,$durum,$mesaj){

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $query = $db->prepare("INSERT INTO mesajlar VALUES (null,:sirket_id,:gonderen_id,:alan_id,:mesaj,now(),:durum)");
        $query->bindParam(':sirket_id',$sirket_id);
        $query->bindParam(':gonderen_id',$gonderen_id);
        $query->bindParam(':alan_id',$alan_id);
        $query->bindParam(':durum',$durum);
        $query->bindParam(':mesaj',$mesaj);
        $sonuc = $query->execute();

        if($sonuc->rowCount() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public static
    function Mesaj_Sil($id){

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;


        $sorgu = $db->prepare("DELETE FROM forum WHERE id = ? ");
        $sorgu->execute(array($id));

        if ($sorgu->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }

    }



}





?>
