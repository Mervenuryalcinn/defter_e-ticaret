<?php
include ("../inc/dbBaglan.php");
if (!isset($_SESSION["kullanici_ID"])) {
    header("Location: girisyap.php");
    exit();
}

$kullanici_ID = $_SESSION["kullanici_ID"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['Siparis_Veren_AdiSoyad'];
    $phone = $_POST['Telefon'];
    $addressName = $_POST['Adres_basligi'];
    $addressLine = $_POST['Adres_Tanimi'];

    $stmt = $conn->prepare("INSERT INTO adresbilgileri (Siparis_Veren_AdiSoyad, Telefon, Adres_basligi, Adres_Tanimi,Kullanici_ID) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi",$name,$phone,$addressName,$addressLine,$kullanici_ID);
    
    if($stmt->execute()){
        header('Location: AdresBilgileri.php');
        exit();
    }else{
        echo "Adres ekleme hatası: ".$stmt->error;
    }
}
?>