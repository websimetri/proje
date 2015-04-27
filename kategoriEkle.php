<?php
session_start();
$_SESSION['sirketId']=1;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style type="text/css">
       option{
           font-size: 12px !important;
       }
        .opt0{
            font-size: 20px !important;
        }

    </style>

</head>
<body>


<?php
include "siniflar.php";
$sirketId=$_SESSION['sirketId'];
if(isset($_POST["kategori_adi"]) && isset($_POST["topCategory"])){
    $catAdi=$_POST["kategori_adi"];
    $topCategory=$_POST["topCategory"];
    Bulut::addCategory($sirketId,$topCategory,$catAdi);
}
$cevap=Bulut::getCategory(0,$sirketId);
?>
<form action="" method="post">
Üst Kategori:
<?php
echo '<select name="topCategory">';
echo "<option value='0'>Kategori Seçiniz </option>";
    Kategori_Select($cevap);
echo '</select>';
?>
<input type="text" name="kategori_adi" placeholder="Kategori Adı Giriniz">
<input type="submit" value="Kaydet" name="kaydet">
</form>

</body>
</html>
<?php
function Kategori_Select($tree,$level=0){

    /*
     *  Sadece Yeni Kategori Ekleme Formunda kullanılan Select Box
     */

    foreach ($tree as $id => $item)
    {
        echo '<option value="'.$id.'" class="opt'.$level.'">'.str_repeat('&nbsp', $level*7).$item['kategori_adi'].'</option>';
        if (!empty($item['sub_cats'])){ Kategori_Select($item['sub_cats'],$level + 1); }
    }
}
?>

