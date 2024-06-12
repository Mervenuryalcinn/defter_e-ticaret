<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MONGA</title>
        <link rel="icon" href="../image/android-chrome-192x192.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/webproje.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/kısaözellikler.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
<body style="background-color: #ffe6f9 ;">
    <header class="header">
        <?php
            include ("../inc/dbBaglan.php"); 
            include ("../inc/header.php"); 
        ?>
    </header>
    <div class="favorite-wrapper">    
        <div class="favorite-header">
            <div class="favorite-header-wrapper">
                <div class="header-left-section">
                    <a class="active" href="../php/favoriler.php">
                        <i class="fas fa-heart"></i>
                        <span>Favoriler</span>
                    </a>
                </div>
                <div class="header-right-section">
                    <div class="searchbox">
                        <div class="clickoutside">
                            <input type="text" class="search-input" id="search-input"
                            placeholder="Favorilerimde ara" value>
                            <button id="search-btn">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    <section class="store1 my-5">
        <div class="row">
        <?php   
            if (!isset($_SESSION['kullanici_ID'])) {
                header("Location: girisyap.php");
                exit();
            }
            $kullanici_ID = $_SESSION['kullanici_ID'];

            $sql = "SELECT urunler.Urun_ID, urunler.UrunAdi, urunler.Aciklama, urunler.UrunFiyat, urunler.fotograf
            FROM favoriler JOIN urunler ON favoriler.Urun_ID = urunler.Urun_ID
            WHERE favoriler.Kullanici_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $kullanici_ID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $index = 0;
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-5 ' . ($index % 2 == 0 ? 'offset-2' : '') . ' my-5">';
                    echo '  <div class="row book-card">';
                    echo '      <div class="col-6">';
                    echo '          <img class="img-fluid shadow" src="' . htmlspecialchars($row['fotograf']) . '" width="258" height="400"/>';
                    echo '      </div>';
                    echo '      <div class="col-6 d-flex flex-column justify-content-between;">';
                    echo '          <div class="book-details">';
                    echo '              <span class="fs-4 fw-bold">' . htmlspecialchars($row['UrunAdi']) . '</span><br>';
                    echo '          </div>';
                    echo '          <p class="book-description fos gray">' . htmlspecialchars($row['Aciklama']) . '</p>';
                    echo '          <div>';
                    echo '              <span class="black fw-bold fs-4 me-2">' . htmlspecialchars($row['UrunFiyat']) . ' TL</span>';
                    echo '          </div>';
                    echo '          <button class="favorite-btn" onclick="removeFromFavorites(' . intval($row['Urun_ID']) . ')"><i style="font-size:22px" class="bi bi-trash"></i></button>';
                    echo '          <button class="btn-purple" onclick="addToBasket(' . intval($row['Urun_ID']) . ')">ADD BASKET</button>';
                    echo '      </div>';
                    echo '  </div>';
                    echo '</div>';
                    $index++;
                }
            } else {
                echo "<p style='font-size:large; font-weight:bold;'>Favori ürün bulunamadı.</p>";
            }

            $stmt->close();
            $conn->close();
        ?>
        </div>
    </section> 
    </div>   
<?php include ('../inc/footer.php') ?>