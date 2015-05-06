<?php
require_once '../../config.php';

if(isset($_POST["kategoriId"]) && !empty($_POST["kategoriId"])){

    $id= $_POST["kategoriId"];
    if($id != 0) {
        $sorgu = $DB->prepare("DELETE from kategoriler where id=? or id_ust_kategori=?");
        $sonuc = $sorgu->execute(array($id,$id));
    }
    else{
        echo "<script>window.location.href='../index.php?link=kategoriler&sonuc=basarisiz'</script>";
    }
    if($sonuc){
        echo "<script>window.location.href='../index.php?link=kategoriler&sonuc=basarili'</script>";
    }

    else{
        echo "<script>window.location.href='../index.php?link=kategoriler&sonuc=basarisiz'</script>";
    }
}
else {
    echo "<script>window.location.href='../index.php?link=kategoriler&sonuc=basarisiz'</script>";
}
?>