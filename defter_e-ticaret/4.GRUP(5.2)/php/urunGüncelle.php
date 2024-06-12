<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<link rel="stylesheet" href="../css/sb-admin.css">
<?php

include('../inc/dbBaglan.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Post olup olmadığını kontrol ediyoruz.
    $UrunAdi = $_POST['UrunAdi'];
    $UrunFiyat = $_POST['UrunFiyat'];
    $uretimYili = $_POST['uretimYili'];
    $Aciklama = $_POST['Aciklama'];
    $stokMiktari = $_POST['stokMiktari'];
    $hata = '';

    if ($UrunAdi != "" && $UrunFiyat != "" && $uretimYili != "" && $Aciklama != "" && $stokMiktari != "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        // Veri güncelleme sorgumuzu yazıyoruz.
        $sql = "UPDATE urunler SET UrunFiyat=?, uretimYili=?, Aciklama=?, stokMiktari=? WHERE UrunAdi=?";
        $stmt = $conn->prepare($sql);
        if($stmt === false){
            $hata .= 'Veritabanı sorgusu hazırlanamıyor: ' . $conn->error;
        } else {
            $stmt->bind_param('sssss', $UrunFiyat, $uretimYili, $Aciklama, $stokMiktari, $UrunAdi);
            $durum = $stmt->execute();
            if ($durum){
                echo '<script>swal("Başarılı","Ürün güncellendi","success").then((value)=>{ window.location.href = "urunler.php"});</script>'; // Eğer güncelleme sorgusu çalıştıysa urunler.php sayfasına yönlendiriyoruz.
            } else {
                $hata .= 'Düzenleme hatası oluştu: ' . $stmt->error; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
            }
        }
    } else {
        $hata .= 'Lütfen tüm alanları doldurunuz.'; // Boş olan form elemanlarını kontrol edip hata döndürüyoruz.
    }
    if ($hata != "") {
        echo '<script>swal("Hata","' . $hata . '","error");</script>';
    }
}

?>
<script src="vendor/CKEditor5/ckeditor.js"></script>
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="urunler.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Ürün Güncelle</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label>Ürün Adı</label>
                        <input required type="text" class="form-control" name="UrunAdi" placeholder="Ürün Adı">
                    </div>
                    <div class="form-group">
                        <label>Ürün Fiyat</label>
                        <input required type="text" class="form-control" name="UrunFiyat" placeholder="Ürün Fiyat">
                    </div>
                    <div class="form-group">
                        <label>Üretim Yılı</label>
                        <input required type="text" class="form-control" name="uretimYili" placeholder="Üretim Yılı">
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <input required type="text" class="form-control" name="Aciklama" placeholder="Açıklama">
                    </div>
                    <div class="form-group">
                        <label>Stok Miktarı</label>
                        <input required type="text" class="form-control" name="stokMiktari" placeholder="Stok Miktarı">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</div>
<script src="js/aktifcustom.js"></script>
<link rel="stylesheet" type="text/css" href="css/switch.css">
