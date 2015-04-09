<?php
// önemli tmpl'lerin dışarıdan ulaşılmasına engel olmak.
// $kontrol değişkeni, tmpl'yi çağıran php dosyasında tanımlanıyor.

if (!isset($kontrol)) {
    echo " <script> window.location.href = '../../index.php?sayfa=404'; </script> ";
    die();
}

?>
