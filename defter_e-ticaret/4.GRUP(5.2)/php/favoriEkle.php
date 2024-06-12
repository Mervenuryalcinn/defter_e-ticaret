<?php
include('../inc/dbBaglan.php');

if (!isset($_SESSION['kullanici_ID'])) {
    header("Location: girisyap.php");
    exit();
}

if (isset($_POST['Urun_ID'])) {
    $kullanici_ID = $_SESSION['kullanici_ID'];
    $Urun_ID = $_POST['Urun_ID'];

    // Önce ürünün zaten favorilere eklenip eklenmediğini kontrol et
    $kontrolSql = "SELECT * FROM favoriler WHERE Urun_ID = ? AND Kullanici_ID = ?";
    $stmt = $conn->prepare($kontrolSql);
    $stmt->bind_param("ii", $Urun_ID, $kullanici_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Bu ürün zaten favorilerinize eklenmiş.";
    } else {
        $ekleSql = "INSERT INTO favoriler (Urun_ID, Kullanici_ID) VALUES (?, ?)";
        $stmt = $conn->prepare($ekleSql);
        $stmt->bind_param("ii", $Urun_ID, $kullanici_ID);

        if ($stmt->execute()) {
            echo "Ürün favorilere eklendi.";
        } else {
            echo "Ürün favorilere eklenirken bir hata oluştu.";
        }
    }    
    $stmt->close();
} else {
    echo "Geçersiz istek.";
}

$conn->close();

?>