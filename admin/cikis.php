<?php
// Session açılımı.
session_start();

// Cookie'lerin silinmesi.
// TODO: Cookie eklenecek.
//setcookie("kulRol", "", time()-3600);
setcookie("hatirla", true, time() - 60 * 60 * 24);
setcookie("kulId", $row_id, time() - 60*60*24);
setcookie("kulAdi", $adi, time() - 60*60*24);
setcookie("kulMail", $mail, time() - 60*60*24);
setcookie("kulRol", "", time() - 60*60*24);

session_destroy();

//header("Location: index.php");

echo "<script>window.location.href = 'index.php';</script>";
?>