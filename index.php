<?php
require_once "lib/siniflar.php";

if (empty($_GET["link"]) or !isset($_GET["link"])) {
    // Anasayfa için gerekli işlemler.
    $view = new Twiggy(0);

    $data = array(
        "title" => "Anasayfa",
        "mesaj" => "Deneme mesajı. Index anasayfa"
    );

    // Templ: templates/index.html.twig.
    $view->render("index.html.twig", $data);
}

elseif ($_GET["link"] == "iletisim")
{
    include "inc/iletisim.php";
}
elseif ($_GET["link"] == "hakkimizda") {
    include "inc/hakkimizda.php";
}
elseif ($_GET["link"] == "kayit") {
    include "inc/kayit.php";
}
elseif ($_GET["link"] == "giris") {
    include "inc/giris.php";
}
elseif ($_GET["link"] == "404") {
    include "inc/404.php";
}
elseif ($_GET["link"] == "sifirla") {
    include "inc/sifirla.php";
}
else {
    include "inc/404.php";
}

?>