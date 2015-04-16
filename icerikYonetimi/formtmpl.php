<!doctype html>
<html>
<head>
<title>Form</title>
<meta charset="utf-8">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<form action="" method="POST" enctype="multipart/form-data">
	<style type="text/css">
.tg {
	border-collapse: collapse;
	border-spacing: 0;
}

.tg td {
	font-family: Arial, sans-serif;
	font-size: 14px;
	padding: 10px 19px;
	border-style: solid;
	border-width: 1px;
	overflow: hidden;
	word-break: normal;
}

.tg th {
	font-family: Arial, sans-serif;
	font-size: 14px;
	font-weight: normal;
	padding: 10px 19px;
	border-style: solid;
	border-width: 1px;
	overflow: hidden;
	word-break: normal;
}

.tg .tg-ehoo {
	font-weight: bold;
	font-family: Tahoma, Geneva, sans-serif !important;
}

.tg .tg-3axh {
	font-weight: bold;
	font-family: Tahoma, Geneva, sans-serif !important;
}
</style>

</head>
<body>
	<h2>İÇERİK YÖNETİMİ</h2>
	<h3>
		<a href="?islem=ekle"><?php echo $islembaslik; ?></a>
	</h3>
	<form action="index.php" method="POST">
		<input type="hidden" name="islem" value="<?php echo $islem; ?>"> <input
			type="hidden" name="duzenleid" value="<?php echo $duzenleid; ?>">
		<table width="600" class="tg">
			<tr>
				<td class="tg-ehoo">Başlık</td>
				<td><input type="text" name="baslik" id="baslik"
					value="<?php echo $basliktmpl; ?>" /></td>
			</tr>
			<tr>
				<td class="tg-ehoo">Kısa Açıklama</td>
				<td><label for="kisa_aciklama"></label> <input type="text"
					name="kisa_aciklama" id="kisa_aciklama"
					value="<?php echo $kisa_aciklamatmpl; ?>" /></td>
			</tr>
			<tr>
				<td class="tg-ehoo">Detay</td>
				<td class="tg-ehoo"><label for="detay"></label> <textarea
						name="detay" id="detay"><?php echo $detaytmpl; ?></textarea> <script
						type="text/javascript">
    CKEDITOR.replace( 'detay' );
    </script></td>
			</tr>
			<tr>
				<td class="tg-ehoo">Durum</td>
				<td><input type="radio" name="durum" value="1" id="durum"
					<?php echo $checked1; ?> />Aktif <input type="radio" name="durum"
					value="0" id="durum" <?php echo $checked2; ?> />Pasif</td>
			</tr>
			<tr>
				<td class="tg-ehoo">Kaydet</td>
				<td><input type="submit" name="kaydet" value="Kaydet" /></td>
			</tr>
		</table>
	</form>
</body>
</html>