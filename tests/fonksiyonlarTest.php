<?php
include "fonksiyonlar.php";

/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class fonksiyonlarTest extends PHPUnit_Framework_TestCase
{


    /**
     * idEncode ve idDecode beraber düzgün çalışıyor mu?
     */
    public function testEncode()
    {
        $id = "110";
        $enc = idEncode($id);
        $dec = idDecode($enc);

        $this->assertEquals($id, $dec);
    }

}

?>