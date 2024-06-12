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
    $stmt =$conn->prepare("DELETE FROM sepetdetay WHERE urun_id = ? and kullanici_id = ?");
    $stmt->bind_param("ii", $urunID,$kullanici_ID); // ID'yi bağlamak
    if ($stmt->execute()) {
        header('Location: sepet.php');
        exit();
    } else {
        echo "Bir hata oluştu: " . $stmt->error;
    }
} else {
    echo "Geçersiz ürün ID.";
}
?>
