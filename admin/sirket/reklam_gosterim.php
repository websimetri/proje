<?php

require_once '../../config.php';
require_once '../../lib/fonksiyonlar.php';
require_once '../../lib/SimpleImage.php';
require_once '../../lib/class.image.php';

$_GET["reklam_id"] = 10;
if(isset($_GET["reklam_id"]) && !empty($_GET["reklam_id"])) {
    $reklam_id = $_GET["reklam_id"];


    $sorgu = $DB->prepare(" SELECT * FROM reklamlar WHERE id = :h");
    $sorgu->bindParam(":h", $reklam_id);
    $sorgu->execute();
    $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);
    // <iframe width="560" height="315" src="https://www.youtube.com/embed/XnaRLo0Dsr4" frameborder="0" allowfullscreen></iframe>
    echo "<a href=http://localhost:8080/php/l/proje/reklam_tiklama.php?reklam_id=" . $reklam_id . " target=\"_blank\"><img src=\"http://localhost:8080/php/l/proje/" . $sonuclar["dosya"] . "\" width=\"100\" height=\"100\"></img></a>";
    // gösterim yapıldı veritabanındaki değeri update yap


}


if($_GET["reklam_id"]) {
    var_dump($sonuclar);
    $gosterim = $sonuclar["gosterim"] + 1;
    $query = $DB->prepare("UPDATE reklamlar SET gosterim = :gosterim WHERE id = :reklam_id");
    $query->bindParam(":gosterim", $gosterim);
    $query->bindParam(":id", $reklam_id);
    $query->execute();

    if ($query) {
        echo "işlem başarılı";
    } else {
        echo "işlem başarısız";
    }

    return $sonuclar;

}

?>