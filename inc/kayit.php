<?php
$data = array(
    "title" => "Kayıt Sayfası",
    "mesaj" => "Kayıt sayfası mesaj."
);

// index.php üzerinden çağırıldığı için depth=0
$view = new Twiggy(0);
$view->render("inc/kayit.html.twig", $data);
?>
