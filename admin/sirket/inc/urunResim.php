<?php
session_start();

if ((isset($_POST["croppedImage"]) && $_POST["croppedImage"] != "") && (isset($_SESSION["cropped"]) && $_SESSION["cropped"]["0"]["thumbnail"]) == true) {
    var_dump($_POST);
    echo "<br><br>";
    var_dump($_SESSION);

    /****
     * $_POST["croppedImage"] => db ye girilecek dosya yolu
     */

    unset($_SESSION["cropped"]);
}

?>