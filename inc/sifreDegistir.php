<?php
require_once ("../lib/siniflar.php");

if (isset($_POST["fSifre"]) and isset($_POST["fSifreTekrar"]) and
    !empty($_POST["fSifre"]) and !empty($_POST["fSifreTekrar"]) and
    isset($_POST["token"]) and !empty($_POST["token"])) {

    if ($_POST["fSifre"] == $_POST["fSifreTekrar"]) {
        $sifre = $_POST["fSifre"];
        $key = $_POST["token"];

        $islem = Bulut::keyIleSifreDegistir($key, $sifre);

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

}
else {
    $mesaj = "basarisiz";
}

echo "
<script>
window.location.href = '../index.php?link=giris&sonuc=$mesaj';
</script>
";


?>