<?php

// index.php üzerinden çağırıldığı için depth=0
$view = new Twiggy(0);
if (isset($_GET["key"]) and !empty($_GET["key"])) {
    $data = array(
        "title" => "Key'li sıfırlama sayfası",
        "mesaj" => "Key'li sifirlama sayfası falan."
    );
    $view->render("inc/sifirlaKey.html.twig", $data);
}
else {
    $data = array(
        "title" => "Şifre Sıfırlama",
        "mesaj" => "Şifre sıfırlama sayfası."
    );
    $view->render("inc/sifirla.html.twig", $data);
}

?>
