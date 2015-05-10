<?php

class siris
{

    public static function siparisAl()
    {

        global $bilgi;
        $dizi = array();
        $dizi = $_POST;
        $bilgi = "";
        foreach ($dizi as $key => $val) {
            $bilgi .= $key;
            $bilgi .= " : ";
            $bilgi .= $val;
            $bilgi .= "<br>";
        }
        return print_r($bilgi);

    }

    // siparişi veri tabanına yazmak
    public static function siparisyaz($must_id, $sirket_id, $urun_id)
    {
        $obj = new static();
        $db = $obj->DB;

        global $bilgi;
        $dizi = array();
        $dizi = $_POST;
        $bilgi = "";
        foreach ($dizi as $key => $val) {
            $bilgi .= $key;
            $bilgi .= " : ";
            $bilgi .= $val;
            $bilgi .= "</br>";
        }
        $q = "
	        INSERT INTO siparis VALUES
	        (NULL, :sirket_id, :must_id, :urun_id, :siparis_bilgisi, now())";
        $yaz = $db->prepare($q);
        $yaz->bindParam(":sirket_id", $sirket_id);
        $yaz->bindParam(":must_id", $must_id);
        $yaz->bindParam(":urun_id", $urun_id);
        $yaz->bindParam(":siparis_bilgisi", $bilgi);
        $yaz->execute();
    }

    public static function siparis_liste($sirket_id)
    {
        $obj = new static();
        $db = $obj->DB;
        global $dizi;
        $dizi = array();
        $liste = $db->query("select*from siparis where sirket_id='" . $sirket_id . "'");
        while ($row = $liste->fetchAll()) {
            foreach ($row as $key => $val) {
                $dizi[] = $val;

            }
            return $dizi;

        }

    }
}


?>