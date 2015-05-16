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


    public  static
    function getirSirketKategori($sirket_id){



        $obj = new static();
        $db = $obj->DB;
        
        $sorgu = $db->prepare("SELECT * FROM kategoriler WHERE   id_sirket =?");
        $sorgu->execute(array($sirket_id));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sorgu->rowCount() > 0) {
            $i = 0;
            foreach ($sonuc as $s ){
                $Category[$i]["CatogryId"] = $s["id"];
                $Category[$i]["TopCatogryId"] = $s["id_ust_kategori"];
                $Category[$i]["CatogryName"] = $s["kategori_adi"];
                $i++;

            }
            $JSON = array("durum" => true,"mesaj"=> "İşlem Başarılı","Categories"=>$Category);

        } else {
            $JSON = array("durum" => false,"mesaj"=> "Kategoriler Alınamadı");
        }
        return $JSON;
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
    function kullaniciAyarlar($id_sirket,$userId, $adi, $soyadi, $mail, $telefon){

        $obj = new static();
        $db = $obj->DB;


        //sorgunun hazırlanması

$sorgu = $db->prepare("
UPDATE musteriler SET adi = :adi , soyadi = :soyadi , mail = :mail , telefon = :telefon
WHERE id = :id AND id_sirket = :id_sirket");


        $sorgu->bindParam(":adi", $adi);
        $sorgu->bindParam(":soyadi", $soyadi);
        $sorgu->bindParam(":mail", $mail);
        $sorgu->bindParam(":telefon", $telefon);
        $sorgu->bindParam(":id", $userId);
        $sorgu->bindParam(":id_sirket", $id_sirket);

        $sorgu->execute();

        if ($sorgu->rowCount() > 0){
            return true;
        }
        else {
            return false;
        }




    }


    public  static
    function  getProductCategory($sirket_id){

        $obj = new static();
        $db = $obj->DB;
        $sorgu = $db->prepare("select * from kategoriler where id_sirket = ? ");
        $sorgu->execute(array($sirket_id ));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if($sorgu->rowCount()>0){


            $i=0;

            foreach($sonuc as $s) {
                $veri[$i]["categoryId"]  = $s["id"]; 
                $veri[$i]["topCategoryId"]  = $s["id_ust_kategori"];
                $veri[$i]["categoryName"]  = $s["kategori_adi"];
            $i++;
            }

            $JSON=array("durum" => true, "mesaj" => "İşlem Başarılı", "bilgiler" =>$veri );
                return $JSON;
        }
        else{
            return array("durum"=>false,"mesaj"=>"Bir hata oluştu");
        }



    }

    public static
    function getirSirketDuyuru($id)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("SELECT * FROM duyuru WHERE id = ?");
        $sorgu->execute(array($id));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sorgu->rowCount() > 0) {
            return $sonuc;
        } else {
            return false;
        }
    }
    public static
    function getirSirketForm($id)
    {
        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("SELECT * FROM formlar WHERE id = ?");
        $sorgu->execute(array($id));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sorgu->rowCount() > 0) {
            return $sonuc;
        } else {
            return false;
        }
    }
    public static
    function formHepsiGetir($id_sirket,$start,$count)
    {
        $obj = new static();
        $db = $obj->DB;

        $limitQuery =  "LIMIT $start,$count";
        $sorgu = $db->prepare("SELECT * FROM formlar WHERE id_sirket =:sirket $limitQuery");
        $sorgu->bindParam(':sirket', $id_sirket);
        $sorgu->execute();


        if ($sorgu->rowCount() > 0) {
            $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
            return $sonuc;
        }
        else {
            return false;
        }
    }

    public static
    function icerikListele($id)
    {
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("SELECT * FROM icerik_yonetimi WHERE id = ?");
        $sorgu->execute(array($id));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);


        if ($sorgu->rowCount() > 0) {
            return $sonuc;
        }
        else {
            return false;
        }
    }


    public static function getNews($sirket_id, $start, $count)
    {
        $obj = new static();
        $db = $obj->DB;
        $limitQuery =  "LIMIT $start,$count";
        $sql="SELECT * FROM haberler WHERE id_sirket =:sirket  $limitQuery";
        $sorgu = $db->prepare($sql);
        $sorgu->bindParam(':sirket', $sirket_id);

        $sorgu->execute();
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sorgu->rowCount() > 0) {
            return $sonuc;
        }
        else {
            return false;
        }
    }


    public static function getNewsCategory($sirket_id)
    {
        $obj = new static();
        $db = $obj->DB;
        $sorgu = $db->prepare("select * from haber_kategori where id_sirket = ? ");
        $sorgu->execute(array($sirket_id));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sorgu->rowCount() > 0) {

            $i = 0;

            foreach ($sonuc as $s) {
                $veri[$i]["newsId"] = $s["id"];
                $veri[$i]["id"] = $s["id_sirket"];
                $veri[$i]["name"] = $s["adi"];
                $i++;
            }

            $JSON = array("durum" => true, "mesaj" => "İşlem Başarılı", "bilgiler" => $veri);
            return $JSON;
        } else {
            return array("durum" => false, "mesaj" => "Bir hata oluştu");
        }

    }

    public static
    function getnewId($id)
    {

        // static bir bağlantı kuruyoruz sınıf ile böylece
        // static fonksiyonlar construct veritabanına ulaşabiliyor.
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("SELECT * FROM haberler WHERE id = ?");
        $sorgu->execute(array($id));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);

        if ($sorgu->rowCount() > 0) {
            return $sonuc;
        } else {
            return false;
        }
    }







    public static
    function icerikGetir($id)
    {
        $obj = new static();
        $db = $obj->DB;

        $sorgu = $db->prepare("SELECT * FROM icerik_yonetimi WHERE id = ?");
        $sorgu->execute(array($id));
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);


        if ($sorgu->rowCount() > 0) {
            return $sonuc;
        }
        else {
            return false;
        }
    }

    public static
    function icerikHepsiGetir($sirket_id,$start,$count)
    {
        $obj = new static();
        $db = $obj->DB;
        $limitQuery =  "LIMIT $start, $count";
        $sql="SELECT * FROM icerik_yonetimi WHERE sirket_id =:sirket  and durum = '1' $limitQuery";
        $sorgu = $db->prepare($sql);
        $sorgu->bindParam(':sirket', $sirket_id);
        $sorgu->execute();



        if ($sorgu->rowCount() > 0) {
            $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
            return $sonuc;
        }
        else {
            return false;
        }
    }
    public static
    function duyuruHepsiGetir($sirket_id,$start,$count)
    {
        $obj = new static();
        $db = $obj->DB;
        $limitQuery =  "LIMIT $start,$count";
        $sql="SELECT * FROM duyuru WHERE sirket_id =:sirket and durum ='1' $limitQuery";
        $sorgu = $db->prepare($sql);
        $sorgu->bindParam(':sirket', $sirket_id);
        $sorgu->execute();

        if ($sorgu->rowCount() > 0) {
            $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
            return $sonuc;
        }
        else {
            return false;
        }
    }

    public static
    function anket($sirket_Id,$anketId){
        $obj = new static();
        $db = $obj->DB;
        $sorgu = $db->prepare("select y.anket_id,y.anket_baslik,s.id secenek_id,s.secenek from anket_yonetimi y join anket_secenek s on y.anket_id=s.anket_id where s.sirket_id = ? and y.anket_id=?");
        $sorgu->execute(array($sirket_Id,$anketId));
        $row=$sorgu->fetchAll();
        if($sorgu->rowCount()>0){
            $i=0;
            foreach($row as $r){
                $secenekler[$i]["secenekId"]=$r["secenek_id"];
                $secenekler[$i]["secenek"]=$r["secenek"];
                $i++;
            }
            $JSON=array("durum" => true, "mesaj" => "İşlem Başarılı", "bilgiler" =>array("anketBaslik"=>$row["0"]["anket_baslik"],"secenekler"=> $secenekler));
        }else
        {
            $JSON=array("durum" => false, "mesaj" => "Bir hata oluştu");
        }
        return $JSON;
    }

    public static
    function anketler($sirket_Id,$start,$count){
        $obj = new static();
        $db = $obj->DB;
        $limitQuery =  "LIMIT $start,$count";
        $sql ="select * from anket_yonetimi WHERE sirket_id=? $limitQuery";
        $sorgu=$db->prepare("$sql");
        $sorgu->execute(array($sirket_Id));
        $row=$sorgu->fetchAll(PDO::FETCH_NAMED);

        if($sorgu->rowCount()>0){
            $i=0;
            foreach($row as $r){
                $anket[$i]["anketBaslik"]=$r["anket_baslik"];
                $anket[$i]["anket_id"]=$r["anket_id"];
                $sorgu2=$db->prepare("select * from anket_secenek WHERE anket_id=?");
                $sorgu2->execute(array($r["anket_id"]));
                $rowSecenek=$sorgu2->fetchAll(PDO::FETCH_NAMED);
                $j=0;
                foreach($rowSecenek as $s){
                  $secenekler[$j]["secenekId"]=$s["id"];
                  $secenekler[$j]["secenek"]=$s["secenek"];
                    $j++;
                }


                $anket[$i]["secenekler"]=$secenekler;

                $i++;


            }
            return $JSON=array("durum" => true, "mesaj" => "İşlem Başarılı", "bilgiler" =>$anket);
        }


        $sorgu = $db->prepare("select y.anket_id,y.anket_baslik,s.id secenek_id,s.secenek from anket_yonetimi y join anket_secenek s on y.anket_id=s.anket_id where s.sirket_id = ? ");
        $sorgu->execute(array($sirket_Id));
        $row=$sorgu->fetchAll(PDO::FETCH_NAMED);
        echo "<pre>";
        print_r($row);
        echo "</pre>";
        if($sorgu->rowCount()>0){
            $i=0;
            foreach($row as $r){
                $anket[$i]["surveyId"]=$r["anket_id"];
                $anket[$i]["surveyName"]=$r["anket_baslik"];

                $i++;
            }
            $JSON=array("durum" => true, "mesaj" => "İşlem Başarılı", "bilgiler" =>array( $anket));
        }else
        {
            $JSON=array("durum" => false, "mesaj" => "Bir hata oluştu");
        }
        return $JSON;
    }





    /**
     * Verilen ürünün "like" larını getirir. Yoksa 0 döner.
     * @param $urun_id
     * @return mixed
     */
    public static
    function getProductLikes($urun_id) {
        $obj = new static();
        $db = $obj->DB;

        $q = "SELECT COUNT(urun_id) as oy_toplam FROM begenme_yonetimi WHERE urun_id = :urun GROUP BY oylama HAVING oylama = 1";
        $sorgu = $db->prepare($q);
        $sorgu->bindParam(":urun", $urun_id);
        $sorgu->execute();

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc["oy_toplam"];
        }
        else {
            return 0;
        }
    }


    /**
     * Verilen ürünün "like" larını getirir. Yoksa 0 döner.
     * @param $urun_id
     * @return mixed
     */
    public static
    function getProductDislikes($urun_id) {
        $obj = new static();
        $db = $obj->DB;

        $q = "SELECT COUNT(urun_id) as oy_toplam FROM begenme_yonetimi WHERE urun_id = :urun GROUP BY oylama HAVING oylama = -1";
        $sorgu = $db->prepare($q);
        $sorgu->bindParam(":urun", $urun_id);
        $sorgu->execute();

        $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sonuc) {
            return $sonuc["oy_toplam"];
        }
        else {
            return 0;
        }
    }

 }

