<?php
session_start();
require_once '../../../config.php';





$mesaj = $_POST["mesaj"];
$sirket_id = $_SESSION["sirketId"];
$gonderen_id = $_SESSION["kulId"];
$konu = $_POST["konu"];
$alan_id =$_POST["sid2"];

$durum = "0";


if(isset($_POST["gonder"])){





    $query = $DB->prepare("INSERT INTO mesajlar VALUES (null,:sirket_id,:gonderen_id,:alan_id,:konu,:mesaj,now(),:durum)");
        $query->bindParam(':sirket_id',$sirket_id);
        $query->bindParam(':gonderen_id',$gonderen_id);
        $query->bindParam(':alan_id',$alan_id);
        $query->bindParam(':konu',$konu);
        $query->bindParam(':durum',$durum);
        $query->bindParam(':mesaj',$mesaj);
        $query->execute();

    if($query->rowCount() > 0) {
        $mesaj = "basarili";
    }
    else {
        $mesaj = "basarisiz";
    }
}
else {
    $mesaj = "basarisiz";
}

echo "
<script>
window.location.href = '../../index.php?link=mesajlar&sonuc=$mesaj';
</script>";


?>