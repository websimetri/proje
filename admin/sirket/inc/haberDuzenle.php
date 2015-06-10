<?php
require_once '../../../config.php';

if (isset($_POST["baslik"]) and !empty($_POST["baslik"]) and
    isset($_POST["kisa_aciklama"]) and !empty($_POST["kisa_aciklama"]) and
    isset($_POST["uzun_aciklama"]) and !empty($_POST["uzun_aciklama"]) and
    isset($_POST["kategori_id"]) and !empty($_POST["kategori_id"]) and
    isset($_POST["id"]) and !empty($_POST["id"])) {

    $baslik = $_POST["baslik"];
    $kisa_aciklama = $_POST["kisa_aciklama"];
    $uzun_aciklama = $_POST["uzun_aciklama"];
    $kid = $_POST["kategori_id"];
    $id = $_POST["id"];

    $query = $DB->prepare("
    UPDATE haberler SET kategori_id = :kid , baslik = :baslik , uzun_aciklama = :uzun_aciklama , kisa_aciklama = :kisa_aciklama WHERE id = :id
    ");

    $query->bindParam(":id",$id);
    $query->bindParam(":kid",$kid);
    $query->bindParam(":baslik",$baslik);
    $query->bindParam(":uzun_aciklama",$uzun_aciklama);
    $query->bindParam(":kisa_aciklama",$kisa_aciklama);

    $query->execute();
	
	
	
	
	// resim değiştirilmek isteniyor ise
	if(isset($_FILES["resim"])) {
		
	$id = $_POST["id"];
	$resim = $_FILES["resim"]["name"];
	$izinverilenDosyalar = array("jpg","jpeg","png","gif","bmp");
	$dosyaHatasi = $_FILES["resim"]["error"];
	if ($dosyaHatasi != 0) {
		//echo "Dosya Yüklemesinde Bir Hata Oluştu.";
	}else {
		// hata yok - dosya yüklemeye çalışıyor
		$boyut = $_FILES["resim"]["size"];
		if($boyut > (1024*1024*2)){
			//echo "Dosya Boyutu Çok Büyük";

		}else {

			$dosyaTipi = $_FILES["resim"]["type"];
			//echo "Dosya Tipi : ". $dosyaTipi;
			// tip kontrol yapılıyor
			//echo ("image/".$izinverilenDosyalar[1])."<br>";
			//echo $dosyaTipi;
			$durum = false;
			for ($i=0; $i < count($izinverilenDosyalar) ; $i++) { 
				if(("image/".$izinverilenDosyalar[$i]) == $dosyaTipi){
					$durum = true;
					break;
				}
			}
			if($durum){
				
				// dosya tipi istediğimiz gibi gönderme yapılabilir.
				// dosya boyutu istediğimiz gibi upload işlemini başlat.
				$path = $_FILES["resim"]["tmp_name"];
				$resim_son = rand(10,100000).$_FILES["resim"]["name"];
				$yaz_resim = "../../static/haber_resimleri/".$resim_son;
				$status = copy($path,$yaz_resim) or die("Could not copy file contents");
				//echo "<br>".$status;
				// 1. parametre : dosyanın tmp'teki yolunu alır
				// 2. parametre : dosyanın yolu ile birlikte adını alır.
				//echo "Dosya Gönderme Başarılı";
				
				$query = $DB->prepare(" UPDATE haberler SET resim = :resim WHERE id = :id");
				$query->bindParam(":id",$id);
				$query->bindParam(":resim",$resim_son);
				$query->execute();
				
						}else {
							//echo "İzin verilmeyen dosya türü";
						}
		}}}
		


    if($query->rowCount() > 0){
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
window.location.href = '../../index.php?link=haberler&sonuc=$mesaj';
</script>";
?>
