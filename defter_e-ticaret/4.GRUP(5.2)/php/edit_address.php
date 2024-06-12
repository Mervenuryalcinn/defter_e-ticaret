<?php
include('../inc/dbBaglan.php');
if (!isset($_SESSION["kullanici_ID"])) {
    header("Location: girisyap.php");
    exit();
}

$kullanici_ID = $_SESSION["kullanici_ID"];

if (isset($_GET['Adres_ID'])) {
    $id = $_GET['Adres_ID'];

    $stmt = $conn->prepare("SELECT * FROM adresbilgileri WHERE Adres_ID = ? AND Kullanici_ID = ?");
    $stmt->bind_param("ii", $id, $kullanici_ID); // Bind parameters
    $stmt->execute();
    $address = $stmt->get_result()->fetch_assoc();

    if (!$address) {
        echo "Adres bulunamadı veya bu adresi düzenleme yetkiniz yok.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['Siparis_Veren_AdiSoyad'];
        $phone = $_POST['Telefon'];
        $addressName = $_POST['Adres_basligi'];
        $addressLine = $_POST['Adres_Tanimi'];

        $stmt = $conn->prepare("UPDATE adresbilgileri SET Siparis_Veren_AdiSoyad = ?, Telefon = ?, Adres_basligi = ?, Adres_Tanimi = ? WHERE Adres_ID = ? AND Kullanici_ID = ?");
        $stmt->bind_param("ssssii", $name, $phone, $addressName, $addressLine, $id, $kullanici_ID); // Parametreleri bağlamak

        if ($stmt->execute()) {
            header('Location: AdresBilgileri.php');
            exit();
        } else {
            echo "Error updating address: " . $stmt->error;
        }
    }    
} else {
    echo "Adres ID'si sağlanmadı.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Address</title>
    <link rel="icon" href="../image/favicon-96x96.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/webproje.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/kısaözellikler.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background-color: #ffe6f9;">
    <header class="header">
    <?php 
        include ("../inc/header.php");
    ?>
    </header>
    <div id="addresses-page-container">
        <div class="addresses-page-wrapper">
            <div class="display-flex addresses-page-header">
                <div>
                    <span class="text color-bordo font-header-sm font-w-bold">Adres Bilgileri</span>
                </div>
                <a class="font-sm font-w-semi-bold">
                    <div class="addreses-page-header-add-address">
                        <button id="modalBtn" class="modalBtn secondary text color-bordo font-sm font-w-bold">Yeni Adres Ekle</button>
                    </div>
                </a>
            </div>
            <div class="display-flex address-page-content">
                <div class="display-flex bg-white flex-column">
                <?php if (isset($address)) { ?>
                    <form class="form1" action="edit_address.php?Adres_ID=<?= htmlspecialchars($address['Adres_ID']) ?>" method="POST">
                        <div class="display-flex flex-row form-group name-group">
                            <div class="display-flex color-black font-sm flex-column input-w">
                                <label class="text color-black font-sm font-w-bold mgb-1">Ad Soyad</label>
                                <input name="Siparis_Veren_AdiSoyad" class="bg-beige input textbox bordered input-medium" value="<?= htmlspecialchars($address['Siparis_Veren_AdiSoyad']) ?>" required>
                            </div>
                        </div>
                        <div class="display-flex flex-row form-group">
                            <div class="display-flex flex-row form-group phone-group">
                                <div class="display-flex color-black font-sm flex-column input-w">
                                    <label class="text color-black font-sm font-w-bold mgb-1">Telefon</label>
                                    <input name="Telefon" class="bg-beige input textbox bordered input-medium" value="<?= htmlspecialchars($address['Telefon']) ?>" required>
                                </div>
                            </div>
                            <div class="display-flex color-black font-sm flex-column input-w">
                                <label class="text color-black font-sm font-w-bold mgb-1">Adres Başlığı</label>
                                <input name="Adres_basligi" class="bg-beige input textbox bordered input-medium" value="<?= htmlspecialchars($address['Adres_basligi']) ?>" required>
                            </div>
                        </div>
                        <div class="display-flex color-black font-sm flex-column input-w">
                            <label class="text color-black font-sm font-w-bold mgb-1">Adres</label>
                            <textarea name="Adres_Tanimi" class="bg-beige input textarea bordered"><?= htmlspecialchars($address['Adres_Tanimi']) ?></textarea>
                        </div>
                        <div class="display-flex flex-row form-group">
                            <button type="submit" class="font-w-semi-bold button bordered transition input-medium primary">Kaydet</button>
                        </div>
                    </form>
                    <?php } else { ?>
                        <p>Adres bilgisi bulunamadı.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php include ('../inc/footer.php'); ?>
</body>
</html>
