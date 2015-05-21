<?php
include "../config.php";
include "../lib/siniflar.php";

if (isset($_GET["ref"])) {
    $cevap = Bulut::GetSirketWithRefCode($_GET["ref"]);

    if ($cevap) {
        // Şirketin kategorileri.

        if (isset($_GET["id"]) and !empty($_GET["id"])) {
            // Verilen Kategori ve alt kategorileri.

            // Tekil kategori bilgileri.
            $cat = array();
            $q = "
            SELECT id AS categoryId, id_ust_kategori AS topCategoryId, kategori_adi AS categoryName
            FROM kategoriler WHERE id_sirket = :sirket AND id = :id
            ";
            $sorgu = $DB->prepare($q);
            $sorgu->bindParam(":sirket", $cevap["id"]);
            $sorgu->bindParam(":id", $_GET["id"]);
            $sorgu->execute();

            $sonuclar = $sorgu->fetch(PDO::FETCH_ASSOC);

            if ($sonuclar) {
                $cat = $sonuclar;

                // Alt kategoriler.
                $q = "
                SELECT id AS categoryId, id_ust_kategori AS topCategoryId, kategori_adi AS categoryName
                FROM kategoriler WHERE id_sirket = :sirket AND id_ust_kategori = :id
                ";
                $sorgu = $DB->prepare($q);
                $sorgu->bindParam(":sirket", $cevap["id"]);
                $sorgu->bindParam(":id", $_GET["id"]);
                $sorgu->execute();

                $alt_kategoriler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
                $cat["subCategories"] = $alt_kategoriler;


                $JSON = array(
                    "durum" => true,
                    "mesaj" => "İşlem başarılı.",
                    "bilgiler" => $cat
                );

            }

            else {
                $JSON = array(
                    "durum" => true,
                    "mesaj" => "Kategori bulunamadı."
                );
            }


        }
        else {
            $JSON = BulutJSON::getProductCategory($cevap["id"]);
        }

    }else{
        $JSON = array(
            "durum" => false,
            "mesaj" => "Referans kodunuz hatalı."
        );
    }


}else{
    $JSON = array(
        "durum" => false,
        "mesaj" => "Referans kodunuz eksik."
    );
}

header('Content-Type: application/json');
echo json_encode(array("ProductCategory" => array($JSON)), JSON_PRETTY_PRINT);

?>