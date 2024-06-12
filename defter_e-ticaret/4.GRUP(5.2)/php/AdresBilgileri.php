<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONGA</title>
    <link rel="icon" href="../image/android-chrome-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/webproje.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/kısaözellikler.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
    function deleteAddress(Adres_ID) {
        console.log("Deleting address with ID:", Adres_ID);
            if (confirm("Adresi silmek istediğine emin misin?")) {
            window.location.href = 'delete_address.php?Adres_ID=' + Adres_ID;
            }
    }
    function editAddress(Adres_ID) {
        window.location.href = 'edit_address.php?Adres_ID=' + Adres_ID;
    }
</script>
</head>
<body style="background-color: #ffe6f9;">
    <header class="header">
        <?php
            include ("../inc/dbBaglan.php"); 
            include ('../inc/header.php'); 
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
        <div class="display-flex address-page-content" style="font-size:20px;">
            <?php
                if (!isset($_SESSION["kullanici_ID"])) {
                    header("Location: girisyap.php");
                    exit();
                }
                $kullanici_ID = $_SESSION["kullanici_ID"];

                $stmt = $conn->prepare("SELECT * FROM adresbilgileri where kullanici_ID=?");
                $stmt->bind_param("i",$kullanici_ID);
                $stmt->execute();
                $addresses = $stmt->get_result();

                if ($addresses->num_rows > 0) {
                    $index = 0; 
                    while($address = $addresses->fetch_assoc()) {
                        ?>
                        <div class="display-flex bg-white flex-column addresses-page-content-box">
                            <div class="display-flex addreses-page-content-box-header">
                                <span class="text color-black font-md font-w-bold"><?php echo htmlspecialchars($address['Adres_basligi']); ?></span>
                            </div>
                            <div class="display-flex flex-column address-page-content-box-body">
                                <span class="text color-black font-sm font-w-bold"><?php echo htmlspecialchars($address['Siparis_Veren_AdiSoyad']); ?></span>
                            </div>
                            <div class="display-flex flex-column address-page-content-box-body">    
                                <span class="text color-black font-sm "><?php echo htmlspecialchars($address['Adres_Tanimi']); ?></span>
                            </div>
                            <div class="display-flex flex-column address-page-content-box-body">    
                                <span class="text color-black font-sm"><?php echo htmlspecialchars($address['Telefon']); ?></span>
                            </div>
                            <div class="display-flex flex-row address-page-content-box-actions">
                                <a class="font-sm font-w-semi-bold">
                                    <div class="display-flex address-page-content-box-actions-delete">
                                        <i class="fas fa-trash"></i>
                                        <button type="button" class="font-w-semi-bold button1 input-smallbordered transition secondary" onclick="deleteAddress(<?php echo intval($address['Adres_ID']); ?>)">Sil</button>
                                    </div>
                                </a>
                                <button type="button" class="font-w-semi-bold button bordered transition input-medium secondary" onclick="editAddress(<?php echo intval($address['Adres_ID']); ?>)">Adresi Düzenle</button>
                            </div>
                        </div>
                        <?php
                        $index++;
                    }
                } else {
                    echo "Adres bulunamadı.";
                }
                $stmt->close();
                $conn->close();    
            ?>
        </div>
    </div>
</div>
<div id="myModal" class="modal1">
    <div class="modal-content1 relative user-address-modal">
        <span class="close1">&times;</span>
        <div class="modal-header1">
            <span class="text color-black font-md font-w-bold">Adres Ekle</span>
        </div>
        <div class="modal-wrapper1">
            <div class="address-form">
                <form class="form1" action="save_address.php" method="POST">
                    <div class="display-flex flex-row form-group name-group">
                        <div class="display-flex color-black font-sm flex-column input-w">
                            <label class="text color-black font-sm font-w-bold mgb-1">Ad Soyad</label>
                            <input name="Siparis_Veren_AdiSoyad" class="bg-beige input textbox bordered input-medium" value required>
                        </div>
                    </div>
                    <div class="display-flex flex-row form-group">
                        <div class="display-flex flex-row form-group phone-group">
                            <div class="display-flex color-black font-sm flex-column input-w">
                                <label class="text color-black font-sm font-w-bold mgb-1">Telefon</label>
                                <input name="Telefon" class="bg-beige input textbox bordered input-medium" value="0(___) ___ __ __" required>
                            </div>
                        </div>
                        <div class="display-flex color-black font-sm flex-column input-w">
                            <label class="text color-black font-sm font-w-bold mgb-1">Adres Başlığı</label>
                            <input name="Adres_basligi" placeholder=" " class="bg-beige input textbox bordered input-medium" value required>
                        </div>
                    </div>
                    <div class="display-flex color-black font-sm flex-column input-w">
                        <label class="text color-black font-sm font-w-bold mgb-1">Adres</label>
                        <textarea placeholder name="Adres_Tanimi" class="bg-beige input textarea bordered"></textarea>
                    </div>
                    <div class="display-flex flex-row form-group">
                        <button type="submit" class="font-w-semi-bold button bordered transition input-medium primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  
<?php include ('../inc/footer.php'); ?>