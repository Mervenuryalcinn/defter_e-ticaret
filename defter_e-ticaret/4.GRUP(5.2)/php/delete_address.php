<?php
include('../inc/dbBaglan.php');

if (isset($_GET['Adres_ID'])) {
    $id = $_GET['Adres_ID'];
    $stmt = $conn->prepare("DELETE FROM adresbilgileri WHERE Adres_ID = ?");
    $stmt->bind_param("i", $id); // ID'yi bağlamak
    if ($stmt->execute()) {
        header('Location: AdresBilgileri.php');
        exit();
    } else {
        echo "Error deleting address: " . $stmt->error;
    }
} else {
    echo "Adres ID'si sağlanmadı.";
}
?>
