<?php 
include "fonksiyonlar.php";

// TODO: Session kontrolü falan yok henüz. Aşağıdaki
// $_SESSION hata verecektir.

if(isset($_FILES["dosya"])) {


	//$ekle_isim = date("YmdHis");
	//$dosyaAdi = $ekle_isim."_".$_FILES["dosya"]["name"];
	
	/***
	* dosya isimleri bu şekilde olsun ki dosyalara site dışından erişimimiz de kolay ve anlamlı olsun.
	* aynı kullanıcının resimleri ard arda görünsün..
	***/
	
	$dosyaAdi = idEncode($_SESSION["kulId"])."_".date("YmdHis");
	



	// $izinverilenDosyalar = array("jpg","jpeg","png","gif","bmp");
	$izinverilenDosyalar = array("jpg","jpeg","png"); // sadece bunlara izin verelim.
	
	if ($dosyaHatasi = 0) {
		echo "Dosya Yüklemesinde Bir Hata Oluştu.";
	}else {

			$dosyaTipi = $_FILES["dosya"]["type"];
			$durum = false;
			for ($i=0; $i < count($izinverilenDosyalar) ; $i++) { 
				if(("image/".$izinverilenDosyalar[$i]) == $dosyaTipi){
					$durum = true;
					break;
				}
			}
			if($durum){
				
				$bak = $_FILES["dosya"]["tmp_name"];
				copy($bak,'files/'.$_FILES["dosya"]["name"].$dosyaAdi);
				
				echo "RESİM GÖNDERİMİ BAŞARILI";
			}else {
				echo "İZİN VERİLMEYEN DOSYA TÜRÜ";
			}



		}
	}




/*

Hosttaki php.ini dosyasının içindeki post_max_size ve upload_max_filesize karşısındaki değerleri değiştirmemiz gerek
daha dogrusu arttırmamız gerek
eğer arttırmazsak;

Warning: POST Content-Length of 8978294 bytes exceeds the limit of 8388608 bytes in Unknown on line 0 hatası ile karşılaşıyoruz.



*/



 ?>

<meta charset="utf-8"/>
 
 <h4>İzin Verilen Dosya Türleri : jpg , jpeg , png, gif, bmp</h4>
 <hr style="height: 10px" >
 <form action="" method="post" enctype="multipart/form-data">
 	<input type="file" name="dosya" placeholder="Dosya"/>
 	<input type="submit" value="Gönder"/>
 </form>
