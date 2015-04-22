<?php
$data = array(
    "title" => "Çalışan Admin",
    "mesaj" => "Şirket çalian işleri."
);

// index.php üzerinden çağırıldığı için depth=0
$view = new Twiggy(1);
$view->render("admin/calisan/index.html.twig", $data);
?>
