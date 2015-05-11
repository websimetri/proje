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
     * $_POST'dan gelen bilgileri gösterir.
     * @return array
     */
    public function siparisGoster()
    {
        $dizi = $_POST;
        $bilgi = "";

        foreach ($dizi as $key => $val) {
            $bilgi .= $key;
            $bilgi .= " : ";
            $bilgi .= $val;
            $bilgi .= "<br>";
        }
        return print_r($bilgi);

    }

}

?>
