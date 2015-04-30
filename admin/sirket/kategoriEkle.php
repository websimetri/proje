<?php
require_once '../../config.php';

$kategori = $_POST["kategori"];
$sirket_id = $_POST["sid"];

if(isset($_POST["sid"])) {
    var_dump($sirket_id);
    $query = $DB->prepare("INSERT INTO haber_kategori VALUES (null,:sirket_id,:adi)");
    $query->bindParam(':sirket_id', $sirket_id);
    $query->bindParam(':adi', $kategori);
    $query->execute();
    if($query->rowCount() > 0) {
        echo "<script>window.location.href = '../index.php?link=haberler'</script>";
    }
}
?>