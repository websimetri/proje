<?php
session_start();
include '../../../lib/siniflar.php';

// Kullanıcı atama.
if (isset($_SESSION["kulId"]) and
    isset($_POST["kulId"]) and !empty($_POST["kulId"]) and
    isset($_POST["ata"])) {

    // Admin olarak atanacak kullanıcı id'si.
    $kul_id = $_POST["kulId"];

    $islem = Bulut::kulAdminAta($kul_id);

    if ($islem) {
        $mesaj = "basarili";
    }
    else {
        $mesaj = "basarisiz";
    }
}
else {
    $mesaj = "basarisiz";
}

echo "
<script>
window.location.href = '../../index.php?link=ayarlar&&islem=yetkili&sonuc=$mesaj';
</script>";


?>