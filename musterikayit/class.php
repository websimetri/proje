<?php

class kayitYonetimi
{
    public $db;

    public $sirketId;

    public $adi;

    public $soyadi;

    public $mail;

    public $telefon;

    public $sifre;

    public $tsifre;

    public $durum;

    function __construct()
    {
        try {
            $dsn = "mysql:host=localhost;dbname=bulut;charset=utf8";
            $this->db = new PDO($dsn, "root", "");
        } catch (Exception $e) {
            echo "PDO Bağlantı Hatası : " . $e->getMessage();
        }
    }

    public function kayitkontrol()
    {
        if (isset($_POST["adi"]) && isset($_POST["soyadi"]) && isset($_POST["mail"]) &&
            isset($_POST["telefon"]) && isset($_POST["sifre"]) && isset($_POST["tsifre"]) && isset($_POST["durum"])
        ) {
            $this->adi = trim($_POST["adi"]);
            $this->adi = strip_tags($this->adi);
            $this->soyadi = trim($_POST["soyadi"]);
            $this->soyadi = strip_tags($this->soyadi);
            $this->mail = trim($_POST["mail"]);
            $this->mail = strip_tags($this->mail);
            $this->telefon = trim($_POST["telefon"]);
            $this->telefon = strip_tags($this->telefon);
            $this->sifre = trim(md5($_POST["sifre"]));
            $this->sifre = strip_tags($this->sifre);
            $this->tsifre = trim(md5($_POST["tsifre"]));
            $this->tsifre = strip_tags($this->tsifre);

            if (!empty($this->adi) && !empty($this->soyadi) &&
                !empty($this->mail) && !empty($this->telefon) && !empty($this->sifre) && !empty($this->tsifre)
            ) {
                if($this->sifre == $this->tsifre) {
                    if ($_POST["durum"] == 0) {
                        $this->durum = 0;
                    } else {
                        $this->durum = 1;
                    }
                }
                return 1;
            }
        }
    }

    public function kayitEkle()
    {
        if ($this->kayitkontrol()) {
            /*
                        $kayitEkle = $this->db->exec("INSERT INTO musteriler VALUES (NULL, '" . $_SESSION['sirketId'] . "', '" . $this->adi . "',
            '" . $this->soyadi . "', '" . $this->mail . "', '" . $this->telefon . "', '" . $this->sifre . "', now(), now(), " . $this->durum . ") ");
            /**/
            $kayitEkle = $this->db->prepare("INSERT INTO musteriler VALUES (null, :sirketId, :adi, :soyadi, :mail, :telefon, :sifre, now(), now(), :durum)");
            $kayitEkle->bindParam(':sirketId', $_SESSION["sirketId"]);
            $kayitEkle->bindParam(':adi', $this->adi);
            $kayitEkle->bindParam(':soyadi', $this->soyadi);
            $kayitEkle->bindParam(':mail', $this->mail);
            $kayitEkle->bindParam(':telefon', $this->telefon);
            $kayitEkle->bindParam(':sifre', $this->sifre);
            $kayitEkle->bindParam(':durum', $this->durum);
            $kayitEkle->execute();

            if ($kayitEkle->rowCount() > 0) {
                echo "<script>alert('Kayıt işlemi başarılı');</script>";
                echo "<script>window.location.href='index.php';</script>";
                //return true;
            } else {
                echo "<script>alert('Şifreler eşleşmedi lütfen tekrar deneyiniz.');</script>";
                echo "<script>window.location.href='index.php';</script>";
            }
        } elseif ($this->kayitkontrol() == 555) {
            echo "<script>alert('Gelen bilgilerden bir ya da birkaçı boş');</script>";
        }
    }
}
?>