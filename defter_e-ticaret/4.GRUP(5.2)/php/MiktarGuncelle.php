<?php
include('../inc/dbBaglan.php');

$urun_ID = $_POST['Urun_ID'];
$quantity = $_POST['miktar'];
$kullanici_ID = $_SESSION['kullanici_ID'];

// Update quantity in the cart
$sql = "UPDATE sepetdetay SET miktar = ? WHERE urun_id = ? AND kullanici_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $quantity, $urun_ID, $kullanici_ID);
$stmt->execute();
$stmt->close();

// Fetch updated cart details
$sql = "SELECT urunler.Urun_ID, urunler.UrunFiyat, sepetdetay.miktar
        FROM sepetdetay
        JOIN urunler ON sepetdetay.urun_id = urunler.Urun_ID
        WHERE sepetdetay.kullanici_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $kullanici_ID);
$stmt->execute();
$result = $stmt->get_result();

$toplamTutar = 0;
while ($row = $result->fetch_assoc()) {
    $toplamTutar += $row["UrunFiyat"] * $row["miktar"];
}

$response = [
    'totalPrice' => number_format($row["UrunFiyat"] * $quantity, 2) . ' TL',
    'cartTotalHtml' => '<h3>Sepet Toplam</h3><table><tr><td>Sepet Ara Toplam</td><td>' . number_format($toplamTutar, 2) . ' TL</td></tr><tr><td>Kargo</td><td>Ücretsiz</td></tr><tr><td><strong>Toplam</strong></td><td><strong>' . number_format($toplamTutar, 2) . ' TL</strong></td></tr></table><button class="normal">Ödeme İşlemi</button>'
];

echo json_encode($response);

$conn->close();
?>
