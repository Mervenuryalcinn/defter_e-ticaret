<?php
include ("../inc/dbBaglan.php"); 
if (!isset($_SESSION['kullanici_ID'])) {
    header("Location: girisyap.php");
    exit();
}

if (isset($_GET['Urun_ID'])) {
    $urunID = $_GET['Urun_ID'];
    $kullanici_ID = $_SESSION['kullanici_ID'];

    // SQL query to delete the product from the favorites
    $stmt =$conn->prepare("DELETE FROM favoriler WHERE Urun_ID = ?");
    $stmt->bind_param("i", $urunID); // ID'yi bağlamak
    if ($stmt->execute()) {
        header('Location: favoriler.php');
        exit();
    } else {
        echo "Bir hata oluştu: " . $stmt->error;
    }
} else {
    echo "Geçersiz ürün ID.";
}
?>

