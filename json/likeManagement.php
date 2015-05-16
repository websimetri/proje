<?php
include "../config.php";
include "../lib/siniflar.php";


if(isset($_GET["ref"]) && !empty($_GET["ref"])){

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    //var_dump($cevap);
    $sirket_id = $cevap["id"];

    if($cevap !=false){

            if(isset($_GET["product_id"]) && !empty($_GET["product_id"]) ){

                $urun = Bulut::getProduct($sirket_id,$_GET["product_id"]);
               // var_dump($urun);

                if ($urun){

                    if (isset($_GET["vote"]) and !empty($_GET["vote"]) and
                        isset($_GET["customerId"]) and !empty($_GET["customerId"])) {
                        // +1 , -1
                        if($_GET["vote"] == "like"){

                            $vote = 1;


                        }else {
                            $vote = -1;
                        }
                        $begen = Bulut::urunBegen($_GET["customerId"],$sirket_id,$_GET["product_id"],$vote);
                        if($begen){
                            $begen = array("durum"=>true,"mesaj"=>"işlem başarılı");

                        }else{
                            $begen = array("durum"=>false,"mesaj"=>"işlem başarısız");
                        }

                    }
                    else {
                        // ürünün toplam + ve - oyları.
                    }

                }
                else {
                    // ürün bulunamadı.
                }

            }
        else {
            // ürün lazim
        }


    }else{
        $begen = array("durum"=>false,"mesaj"=>"Referans Kodu Eksik veya Yanlış.");
    }


}else{
    $begen =array( "durum"=>false,"mesaj"=>"Referans Kodu Yok" );
}
header('Content-Type: application/json');
echo json_encode(array("votes" => array($begen)),JSON_PRETTY_PRINT);

?>