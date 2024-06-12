<?php

include("../inc/dbBaglan.php");

// Eğer GET isteği varsa
if ($_GET) {
    $id = (int)$_GET["id"]; // Gelen ID'yi alıyoruz
    if ($id > 0) {
        $sorgu = $conn->prepare("DELETE FROM admin WHERE id = ?");
        $sorgu->bind_param("i", $id);
        $durum = $sorgu->execute();

        if ($durum) {
            header("location:adminpanel.php"); // Eğer sorgu çalışırsa adminpanel.php sayfasına yönlendiriyoruz
            exit;
        } else {
            echo "Kullanıcı silinirken bir hata oluştu.";
        }
    } else {
        echo "Geçersiz ID.";
    }
} else {
    echo "ID bulunamadı.";
}
?>







