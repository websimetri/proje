<table>
<tr>
	<th>id</th>
	<th>müşteri id</th>
	<th>ürün id</th>
	<th>sipariş formuyla gelen bilgiler</th>
	<th>eklenme tarihi</th></tr>
	<tr>
<?php 
require_once 'class.php';
session_start();
$_SESSION["sirketId"]=1;
$siparis = new siparis();
if(!empty($_POST)){
$siparis->siparisyaz("1",$_SESSION["sirketId"],"5");}
$liste = $siparis->siparis_liste($_SESSION["sirketId"]);
//var_dump($liste[0]);
for($i=0;$i<count($liste);$i++){?>

	  

<tr>
	<td><?=$liste[$i]["id"]?></td>
	<td><?=$liste[$i]["must_id"]?></td>
	<td><?=$liste[$i]["urun_id"]?></td>
	<td><?=$liste[$i]["siparis_bilgisi"]?></td>
	<td><?=$liste[$i]["eklenme_tarihi"]?></td></tr>
	<?php } ?>
	
</table>