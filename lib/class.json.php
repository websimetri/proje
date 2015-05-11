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
        $kontrol =$db->prepare("SELECT * FROM musteriler where id_sirket=? and mail=?");
        $kontrol->execute(array($id_sirket,$mail));
        //aynı şirket id ve mail adresi ile birden fazla kayıt olmaması için
        if($kontrol->rowCount()>0){
            return array("durum"=>false,"mesaj"=>"Bu mail adresi ile daha önce kayıt olunmuş");
        }else{
            // Sorgunun hazırlanması.
            $sorgu = $db->prepare("INSERT INTO musteriler  VALUES (NULL,?,?,?,?,?,?,now(),now(),?)");
            $sorgu->execute(array($id_sirket , $adi, $soyadi, $mail, $telefon , md5($sifre) , "1"));

            if ($sorgu->rowCount() > 0) {
                return array("durum"=>true,"mesaj"=>"Kayıt işlemi başarılı");
            } else {
                return array("durum"=>false,"mesaj"=>"Kayıt işlemi sırasında beklenmedik bir hata oluştu. Lütfen Daha sonra Tekrar Deneyiniz");
            }
        }

    }

    public static
    function kullaniciAyarlar(){

        $obj = new static();
        $db = $obj->DB;
        $tarih = dateTime();
        $sifre = md5($sifre);
        //sorgunun hazırlanması

$sorgu = $db->prepare("
UPDATE musteriler SET adi = :adi , soyadi = :soyadi , mail = :mail , telefon = :telefon , sifre = :sifre , tarih = :tarih
WHERE id = :id AND id_sirket = :id_sirket");


        $sorgu->bindParam(":adi", $adi);
        $sorgu->bindParam(":soyadi", $soyadi);
        $sorgu->bindParam(":mail", $mail);
        $sorgu->bindParam(":telefon", $telefon);
        $sorgu->bindParam(":sifre", $sifre);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0){
            return true;
        }
        else {
            return false;
        }




    }

}
