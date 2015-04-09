<?php 

require_once "config.php";
require_once "siniflar.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>Şifremi Unuttum</title>
</head>
<body>
<form method="post" action="">
		<input type="text" name="email" placeholder="Mail Adresinizi Giriniz..">
		<input type="submit" name="gonder" value="Gönder">




</form>
</body>
</html>

<?php


$sifirlama_anahtar = Bulut::sifreSifirlamaKeyOlustur();


if (isset($_POST['email'])) {

  $email = $_POST['email'];
} else {
	
	echo 'email girilmedi';
	return;
}

//$host = $_SERVER['HTTP_HOST'];

		$emailSorgu = $DB->prepare("SELECT `id`,`adi`,`soyadi`,`mail` FROM kullanicilar WHERE mail = :mail");
        $emailSorgu->bindParam(":mail", $email);
        $emailSorgu->execute();
        $emailBilgileri = $emailSorgu->fetchAll(PDO::FETCH_ASSOC);

// Eğer email sistemde mevcut ise parola sıfırlama maili gönnder
if (count($emailBilgileri) > 0) {
	
	require 'class.phpmailer.php';
	
	
	$kulid          = $emailBilgileri[0]['id'];
	$isim			= $emailBilgileri[0]['adi'];
	$soyisim		= $emailBilgileri[0]['soyadi'];
	$gidecekMail    = $emailBilgileri[0]['mail'];
	$konu			= 'Şifre Hatırlatma';
	$mesaj			= '<p>Sayın&nbsp;' . $isim . ' ' . $soyisim . ',</p>
						<p>Şifremi sıfırlama adresi aşağıdadır...</p>
						<p>Şifre sıfırlama adresi:&nbsp; '.$sifirlama_anahtar[1].'</p>
						<p>Kendiniz adres çubuğundan manuel olarak girmek istiyorsanız aşağıdaki kodu şifre sıfırlama sayfasına girebilirsiniz</p>

						<p>'.$sifirlama_anahtar[2].'</p>
						';
	$headers  = 'MIME-Version: 1.0' . "rn";
	$headers .= 'Content-type: text/html; charset=utf-8' . "rn";
	
	$mail = new PHPMailer;

	$mail->isSMTP();
	$mail->SMTPAuth = true;	
	$mail->CharSet = 'UTF-8';                                    
	$mail->Host = 'mail.uranus.com.tr';
	$mail->Port = 587;
	$mail->Username = 'test@uranus.com.tr';
	$mail->Password = '';                          
	                         
    
	$mail->CharSet = 'UTF-8';
	$mail->From = 'test@uranus.com.tr';
	$mail->FromName = 'Emre Ersöz';
	$mail->addAddress($gidecekMail);          
	$mail->AddReplyTo($gidecekMail);

	$mail->isHTML(true);                                  

	$mail->Subject = $konu;
	$mail->Body    = $mesaj;
	
	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
		
		
		$DB->exec("INSERT INTO `kullanicilar_sifre_reset` VALUES(null, $kulid, '" . $sifirlama_anahtar[0] . "' , 'now()'");
		echo "<script>alert('Mail gönderildi');
		window.location.href='index.php'</script>";
	}
	
} else {
	echo 'email sistemde mevcut değil';
	return;
}

 ?>




