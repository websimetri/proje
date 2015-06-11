<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body leftmargin="0" topmargin="0">
<?php
include "../config.php";
include "../lib/siniflar.php";


if (isset($_GET["ref"]) && !empty($_GET["ref"])) {


    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap != false) {

        $sirket_id = $cevap["id"];


        if (isset($_GET["advertisementId"]) && !empty($_GET["advertisementId"])) {


            $query = $DB->prepare("SELECT *FROM reklamlar WHERE id_sirket = :sirket_id AND id = :id");
            $query->bindParam(":sirket_id", $sirket_id);
            $query->bindParam(":id", $_GET["advertisementId"]);
            $query->execute();

            if ($query->rowCount() > 0) {
                $reklam = $query->fetch(PDO::FETCH_ASSOC);

                $ilk = strtotime($reklam["tarih_bitis"]);
                $tarih = strtotime(date("Y-m-j H:i:s"));
                $zaman = $tarih - $ilk;

                if ($zaman < 0) {

                    $ads = '<a href="http://jsonbulut.com/admin/sirket/reklam_tiklama.php?ref='.$_GET["ref"].'&advertisementId='.$_GET["advertisementId"].'&href=' . $reklam["href"] . '" target="_top"><img src="http://jsonbulut.com/' . $reklam["dosya"] . '"></a>';
                    $JSON = array("durum" => true, "mesaj" => "İşlem Başarılı", "reklam" => $ads);
					
					// update işlemi yapılıyor
				$gosterim = $reklam["gosterim"] + 1;
                $query = $DB->prepare("UPDATE reklamlar SET gosterim = :gosterim WHERE id = :id");
                $query->bindParam(":gosterim", $gosterim);
                $query->bindParam(":id", $_GET["advertisementId"]);
                $query->execute();

                if ($query) {
                    //echo "işlem başarılı";
                } else {
                    //echo "işlem başarısız";
                }
					
					
                } else {
                    $JSON = array("durum" => false, "mesaj" => "Reklam SÜreniz dOLMUŞ");

                }


            } else {
                $JSON = array("durum" => false, "mesaj" => "Reklam id bulunamadı.");
            }

        } else {
            $JSON = array("durum" => false, "mesaj" => "Reklam id giriniz.");
        }


    } else {
        $JSON = array("durum" => false, "mesaj" => "referans kodu hatalı");
    }


} else {
    $JSON = array("durum" => false, "mesaj" => "referans kodu yok");

}
//header('Content-Type: application/json');
//echo json_encode(array("reklam" => array($JSON)), JSON_PRETTY_PRINT);
echo $ads;
?>
</body>