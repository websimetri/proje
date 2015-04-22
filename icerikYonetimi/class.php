<?php

class icerikYonetimi
{

    public $db;

    public $baslik;

    public $kisa_aciklama;

    public $detay;

    public $durum;

    function __construct ()
    {
        try {
            $dsn = "mysql:host=localhost;dbname=bulut;charset=utf8";
            $this->db = new PDO($dsn, "root", "");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function icerikKontrol ()
    {
        /**
         * **
         * baslik = başlık giriliyor
         * kisa_aciklama = kısa açıklama
         * detay = detayı
         * durum = aktiflik - pasiflik [1 - 0]
         * kaydet = button-
         */
        if (isset($_POST["baslik"]) && isset($_POST["kisa_aciklama"]) &&
                 isset($_POST["detay"]) && isset($_POST["durum"])) {
            $this->baslik = trim($_POST["baslik"]);
            $this->baslik = strip_tags($this->baslik);
            $this->kisa_aciklama = trim($_POST["kisa_aciklama"]);
            $this->kisa_aciklama = strip_tags($this->kisa_aciklama);
            $this->detay = trim($this->detay);
            
            if (! empty($this->baslik) && ! empty($this->kisa_aciklama) &&
                     ! empty($this->detay)) {
                if ($_POST["durum"] == 0) {
                    $this->durum = 0;
                } else {
                    $this->durum = 1;
                }
                return 1;
            } else {
                return 555; // gelen bilgilerden bir yada birkaçı boş
            }
        } else {
            return 600; // bilgilerden bir yada birkaçı gelmedi.
        }
    }

    public function icerikEkle ()
    {
        if ($this->icerikKontrol() == 1) { // direk $this->icerikKontrol()
                                           // hali de çalışır
            $kayitEkle = $this->db->exec(
                    "INSERT INTO icerik_yonetimi VALUES (NULL, '" .
                             $_SESSION['sirketId'] . "', '" . $this->baslik .
                             "', '" . $this->kisa_aciklama . "', '" .
                             $this->detay . "', now(), '" . $this->durum . "')");
            if ($kayitEkle) {
                return true;
            } else {
                echo "<script>alert('Kayıt girilme işlemi başarısız oldu');</script>";
            }
        } elseif ($this->icerikKontrol() == 555) {
            echo "<script>alert('Gelen bilgilerden bir ya da birkaçı boş');</script>";
        } elseif ($this->icerikKontrol() == 600) {
            echo "<script>alert('Bilgilerden bir yada birkaçı gelmedi');</script>";
        }
    }

    public function icerikListele ()
    {
        $listele = $this->db->query(
                "SELECT * FROM icerik_yonetimi WHERE durum = '1'");
        echo "<table>";
        while ($row = $listele->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>
                    <td>' . $row["baslik"] . '</td>
                    <td>' .
                     $row["kisa_aciklama"] . '</td>
                    <td>' . htmlspecialchars_decode($row["detay"]). '</td>
                    <td>' . $row["eklenme_tarihi"] . '</td>
                    <td><a href="?islem=duzenle&id=' . $row["id"] . '">Düzenle</a></td>
                    <td><a href="?islem=sil&id=' . $row["id"] . '">Sil</a></td>
                  </tr>';
        }
        echo "</table>";
    }

    public function icerikDuzenle ($id)
    {
        $listele = $this->db->query(
                "SELECT * FROM icerik_yonetimi WHERE id = $id");
        $icerik = $listele->fetch(PDO::FETCH_ASSOC);
        global $islembaslik;
        global $islem;
        global $duzenleid;
        global $basliktmpl;
        global $kisa_aciklamatmpl;
        global $detaytmpl;
        global $checked1;
        global $checked2;
        $islembaslik = "İÇERİK DÜZENLEME EKRANI";
        $islem = "duzenle";
        $duzenleid = $icerik["id"];
        $basliktmpl = $icerik["baslik"];
        $kisa_aciklamatmpl = $icerik["kisa_aciklama"];
        $detaytmpl = $icerik["detay"];
        if ($icerik["durum"] == 1) {
            $checked1 = "checked";
        } elseif ($icerik["durum"] == 0) {
            $checked2 = "checked";
        }
    }

    public function icerikDuzenleKaydet ($id)
    {
        if ($this->icerikKontrol() == 1) {
            $kayitDuzenle = $this->db->prepare(
                    "UPDATE `icerik_yonetimi` SET `baslik`=?,`kisa_aciklama`=?,`detay`=?,`durum`=? WHERE id = $id");
            if ($kayitDuzenle->execute(
                    array(
                            $_POST["baslik"],
                            $_POST["kisa_aciklama"],
                            $_POST["detay"],
                            $_POST["durum"]
                    ))) {
                echo "<script>alert('güncelleme başarılı');</script>";
                echo "<script>window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('güncelleme başarısız');</script>";
            }
        } else {
            echo "<script>alert('içeriklerin bir ya da birkaçı boş');</script>";
        }
    }

    public function icerikSil ($id)
    {
        if ($this->db->exec("DELETE FROM icerik_yonetimi WHERE id = $id")) {
            echo "<script>alert('içerik silindi');</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('silme başarısız');</script>";
        }
    }
}

?>