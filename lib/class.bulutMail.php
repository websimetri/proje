<?php
/**
 * Statik kullanım yok bu sınıfta. Normal şekilde
 * kullanıyoruz.
 *
 * NOT: Kullanıldığı yerde config.php include edilmiş olmalı.
 *
 * Class BulutMail
 */

class BulutMail
{

    public $db;

    /**
     * @param $DB   config.php'den $DB bağlantısı
     */
    function __construct($DB)
    {
        $this->db = $DB;
    }

    /**
     *
     * Şifre unuttum mail'i ve linki yollar.
     *
     * @param $email
     * @return bool
     * @throws Exception
     * @throws phpmailerException
     */
    public function sifreUnuttum($email)
    {
        $emailBilgileri = Bulut::emailSorgu($email);

        if ($emailBilgileri) {
            require 'class.phpmailer.php';

            $kulid = $emailBilgileri['id'];
            $isim = $emailBilgileri['adi'];
            $soyisim = $emailBilgileri['soyadi'];
            $gidecekMail = $emailBilgileri['mail'];
            $konu = 'Şifre Hatırlatma';
            $sifirlama_anahtar = Bulut::sifreSifirlamaKeyOlustur();
			
            $mailTmpl = "inc/tmpl/mailTmpl.html";
			$text = fopen($mailTmpl,"r+");
			$text = fread($text,filesize($mailTmpl));

			$mesaj = sprintf($text, $isim, $soyisim, $sifirlama_anahtar[1], $sifirlama_anahtar[2]);
			
			/*****
			* burada sprintf ile değişkenler sırasıyla değişiyor. onu %$1s gibi birşey yapalım yarın. 
			* bi mantık belirleyelim ona göre düzenli olsun. tmpl değişse bile isimler kaymasın.
			*****/

            $headers  = 'MIME-Version: 1.0' . "rn";
            $headers .= 'Content-type: text/html; charset=utf-8' . "rn";

            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'mail.uranus.com.tr';
            $mail->Port = 587;
            $mail->Username = 'test@uranus.com.tr';
            $mail->Password = '';

            $mail->CharSet = 'UTF-8';
            $mail->From = 'test@uranus.com.tr';
            $mail->FromName = 'Bulut Ltd. Şti.';
            $mail->addAddress($gidecekMail);
            $mail->AddReplyTo($gidecekMail);

            $mail->isHTML(true);

            $mail->Subject = $konu;
            $mail->Body    = $mesaj;

            $yollandi = $mail->Send();

            if ($yollandi) {
                $this->db->exec("INSERT INTO kullanicilar_sifre_reset VALUES(null, $kulid, '" . $sifirlama_anahtar[0] . "' , now())");
                return true;

            }
            else {
                return false;
//                echo 'Message could not be sent.';
//                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }

        }
        else {
            // Mail veritabanında bulunamadı.
            return false;
        }
    }

}



?>