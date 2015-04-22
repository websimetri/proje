<?php
$data = array(
    "title" => "404",
    "mesaj" => "404 Hatası"
);

// index.php üzerinden çağırıldığı için depth=0
$view = new Twiggy(0);
$view->render("inc/404.html.twig", $data);
?>
