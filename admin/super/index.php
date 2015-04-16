<?php
require_once "../lib/fonksiyonlar.php";

$view = new Twiggy(1);

if (isset($_GET["link"]) and !empty($_GET["link"])) {
    $link = $_GET["link"];

    // Admin > Şirketler
    // admin/index.php?link=sirketler
    if ($link == "sirketler") {
        $data = array(
            "title" => "Süper Admin | Şirketler"
        );
        $data["sirketler"] = superAdminGetirSirketler();
//        echo "<pre>";
//        var_dump($data);
//        echo "</pre>";
        $view->render("admin/super/inc/sirketler.html.twig", $data);
    }

    // Admin > Şirket
    // admin/index.php?link=sirket&id=1
    elseif($link == "sirket" and isset($_GET["id"]) and !empty($_GET["id"])){
        $data = array();
        $data["sirket"] = superAdminGetirSirket($_GET["id"]);
        $data["title"] = "Süper Admin | ".$data["sirket"]["adi"];
        $view->render("admin/super/inc/sirket.html.twig", $data);
    }


}
else {
    // ?link boş ise veya gelmemişse direkt ana super/index
    // çağırılıyor.
    $data = array(
        "title" => "Süper Admin Paneli",
        "mesaj" => "Süper admin sayfası mesaj."
    );
    $view->render("admin/super/index.html.twig", $data);
}



?>
