<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONGA</title>
    <link rel="icon" href="../image/android-chrome-192x192.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/kısaözellikler.css">
    <link rel="stylesheet" href="../css/webproje.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #cart1 table{
            width: 90%;
            border-collapse: collapse;
            table-layout: fixed;
            white-space: nowrap;
            margin:auto;
            background-color:#fff;
        }

        #cart1 table td:nth-child(1) {
            width: 100px;
            text-align: center;
        }

        #cart1 table td:nth-child(2) {
            width: 150px;
            text-align: center;
        }

        #cart1 table td:nth-child(3) {
            width: 250px;
            text-align: center;
        }

        #cart1 table td:nth-child(4),
        #cart1 table td:nth-child(5),
        #cart1 table td:nth-child(6){
            width: 150px;
            text-align: center;
        }

        #cart1 table td:nth-child(5) input{
            width: 75px;
            padding: 10px 5px 10px 30px;
            cursor: pointer;
            font-size: 16px;
            color: var(--purple);
            font-weight: bold;
            background-color: transparent;
            transition: var(--transition);
            border: 2px solid var(--purple);
        }

        #cart1 table thead{
            border:1px solid #e2e9e1;
            border-left:none;
            border-right:none;
        }

        #cart1 table thead td{
            font-weight:700;
            text-transform:uppercase;
            font-size:13px;
            padding:18px 0;
        }

        #cart1 table tbody tr td{
            padding-top: 15px;
        }

        #cart1 table tbody  td{
            font-size:20px;
        }

        #cart-add{
            display: flex;
            flex-wrap:wrap;
            justify-content:space-between;
        }

        #aratoplam{
            width: 90%;
            margin:auto;
            border:2px solid #ddd;
            padding:30px;
            background-color:#fff;
        }

        #aratoplam table{
            border-collapse:collapse;
            width: 100%;
            margin-bottom:20px;
        }

        #aratoplam table td{
            width: 50%;
            border:1px solid #ddd;
            padding: 10px;
            font-size:13px;
        }

        #aratoplam h3{
            padding-bottom:15px;
        }

        #aratoplam button{
            background-color: #66004d;
            color:#fff;
            padding:12px 20px;
        }

    </style>    
</head>
<body style="background-color: #ffe6f9 ;">
<header class="header">
    <?php
        include('../inc/dbBaglan.php');
        include('../inc/header.php'); 
    ?>       
</header>
<div class="favorite-header">
    <div class="favorite-header-wrapper">
        <div class="header-left-section">
            <a class="active" href="../php/sepet.php">
                <i class="fas fa-shopping-cart"></i>
                <span>Sepetim</span>
            </a>
        </div>
    </div>    
</div>
<br>
<section id="cart1" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Sil</td>
                <td>Resim</td>
                <td>Ürün</td>
                <td>Fiyat</td>
                <td>Miktar</td>
                <td>Toplam</td>
            </tr>
        </thead>
        <tbody>
            <?php
            // Kullanıcı girişi kontrolü
                if (!isset($_SESSION['kullanici_ID'])) {
                    header("Location: ../php/girisyap.php");
                    exit();
                }
                $kullanici_ID = $_SESSION['kullanici_ID'];

                // Kart bilgilerini veri tabanından çekiyoruz
                $sql = "SELECT urunler.Urun_ID, urunler.UrunAdi, urunler.UrunFiyat, urunler.fotograf, sepetdetay.miktar
                        FROM sepetdetay
                        JOIN urunler ON sepetdetay.urun_id = urunler.Urun_ID
                        WHERE sepetdetay.kullanici_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $kullanici_ID);
                $stmt->execute();
                $result = $stmt->get_result();
                $toplamTutar = 0;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $toplamFiyat = $row["UrunFiyat"] * $row["miktar"];
                        $toplamTutar += $toplamFiyat;
                        echo "<tr>
                            <td><button class='basket-btn' onclick='removeFromBasket(" . $row['Urun_ID'] . ")'><i style='font-size:22px' class='bi bi-trash'></i></button></td>
                            <td><img src='" . $row["fotograf"] . "' alt='' width='120px' height='150px'></td>
                            <td>" . $row["UrunAdi"] . "</td>
                            <td>" . $row["UrunFiyat"] . "</td>
                            <td> 
                                <button class='miktar-btn' onclick='changeQuantity(" . $row['Urun_ID'] . ", -1)'>-</button>
                                <input  id='miktar-" . $row['Urun_ID'] . "' value='" . $row["miktar"] . "' min='1'>
                                <button class='miktar-btn' onclick='changeQuantity(" . $row['Urun_ID'] . ", 1)'>+</button>
                            </td>
                            <td id='total-" . $row['Urun_ID'] . "'>" . $toplamFiyat . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Sepetiniz boş</td></tr>";
                }
                $stmt->close();
                $conn->close();
            ?>
        </tbody>       
    </table>    
</section>
<br><br>
<section id="cart-add" class="section-p1">
    <div id="aratoplam">
        <h3>Sepet Toplam</h3>
        <table>
            <tr>
                <td>Sepet Ara Toplam</td>
                <td><?php echo number_format($toplamTutar, 2); ?> TL</td>
            </tr>
            <tr>
                <td>Kargo</td>
                <td>Ücretsiz</td>   
            </tr>
            <tr>
                <td><strong>Toplam</strong></td>
                <td><strong><?php echo number_format($toplamTutar, 2); ?> TL</strong></td>
            </tr>
        </table>
        <button class="normal">Ödeme İşlemi</button>    
    </div>   
</section>
<script>

function removeFromBasket(Urun_ID) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          confirm("Sepetten silmek istediğinize emin misiniz?");
          location.reload(); // Sayfayı yenile
      }
  };
  xhttp.open("GET", "sepetSil.php?Urun_ID=" + Urun_ID, true);
  xhttp.send();
}

function changeQuantity(Urun_ID, change) {
    var quantityInput = document.getElementById('miktar-' + Urun_ID);
    var newQuantity = parseInt(quantityInput.value) + change;
    if (newQuantity < 1) {
        newQuantity = 1;
    }
    quantityInput.value = newQuantity;
    updateTotal(Urun_ID, newQuantity);
}

function updateTotal(Urun_ID, miktar) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            document.getElementById('total-' + Urun_ID).innerText = response.totalPrice;
            document.getElementById('aratoplam').innerHTML = response.cartTotalHtml;
        }
    };
    xhttp.open("POST", "MiktarGuncelle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("Urun_ID=" + Urun_ID + "&miktar=" + miktar);
}
</script>
<?php include('../inc/footer.php'); ?>   