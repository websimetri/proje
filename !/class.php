<?php

class nket
{


    public function secenek_duzenle($id){
        global $yeniid;
        global $ankid;
        global $secim;
        global $secc;
        global $olay;
        $olay ="duzenle";
        $deg = $this->db->query("SELECT*FROM anket_secenek WHERE id=$id");
        while($row = $deg->fetchAll()){
            foreach ($row as $key) {
                $anked = $key["anket_id"];
                $yeniid = $key["id"];
                $secc = $key["secenek"];
                $select = $this->db->query("select*from anket_yonetimi where anket_id='".$anked."'");
                while ($drow = $select->fetch(PDO::FETCH_ASSOC)) {
                    $secim= '<option value="'.$anked.'"selected>'.$drow["anket_baslik"].'</option>';
                }
            }
        }

    }
    public function secenek_duzenleYaz($id){

        $duzenleYaz = $this->db->prepare("UPDATE anket_secenek SET secenek=:sec  WHERE id=:yni");
        if($duzenleYaz->execute(array('sec'=>$_POST["secenek"], 'yni'=>$_POST["yeniid"])))
        {echo "<script>alert('güncelleme başarılı');</script>";
            echo "<script>window.location.href='index.php';</script>";
        }else {
            echo "<script>alert('güncelleme başarısız');</script>";
        }
    }
}

?>