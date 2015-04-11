<?php
session_start();

$_SESSION["kulId"] = 3;
$_SESSION['sirketId'] = 1;


if (isset($_FILES["dosya"])) {
	
	$class = new ResimIslemleri($DB);
	$class->imageUpload("dosya");
	
}

/*
 *
 * Hosttaki php.ini dosyasının içindeki post_max_size ve upload_max_filesize karşısındaki değerleri değiştirmemiz gerek
 * daha dogrusu arttırmamız gerek
 * eğer arttırmazsak;
 *
 * Warning: POST Content-Length of 8978294 bytes exceeds the limit of 8388608 bytes in Unknown on line 0 hatası ile karşılaşıyoruz.
 *
 *
 *
 */

?>

<meta charset="utf-8" />

<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="dosya" placeholder="Dosya" /> <input
		type="submit" value="Gönder" />
</form>
