<?php
$data = array(
    "title" => "İletişim Sayfası",
    "mesaj" => "Form sayfası mesaj.",

);

if (isset($_POST["isim"])) {
    $data["form"] = $_POST["isim"];
}

// index.php üzerinden çağırıldığı için depth=0
$view = new Twiggy(0);
$view->render("inc/form.html.twig", $data);
?>

