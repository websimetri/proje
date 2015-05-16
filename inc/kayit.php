<?php
$data = array(
    "title" => "Kayıt Sayfası",
    "mesaj" => "Kayıt sayfası mesaj."
);

$data["sektorler"] = Bulut::getirSektorler();
$data["GET"] = $_GET;

// index.php üzerinden çağırıldığı için depth=0
$view = new Twiggy(0);
$view->render("inc/kayit.html.twig", $data);
?>
