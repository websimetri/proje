<?php
session_start();
$_SESSION["sirketId"] = 1;

require_once 'class.php';

$kayitYonetimi = new kayitYonetimi();

if (isset($_POST["kytEkle"])) {
    switch ($_POST["kytEkle"]) {
        case "ekle":
            $kayitYonetimi->kayitEkle();
            break;
    }
}
if (!isset($_POST["kytEkle"]) && !isset($_GET["kytEkle"])) {
    $kytEkle = "ekle";

}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Müşteri Kayıt</title>
    <style>
        .hide { display:none; }
    </style>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $(function(){

        $('input[name=tsifre]').on('keyup', function(){
            var sfr = $('input[name=sifre]').val();
            var sifret = $(this).val();
            $('span.success').hide();
            $('span.error').hide();
            if( sfr == sifret ){
                $('span.success').show();
            }
            else {
                $('span.error').show();
            }

        });

    });

</script>
<form action="" method="POST" align="center">
    <div> <input type="hidden" name="kytEkle" value="<?php echo $kytEkle; ?>"></div>

    <div><input type="text" name="adi" id="adi" placeholder="Adı" required></div>

    <div><input type="text" name="soyadi" id="soyadi" placeholder="Soyadı" required></div>

    <div><input type="text" name="mail" id="mail" placeholder="Mail Adresi" required></div>

    <div><input type="text" name="telefon" id="telefon" placeholder="Telefon Numarası" required></div>

    <span class="hide success">Parolalar aynı.</span>
    <span class="hide error">Parolalar eşleşmiyor.</span>

    <div><input type="password" name="sifre" id="sifre" placeholder="Şifre"  aria-invalid="true" required></div>

    <div><input type="password" name="tsifre" id="tsifre" placeholder="Şifre Tekrarı"  aria-invalid="true" required></div>

    <div>
        <input type="radio" name="durum" value="1" id="durum" checked/>Aktif
        <input type="radio" name="durum" value="0" id="durum"/>Pasif
    </div>

    <div><input type="submit" id="kayit" name="kayit" value="Kayıt Ol"></div>

</form>
</body>
</html>