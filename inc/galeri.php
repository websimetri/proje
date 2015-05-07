<?php
$data = array(
    "title" => "Galeri",
);
$view = new Twiggy(0);

if (isset($_GET["album"])) {
    $view->render("inc/album01.html.twig", $data);
}
else {
    $view->render("inc/galeri.html.twig", $data);
}
?>
