<?php
include "../config.php";
include "../lib/siniflar.php";


if(isset($_GET["ref"]) && !empty($_GET["ref"])){

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    //var_dump($cevap);
    $sirket_id = $cevap["id"];


    if($cevap !=false){

        if (isset($_GET["customerId"]) and !empty($_GET["customerId"]) and
            !isset($_GET["productId"]) and !isset($_GET["vote"])) {
            $begeniler = BulutJSON::user_begeni($_GET["customerId"]);
            // var_dump($begeniler);
            if ($begeniler) {

                $begen = $begeniler;

            }
            else {
                $begen = array(
                    "durum" => "false",
                    "mesaj" => "Beğeni bulunamadı."
                );
            }

        }

        elseif (isset($_GET["productId"]) && !empty($_GET["productId"])){
            // Oylama kısmı.

            $urun = BulutJSON::getir_urun($sirket_id,$_GET["productId"]);
            if($urun){

                if(isset($_GET["vote"]) and
                    isset($_GET["customerId"]) and !empty($_GET["customerId"])){

                    if(($_GET["vote"] >= 0) and ($_GET["vote"] <= 5)){
                        $vote = $_GET["vote"];

                    }else {
                        $vote = 0;
                    }

                    $begen = Bulut::urunBegen($_GET["customerId"],$sirket_id,$_GET["productId"],$vote);

                    if($begen){
                        $begen = array("durum"=>true,"mesaj"=>"işlem başarılı");

                    }else{
                        $begen = array("durum"=>false,"mesaj"=>"işlem başarısız");
                    }

                } else {
                    $begen = Bulut::getirUrunBegenilerUrun($sirket_id,$_GET["productId"]);


                }
            } else{
                //urun bulunamadı
                $begen = array("durum"=>false,"mesaj"=>"Ürün Bulunamadı");

            }


        }else {
            //urun lazım
            $begen = array("durum"=>false,"mesaj"=>"Ürün Id Eksik");
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