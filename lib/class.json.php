<?php

/**
 * Class Bulut
 *
 * Statik Bulut sınıfı ve metodları.
 */
class BulutJSON
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

    public static
    function getirSirketMusteri($sirket_id, $mail,$sifre)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("SELECT * FROM musteriler WHERE id_sirket = ? and mail=? and sifre=?");
        $sorgu->execute(array($sirket_id,$mail,$sifre));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sorgu->rowCount() > 0) {
            return $sonuc;
        } else {
            return false;
        }
    }
    public static
    function kullaniciEkle($id_sirket, $adi, $soyadi, $mail, $telefon , $sifre )
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;
        $tarih = dateTime();
        $sifre = md5($sifre);
        // Sorgunun hazırlanması.
        $sorgu = $db->prepare("INSERT INTO musteriler  VALUES (NULL,?,?,?,?,?,?,?,?,?)");
        $sorgu->execute(array($id_sirket , $adi, $soyadi, $mail, $telefon , $sifre ,$tarih  , null , 1));

        if ($sorgu->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
