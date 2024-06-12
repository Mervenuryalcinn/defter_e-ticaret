<?php
include("../inc/dbBaglan.php");

if (isset($_GET['id'])) {
    $Urun_ID = (int)$_GET['id']; // URL'den ID'yi alıyoruz
    if ($Urun_ID > 0) {
        $sorgu = $conn->prepare("DELETE FROM urunler WHERE Urun_ID = ?");
        $sorgu->bind_param("i", $Urun_ID);
        $durum = $sorgu->execute();

        if ($durum) {
            header("location:urunler.php"); // Başarılı silme işleminden sonra adminpanel.php sayfasına yönlendiriyoruz
            exit;
        } else {
            echo "Ürün silinirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz ID.";
    }
} else {
    echo "ID bulunamadı.";
}
?>