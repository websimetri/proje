<?php
session_start();
require_once '../../../config.php';
require_once "../../../lib/siniflar.php";



$kulid =$_SESSION["kulId"];
$id = $_POST["mesaj_id"];

if(isset($_POST["mesaj_id"]) && isset($_POST["kul_id"])){

    if($kulid == $_POST["kul_id"]){
        $sonuc = Mesaj::Mesaj_Sil($id);
        var_dump($sonuc);
    if($sonuc){
        echo "<script>window.location.href='../../index.php?link=mesajlar&islem=forum'</script>";
    }else{
        echo "Başarısız";
    }

    }else{
        echo"<script>alert('İşlem Yapma Yetkiniz Yok !');
            window.location.href='../../index.php?link=mesajlar&islem=forum';
</script>";
}


}



?>