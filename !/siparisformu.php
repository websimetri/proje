<?php
session_start();
$_SESSION["sirketId"] = 1;

try {
    $db = new PDO("mysql:host=localhost;dbname=bulut;charset=utf8;", "root", "");
} catch (Exception $ex) {
    echo "Hata : " . $ex->getMessage();
}
echo '<form action="index.php" method="post">';

$baglan = $db->query("select * from formlar where id_sirket='" . $_SESSION["sirketId"] . "' ");

while ($row = $baglan->fetch(PDO::FETCH_ASSOC)) {

    if ($row["id"] == 10) {
        echo $row["html"];
    }
}
echo '</form>';

?>