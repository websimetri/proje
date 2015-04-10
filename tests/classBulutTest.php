<?php
include "siniflar/class.bulut.php";

// Bulut için yeni constructor.
// bulut_test veritabanını kullanması için.
class BulutTest extends Bulut
{
    public function __construct()
    {
        $host = "localhost";
        $dbname = "bulut_test";
        $user = "root";
        $pass = "";
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            $this->DB = new PDO($dsn, $user, $pass);
            //$this->DB->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            echo "[HATA]: Veritabanı -".$e->getMessage();
        }
    }
}


/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class DatabaseTestCase extends PHPUnit_Extensions_Database_TestCase
{

    /**
     * Veritabanı bağlantısı.
     *
     * @return mixed
     */
    final public function getConnection()
    {
        $dsn = "mysql:host=localhost;dbname=bulut_test;charset=utf8";
        $pdo = new PDO($dsn, "root", "");

        return $this->createDefaultDBConnection($pdo, "bulut_test");
    }

    /**
     * XML dosyasından dataset almak.
     * @return mixed
     */
    public function getDataSet()
    {
        return $this->createXMLDataSet(dirname(__FILE__)."/.files/dataset.xml");
    }

    /**
     * Bulut::rolIsim
     */
    public function testRolIsim()
    {
        $this->assertEquals("Super Admin", BulutTest::rolIsim(0));
        $this->assertEquals("Sirket Admin", BulutTest::rolIsim(1));
        $this->assertEquals("Sirket Kullanicisi", BulutTest::rolIsim(2));
    }

    /**
     * Bulut::normalizasyonSirket
     */
    public function testNormalizasyonSirket()
    {
        $baslangic_row = $this->getConnection()->getRowCount("kullanicilar_sirket");

        $islem = BulutTest::normalizasyonSirket(111, 222);

        // True dönmüş mü fonksiyondan?
        $this->assertEquals(true, $islem);

        // Sıra eklenmiş mi?
        $this->assertEquals($baslangic_row + 1, $this->getConnection()->getRowCount("kullanicilar_sirket"));

        $qTable = $this->getConnection()->createQueryTable(
            "kullanicilar_sirket", "SELECT id_kullanici, id_sirket FROM kullanicilar_sirket ORDER BY ID DESC LIMIT 1"
        );

        $qBeklenen = $this->createFlatXmlDataSet("tests/.files/testNormalizasyonSirket.xml")->getTable("kullanicilar_sirket");
        $this->assertTablesEqual($qBeklenen, $qTable);

        // TODO: Delete last added row.
        // Added during the test.
    }


    /**
     * Bulut::normalizasyonRoller
     */
    public function testNormalizasyonRoller()
    {
        $baslangic_row = $this->getConnection()->getRowCount("kullanicilar_roller");

        $islem = BulutTest::normalizasyonRoller(111, 222);

        // True dönmüş mü fonksiyondan?
        $this->assertEquals(true, $islem);

        // Sıra eklenmiş mi?
        $this->assertEquals($baslangic_row + 1, $this->getConnection()->getRowCount("kullanicilar_roller"));

        $qTable = $this->getConnection()->createQueryTable(
            "kullanicilar_roller", "SELECT id_kullanici, id_rol FROM kullanicilar_roller ORDER BY ID DESC LIMIT 1"
        );

        $qBeklenen = $this->createFlatXmlDataSet("tests/.files/testNormalizasyonRoller.xml")->getTable("kullanicilar_roller");
        $this->assertTablesEqual($qTable, $qBeklenen);

        // TODO: Delete last added row.
        // Added during the test.
    }

    public function testKullaniciRolu()
    {
        // TODO: Fonksiyon array dönümünü destekliyor ama testi yapılmadı.
        $this->assertEquals(0, BulutTest::kullaniciRolu(1));
        $this->assertEquals("Super Admin", BulutTest::kullaniciRolu(1, true));
        $this->assertEquals(1, BulutTest::kullaniciRolu(2));
    }

    public function testOturumAc()
    {
        $mail = "yasin@yasin.com";
        $sifre = "12345";
        $sonuc = BulutTest::oturumAc($mail, $sifre);
        $this->assertEquals(true, $sonuc);
        $this->assertEquals($_SESSION["kulAdi"], "Yasin Kesim");

        // Hatalı kısım için Session globalinin sıfırlanması.
        $_SESSION = null;

        $mail = "sirket.admin@mail.com";
        $sifre = "1234";
        $sonuc = BulutTest::oturumAc($mail, $sifre);
        $this->assertEquals(false, $sonuc);
        $this->assertEquals(isset($_SESSION), false);

    }

    public function testBeniHatirlaKontrol()
    {
        $this->assertEquals(BulutTest::beniHatirlaKontrol(), false);
    }

    public function testSirketEkle()
    {

    }

    public function testKullaniciEkle()
    {
        $adi = "Deneme";
        $soyadi = "Tahtasi";
        $mail = "deneme@mail.com";
        $sifre = "12345";
        $tarih = "2015-04-01 19:12:13";

        $rows = $this->getConnection()->getRowCount("kullanicilar");

        $girdi = BulutTest::kullaniciEkle($adi, $soyadi, $mail, $sifre, $tarih);
        $this->assertEquals($girdi, true);

        $rows_yeni = $this->getConnection()->getRowCount("kullanicilar");

        $this->assertEquals($rows_yeni, $rows + 1);
    }

    public function testRefOlustur()
    {
        // Su anda pek gerek yok.
    }

    public function testEmailSorgu()
    {

        $sorgu = BulutTest::emailSorgu("bu.email@yok.com");
        $this->assertEquals(false, $sorgu);

        // Mail bulunduğu takdirde:
        // id, adi, soyadi, mail bir array içinde geri dönecek.
        $sorgu = BulutTest::emailSorgu("yasin@yasin.com");

        $this->assertEquals(4, count($sorgu));
        $this->assertEquals("Yasin", $sorgu["adi"]);
    }

    public function testGetSirketWithRefCode()
    {
        $sorgu = BulutTest::GetSirketWithRefCode("bulunamayan_ref");
        $this->assertEquals($sorgu, false);

        $sorgu= BulutTest::GetSirketWithRefCode("yasin_ref_kod");
        $this->assertEquals(13, count($sorgu));
        $this->assertEquals("Yasin Emlak", $sorgu["adi"]);
    }

}
?>