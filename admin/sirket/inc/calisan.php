<?php
session_start();

var_dump($_POST);

if (isset($_SESSION["sirketId"]) and
    isset($_POST["adi"]) and !empty($_POST["adi"]) and
    isset($_POST["soyadi"]) and !empty($_POST["soyadi"])) {

}


?>