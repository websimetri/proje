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
//        $this->assertEquals("Sirket Admin", BulutTest::rolIsim(1));
//        $this->assertEquals("Sirket Kullanici", BulutTest::rolIsim(2));
    }

}
?>