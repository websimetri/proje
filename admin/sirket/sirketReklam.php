<?php
require_once '../../config.php';
require_once '../../lib/fonksiyonlar.php';
require_once '../../lib/SimpleImage.php';
require_once '../../lib/class.image.php';
session_start();

if (isset($_POST["sil"])) {
    if(isset($_POST["reklam_id"]) && !empty($_POST["reklam_id"])){

        $sorgu = $DB->prepare("DELETE from reklamlar where id=?");
        $sonuc = $sorgu->execute(array($_POST["reklam_id"]));

        if($sonuc){
            echo "<script>window.location.href='../index.php?link=reklam&sonuc=basarili'</script>";
        }

        else{
            echo "<script>window.location.href='../index.php?link=reklam&sonuc=basarisiz'</script>";
        }
    }
    else {
        echo "<script>window.location.href='../index.php?link=reklam&sonuc=basarisiz'</script>";
    }
}elseif (isset($_POST["ekle"])) {
    $dosya = ResimIslemleri::imageUpload("dosya", false, array("gif","png","jpg","jpeg"));

    if ($dosya[0] == true &&
        isset($_POST["sid"]) &&
        isset($_POST["adi"]) &&
        isset($_POST["gosterim"]) &&
        isset($_POST["baslangic"]) &&
        isset($_POST["bitis"]) &&
        isset($_POST["genislik"]) &&
        isset($_POST["yukseklik"]) &&
        isset($_POST["link"]) &&
        isset($_FILES["dosya"]) ){

        $sirket_id = $_SESSION["sirketId"];
        $adi = $_POST["adi"];
        $gosterim = $_POST["gosterim"]; // burası nasıl olacak aklıma tam yatmadı
        $tiklama = "0";
        $baslangic = $_POST["baslangic"];
        $bitis = $_POST["bitis"];
        $genislik = $_POST["genislik"];
        $yukseklik = $_POST["yukseklik"];
        $href = $_POST["link"];
        $aktif = "1";
        $kod = "<iframe></iframe>";

        $query = $DB->prepare("
    INSERT INTO reklamlar
    VALUES (null,:id_sirket,:adi,:gosterim,:tiklama,:tarih_baslangic,:tarih_bitis,now(),:dosya,:kod,:href,:genislik,:yukseklik,:aktif)
    ");

        $query->bindParam(':id_sirket',$sirket_id);
        $query->bindParam(':adi',$adi);
        $query->bindParam(':gosterim',$gosterim);
        $query->bindParam(':tiklama',$tiklama);
        $query->bindParam(':tarih_baslangic',$baslangic);
        $query->bindParam(':tarih_bitis',$bitis);

        // TODO: Burasının ileride değişmesi gerekebilir.
        // Reklam dosyaları admin/sirket/upload altına atılıyor.
        $dosyaYolu = "admin/sirket/".$dosya[1];
        $query->bindParam(':dosya',$dosyaYolu);

        $query->bindParam(':href',$href);
        $query->bindParam(':genislik',$genislik);
        $query->bindParam(':yukseklik',$yukseklik);
        $query->bindParam(':aktif',$aktif);
        $query->bindParam(':kod',$kod);
        $sonuc = $query->execute();

        if ($sonuc) {
            // islem başarılı.
            $mesaj = "basarili";
        }

        else {
            // islem başarısız.
            $mesaj = "basarisiz";
        }
    }
    else {
        // islem başarısız.
        $mesaj = "basarisiz";
    }
    echo "
<script>
window.location.href = '../index.php?link=reklam&sonuc=$mesaj';
</script>
";
}elseif (isset($_POST["duzenle"])) {
    if (isset($_POST["reklam_id"]) && !empty($_POST["reklam_id"])){

        $adi = $_POST["adi"];

        $href = $_POST["href"];
        $dosya = ResimIslemleri::imageUpload("dosya",false,array("gif","png","jpg","jpeg"));
        $id = $_POST["reklam_id"];

        $yukseklik = $_POST["yukseklik"];
        $genislik = $_POST["genislik"];


        $query = $DB->prepare("UPDATE reklamlar SET adi =:adi ,yukseklik = :yukseklik,genislik = :genislik, dosya=:dosya , href = :href WHERE id = :id");
        $query->bindParam(":adi",$adi);
        $query->bindParam(":genislik",$genislik);
        $query->bindParam(":yukseklik",$yukseklik);


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
}else {
    $mesaj = "basarisiz";
}
echo "
<script>
window.location.href = '../../index.php?link=duyuru&sonuc=$mesaj';
</script>";
?>