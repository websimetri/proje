<?php
$data = array(
    "title" => "İletişim Sayfası",
    "mesaj" => "İletişim sayfası mesaj.",

);

$isim = array("serkan", "tekin", "yasin");
$data["isimler"] = $isim;

// index.php üzerinden çağırıldığı için depth=0
$view = new Twiggy(0);
$view->render("inc/iletisim.html.twig", $data);
?>