<?php
    include ('../inc/dbBaglan.php');
    if (!isset($_SESSION["kullanici_ID"])) {
        header("Location: girisyap.php");
        exit();
    }

    $kullanici_ID = $_SESSION["kullanici_ID"];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["Siparis_Veren_AdiSoyad"]) && isset($_POST["email"]) && isset($_POST["cep_telefonu"])) {
            $Siparis_Veren_AdiSoyad = $_POST["Siparis_Veren_AdiSoyad"];
            $email = $_POST["email"];
            $cep_telefonu = $_POST["cep_telefonu"];
    
            $sql = "UPDATE kullanici SET adSoyad='$Siparis_Veren_AdiSoyad', email='$email', cep_telefonu='$cep_telefonu' WHERE kullanici_ID='$kullanici_ID'";
    
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Bilgileriniz başarıyla güncellendi');</script>";
                // header("refresh: 0; KullaniciBilgileri.php");
            } else {
                echo "<script>alert('Bilgileriniz güncellenirken bir hata oluştu');</script>";
            }
        }

        if (isset($_POST["eskisifre"]) && isset($_POST["yenisifre"]) && isset($_POST["yenisifretekrar"])) {
            if ($_POST["eskisifre"] == "" || $_POST["yenisifre"] == "" || $_POST["yenisifretekrar"] == "") {
                echo "<script>alert('Lütfen tüm alanları doldurunuz');</script>";
            } else if ($_POST["yenisifre"] != $_POST["yenisifretekrar"]) {
                echo "<script>alert('Şifreler eşleşmiyor');</script>";
            }else {
                $eskisifre = $_POST["eskisifre"];
                $yenisifre = $_POST["yenisifre"];
                $yenisifretekrar = $_POST["yenisifretekrar"];
                $sql1 = "SELECT sifre FROM kullanici WHERE kullanici_ID='$kullanici_ID'";
                $result1 = $conn->query($sql1);
    
                if ($result1->num_rows > 0) {
                    $sql2 = "UPDATE kullanici SET sifre='$yenisifretekrar' WHERE kullanici_ID='$kullanici_ID'";
                    if ($conn->query($sql2)) {
                        echo "<script>alert('Şifreniz güncellendi');</script>";
                    } else {
                        echo "<script>alert('Şifreniz güncellenirken bir hata oluştu');</script>";
                    }
                } else {
                    echo "<script>alert('Şifrenizi yanlış girdiniz');</script>";
                }
            }    
        }    
    }

    $sql = "SELECT * FROM kullanici WHERE kullanici_ID='$kullanici_ID'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Sorgu hatası: " . mysqli_error($conn));
    }
    
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MONGA</title>
        <link rel="icon" href="../image/android-chrome-192x192.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/webproje.css">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/forms.css">
        <link rel="stylesheet" href="../css/kısaözellikler.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
<body style="background-color: #ffe6f9 ;">
    <header class="header" >
        <?php
            include ("../inc/header.php");
        ?>
    </header>
    <div id="member-user-information">
        <div class="user-account-info">
            <div class="my-account-title">Kullanıcı Bilgilerim</div>
        </div>
        <div class="user-forms">
            <div class="form-section">
                <h1 class="text color-green font-header-md font-w-bold">Üyelik Bilgileri</h1>
                <form class="form-1 user-information-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="display-flex flex-row form-group form-group-stretched">
                        <div class="display-flex color-black font-md flex-column input-w">
                            <label class="text color-black font-sm font-w-bold  mgb-1" for="Siparis_Veren_AdiSoyad">Ad Soyad</label>
                            <input name="Siparis_Veren_AdiSoyad" autocomplete="off" class="bg-beige input textbox bordered input-large" value="<?php echo $row["adSoyad"];?>">
                            <!-- Aralarında boşluk bırakmak için kullandık-->
                            <div class="display-flex mgt-1">
                                <span class="text color-black font-sm font-w-bold"></span>
                                <span class="text color-soft-gray font-sm mgl-auto"></span>
                            </div>
                        </div>
                    </div>
                    <div class="display-flex flex-row form-group form-group-stretched">
                        <div class="display-flex color-black font-md flex-column input-w">
                            <label class="text color-black font-sm font-w-bold mgb-1" for="email">Email</label>
                            <input name="email" autocomplete="off" class="bg-beige input textbox bordered input-large" value="<?php echo $row["email"];?>">
                            <div class="display-flex mgt-1">
                                <span class="text color-black font-sm font-w-bold"></span>
                                <span class="text color-soft-gray font-sm mgl-auto"></span>
                            </div>
                        </div>
                    </div>
                    <div class="display-flex flex-row form-group form-group-stretched phone-input">
                        <div class="display-flex color-black font-md flex-column input-w">
                            <label class="text color-black font-sm font-w-bold mgb-1" for="cep_telefonu">Cep Telefonu</label>
                            <input name="cep_telefonu" autocomplete="off" class="bg-beige input-phone textbox bordered input-large" value="<?php echo $row["cep_telefonu"];?>">
                       </div>
                    </div><br>
                    <button type="submit" id="guncelleButonu" class="font-w-semi-bold button bordered transition input-large secondary">GÜNCELLE</button>
                </form>
            </div>
            <div class="divider"></div> <!--Araya çizgi koymak için kullanılır-->
            <div class="form-section">
                <h1 class="text color-green font-header-md font-w-bold">Şifre Güncelleme</h1>
                <form class="form-1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="display-flex1 flex-row form-group form-group-stretched">
                        <div class="password-wrapper">
                            <div class="password-input-area">
                                <div class="display-flex1 color-black font-md flex-colum input-w">
                                    <label class="text color-black font-sm font-w-bold mgb-1">Şu Anki Şifre</label>
                                    <input name="eskisifre" autocomplete="off" class="bg-beige input textbox bordered input-large" value type="password">
                                    <div class="display-flex1 mgt-1">
                                        <span class="text color-black font-sm font-w-bold"></span>
                                        <span class="text color-soft-gray font-sm mgl-auto"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="display-flex1 flex-row form-group form-group-stretched">     
                        <div class="password-wrapper">
                            <div class="password-input-area">
                                <div class="display-flex1 color-black font-md flex- column input-w">
                                    <label class="text color-black font-sm font-w-bold mgb-1">Yeni Şifre</label>
                                    <input name="yenisifre" autocomplete="off" class="bg-beige input textbox bordered input-large" value type="password">
                                    <div class="display-flex1 mgt-1">
                                        <span class="text color-black font-sm font-w-bold"></span>
                                        <span class="text color-soft-gray font-sm mgl-auto"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="display-flex1 flex-row form-group form-group-stretched">
                        <div class="password-wrapper">
                            <div class="password-input-area">
                                <div class="display-flex1 color-black font-md flex-column input-w">
                                    <label class="text color-black font-sm font-w-bold mgb-1">Yeni Şifre(Tekrar)</label>
                                    <input name="yenisifretekrar" autocomplete="off" class="bg-beige input textbox bordered input-large" value type="password">
                                    <div class="display-flex1 mgt-1">
                                        <span class="text color-black font-sm font-w-bold"></span>
                                        <span class="text color-soft-gray font-sm mgl-auto"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="font-w-semi-bold button bordered transition input-large secondary">GÜNCELLE</button>
                </form>
            </div>
        </div>
    </div>
<?php include('../inc/footer.php'); ?>