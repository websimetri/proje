<?php


require_once '../../config.php';
require_once '../../lib/fonksiyonlar.php';
require_once '../../lib/SimpleImage.php';
require_once '../../lib/class.image.php';


if(isset($_GET["href"]) && !empty($_GET["href"])) {
    $h = $_GET["href"];

    $sorgu = $DB->prepare("
        SELECT * FROM reklamlar WHERE href = :h
    ");
    $sorgu->bindParam(":h", $_GET["href"]);
    $sorgu->execute();
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    //var_dump($sonuclar);

$id = $sonuclar["id"];
    $tiklama = $sonuclar["tiklama"]+1;
    //var_dump($tiklama);
$query = $DB->prepare("UPDATE reklamlar SET tiklama = :tiklama WHERE id = :id");
    $query->bindParam(":id",$id);
    $query->bindParam(":tiklama",$tiklama);

$query->execute();
if($query){
    //echo "işlem başarılı";
	echo "<script>window.location.href='".$_GET["href"]."';</script>";
}else{
    //echo "işlem başarısız";
}

    return $sonuclar;
}



?>