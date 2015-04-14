<?php
$data = array(
    "title" => "Şirket Admin",
    "mesaj" => "Şirket admin işleri."
);

// index.php üzerinden çağırıldığı için depth=0
$view = new Twiggy(1);
$view->render("admin/sirket/index.html.twig", $data);
?>

