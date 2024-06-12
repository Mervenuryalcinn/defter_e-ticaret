<script type="text/javascript" src="../script/sweetalert.min.js"></script>
<link rel="stylesheet" href="../css/sb-admin.css">
<?php
include('../inc/dbBaglan.php');

// Veritabanı bağlantısını kontrol et
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Formdan gelen verileri al
    $UrunAdi = $_POST['UrunAdi'] ?? '';
    $UrunFiyat = $_POST['UrunFiyat'] ?? '';
    $uretimYili = $_POST['uretimYili'] ?? '';
    $Aciklama = $_POST['Aciklama'] ?? '';
    $stokMiktari = $_POST['stokMiktari'] ?? '';
    $kategori_ID = $_POST['kategori_ID'] ?? '';
    $hata = "";

    // Fotoğraf dosyasını işle
   

if (isset($_FILES['fotograf']) && $_FILES['fotograf']['error'] == 0) {
    // Dosya için hedef dizini belirleyelim
    $target_dir = "../image/";
    // Dosyanın hedef yolunu oluşturalım
    // $target_file = $target_dir. basename($_FILES["fotograf"]["name"]);
    // Dosya uzantısını alalım
    $fotograf = basename($_FILES["fotograf"]["name"]);
    $target_file = $target_dir. $fotograf;

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Yüklenen dosyanın bir resim olup olmadığını kontrol edelim
    $check = getimagesize($_FILES["fotograf"]["tmp_name"]);
    if ($check!== false) {
        // Dosyayı hedef dizine taşıyalım
        if (move_uploaded_file($_FILES["fotograf"]["tmp_name"], $target_file)) {
            $fotograf = basename($_FILES["fotograf"]["name"]);
        } else {
            $hata.= "Dosyanın yüklenmesinde bir hata oluştu.";
        }
    } else {
        $hata.= "Dosya bir resim değil.";
    }
}

    // Veritabanına veri ekle
    if ($UrunAdi != "" && $UrunFiyat != "" && $uretimYili != "" && $Aciklama != "" && $stokMiktari != "" && $kategori_ID != "" ) {
        $sql = "INSERT INTO urunler (UrunAdi, UrunFiyat, uretimYili, Aciklama, stokMiktari, kategori_ID, fotograf) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            $hata .= ' Veritabanı sorgusu hazırlanamıyor: ' . $conn->error;
        } else {
            $stmt->bind_param('sssssss', $UrunAdi, $UrunFiyat, $uretimYili, $Aciklama, $stokMiktari, $kategori_ID, $fotograf);
            $durum = $stmt->execute();
            if ($durum) {
                echo '<script>swal("Başarılı", "Ürün Eklendi", "success").then((value)=>{ window.location.href = "urunler.php"});</script>';
            } else {
                $hata .= ' Ürün eklenirken bir hata oluştu: ' . $stmt->error;
            }
        }
    } 
    if ($hata != "") {
        echo '<script>swal("Hata", "'.$hata.'", "error");</script>';
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
            <li class="breadcrumb-item active">Ürün Ekle</li>
        </ol>
        <!-- DataTables Example -->
        <div class="card mb=3">
            <div class="card-body">
                <form method="post" action="urunEkle.php"  enctype="multipart/form-data">
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
                        <label>Kategori ID</label>
                        <input required type="text" class="form-control" name="kategori_ID" placeholder="Kategori ID">
                    </div>


                    <div class="form-group">
    <label>Fotoğraf</label>
    <input required type="file" class="form-control" name="fotograf">

 
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                   
                </form>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</div>
<script src="../script/aktifcustom.js"></script>
<link rel="stylesheet" type="text/css" href="css/switch.css">