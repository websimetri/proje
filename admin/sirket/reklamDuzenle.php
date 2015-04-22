<?php
require_once '../../config.php';
require_once '../../lib/fonksiyonlar.php';
require_once '../../lib/SimpleImage.php';
require_once '../../lib/class.image.php';
session_start();

// TODO: Diğer form kontrolleri yapılması lazım burada.
if (isset($_POST["reklam_id"]) && !empty($_POST["reklam_id"])){

    $adi = $_POST["adi"];
    $kod = $_POST["kod"];
    $href = $_POST["link"];
    $dosya = ResimIslemleri::imageUpload("dosya",false,array("gif","png","jpg","jpeg"));
    $id = $_POST["reklam_id"];

    $query = $DB->prepare("UPDATE reklamlar SET adi =:adi , kod = :kod, dosya=:dosya , href = :href WHERE id = :id");
    $query->bindParam(":adi",$adi);
    $query->bindParam(":kod",$kod);

    // TODO: Burasının ileride değişmesi gerekebilir.
    // Reklam dosyaları admin/sirket/upload altına atılıyor.
    $dosyaYolu = "admin/sirket/".$dosya[1];
    $query->bindParam(":dosya",$dosyaYolu);
    $query->bindParam(":href",$href);
    $query->bindParam(":id",$id);
    $sonuc = $query->execute();

    if ($sonuc){
        $mesaj = "basarili";
    } else {
        $mesaj = "basarisiz";
    }
}

else {
    $mesaj = "basarisiz";
}

echo "
<script>
window.location.href = '../index.php?link=reklam&sonuc=$mesaj';
</script>
";
?>