<?php
$data = array(
    "title" => "Galeri",
);
$view = new Twiggy(0);

if (isset($_GET["album"])) {
    if ($_GET["album"] == 1) {
        $view->render("inc/album01.html.twig", $data);
    }else{
        $data["mesaj"] = "galeri";
        $view->render("inc/404.html.twig", $data);
    }

}
else {
    $view->render("inc/galeri.html.twig", $data);
}
?>
