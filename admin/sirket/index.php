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
     * -----------------------------------------------------------------*/
    if ($link == "ayarlar") {
        $data["title"] = "Kullanıcı Ayarları";
        $data["mesaj"] = "Kullanıcı ayarları sayfası.";
        $data["GET"] = $_GET;


        /** --------------------------------------------------------------
         * Şirket Admin: Ayarlar / Kullanıcı Düzenleme.
         *
         * URL: ?link=ayarlar&islem=kul_duzenle
         * -------------------------------------------------------------*/
        if (isset($_GET["islem"]) and $_GET["islem"] == "kul_duzenle") {
            $data["islem"] = "kul_duzenle";
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/ayarlar.html.twig", $data);
        }

         /** --------------------------------------------------------------
         * Şirket Admin: Ayarlar / Şifre Değiştirme
         *
         * URL: ?link=ayarlar&islem=kul_sifre
         * ---------------------------------------------------------------*/
        elseif (isset($_GET["islem"]) and $_GET["islem"] == "kul_sifre") {
            $data["islem"] = "kul_sifre";
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/ayarlar.html.twig", $data);
        } else {
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/ayarlar.html.twig", $data);
        }

    }

    // Şirket Admin: Reklamlar.
    elseif ($link == "reklam") {

        /** --------------------------------------------------------------
         * Şirket Admin: Ana Reklamlar sayfası. Reklam listelemesi yapar.
         *
         * URL: ?link=reklam
         * ---------------------------------------------------------------*/
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
         * --------------------------------------------------------------*/
        elseif ($_GET["islem"] == "ekle") {
            $data["title"] = "Reklam Ekleme Sayfası";

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/reklamEkle.html.twig", $data);
        }

         /** --------------------------------------------------------------
         * Şirket Admin: Reklam Düzenle
         *
         * URL: ?link=reklam&islem=duzenle&id={reklam_id}
         * --------------------------------------------------------------*/
        elseif ($_GET["islem"] == "duzenle" and isset($_GET["id"])) {

            $data["title"] = "Reklam Yönetimi";
            $data["reklamlar"] = v_sirketAdminReklamAna($sirket_id, $admin_id);
            $data["duzenle"] = true;
            $data["duzenleId"] = $_GET["id"];

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/reklam.html.twig", $data);
        }

    }

     /** ------------------------------------------------------------------
     * Şirket Admin: Müşteri Yönetimi
     *
     * URL: ?link=musteriler
     * -------------------------------------------------------------------*/
    elseif ($link == "musteriler") {

        if (isset($_GET["kulid"]) && isset($_GET["islem"])) {
            sirketMusterilerIslem($_GET["kulid"], $_GET["islem"]);
        }
        $data["title"] = "Müşteri Yönetimi";
        $data["musteriler"] = sirketMusterilerGetir();
        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/musteriler.html.twig", $data);
    }

     /** ------------------------------------------------------------------
     * Şirket Admin: İçerik Yönetim Ana Sayfa
     *
     * URL: ?link=icerik
     * -------------------------------------------------------------------*/
    elseif ($link == "icerik") {
        $data["title"] = "İçerik Yönetim Sayfası";

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/icerik.html.twig", $data);
    }

    /** ------------------------------------------------------------------
     * Şirket Admin: İçerik Yönetim Ana Sayfa
     *
     * URL: ?link=icerik
     * -------------------------------------------------------------------*/
    elseif ($link == "galeri") {
        $data["title"] = "Galeri Yönetim Sayfası.";

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/galeri.html.twig", $data);
    }


    /** ------------------------------------------------------------------
     * Şirket Admin: Duyurular.
     *
     * URL: ?link=duyurular
     * -------------------------------------------------------------------*/
    elseif ($link == "duyurular") {

        $data["GET"] = $_GET;



        if (isset($_GET["id"]) and !empty($_GET["id"])) {
            $data["title"] = "Duyurular";

            $data["duyuru"] = Bulut::getirDuyuru($_GET["id"], $admin_id);

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/duyuru.html.twig", $data);
        }
        else {
            $data["title"] = "Duyurular";

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/duyurular.html.twig", $data);
        }
    }

    else {
        $data["title"] = "404";
        $data["mesaj"] = "Aradığınız sayfaya ulaşılamadı.";

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/404.html.twig", $data);
    }

} else {
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

