<?php
$data = array(
    "title" => "İletişim Sayfası",
);


// index.php üzerinden çağırıldığı için depth=0
$view = new Twiggy(0);
$view->render("inc/iletisim.html.twig", $data);
?>