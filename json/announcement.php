<?php
include "../config.php";
include "../lib/siniflar.php";

/*
 * GELECEK OLAN PARAMETRELER GET TİPİNDE
 * referans kofu  ?ref=
 * kullanıcı mail adresi ?userEmail=
 * kullanıcı şifresi ?userPass=
 *
 *
 * Geri Gönecek olan bilgiler
 *
 *Giriş başarısız olursa user{durum="başarısız",mesaj}
 *
 * giriş başarılı olursa user{durum="başarılı", bilgiler{userId,companyId,id_sirket,userName,userSurname,userEmail,userPhone} }
 *
 */



if(isset($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap != false) {

        if (isset($_GET["userId"]) && isset($_GET["companyId"])) {
            $kulBilgi = BulutJSON::getirSirketDuyuru($_GET["userId"], md5($_GET["companyId"]));
//            $kulBilgi = Bulut::getirSirketMusteri($cevap["id"], $_GET["userEmail"], $_GET["userPass"]);
            // Json işlemleri için ayrı bir sınıf kullanalım.

            if ($kulBilgi != false) {
                $kulBilgi=$kulBilgi[0];
                if($kulBilgi["aktif"] == "1") {
                    $JSON = array("durum" => true,"mesaj" => "Giriş Başarılı", "bilgiler" => array(
                        "userId" => $kulBilgi["id"], "companyId" => $kulBilgi["sirket_id"], "announcementtitle" => $kulBilgi["duyuru_baslik"],
                        "announcementtitle" => $kulBilgi["duyuru_detay"], "case" => $kulBilgi["durum"]));
                }
                else{
                    $JSON = array("durum" => false, "mesaj" => "Aktif Kullanıcı Bulunamadı");
                }
            } else {
                $JSON = array("durum" => false, "mesaj" => "Kullanıcı Bilgileri Hatalı");
            }
        } else {
            //kullanıcı Bilgileri yanlış ise
            $JSON = array("durum" => false, "mesaj" => "Kullanıcı Bilgileri Eksik");

        }
    } else {
        //referans kodu yanlış ise
        $JSON = array("durum" => false, "mesaj" => "Referans Kodu Hatalı");
    }
}
else{
    $JSON =array( "durum"=>false,"mesaj"=>"Referans Kodu Eksik" );
}

echo json_encode(array("user"=>array($JSON)));
?>