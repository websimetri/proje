<?php

class duyu
{

    public function duyuruListele ()
    {
        $listele = $this->db->query(
                "SELECT * FROM duyuru ");
        echo "<table>";
        echo "<h2>Duyuru Yönetimi</h2>";
        echo "<h3>Duyuru Listesi</h3>";
        echo '<tr>
                    <th> DUYURU BAŞLIĞI</th>
                    <th> DUYURU DETAYI</th>
                    <th> DURUM</th></tr>';
        echo "<a href='?islem=yeniekle'>Yeni Duyuru Ekle</a>";            
        while ($row = $listele->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>
                    <td>' . $row["duyuru_baslik"] . '</td>
                    <td>' . $row["duyuru_detay"] . '</td>
                    <td>' . $row["durum"] . '</td>
                    <td><a href="?islem=duzenle&id=' . $row["id"] . '">Düzenle</a></td>
                    <td><a href="?islem=sil&id=' . $row["id"] . '">Sil</a></td>
                  </tr>';

        }
        echo "</table>";
    }

    public function duyuruDuzenle ($id)
    {
        $listele = $this->db->query(
                "SELECT * FROM duyuru WHERE id = $id");
        $duyuru = $listele->fetch(PDO::FETCH_ASSOC);
        global $islembaslik;
        global $islem;
        global $duzenleid;
        global $basliktmpl;
        global $detaytmpl;
        global $checked1;
        global $checked2;
        $islembaslik = "DUYURU DÜZENLEME EKRANI";
        $islem = "duzenle";
        $duzenleid = $duyuru["id"];
        $basliktmpl = $duyuru["duyuru_baslik"];
        $detaytmpl = $duyuru["duyuru_detay"];
        if ($duyuru["durum"] == 1) {
            $checked1 = "checked";
        } elseif ($duyuru["durum"] == 0) {
            $checked2 = "checked";
        }
    }

    public function duyuruDuzenleKaydet ($id)
    {
        if ($this->girisKontrol() == 1) {
            $kayitDuzenle = $this->db->prepare(
                    "UPDATE `duyuru` SET `duyuru_baslik`=?,`duyuru_detay`=?,`durum`=? WHERE id = $id");
            if ($kayitDuzenle->execute(
                    array(
                            $_POST["baslik"],
                            $_POST["detay"],
                            $_POST["durum"]
                    ))) {
                echo "<script>alert('güncelleme başarılı');</script>";
                echo "<script>window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('güncelleme başarısız');</script>";
            }
        } else {
            echo "<script>alert('içeriklerin bir ya da birkaçı boş');</script>";
        }
    }

    public function duyuruSil ($id)
    {
        if ($this->db->exec("DELETE FROM duyuru WHERE id = $id")) {
            echo "<script>alert('içerik silindi');</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('silme başarısız');</script>";
        }
    }
}

?>