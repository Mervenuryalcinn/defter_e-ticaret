<?php
include ("../inc/dbBaglan.php");

if(isset($_POST['kayit'])){
    $adSoyad=$_POST['adSoyad'];
    $email=$_POST['email'];
    $password=$_POST['sifre'];
    $password_again=$_POST['sifretekrar'];
    if(!$email){
        echo "<p>Lütfen bir email değeri giriniz! </p>";
    }elseif(!$adSoyad){
        echo "<p>Lütfen geçerli bir ad soyad giriniz!</p>";
    }elseif(!$password){
        echo "<p>Lütfen bir şifre giriniz!</p>";
    }elseif(!$password && !$password_again){
        echo "<p>Lütfen şifrenizi giriniz!</h1>";
    }elseif($password != $password_again){
        echo "<p>Girdiğiniz şifreler birleriyle aynı değil!</p>";
    }else{
        $sorgu = $conn->prepare("INSERT INTO kullanici (email, sifre, adSoyad) VALUES (?, ?, ?)") ;
       $sorgu->bind_param("sss", $email, $password, $adSoyad);
        $ekle = $sorgu->execute();

        if ($ekle) {
            $_SESSION['email'] = $email;
            $_SESSION['kullanici_ID'] = $conn->insert_id;
            echo "<h2>Başarıyla kayıt yaptınız,yönlendiriliyorsunuz</h2>";
            header('Refresh:1;../php/girisyap.php');
            exit();
        } else {
            echo '<script>swal("Hata", "Kayıt sırasında bir hata oluştu", "error");</script>';
        }
    }
}

if (isset($_POST['giris'])) {
    $email = $_POST['email'];
    $password = $_POST['sifre'];

    if (!$email) {
        echo "<p>Lütfen bir email değeri giriniz!</p>";
    } elseif (!$password) {
        echo "<p>Lütfen bir şifre giriniz!</p>";
    } else {
        // Kullanıcıyı email ile sorgula
        $kullanici_sor = $conn->prepare("SELECT * FROM kullanici WHERE email = ?");
        if ($kullanici_sor) {
            $kullanici_sor->bind_param("s", $email);
            $kullanici_sor->execute();
            $result = $kullanici_sor->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                // Şifre kontrolü
                if ($row['sifre'] === $password) {
                    $_SESSION['email'] = $email;
                    $_SESSION['kullanici_ID'] = $row['kullanici_ID'];
                    echo "<h2>Başarıyla giriş yaptınız, yönlendiriliyorsunuz</h2>";
                    header('Refresh:1;../php/anasayfa.php');
                    exit();
                } else {
                    echo "<h2>Şifre yanlış ,tekrar deneyiniz!</h2>";
                    header('Refresh:1;../php/girisyap.php');
                    exit();
                }
            } else {
                echo "<h2>Kullanici bulunamadı, tekrar deneyiniz!</h2>";
                header('Refresh:1;../php/girisyap.php');
                exit();
            }
            $kullanici_sor->close();
        } else {
            echo "Veritabanı sorgu hatası: " . $conn->error;
        }
    }
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONGA</title>
    <link rel="icon" href="../image/favicon-96x96.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/kısaözellikler.css">
    <link rel="stylesheet" href="../css/webproje.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background-color:#ffe6f9 ;">
    
<?php include('../inc/footer.php'); ?>