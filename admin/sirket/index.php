<?php
require_once "../lib/fonksiyonlar.php";
require_once "../lib/twigFonksiyonlari.php";


if (isset($_GET["link"]) and !empty($_GET["link"])) {
    $link = $_GET["link"];

    // Bütün ŞirketAdmin görüntülerinde ortak olan veriler.
    //  - admin ve şirket bilgileri.
    $sirket_id = $_SESSION["sirketId"];
    $admin_id = $_SESSION["kulId"];
    $data = v_sirketAdminAnaVeriler($sirket_id, $admin_id);


    /** ------------------------------------------------------------------
     * Şirket Admin: Ayarlar
     *
     * URL: ?link=ayarlar
     -------------------------------------------------------------------*/
    if ($link == "ayarlar"){
        $data["title"] = "Kullanıcı Ayarları";
        $data["mesaj"] = "Kullanıcı ayarları sayfası.";

//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/ayarlar.html.twig", $data);
    }


    // Şirket Admin: Reklamlar.
    elseif ($link == "reklam") {

        /** --------------------------------------------------------------
         * Şirket Admin: Ana Reklamlar sayfası. Reklam listelemesi yapar.
         *
         * URL: ?link=reklam
         ---------------------------------------------------------------*/
        if (!isset($_GET["islem"]) or empty($_GET["islem"])) {
//            $data = array();

            // $data daha önce tanımlanmış durumda.
            $data["title"] = "Reklam Yönetimi";
            $data["reklamlar"] = v_sirketAdminReklamAna($sirket_id, $admin_id);

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/reklam.html.twig", $data);
        }

        /** --------------------------------------------------------------
         * Şirket Admin: Reklam Ekle
         *
         * URL: ?link=reklam&islem=ekle
         ---------------------------------------------------------------*/
        elseif ($_GET["islem"] == "ekle")
        {
            $data["title"] = "Reklam Ekleme Sayfası";

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/reklamEkle.html.twig", $data);
        }

        /** --------------------------------------------------------------
         * Şirket Admin: Reklam Düzenle
         *
         * URL: ?link=reklam&islem=duzenle&id={reklam_id}
         ---------------------------------------------------------------*/
        elseif ($_GET["islem"] == "duzenle" and isset($_GET["id"])){

            $data["title"] = "Reklam Yönetimi";
            $data["reklamlar"] = v_sirketAdminReklamAna($sirket_id, $admin_id);
            $data["duzenle"] = true;
            $data["duzenleId"] = $_GET["id"];

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/reklam.html.twig", $data);
        }


    }

    /** ------------------------------------------------------------------
     * Şirket Admin: İçerik Yönetim Ana Sayfa
     *
     * URL: ?link=icerik
     -------------------------------------------------------------------*/
    elseif ($link = "icerik") {
        $data["title"] = "İçerik Yönetim Sayfası";

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

    // Bütün ŞirketAdmin görüntülerinde ortak olan veriler.
    //  - admin ve şirket bilgileri.
    $sirket_id = $_SESSION["sirketId"];
    $admin_id = $_SESSION["kulId"];
    $data = v_sirketAdminAnaVeriler($sirket_id, $admin_id);

    $data["title"] = "Şirket Admin";
    $data["mesaj"] = "Şirket Admin İşleri.";

    // admin/index.php üzerinden çağırıldığı için depth=1
    $view = new Twiggy(1);
    $view->render("admin/sirket/index.html.twig", $data);
}



?>

