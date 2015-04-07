<h1>Giriş Sayfası</h1>


<h2>Şirket Giriş (Grup 1)</h2>

<hr/>

<h2>SüperAdmin Giriş</h2>

<form action="admin/index.php" method="POST">
    <input type="text" name="fMail" id="fMailId" placeholder="Mail adresiniz."/> <br/>
    <div class="hidden">Kullanıcı Adını Giriniz</div>
    <input type="password" name="fSifre" id="fSifreId" placeholder="Şifreniz"/> <br/>
    <div class="hidden">Şifrenizi Giriniz</div>
    <label for="fHatirla">Beni Hatırla :</label><input type="checkbox" name="fHatirla" id="fHatirla"><br/>
    <input type="submit" value="Giriş Yap" name="giris"/>
</form>


