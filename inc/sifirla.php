<?php

$kontrol = "ssada";

if (isset($_GET["key"]) and !empty($_GET["key"])){
    include "tmpl/sifirlaSifre.tmpl.php";
}
else {
    include "tmpl/sifirlaMail.tmpl.php";
}


?>