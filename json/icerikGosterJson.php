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

        if (isset($_GET["userId"])) {
            $kulBilgi = BulutJSON::icerikListele($_GET["userId"]);


            if ($kulBilgi != false) {
                $kulBilgi=$kulBilgi[0];
                if($kulBilgi["durum"] == "1") {
                    $JSON = array("durum" => true,"mesaj" => "Giriş Başarılı", "bilgiler" => array(
                        "userId" => $kulBilgi["id"], "companyId" => $kulBilgi["sirket_id"], "Title" => $kulBilgi["baslik"],
                        "view" => $kulBilgi["kisa_aciklama"], "Detail" => $kulBilgi["detay"], "Date" => $kulBilgi["eklenme_tarihi"], "Case" => $kulBilgi["durum"]));
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
    $JSON =array( "durum"=>false,"mesaj"=>"Referans Kodu Giriniz" );
}

echo json_encode(array("user"=>array($JSON)));
?>