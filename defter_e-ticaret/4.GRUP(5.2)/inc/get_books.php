<?php
include('../inc/dbBaglan.php');
$books = []; // Boş bir dizi olarak tanımla

$sql = "SELECT Urun_ID, UrunAdi, Aciklama, UrunFiyat, fotograf, stokMiktari FROM urunler";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
    $booksJson = json_encode($books);
} else {
    $booksJson = json_encode([]);
}

$conn->close();
?>