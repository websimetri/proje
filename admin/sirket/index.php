<?php
require_once "../lib/fonksiyonlar.php";

if (isset($_GET["link"]) and !empty($_GET["link"])) {
    $link = $_GET["link"];

    // Admin > Ayarlar
    // admin/index.php?link=ayarlar
    if ($link == "ayarlar"){
        $data = array(
            "title" => "Kullanıcı Ayarları",
            "mesaj" => "Kullanıcı ayarları sayfası."
        );

        $sirket_id = $_SESSION["sirketId"];
        $admin_id = $_SESSION["kulId"];
        $temp = sirketAdminAyarlarAna($sirket_id, $admin_id);
        $data["sirket"] = $temp["sirket"];
        $data["admin"] = $temp["admin"];

        // index.php üzerinden çağırıldığı için depth=1
        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/ayarlar.html.twig", $data);
    }
    elseif ($link == "reklam") {

        if (!isset($_GET["islem"]) or empty($_GET["islem"])) {
            $data = array();

            $data = sirketAdminReklamAna($_SESSION["sirketId"], $_SESSION["kulId"]);
            $data["title"] = "Reklam Yönetimi";

//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/reklam.html.twig", $data);
        }

        // link=reklam
        // islem=ekle
        elseif ($_GET["islem"] == "ekle")
        {
            $data = array(
                "title" => "Reklam Ekleme Sayfası"
            );

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/reklamEkle.html.twig", $data);
        }
        elseif ($_GET["islem"] == "duzenle" and isset($_GET["id"])){
            $data = array();

            $data = sirketAdminReklamAna($_SESSION["sirketId"], $_SESSION["kulId"]);
            $data["title"] = "Reklam Yönetimi";
            $data["duzenle"] = true;
            $data["duzenleId"] = $_GET["id"];
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/reklam.html.twig", $data);
        }


    }

}

else {
    // link boş ise veya hiç gelmemişse.
    $data = array(
        "title" => "Şirket Admin",
        "mesaj" => "Şirket admin işleri."
    );


    $sirket_id = $_SESSION["sirketId"];
    $admin_id = $_SESSION["kulId"];
    $temp = sirketAdminAyarlarAna($sirket_id, $admin_id);
    $data["sirket"] = $temp["sirket"];
    $data["admin"] = $temp["admin"];

    // admin/index.php üzerinden çağırıldığı için depth=1
    $view = new Twiggy(1);
    $view->render("admin/sirket/index.html.twig", $data);
}



?>

