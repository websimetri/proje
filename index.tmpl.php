<?php
/**
 * index.tmpl.php
 * ~~~~~~~~~~~~~~
 *
 * Anasayfa'nın template dosyası.
 *
 *
 *
 * *.tmpl dosyalarında daha çok değişkenler ile ilgili işlemler olmalı.
 */
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="static/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="static/css/jquery.bxslider.css" />
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="static/css/bulut.css"/>
    <script src="static/js/jquery.min.js"></script>
    <script src="static/js/jquery.min.js"></script>
    <script type="text/javascript" src="static/js/jquery.bxslider.js"></script>
    <script type="text/javascript" src="static/js/bootstrap.js"></script>
    <script type="text/javascript" src="static/js/fi.js"></script>
    <title>
        <?php echo SITE_ADI; ?>
    </title>
</head>
<body>

    <p>Index vs...</p>

    <a href="?sayfa=iletisim">İletişim</a>
    <br/>
    <a href="?sayfa=">Anasayfa.PHP</a>
    <br/>
    <a href="?sayfa=giris">Giriş Sayfası</a>
    <br/>
    <a href="?sayfa=sifirla">Sıfırlama</a>
    <br/>
    <a href="?sayfa=sifirla&key=asdfaera">Keyli Sıfırlama Deneme</a>
	<br/>
	<a href="?sayfa=logoDegistir">Logo Ekleme</a>
    <hr/>
	
	
    <!-- Template'lerin eklenmesi. -->
    <?php
    templateEkle();
    ?>

    <footer style="clear: both">
        FOOTER
    </footer>
</body>
</html>