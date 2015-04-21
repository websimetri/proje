<?php

class FileUpload
{
    public static function imageUpload($inputname, $imageResize = false, $turler = false)
    {

        /**
         * *
         * dosya isimleri bu şekilde olsun ki dosyalara site dışından erişimimiz de kolay ve anlamlı olsun.
         * aynı kullanıcının resimleri ard arda görünsün..
         * *
         */

        $dosyaAdi = idEncode($_SESSION["sirketId"]) . "_" . date("YmdHis");

        // $izinverilenDosyalar = array("jpg","jpeg","png","gif","bmp");

        if ($turler != false && is_array($turler)) {
            $izinVerilenTurler = $turler;
        } else {
            $izinVerilenTurler = array(
                "jpg",
                "jpeg",
                "png"
            );
        }

        // TODO: Bu kısım, eğer fonksiyon index dışında bir yerden çağırılırsa direkt o kısma
        // klasör açabilir.
        // Yani admin/login.php'de çağırdık diyelim. "upload" ve altındaki klasörleri orada
        // açabilir.
        // $_SERVER["DOCUMENT_ROOT"]
        // Sorun çıkarırsa bunu kullanırız.
        $klasoryolu = UPLOAD_DIR . "/" . date("Y-m");
        $maximum_dosya_boyutu = 1024 * 1024 * 2;

        if (!file_exists($klasoryolu)) {
            mkdir($klasoryolu, 0777, true);
        }

        $dosyaHatasi = $_FILES[$inputname]["error"]; // integer değer döner.
        if ($dosyaHatasi != 0) {
            // echo "Dosya yüklemesinde bir hata oluştu";
            return 2; // file upload sırasında bir hata
        } else {
            $boyut = $_FILES[$inputname]["size"];
            if ($boyut > ($maximum_dosya_boyutu)) {
                return 3; // "Dosya boyutu belirtilen değerden daha büyük olamaz!";
            } else {
                $dosyaTipi = pathinfo($_FILES[$inputname]["name"]);
                $dosyaTipi = $dosyaTipi['extension'];

                $durum = false;
                for ($i = 0; $i < count($izinVerilenTurler); $i++) {
                    if ($izinVerilenTurler[$i] == $dosyaTipi) {
                        $dosyaUzanti = $izinVerilenTurler[$i];
                        $durum = true;
                        break;
                    }
                }

                if ($durum) {
                    $path = $_FILES[$inputname]["tmp_name"];
                    if (!getimagesize($_FILES[$inputname]["tmp_name"]) & is_executable($_FILES[$inputname]["tmp_name"])) {
                        return 4; // Dosya resim değil
                    } else {
                        $ciktiYolu = $klasoryolu . "/" . $dosyaAdi . "." . $dosyaUzanti;
                        if (copy($path, $ciktiYolu)) {
                            return $ciktiYolu; // dosya tek kopya halinde yüklendi
                        } else {
                            return 6; // copy fonksiyonu hatası
                        }
                    }
                } else {
                    return 7; // "İzin verilmeyen dosya türü
                }
            }
        }
    }
}


?>