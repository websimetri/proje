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

        /** ----------------------------------------------------------------
         *  Şirket Admin: Ayarlar / Yeni yetkili atama.
        -----------------------------------------------------------------*/
        elseif (isset($_GET["islem"]) and $_GET["islem"] == "calisan_ekle") {
            $data["GET"] = $_GET;
            $data["title"] = "Yeni Çalışan Ekleme";

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/calisanEkle.html.twig", $data);
        }

        else {
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/ayarlar.html.twig", $data);
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
        $data["musteriler"] = sirketMusterilerGetir($sirket_id);
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
        $data["icerikler"] = v_icerikAnaSayfa($sirket_id);
        $data["GET"] = $_GET;

        $view = new Twiggy(1);

        /** --------------------------------------------------------------
         * İÇERİK (Görüntüleme ve Düzeltme)
         * link = icerik,
         * id = {id}
         ---------------------------------------------------------------*/
        if (isset($_GET["id"])) {

            $data["icerik"] = Icerik::icerikGetir($_GET["id"], $sirket_id);

            /** ----------------------------------------------------------
             * İÇERİK EKLEME
             *
             * link=icerik
             * id = {id}
             * islem = duzenle
            ------------------------------------------------------------*/
            if (isset($_GET["islem"]) and $_GET["islem"] == "duzenle") {
                $data["title"] = "İçerik Düzenleme";

                // Düzenle işlemi için id'yi session'dan alsın.
                $_SESSION["icerikDuzenleId"] = $data["icerik"]["id"];

                $view->render("admin/sirket/inc/icerikDuzenle.html.twig", $data);
            }
            else {
                $data["title"] = "İçerik Önizleme";

                $view->render("admin/sirket/inc/icerik.html.twig", $data);
            }


        }

        /** --------------------------------------------------------------
         * İÇERİK EKLEME
         * link = icerik,
         * islem = ekle
        ---------------------------------------------------------------*/
        elseif (isset($_GET["islem"]) and $_GET["islem"] == "ekle") {
            $data["title"] = "İçerik Ekleme Sayafası";

            $view->render("admin/sirket/inc/icerikEkle.html.twig", $data);
        }

        else {
            $view->render("admin/sirket/inc/icerikler.html.twig", $data);
        }

    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: Galeri Yönetim Ana Sayfa
     *
     * URL: ?link=galeri
     * ---------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "galeri") {
        $view = new Twiggy(1);

        if (isset($_GET["islem"])) {
            if (isset($_GET["albumId"]) && $_GET["islem"] == "ekle") {
                if (isset($_POST["resim"]) and isset($_POST["alt"])) {
                $yeniResimId = galeriResimEkle($_GET["albumId"], "resim", $_POST["alt"]);
                } else {
                    echo "<script>alert('Resim yükleme işlemi başarısız! Lütfen yüklediğiniz dosyanın belirtilen tür ve aralıkta olduğundan emin olun..')</script>";
                    $url = "?link=galeri&albumId=" . $_GET["albumId"];
                    echo "<script>window.location.href='$url';</script>";
                }
                if ($yeniResimId != false) {
                    $url = "?link=galeri&albumId=" . $_GET["albumId"] . "&resimId=$yeniResimId";
                    echo "<script>window.location.href='$url';</script>";
                } else {
                    echo "<script>alert('Resim yükleme işlemi başarısız! Lütfen yüklediğiniz dosyanın belirtilen tür ve aralıkta olduğundan emin olun..')</script>";
                    $url = "?link=galeri&albumId=" . $_GET["albumId"];
                    echo "<script>window.location.href='$url';</script>";
                }
            } elseif ($_GET["islem"] == "galeriOlustur") {
                $yeniAlbumId = galeriEkle($_SESSION["sirketId"], $_POST["galeriAdi"], $_POST["galeriAciklama"]);
                if ($yeniAlbumId != false) {
                    $url = "?link=galeri&albumId=$yeniAlbumId";
                    echo "<script>window.location.href='$url';</script>";
                } else {
                    echo "<script>alert('Galeri oluşturma işlemi başarısız!')</script>";
                    $url = "?link=galeri";
                    echo "<script>window.location.href='$url';</script>";
                }
            } elseif ($_GET["islem"] == "sil" && isset($_GET["albumId"])) {
                if (isset($_GET["resimId"])) {
                    galeriResimSil($_GET["resimId"]);
                    $albumId = $_GET["albumId"];
                    echo "<script>window.location.href='?link=galeri&albumId=$albumId';</script>";
                } else {
                    galeriSil($_GET["albumId"]);
                    echo "<script>window.location.href='?link=galeri';</script>";
                }
            }

        } elseif (isset($_GET["albumId"])) {
            $data["AlbumAdi"] = galeriAdiGetir($_GET["albumId"]);
            if (isset($_GET["resimId"])) {

                if (isset($_POST["sil"])) {
                    if (galeriResimSil($_GET["resimId"])) {
                        $albumId = $_GET["albumId"];
                        echo "<script>window.location.href='?link=galeri&albumId=$albumId';</script>";
                    }
                } elseif (isset($_POST["kaydet"]) && isset($_GET["albumId"])) {
                    galeriResimDuzenle($_GET["albumId"], $_GET["resimId"], $_POST["alt"]);
                }
                $resim = galeriTekilResimGetir($_GET["resimId"], $_GET["albumId"]);
                $boyutluResim = resimBoyutunaGoreGetir($resim["url"], "400");
                if ($boyutluResim != false) {
                    $data["resim"] = galeriTekilResimGetir($_GET["resimId"], $_GET["albumId"]);
                    $data["resim"]["url"] = $boyutluResim;
                } else {
                    $data["resim"] = $resim;
                }
                if ($data["resim"] == false) {
                    $data["mesaj"] = "Böyle bir resim bulunmamaktadır";
                    $view->render("admin/sirket/inc/404.html.twig", $data);
                } else {
                    $data["albumler"] = galeriListele();
                    $data["galerininResimleri"] = galerininDigerResimleriListele($_GET["albumId"], $_GET["resimId"]);
                    $view->render("admin/sirket/inc/galeriResimDetay.html.twig", $data);
                }
            } else {
                $albumId = $_GET["albumId"];
                $data["title"] = "Albüm Yönetim Sayfası";
                $data["resimler"] = galeriResimGetir($albumId);
                $data["albumler"] = galeriListele();
                $data["albumId"] = $albumId;
                if ($data["resimler"] == false) {
                    $view->render("admin/sirket/inc/galeriResimBos.html.twig", $data);
                } else {
                    $view->render("admin/sirket/inc/galeriDetay.html.twig", $data);
                }
            }
        } else {
            $data["title"] = "Galeri Yönetim Sayfası.";
            $data["galeriler"] = galeriGetir();
            if ($data["galeriler"] == false) {
                $view->render("admin/sirket/inc/galeriBos.html.twig", $data);
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

    elseif($link == "urunler") {
        if(!isset($_GET["islem"]) or empty($_GET["islem"])) {
            $data["title"] = "Ürün Yönetimi";

            $data["urunler"] = Bulut::getProduct($sirket_id);

            $data["GET"] = $_GET;
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/urunler.html.twig", $data);
        }
        elseif ($_GET["islem"] == "ekle") {
            $data["title"] = "Ürün Ekleme Sayfası";
            $data["GET"] = $_GET;
            $data["kategoriler"] = Kategori_Select(Bulut::getCategory(0, $sirket_id));
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/urunEkle.html.twig", $data);
        }

        /** --------------------------------------------------------------
         * Şirket Admin: Ürün Düzenle
         *
         * URL: ?link=urunler&islem=duzenle&id={urun_id}
         * --------------------------------------------------------------*/
        elseif ($_GET["islem"] == "duzenle" and isset($_GET["id"])) {

            $data["title"] = "Ürün Yönetimi";
            //$data["urun"] = v_sirketAdminReklamAna($sirket_id, $admin_id);
            $data["GET"] = $_GET;
            $data["urun"] = Bulut::getProduct($sirket_id,$_GET["id"]);
            $data["kategoriler"] = Secili_Kategori_Listele(Bulut::getCategory(0, $sirket_id),$data["urun"]["id_category"]);
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/urunDuzenle.html.twig", $data);
        }
    }
    /** ------------------------------------------------------------------
     * Şirket Admin:Kategori Yönetimi Ana Sayfa
     *
     * URL: ?link=kategoriler
     * -------------------------------------------------------------------*/
    elseif($link == "kategoriler") {
        if(!isset($_GET["islem"]) or empty($_GET["islem"])) {
            $data["title"] = "Kategori Yönetimi";
            $data["kategoriler"] = Kategori_Listele(Bulut::getCategory(0, $sirket_id));
            $data["GET"] = $_GET;
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/urunKategori.html.twig", $data);
        }
        elseif($_GET["islem"] == "duzenle" and isset($_GET["id"])){
            $data["title"] = "Ürün Yönetimi";
            $data["kategoriler"] = Kategori_Listele(Bulut::getCategory(0, $sirket_id));
            $data["GET"] = $_GET;
            $data["kategori"]=Bulut::getCategoryNameWithId($_GET["id"]);
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/urunKategori.html.twig", $data);
        }


    }
    elseif($link == "urun") {
        if(isset($_GET["urunid"])) {
            $urunId=@$_GET["urunid"];
            $data["title"] = "Ürün Yönetimi";
            $data["kategoriler"] = Kategori_Select(Bulut::getCategory(0, $sirket_id));
            $data["GET"] = $_GET;
            $data["urun"] = Bulut::getProduct($urunId);
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/urun.html.twig", $data);
        }
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
    elseif ($link == "begeni") {
        $data["title"] = "Ürün Beğeni Yönetimi";
        $data["begeniler"] = Bulut::getirBegeniler($sirket_id);
        $data["urun_begeniler"] = Bulut::getirUrunBegeniler($sirket_id);

//        var_dump(Bulut::urunBegen(1, 1, 7, 5));

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/begeni.html.twig", $data);
    }


    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: Anket Yönetimi
     *
     * URL: ?link=anketler
     * ---------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "anketler") {
        $anketler = new Anket();

        $data["title"] = "Anket Yönetimi";
        $data["GET"] = $_GET;
        $data["anketler"] = $anketler->anketListele();

        $view = new Twiggy(1);

        /** --------------------------------------------------------------
         * ANKET EKLEME:
         * link=anketler,
         * islem=ekle
         ---------------------------------------------------------------*/
        if (isset($_GET["islem"]) and $_GET["islem"] == "ekle") {
            $view->render("admin/sirket/inc/anketEkle.html.twig", $data);
        }


        /** --------------------------------------------------------------
         * ANKET DUZENLE
         * link=anketler,
         * islem=duzenle
        ---------------------------------------------------------------*/
        elseif (isset($_GET["islem"]) and $_GET["islem"] == "duzenle" and
                isset($_GET["id"]) and !empty($_GET["id"])) {

            $data["anket"] = $anketler->anketGetir($_GET["id"], $sirket_id);
            $view->render("admin/sirket/inc/anketDuzenle.html.twig", $data);
        }

        /** --------------------------------------------------------------
         * SEÇENEK EKLE
         * link=anketler
         * islem=secenek_ekle
         * anket_id={id}
         ---------------------------------------------------------------*/
        elseif (isset($_GET["islem"]) and $_GET["islem"] == "secenek_ekle" and
                isset($_GET["anket_id"]) and !empty($_GET["anket_id"])) {
            $data["anket"] = $anketler->anketGetir($_GET["anket_id"], $sirket_id);
            $view->render("admin/sirket/inc/anketSecenek.html.twig", $data);
        }

        /** --------------------------------------------------------------
         * ANKET GÖRÜNTÜLE
         * link=anketler,
         * id={id}
        ---------------------------------------------------------------*/
        elseif (isset($_GET["id"]) and !empty($_GET["id"])) {
            $data["anket"] = $anketler->anketGetir($_GET["id"], $sirket_id);

            $view->render("admin/sirket/inc/anketGoruntule.html.twig", $data);
        }
        /** --------------------------------------------------------------
         * ANKETLER ANASAYFA
         ---------------------------------------------------------------*/
        else {
            $view->render("admin/sirket/inc/anketler.html.twig", $data);
        }
    }


    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: duyuru Yönetimi
     *
     * URL: ?link=duyuru
     * ---------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "duyuru") {
        $duyuruSinif = new Duyuru();

        $data["GET"] = $_GET;
        $data["sirket_duyurular"] = $duyuruSinif->duyuruListele($sirket_id);

        $view = new Twiggy(1);

        if (isset($_GET["islem"]) and $_GET["islem"] == "ekle") {
            $data["title"] = "Duyuru Ekleme";
            $view->render("admin/sirket/inc/sirketDuyuruEkle.html.twig", $data);
        }
        elseif (isset($_GET["islem"]) and $_GET["islem"] == "duzenle" and
                isset($_GET["id"]) and !empty($_GET["id"])) {
            $data["title"] = "Duyuru Düzenleme";

            $duy = new Duyuru();
            $data["sirket_duyuru"] = $duy->duyuruGetir($sirket_id, $_GET["id"]);

            $view->render("admin/sirket/inc/sirketDuyuruDuzenle.html.twig", $data);
        }
        else {
            $data["title"] = "Duyuru Yönetimi";
            $view->render("admin/sirket/inc/sirketDuyurular.html.twig", $data);
        }


    }

    /** ----------------------------------------------------------------------------------------------------------------
     * Şirket Admin: Reklam yönetimi
     *
     * URL: ?link=reklam
     * ---------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "reklam") {
        $reklamSinif = new Reklam();

        $data["GET"] = $_GET;
        $data["sirket_reklamlar"] = $reklamSinif->reklamListele($sirket_id);

        $view = new Twiggy(1);

        if (isset($_GET["islem"]) and $_GET["islem"] == "ekle") {
            $data["title"] = "Reklam Ekleme";
            $view->render("admin/sirket/inc/sirketReklamEkle.html.twig", $data);
        }
        elseif (isset($_GET["islem"]) and $_GET["islem"] == "duzenle" and
            isset($_GET["id"]) and !empty($_GET["id"])) {
            $data["title"] = "Reklam Düzenleme";

            $rek = new Reklam();
            $data["sirket_reklam"] = $rek->reklamGetir($sirket_id, $_GET["id"]);

            $view->render("admin/sirket/inc/sirketReklamDuzenle.html.twig", $data);
        }
        else {
            $data["title"] = "Reklam Yönetimi";
            $view->render("admin/sirket/inc/sirketReklamlar.html.twig", $data);
        }


    }
    /** ----------------------------------------------------------------------------------------------------------------
     * MESAJ YÖNETİMİ
    -----------------------------------------------------------------------------------------------------------------*/

    elseif ($link == "mesajlar") {

        if (!isset($_GET["islem"]) or empty($_GET["islem"])) {
//            $data = array();

            // $data daha önce tanımlanmış durumda.
            $data["title"] = "Mesaj Yönetimi";

            $data["GET"] = $_GET;

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/mesajlar.html.twig", $data);
        }

        elseif ($link == "mesajlar" && $_GET["islem"] == "ozel") {

            $data["title"] = "Mesaj Ekleme Sayfası";
            $data["GET"] = $_GET;
            $data["musteriler"] = sirketMusterilerGetir($sirket_id);

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/ozelMesaj.html.twig", $data);
        }

        elseif ($link == "mesajlar" && $_GET["islem"] == "forum") {
            $data["title"] = "Mesaj Ekleme Sayfası";
            $data["GET"] = $_GET;
            $data["mesajlar"] = sirketMesajlarGetir();
            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/forumMesaj.html.twig", $data);
        }

        elseif ($link = "mesajlar" && $_GET["islem"] == "ozel_mesaj_gonder"){
            $data["title"] = "mesajlar";
            $data["GET"] = $_GET;

            $view = new Twiggy(1);
            $view->render("admin/sirket/inc/ozel_mesaj_form.html.twig", $data);

        }

    }

    /** ----------------------------------------------------------------------------------------------------------------
     * JSON YÖNETİMİ
    -----------------------------------------------------------------------------------------------------------------*/
    elseif ($link == "json") {
        $data["title"] = "JSON API Yönetimi";
        $data["GET"] = $_GET;

        if (isset($_GET["id"]) and !empty($_GET["id"])) {
            $data["json_link"] = "admin/sirket/inc/json/".$_GET["id"].".html.twig";
        }

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/json.html.twig", $data);
    }


    /** ----------------------------------------------------------------------------------------------------------------
     * Sipariş Yönetimi.
    -----------------------------------------------------------------------------------------------------------------*/

    elseif ($link == "siparisler") {
        $data["title"] = "Siparis Yönetimi";
        $data["GET"] = $_GET;

        $sip = new Siparis();
        $data["siparisler"] = $sip->siparisListele($sirket_id);

        $view = new Twiggy(1);
        $view->render("admin/sirket/inc/siparisler.html.twig", $data);
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