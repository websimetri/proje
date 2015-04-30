<?php
require_once '../../config.php';
if(isset($_POST["haber_id"]) && !empty($_POST["haber_id"])){
    $sorgu = $DB->prepare("DELETE from haberler where id=?");
    $sonuc = $sorgu->execute(array($_POST["haber_id"]));
    if($sonuc){
        echo "<script>window.location.href='../index.php?link=haberler'</script>";
    }else{
        echo "<script>window.location.href='../index.php?link=haberler'</script>";
    }
}
?>