<?php
require_once "../lib/fonksiyonlar.php";
require_once "../lib/twigFonksiyonlari.php";


if (isset($_GET["link"]) and !empty($_GET["link"])) {
    $link = $_GET["link"];

    // Bütün ŞirketAdmin görüntülerinde ortak olan veriler.
    //      - admin ve şirket bilgileri.
    $sirket_id = $_SESSION["sirketId"];
    $admin_id = $_SESSION["kulId"];
    $data = sirketAdminAnaVeriler($sirket_id, $admin_id);

    /**
     * Şirket Admin: Ayarlar
     *
     * URL: ?link=ayarlar
     */
    if ($link == "ayarlar"){
        $data["title"] = "Kullanıcı Ayarları";
        $data["mesaj"] = "Kullanıcı ayarları sayfası.";

//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/ayarlar.html.twig", $data);
    }

    /**
     * Şirket Admin: Reklamlar.
     */
    elseif ($link == "reklam") {

        /**
         * Şirket Admin: Ana Reklamlar sayfası. Reklam listelemesi yapar.
         *
         * URL: ?link=reklam
         */
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

        // LINK = "REKLAM"
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

    elseif ($link = "icerik") {
        $data = array(
            "title" => "İçerik Yönetimi"
        );

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/icerik.html.twig", $data);
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

