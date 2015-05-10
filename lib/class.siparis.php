<?php
/**
 * Class Duyuru
 *
 * Duyuru işlemlerini halleden sınıf.
 */


class Siparis
{
    public $DB;

    function __construct()
    {
        $host = "localhost";
        $dbname = "bulut";
        $user = "root";
        $pass = "";
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            $this->DB = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {
            echo "[HATA]: Veritabanı -" . $e->getMessage();
        }
    }


    /**
     *
     * @param $arr  ($_POST gelebilir genelde buraya.)
     */
    public function siparisGoster()
    {

    }

}

?>
