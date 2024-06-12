<?php
ob_start();
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kitap_e-ticaret";

// Veritabanı bağlantısı oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Bağlantı Hatası: " . $conn->connect_error);
}
?>