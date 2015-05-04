<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Seçenek Ekleme </title>
</head>
<body>

<form action="index.php" method="post">
    <input type="hidden" name="olay" value="<?php echo @$olay; ?>"/>
    <input type="hidden" name="yeniid"  value="<?php echo @$yeniid; ?>"/>
    <label>Ankete Seçenek Ekle</label>
    <select name="id"><?php echo @$secmece; ?><?php echo @$secim; ?></select>
    <input type="text" name="secenek" value="<?php echo @$secc; ?>" />
    <input type="submit" name="kaydet" value="Kaydet"/>
</form>
</body>
</html>