<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<link rel="stylesheet" href="../css/sb-admin.css">
<?php

include('../inc/dbBaglan.php');


if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];
} else {
    echo '<script>swal("Hata","Geçersiz ID","error");</script>';
    exit;
}

$sorgu = $conn->prepare("SELECT * FROM admin WHERE id=?");
$sorgu->bind_param('i', $id);
$sorgu->execute();
$sonuc = $sorgu->get_result()->fetch_assoc();

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    $adminAdi = $_POST['adminAdi']; // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $parola = $_POST['parola'];
    $parolatekrar = $_POST['parolatekrar'];

    $hata = "";

    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. başka kontrollerde yapabilirsiniz.

    if ($adminAdi != "" && $parola != "" && $hata == "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        //Değişecek veriler
        if ($parola == $parolatekrar && $parola != '' && $adminAdi != '') {

            $sql = "UPDATE admin SET adminAdi=?, parola=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssi', $adminAdi, $parola, $id);
            $durum = $stmt->execute();

            if ($durum) {
                echo '<script>swal("Başarılı","Güncellendi","success").then((value)=>{ window.location.href = "Kullanicilar.php"});</script>';
                // Eğer güncelleme sorgusu çalıştıysa kullanicilar.php sayfasına yönlendiriyoruz.
            } else {
                echo '<script>swal("Hata","Güncelleme başarısız","error");</script>';
            }
        } else {
            echo '<script>swal("Hata","Hatalı, Lütfen Bilgilerinizi doğru girdiğinizden emin olunuz.","error");</script>'; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
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
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Kullanıcı Düzenle</li>
        </ol>


        <div class="card mb-3">

            <div class="card-body">

                <form method="post" action="" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input required type="text" value="<?= htmlspecialchars($sonuc["adminAdi"]) ?>" class="form-control" name="adminAdi"
                               placeholder="Üst başlık">
                    </div>

                    <div class="form-group">
                        <label>Yeni Parola</label>
                        <input required type="text" class="form-control" name="parola"
                               placeholder="Yeni Parola">
                    </div>
                    <div class="form-group">
                        <label>Parola Tekrar</label>
                        <input required type="text" class="form-control" name="parolatekrar"
                               placeholder="Parola Tekrar">
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                    </div>


                </form>


            </div>
        </div>


        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
<?php
$sorgu->close();
$conn->close();
?>