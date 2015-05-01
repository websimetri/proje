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


    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: Ayarlar
     *
     * URL: ?link=ayarlar
     * ---------------------------------------------------------------------------------------------------------------*/
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
        }

        /** ----------------------------------------------------------------
         *  Şirket Admin: Ayarlar / Yeni yetkili atama.
         -----------------------------------------------------------------*/
        elseif (isset($_GET["islem"]) and $_GET["islem"] == "yetkili") {
            $data["GET"] = $_GET;
            $data["title"] = "Yeni Yetkili Atama";
            $data["calisanlar"] = Bulut::getirSirketCalisanlar($sirket_id);

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/yetkili.html.twig", $data);
        }

        else {
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/ayarlar.html.twig", $data);
        }

    }

    /** ----------------------------------------------------------------------------------------------------------------
     * REKLAMLAR
     -----------------------------------------------------------------------------------------------------------------*/
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
            $data["GET"] = $_GET;

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
            $data["GET"] = $_GET;

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

    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: Müşteri Yönetimi
     *
     * URL: ?link=musteriler
     * ---------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "musteriler") {

        if (isset($_GET["kulid"]) && isset($_GET["islem"])) {
            sirketMusterilerIslem($_GET["kulid"], $_GET["islem"]);
        }
        $data["title"] = "Müşteri Yönetimi";
        $data["musteriler"] = sirketMusterilerGetir();
        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/musteriler.html.twig", $data);
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: İçerik Yönetim Ana Sayfa
     *
     * URL: ?link=icerik
     * ---------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "icerik") {
        $data["title"] = "İçerik Yönetim Sayfası";

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/icerik.html.twig", $data);
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: Galeri Yönetim Ana Sayfa
     *
     * URL: ?link=galeri
     * ---------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "galeri") {
        $view = new Twiggy(1);
        if (isset($_GET["albumId"])) {
            if (isset($_GET["resimId"])) {
                $data["resim"] = galeriTekilResimGetir($_GET["resimId"]);
                if ($data["resim"] == false) {
                    $data["mesaj"] = "Böyle bir resim bulunmamaktadır";
                    $view->render("admin/sirket/inc/404.html.twig", $data);
                } else {
                    $view->render("admin/sirket/inc/galeriResimDetay.html.twig", $data);
                }
            } else {
                $albumId = $_GET["albumId"];
                $data["title"] = "Albüm Yönetim Sayfası";
                $data["resimler"] = galeriResimGetir($albumId);
                if ($data["resimler"] == false) {
                    $data["mesaj"] = "Böyle bir albüm bulunmamaktadır";
                    $view->render("admin/sirket/inc/404.html.twig", $data);
                } else {
                    $view->render("admin/sirket/inc/galeriDetay.html.twig", $data);
                }
            }
        } else {
            $data["title"] = "Galeri Yönetim Sayfası.";
            $data["galeriler"] = galeriGetir();
            if ($data["galeriler"] == false) {
                $data["mesaj"] = "Böyle bir galeri bulunmamaktadır";
                $view->render("admin/sirket/inc/404.html.twig", $data);
            } else {
                $view->render("admin/sirket/inc/galeri.html.twig", $data);
            }
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: Duyurular.
     *
     * URL: ?link=duyurular
     * ---------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "duyurular") {

        $data["GET"] = $_GET;

        if (isset($_GET["id"]) and !empty($_GET["id"])) {
            $data["title"] = "Duyurular";

            $data["duyuru"] = Bulut::getirDuyuru($_GET["id"], $admin_id);

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/duyuru.html.twig", $data);
        } else {
            $data["title"] = "Duyurular";

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/duyurular.html.twig", $data);
        }
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: Ürün Yönetimi Ana Sayfa
     *
     * URL: ?link=urunler
     * ---------------------------------------------------------------------------------------------------------------*/

    elseif ($link == "urunler") {
        $data["title"] = "Ürün Yönetimi";
        $data["kategoriler"] = Kategori_Select(Bulut::getCategory(0, $sirket_id));

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/urunler.html.twig", $data);
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: Formlar ve Form Yönetimi.
     *
     * URL: ?link=formlar
     * ---------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "formlar") {
        $data["title"] = "Form Yönetimi";
        $data["GET"] = $_GET;
        $data["formlar"] = Bulut::formGetir($sirket_id);

        $view = new Twiggy(1);

        if (isset($_GET["islem"]) and $_GET["islem"] == "ekle") {
            $view->render("admin/sirket/inc/formEkle.html.twig", $data);
        } elseif (isset($_GET["islem"]) and $_GET["islem"] = "jgoruntule" and
            isset($_GET["id"]) and !empty($_GET["id"])
        ) {

            $data["form"] = Bulut::formGetir($sirket_id, $_GET["id"]);
            $view->render("admin/sirket/inc/formGoruntule.html.twig", $data);
        } else {
            $view->render("admin/sirket/inc/formlar.html.twig", $data);
        }

    }

    /** ----------------------------------------------------------------------------------------------------------------
     * HABERLER
    -----------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "haberler") {
        $view = new Twiggy(1);

        $data["title"] = "Haberler Yönetim Sayfası";
        $data["GET"] = $_GET;

        // Kategoriler.
        $data["kategoriler"] = kategoriGetir($sirket_id);

        // Haberlerin getirilmesi.
        if (isset($_GET["durum"]) or isset($_GET["kategori_id"])) {

            $durum = (isset($_GET["durum"]) and $_GET["durum"] != 0)? $_GET["durum"]: false;
            $kategori_id = (isset($_GET["kategori_id"]) and $_GET["kategori_id"] != 0)? $_GET["kategori_id"]: false;

            // Aktif, Pasif | Kategori...
            $data["haberler"] = v_sirketAdminHaberAna($sirket_id, $kategori_id, $durum);
            echo "....";
        }
        else {
            // Bütün Haberler.
            $data["haberler"] = v_sirketAdminHaberAna($sirket_id);
        }



        /** --------------------------------------------------------------
         * İŞLEM
         ---------------------------------------------------------------*/
        if (isset($_GET["islem"])) {

            /** ----------------------------------------------------------
             * ?link=haberler&islem=duzenle&id={sayi}
             -----------------------------------------------------------*/
            if ($_GET["islem"] == "duzenle" and isset($_GET["id"])) {
                $data["title"] = "Haber Düzenleme İşlemi";
                $view->render("admin/sirket/inc/haberler.html.twig", $data);
            }

            /** ----------------------------------------------------------
             * ?link=haberler&islem=ekle
            -----------------------------------------------------------*/
            elseif ($_GET["islem"] == "ekle") {
                $data["title"] = "Haber Ekleme";

                $view->render("admin/sirket/inc/haberEkle.html.twig", $data);
            }

            /** ----------------------------------------------------------
             * ?link=haberler&islem=kategori_ekle
            -----------------------------------------------------------*/
            elseif ($_GET["islem"] == "kategori_ekle") {
                $data["title"] = "Kategori Ekleme";

                $view->render("admin/sirket/inc/kategoriEkle.html.twig", $data);
            }
        }
        else {

            $view->render("admin/sirket/inc/haberler.html.twig", $data);

        }



    }

    /** ----------------------------------------------------------------------------------------------------------------
     * ÜRÜN BEĞENİ YÖNETİMİ
    -----------------------------------------------------------------------------------------------------------------*/
    elseif ($link = "begeni") {
        $data["title"] = "Ürün Beğeni Yönetimi";
        $data["begeniler"] = Bulut::getirBegeniler($sirket_id);
        $data["urun_begeniler"] = Bulut::getirUrunBegeniler($sirket_id);

//        var_dump(Bulut::urunBegen(1, 1, 7, 5));

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/begeni.html.twig", $data);
    }

    /** ----------------------------------------------------------------------------------------------------------------
     * 404
     -----------------------------------------------------------------------------------------------------------------*/
    else {
        $data["title"] = "404";
        $data["mesaj"] = "Aradığınız sayfaya ulaşılamadı.";

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/404.html.twig", $data);
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