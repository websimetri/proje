<?php
$data = array(
    "title" => "Ailemiz",
);

$view = new Twiggy(0);
$view->render("inc/ailemiz.html.twig", $data);
?>
