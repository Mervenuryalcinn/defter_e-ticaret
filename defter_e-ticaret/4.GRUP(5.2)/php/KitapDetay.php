<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONGA</title>
    <link rel="icon" href="../image/favicon-96x96.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/webproje.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/kısaözellikler.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .secenek {
            font-size: 2.3rem;
        }
        body {
            font-family: Arial, sans-serif;
        }
        .product-container {
            display: flex;
            margin: 20px;
        }
        .product-image {
            flex: 1;
            height: -webkit-fill-available;
        }
        .product-image img {
            max-width: 100%;
            height: auto;
            margin-left: 76px;
        }
        .product-details {
            flex: 2;
            margin-left: 20px;
        }
        .product-details h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        .product-details .sku {
            color: #888;
        }
        .product-details .price {
            font-size: 2rem;
            margin: 10px 0;
        }
        .product-details .quantity {
            margin: 10px 0;
            font-size: 1.8rem;
        }
        .product-details .quantity input {
            width: 50px;
            text-align: center;
        }
        .product-details button {
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
        }
        .add-to-cart {
            background-color: purple;
            color: white;
            border: none;
        }
        .buy-now {
            background-color: purple;
            color: white;
            border: none;
        }
        .product-info {
            margin-top: 20px;
        }
        .product-info h2 {
            font-size: 1.8rem;
        }
    </style>
</head>
<body>
<?php include('../inc/dbBaglan.php'); ?>
<header class="header">
    <?php 
    include "../inc/header.php"; 
    ?>   
</header>
<?php
// Get the product ID from the URL
$Urun_ID = $_GET['Urun_ID'];
$sql = "SELECT * FROM urunler WHERE Urun_ID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $Urun_ID);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the product details from the result set
$row = $result->fetch_assoc();

// Close the database connection
$stmt->close();


$sayfa_sql = "SELECT DISTINCT Sayfa_Ozelligi FROM kitap_ozellikleri";
$sayfa_result = $conn->query($sayfa_sql);

// Fetch edge types
$kenar_sql = "SELECT DISTINCT Kenar_Cesidi FROM kitap_ozellikleri";
$kenar_result = $conn->query($kenar_sql);

// Fetch book sizes
$buyukluk_sql = "SELECT DISTINCT Buyukluk FROM kitap_ozellikleri";
$buyukluk_result = $conn->query($buyukluk_sql);
?>

<!-- Display the product details on the page -->
<div class="product-container">
    <div class="product-image">
        <img src="<?php echo htmlspecialchars($row['fotograf']); ?>" width="258" height="400">
    </div>
    <div class="product-details">
        <h1><?php echo htmlspecialchars($row['UrunAdi']); ?></h1>
        <p class="price"><?php echo htmlspecialchars($row['UrunFiyat']); ?> TL</p>
        <form id="productForm">
            <div class="quantity">
                <label for="quantity">Miktar</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
            </div>
            <div class="secenek">
                <div>
                    <label class="menuler" for="Sayfa">Sayfa Özelligi</label>
                    <select id="Sayfa" name="Sayfa" required>
                        <?php while ($sayfa_row = $sayfa_result->fetch_assoc()) { ?>
                            <option value="<?php echo htmlspecialchars($sayfa_row['Sayfa_Ozelligi']); ?>">
                                <?php echo htmlspecialchars($sayfa_row['Sayfa_Ozelligi']); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <br/>
                </div>
                <div>
                    <label class="menuler" for="Kenar">Kenar Çesidi</label>
                    <select id="Kenar" name="Kenar" required>
                        <?php while ($kenar_row = $kenar_result->fetch_assoc()) { ?>
                            <option value="<?php echo htmlspecialchars($kenar_row['Kenar_Cesidi']); ?>">
                                <?php echo htmlspecialchars($kenar_row['Kenar_Cesidi']); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <br/>        
                </div>
                <div>
                    <label class="menuler" for="Büyüklük">Kitap Büyüklügü</label>
                    <select id="Büyüklük" name="Büyüklük" required>
                        <?php while ($buyukluk_row = $buyukluk_result->fetch_assoc()) { ?>
                            <option value="<?php echo htmlspecialchars($buyukluk_row['Buyukluk']); ?>">
                                <?php echo htmlspecialchars($buyukluk_row['Buyukluk']); ?>
                            </option>
                        <?php } ?>
                    </select>
                    <br/>
                </div>
            </div>
            <button type="button" class="favorite-btn" onclick="addToFavorites(<?php echo intval($row['Urun_ID']); ?>)">
                <i class="bi bi-heart"></i>
            </button>
            <button type="button" class="btn-purple" onclick="addToBasket(<?php echo intval($row['Urun_ID']); ?>)">
                ADD BASKET
            </button>     
        </form>
        <div class="product-info">
            <h2>Açıklama</h2>
            <p><?php echo htmlspecialchars($row['Aciklama']); ?></p>
        </div>
    </div>
</div>
<?php
$conn->close();
?>

<?php include "../inc/footer.php"; ?>
</body>
</html>