<?php
require_once '../../config.php';
require_once "../../../lib/siniflar.php";
session_start();

if (isset($_POST["sirket_id"]) &&
      isset($_POST["mesaj"]) )


$sirket_id = $_POST["sirket_id"];
$mesaj = $_POST["mesaj"];
$gonderen_id = $_GET["{{ musteri.id }}"];
$alan_id ="1";
$durum = "0";


if(isset($_POST["gonder"])) {

        $sonuc = Mesaj::Ozel_Mesaj($sirket_id,$gonderen_id,$alan_id,$durum,$mesaj);
        var_dump($sonuc);
}
/*
echo "
<script>
window.location.href = '../index.php?link=mesajlar&islem=ozel&sonuc=$islem';
</script>
";
*/

?>

