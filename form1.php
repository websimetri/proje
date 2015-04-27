<form action="" method="post">
    <div id="example-3">
        <div>
            <ul>
                <?php Kategori_Select($tree); ?>
            </ul>
        </div>
    </div>
    <input type="text" name="urunAdi" placeholder="Ürün Adınız Giriniz">
    <input  type="text" name="kisaAciklama" placeholder="Ürün Tanımını Giriniz">
    <textarea name="urunAciklama" placeholder="Ürün açıklamasını giriniz" cols="30" rows="10"></textarea>
    <input type="submit" value="Kaydet" name="kaydet">

</form>