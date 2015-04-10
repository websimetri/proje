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
        $this->assertEquals("Sirket Kullanici", BulutTest::rolIsim(2));
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
        $this->assertEquals(0, BulutTest::kullaniciRolu(1));
        $this->assertEquals("Super Admin", BulutTest::kullaniciRolu(1, true));
        $this->assertEquals(1, BulutTest::kullaniciRolu(2));
    }

}
?>