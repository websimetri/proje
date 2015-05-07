<?php
include "../config.php";
include "../lib/siniflar.php";

if(isset($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap != false) {

        if (isset($_GET["userEmail"]) && isset($_GET["userPass"])) {
            $kulBilgi = Bulut::getirSirketMusteri($cevap["id"], $_GET["userEmail"], $_GET["userPass"]);

            if ($kulBilgi != false) {
                $kulBilgi=$kulBilgi[0];
                if($kulBilgi["aktif"] == "1") {
                    $JSON = array("durum" => "Başarılı", "bilgiler" => array(
                        "userId" => $kulBilgi["id"], "companyId" => $kulBilgi["id_sirket"], "userName" => $kulBilgi["adi"],
                        "userSurname" => $kulBilgi["soyadi"], "userEmail" => $kulBilgi["mail"], "userPhone" => $kulBilgi["telefon"],
                        "userPass" => $kulBilgi["sifre"]
                    ));
                }
                else{
                    $JSON = array("durum" => "Başarısız", "mesaj" => "Aktif Kullanıcı Bulunamadı");
                }
            } else {
                $JSON = array("durum" => "Başarısız", "mesaj" => "Kullanıcı Bilgileri Hatalı");
            }
        } else {
            //kullanıcı Bilgileri yanlış ise
            $JSON = array("durum" => "Başarısız", "mesaj" => "Kullanıcı Bilgileri Eksik");

        }
    } else {
        //referans kodu yanlış ise
        $JSON = array("durum" => "Başarısız", "mesaj" => "Referans Kodu Hatalı");
    }
}
else{
    $JSON =array( "durum"=>"Başarısız","mesaj"=>"Referans Kodu Eksik" );
}
echo json_encode(array("user"=>array($JSON)));
?>