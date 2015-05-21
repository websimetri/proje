<?php

include "../config.php";
include "../lib/siniflar.php";


if(isset($_GET["ref"]) && !empty($_GET["ref"])){

    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);
    $sirket_id = $cevap["id"];

    if($cevap !=false) {




        if(isset($_GET["userId"]) && !empty($_GET["userId"]) && isset($_GET["status"])){
                //duruma göre mesajları çekiyoruz

            if ($_GET["status"] == "0" or $_GET["status"] == 1) {
                $query=$DB->prepare("SELECT *FROM mesajlar WHERE alan_id = :alan_id and durum = :durum and sirket_id = :sirket_id");
                $query->bindParam(":alan_id",$_GET["userId"]);
                $query->bindParam(":durum",$_GET["status"]);
                $query->bindParam(":sirket_id",$sirket_id);
                $query->execute();
                if($query->rowCount() > 0){
                    $mesaj = $query->fetchAll(PDO::FETCH_ASSOC);
                    $JSON = array("durum" => true, "mesaj" => "başarılı","mesajlar"=>$mesaj);
                }
            }
            else {
                // status boş gelmesi hali.
                $JSON = array("durum" => false, "mesaj" => "Durum eksik.");
            }


        }else{
            if(isset($_GET["userId"]) && !empty($_GET["userId"]) && isset($_GET["messageId"]) && !empty($_GET["messageId"])){
                //mesaj id ye göre istediği mesajı çekiyor ve durumu okunmuş olarak değiştiriyor

                $query =$DB->prepare("SELECT *FROM mesajlar WHERE alan_id = :alan_id and sirket_id = :sirket_id and id = :id");
                $query->bindParam(":alan_id",$_GET["userId"]);
                $query->bindParam(":sirket_id",$sirket_id);
                $query->bindParam(":id",$_GET["messageId"]);
                $query->execute();
                if($query->rowCount() > 0){
                    $mesaj = $query->fetch(PDO::FETCH_ASSOC);
                    $JSON = array("durum" => true, "mesaj" => "başarılı","mesajlar"=>$mesaj);

                    if($mesaj["durum"] == 0){
                        $dgsken = "1";
                        $query = $DB->prepare("UPDATE mesajlar SET durum = :durum WHERE id = :id");
                        $query->bindParam(":durum",$dgsken);
                        $query->bindParam(":id",$_GET["messageId"]);
                        $query->execute();
                        if($query->rowCount() >0){
                            $JSON = array("durum" => true, "mesaj" => "başarılı","mesajlar"=>$mesaj);
                        }
                    }

                }

            }else{



                if(isset($_GET["userId"]) && !empty($_GET["userId"])) {
                    //sadece kul id ile o kişiye ait tüm mesajları çekiyor.

                    $query = $DB->prepare("SELECT *FROM mesajlar WHERE alan_id = :alan_id and sirket_id = :sirket_id");
                    $query->bindParam(":alan_id", $_GET["userId"]);
                    $query->bindParam(":sirket_id", $sirket_id);
                    $query->execute();
                    if ($query->rowCount() > 0) {

                        $mesaj = $query->fetchAll(PDO::FETCH_ASSOC);
                        $JSON = array("durum" => true, "mesaj" => "başarılı", "mesajlar" => $mesaj);
                        //$messageId = $mesaj[0]["id"];
                        // var_dump($messageId);

                    }
                }else{
                    $JSON = array("durum" => false, "mesaj" => "Kullanıcı id Yok");
                }

            }

    }

    }else{
            $JSON = array("durum" => false, "mesaj" => "Referans Kodu Eksik veya Yanlış.");
        }
}else{
    $JSON = array("durum" => false, "mesaj" => "Referans Kodu Yok");
}

header('Content-Type: application/json');
echo json_encode(array("mesajlar" => array($JSON)), JSON_PRETTY_PRINT);



?>