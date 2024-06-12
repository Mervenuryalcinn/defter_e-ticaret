<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<link rel="stylesheet" href="../css/sb-admin.css">
<?php


include('../inc/dbBaglan.php');


$sorgu = $conn->prepare("SELECT * FROM admin WHERE id=?");
$sorgu->bind_param('i', $id);
$sorgu->execute();
$sonuc = $sorgu->get_result()->fetch_assoc();

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz

    $adminAdi = $_POST['adminAdi']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $parola = $_POST['parola'];
    $parolatekrar = $_POST['parolatekrar'];

    $hata = "";

    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. başka kontrollerde yapabilirsiniz.
    if ($adminAdi <> "" && $parola <> "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        //Değişecek veriler

        if ($parola == $parolatekrar && $parola != '' && $adminAdi != '') {
            $sql = "INSERT INTO admin SET adminAdi=?, parola=?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $adminAdi, $parola );
            $durum = $stmt->execute();

            if ($durum) {
                echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "adminpanel.php"});
                </script>';
                // Eğer güncelleme sorgusu çalıştıysa adminpanel.php sayfasına yönlendiriyoruz.
            }
        } else {
            echo '<script>swal("Hata","Hatalı , Lütfen bilgilerinizi kontrol ediniz.","error");</script>'; // Parolalar uyuşmuyorsa veya boşsa hata mesajı gösteriyoruz
        }
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
                <a href="adminpanel.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Admin Ekle</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input required type="text" class="form-control" name="adminAdi" placeholder="Kullanıcı Adınız">
                    </div>
                    <div class="form-group">
                        <label>Parola</label>
                        <input required type="text" class="form-control" name="parola" placeholder="Yeni Parola">
                    </div>
                    <div class="form-group">
                        <label>Parola Tekrar</label>
                        <input required type="text" class="form-control" name="parolatekrar" placeholder="Parolayı Tekrar Giriniz">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    <!-- /.container-fluid -->
</div>

<script src="js/aktifcustom.js"></script>
<link rel="stylesheet" type="text/css" href="css/switch.css">