<?php
include ("../inc/dbBaglan.php");
if (!isset($_SESSION['kullanici_ID'])) {
    header("Location: girisyap.php");
    exit();
}

// POST parametrelerinden verileri al
if (isset($_POST['Urun_ID'])) {
    $Urun_ID = $_POST['Urun_ID'];
    $kullanici_ID = $_SESSION['kullanici_ID'];

    $kontrolSql = "SELECT * FROM sepetdetay WHERE urun_id = ? AND kullanici_id = ?";
    $stmt = $conn->prepare($kontrolSql);
    $stmt->bind_param("ii", $Urun_ID, $kullanici_ID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $guncelleSql = "UPDATE sepetdetay SET miktar = miktar + 1 WHERE urun_id = ? AND kullanici_id = ?";
        $stmt = $conn->prepare($guncelleSql);
        $stmt->bind_param("ii", $Urun_ID, $kullanici_ID);

        if ($stmt->execute()) {
            echo "Sepetteki ürün miktarı güncellendi.";
        } else {
            echo "Ürün miktarı güncellenirken bir hata oluştu.";
        }
    }else {
        $ekleSql = "INSERT INTO sepetdetay (urun_id, kullanici_id,miktar) VALUES (?, ?,1)";
        $stmt = $conn->prepare($ekleSql);
        $stmt->bind_param("ii", $Urun_ID, $kullanici_ID);

        if ($stmt->execute()) {
            echo "Ürün sepete eklendi.";
        } else {
            echo "Ürün sepete eklenirken bir hata oluştu.";
        }
    }
    $stmt->close();
} else {
    echo "Geçersiz istek.";
}

$conn->close();
?>
