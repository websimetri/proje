<?php

class ResimIslemleri
{
    public $SimpleImage;

    /**
     *
     * @param $DB config.php'den
     *            $DB bağlantısı
     */
    function __construct()
    {
        $this->SimpleImage = new SimpleImage(); // SimpleImage ın yeteneklerini de kullanabilelim diye..
    }

    /**
     * @param $inputname
     * @param bool $imageResize
     * @return int|string
     */
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

        $minYukseklik = "400";
        $minGenislik = "400";

        // TODO: Bu kısım, eğer fonksiyon index dışında bir yerden çağırılırsa direkt o kısma
        // klasör açabilir.
        // Yani admin/login.php'de çağırdık diyelim. "upload" ve altındaki klasörleri orada
        // açabilir.
        // $_SERVER["DOCUMENT_ROOT"]
        // Sorun çıkarırsa bunu kullanırız.
        $klasoryolu = UPLOAD_DIR;
        $maximum_dosya_boyutu = 1024 * 1024 * 2;

       // if (!file_exists($klasoryolu)) {
        //    mkdir($klasoryolu, 0777, true);
        //}

        $dosyaHatasi = $_FILES[$inputname]["error"]; // integer değer döner.
        if ($dosyaHatasi != 0) {
            return array(false,2); // file upload sırasında bir hata
        } else {

            $imageData = getimagesize($_FILES[$inputname]["tmp_name"]);
            $width = $imageData[0];
            $height = $imageData[1];
            
            $boyut = $_FILES[$inputname]["size"];
            if ($boyut > ($maximum_dosya_boyutu)) {
                return array(false,3); // "Dosya boyutu belirtilen değerden daha büyük olamaz!";
            } elseif ($width < $minGenislik & $height < $minYukseklik) {
                return array (false,4); // dosya genişliği veya yüksekliği belirtilen değerden daha küçük olamaz
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
                        return array(false,5); // Dosya resim değil
                    } else {
                        $ciktiYolu = $klasoryolu . "/" . $dosyaAdi . "." . $dosyaUzanti;
						$tciktiYolu = $klasoryolu . "/tmb/" . $dosyaAdi . "." . $dosyaUzanti;
	
	
	$ciktiYoluB =  $dosyaAdi . "." . $dosyaUzanti;
						
						$image = new SimpleImagel();
						$image->load($path);
						$image->resize(100, 100);
						$image->save($tciktiYolu);
						
						
                        if (copy($path, $ciktiYolu)) {
							
                            if ($imageResize != false && is_array($imageResize)) {
$resize = ResimIslemleri::imageResize($ciktiYolu,$dosyaAdi,$imageResize);
//$tresize = ResimIslemleri::imageResize($tciktiYolu,$dosyaAdi,$imageResize,1);

                                if ($resize[0] == true) {
                                    return array(true, $ciktiYolu);
                                } else {
                                    return array(false, 6); // resize hatası
                                }
                            } else {
                                return array(true, $ciktiYoluB); // dosya tek kopya halinde yüklendi
                            }
                        } else {
                            return array(false,7); // copy fonksiyonu hatası
                        }
                    }
                } else {
                    return array(false,8); // "İzin verilmeyen dosya türü
                }
            }
        }
    }

    /**
     * @param $dosyaYolu
     * @param $ciktiIsım
     * @param $istenenGenislikler
     * @return mixed
     */
    public static function imageResize($dosyaYolu, $ciktiIsim, $istenenGenislikler)
    {
			list ($genislik, $yukseklik) = getimagesize($dosyaYolu);
			
        //list ($genislik, $yukseklik) = getimagesize($dosyaYolu);
        $oran = $yukseklik / $genislik;
        if ($oran > 3 & $oran < 1 / 3) {
            return array(false,2);
        } else {
            $obj = new static();
            $SimpleImage = $obj->SimpleImage;
            $dosyaTipi = pathinfo($dosyaYolu);
            $dosyaTipi = $dosyaTipi['extension'];
            for ($i = 0; $i < count($istenenGenislikler); $i++) {
                $SimpleImage->load($dosyaYolu);
				$SimpleImage->resizeToWidth($istenenGenislikler[$i]);
				$SimpleImage->save($ciktiIsim . "_" . $istenenGenislikler[$i] . ".$dosyaTipi");
				
            }
            return array(true,$dosyaYolu);
        }
    }
	

}


/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/blog/resizing-images-with-php/
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/

class SimpleImagel {

   var $image;
   var $image_type;

   function load($filename) {

      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {

         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {

         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {

         $this->image = imagecreatefrompng($filename);
      }
   }
   function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {

      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {

         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {

         imagepng($this->image,$filename);
      }
      if( $permissions != null) {

         chmod($filename,$permissions);
      }
   }
   function output($image_type=IMAGETYPE_JPEG) {

      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {

         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {

         imagepng($this->image);
      }
   }
   function getWidth() {

      return imagesx($this->image);
   }
   function getHeight() {

      return imagesy($this->image);
   }
   function resizeToHeight($height) {

      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }

   function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }

   function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }

   function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }      

}
?>