<?php

session_start();
require_once '../../../config.php';
require_once "../../../lib/siniflar.php";

$mesaj = $_POST["mesaj"];
$gonderen_id = $_SESSION["kulId"];
$konu = $_POST["konu"];





if(isset($_POST["gonder"]) && !empty($_POST["mesaj"]) && !empty($_POST["konu"]) && isset($_SESSION["kulId"])) {

    $sonuc = Mesaj::Forum_Mesaj($gonderen_id,$konu,$mesaj);





echo "
   <script>
    window.location.href = '../../index.php?link=mesajlar&islem=forum';
    </script>";

}
?>