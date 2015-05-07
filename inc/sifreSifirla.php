<?php
require_once "../config.php";
require_once ("../lib/siniflar.php");

$mail = new BulutMail($DB);

if (isset($_POST["fMail"]) and !empty($_POST["fMail"])) {

    $yolla = $mail->sifreUnuttum($_POST["fMail"]);

    if ($yolla) {
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
window.location.href = '../index.php?link=sifirla&sonuc=$mesaj';
</script>
";



?>