<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Anket Yönetimi</title>
</head>
<body>

<form action="" method="post">

    <input type="hidden" name="islem" value="<?php echo @$islem; ?>"/>
    <input type="hidden" name="duzenleid"  value="<?php echo $duzenleid; ?>"/>
    <label>Anket sorusu ekle</label>
    <input type="text" name="baslik" value="<?php echo @$baslikhtml; ?>" />
    <input type="submit" name="gonder" value="Kaydet"/></br>
</form>


</body>
</html>