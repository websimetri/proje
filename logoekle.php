<?php
include "fonksiyonlar.php";

// TODO: Session kontrolü falan yok henüz. Aşağıdaki
// $_SESSION hata verecektir.

function imageUpload($inputname, $maximum_dosya_boyutu = false)
{
    if (isset($_FILES["dosya"])) {
        
        /**
         * *
         * dosya isimleri bu şekilde olsun ki dosyalara site dışından erişimimiz de kolay ve anlamlı olsun.
         * aynı kullanıcının resimleri ard arda görünsün..
         * *
         */
        
        $dosyaAdi = idEncode($_SESSION["kulId"]) . "_" . date("YmdHis");
        
        // $izinverilenDosyalar = array("jpg","jpeg","png","gif","bmp");
        $izinVerilenTurler = array(
            "jpg",
            "jpeg",
            "png"
        ); // sadece bunlara izin verelim.
        
        $klasoryolu = UPLOAD_DIR . "/" . date("Y-m");
        $maximum_dosya_boyutu = $maximum_dosya_boyutu == false ? 1024 * 1024 * 2 : $maximum_dosya_boyutu;
        
        if (! file_exists($klasoryolu)) {
            mkdir($klasoryolu, 0777, true);
        }
        
        $dosyaHatasi = $_FILES[$inputname]["error"]; // integer değer döner.
        if ($dosyaHatasi != 0) {
            // echo "Dosya yüklemesinde bir hata oluştu";
            return 2; // file upload sırasında bir hata
        } else {
            $boyut = $_FILES[$inputname]["size"];
            if ($boyut > ($maximum_dosya_boyutu)) {
                return 3; // "Dosya boyutu 2 MB'tan daha büyük olamaz!";
            } else {
                $dosyaTipi = $_FILES["dosya"]["type"];
                
                $durum = false;
                for ($i = 0; $i < count($izinVerilenTurler); $i ++) {
                    if (("image/" . $izinVerilenTurler[$i]) == $dosyaTipi) {
                        $dosyaUzanti = $izinVerilenTurler[$i];
                        $durum = true;
                        break;
                    }
                }
                
                if ($durum) {
                    $path = $_FILES[$inputname]["tmp_name"];
                    if (! getimagesize($_FILES[$inputname]["tmp_name"]) & is_executable($_FILES[$inputname]["tmp_name"])) {
                        return 4; // Dosya resim değil
                    } else {
                        if (copy($path, $klasoryolu . "/" . $dosyaAdi . "." . $dosyaUzanti)) {
                            return true;
                        } else {
                            return 5; // copy fonksiyonu hatası
                        }
                    }
                } else {
                    return 6; // "İzin verilmeyen dosya türü
                }
            }
        }
    } else {
        return 7; // input veri göndermedi
    }
}

imageUpload("dosya");

/*
 *
 * Hosttaki php.ini dosyasının içindeki post_max_size ve upload_max_filesize karşısındaki değerleri değiştirmemiz gerek
 * daha dogrusu arttırmamız gerek
 * eğer arttırmazsak;
 *
 * Warning: POST Content-Length of 8978294 bytes exceeds the limit of 8388608 bytes in Unknown on line 0 hatası ile karşılaşıyoruz.
 *
 *
 *
 */

?>

<meta charset="utf-8" />

<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="dosya" placeholder="Dosya" /> <input
		type="submit" value="Gönder" />
</form>
