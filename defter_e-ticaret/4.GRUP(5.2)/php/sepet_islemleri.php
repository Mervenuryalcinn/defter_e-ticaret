<?php
session_start();
include ('../inc/dbBaglan.php');

function addItemToBasket($conn, $productId) {
    $sql = "SELECT * FROM sepetdetay WHERE urun_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $sql = "UPDATE sepetdetay SET miktar = miktar + 1 WHERE urun_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
    } else {
        $sql = "INSERT INTO sepetdetay (urun_id, miktar) VALUES (?, 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
    }
    $stmt->execute();
    $stmt->close();
}

function removeItemFromBasket($conn, $productId) {
    $sql = "DELETE FROM sepetdetay WHERE urun_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $stmt->close();
}

function decreaseItemInBasket($conn, $productId) {
    $sql = "SELECT miktar FROM sepetdetay WHERE urun_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();
    if ($item['miktar'] > 1) {
        $sql = "UPDATE sepetdetay SET miktar = miktar - 1 WHERE urun_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
    } else {
        $sql = "DELETE FROM sepetdetay WHERE urun_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $productId);
    }
    $stmt->execute();
    $stmt->close();
}

function increaseItemInBasket($conn, $productId) {
    $sql = "UPDATE sepetdetay SET miktar = miktar + 1 WHERE urun_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $productId = isset($_POST['urun_id']) ? (int)$_POST['urun_id'] : 0;

    switch ($action) {
        case 'add':
            addItemToBasket($conn, $productId);
            break;
        case 'remove':
            removeItemFromBasket($conn, $productId);
            break;
        case 'decrease':
            decreaseItemInBasket($conn, $productId);
            break;
        case 'increase':
            increaseItemInBasket($conn, $productId);
            break;
    }
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

$conn->close();

?>