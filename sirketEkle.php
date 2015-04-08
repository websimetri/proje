<?php

include "config.php";
include "siniflar.php";
if(isset($_POST["adi"]) && isset($_POST["adres"]) && isset($_POST["tel"])  && isset($_POST["gonder"])){
    $adi=$_POST["adi"];
    $adres=$_POST["adres"];
    $tel=$_POST["tel"];
    $ekle_isim = date("YmdHis");
    $sektor=$_POST["id_sektor"];
    $premium=0;
    $katar = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $katar = str_split($katar);
    $katar_uzunluk = count($katar) - 1;
    $key="";
    for ($sinir = 0; $sinir < 5; $sinir ++) {
        $rand = rand(0, $katar_uzunluk);
        $key .= $katar[$rand];
    }
    $ref=md5($adi.$key.$ekle_isim);
    echo $ref."<br>";
    $logo=$ekle_isim."_".$_FILES["logo"]["name"];
    $date=date("Y.m.d H:i:s");
    //if(copy($_FILES["logo"]["tmp_name"], "files/".$logo)){

    //}
   // else{
   // $logo="";
    //}

    $sonuc = Bulut::sirketEkle($adi,$adres,$tel,"",$sektor,$premium,$ref,$date);
    if($sonuc){
        echo "Başarılı";
    }
    else{
        echo "olmadı laaa";
    }
}


?>


 <!DOCTYPE html>
 <html>
 <head>
        <title>Kayıt Ol.</title>
 </head>
 <body>

 <form method="post" action="" enctype="multipart/form-data">
    <br>
    Sektör :<select name="id_sektor" style="width: 100px">
         <br>
        <option>1</option>
        <option>Otomotiv</option>
        <option>Sağlık</option>
    </select>
     <br>
    <input type="text" name="adi" Placeholder="Şirket Adınız..."><br><br>
    <textarea name="adres" placeholder="Şirket Adresi." style="width:167px"></textarea><br><br>
    <input type="text" name="tel" Placeholder="Şirket GSM..."><br><br>
    <input type="file" name="logo"><br><br>
     <hr>
    <input type="submit" value="Kayıt" name="gonder">
    <input type="reset"/>
</form>

 </body>
 </html>