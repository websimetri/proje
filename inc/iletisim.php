<?php
$data = array(
    "title" => "İletişim Sayfası",
    "mesaj" => "İletişim sayfası mesaj."
);

// index.php üzerinden çağırıldığı için depth=0
$view = new Twiggy(0);
$view->render("inc/iletisim.html.twig", $data);
?>