<?php
require_once "../../../lib/class.bulut.php";

// İşlemler.
if (isset($_POST["gonder"]) and !empty($_POST["fKonu"]) and
    !empty($_POST["fMesaj"])) {

    if ($_POST["fKime"] == "kul") {
        $islem = Bulut::duyuruYolla($_POST["fKonu"], $_POST["fMesaj"], true);
        if ($islem) {
            $mesaj = "basarili";
        }
        else {
            $mesaj = "basarisiz";
        }
    }

    elseif ($_POST["fKime"] == "sir") {
        $islem = Bulut::duyuruYolla($_POST["fKonu"], $_POST["fMesaj"], false);
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
    </script>
    ";

}

else {
    echo "
    <script>
    window.location.href = '../../index.php?link=duyurular&sonuc=basarisiz';
    </script>
    ";
}


?>