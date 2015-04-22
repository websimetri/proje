<?php
// TODO: KONTROL lazım.

require_once "../../../lib/fonksiyonlar.php";
$kul_id = idDecode($_POST["kulId"]);

if (isset($_POST["sil"])) {
    $islem = Bulut::duyuruSil($_POST["duyId"], $kul_id);
    if ($islem) {
        $mesaj = "basarili";
    }
    else {
        $mesaj = "basarisiz";
    }
}

elseif (isset($_POST["oku"])) {
    $islem = Bulut::duyuruOku($_POST["duyId"], $kul_id);
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
window.location.href = '../../index.php?link=duyurular&sonuc=$mesaj';
</script>";

?>