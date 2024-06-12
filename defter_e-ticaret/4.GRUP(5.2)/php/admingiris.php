<!DOCTYPE html>
<html lang="tr" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONGA</title>
    <link href="../css/webproje.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/kısaözellikler.css" rel="stylesheet">
    <link rel="icon" href="../image/favicon-96x96.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body style="background-color: #ffe6f9;">
    <header class="header">
        <?php  
        include ('../inc/header.php');   
        include("../inc/dbBaglan.php"); ?>
    </header>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $txtadminAdi = isset($_POST["txtadminAdi"]) ? htmlspecialchars($_POST["txtadminAdi"]) : '';
    $txtParola = isset($_POST["txtParola"]) ? htmlspecialchars($_POST["txtParola"]) : '';

    if (!empty($txtadminAdi) && !empty($txtParola)) {
        $sorgu = $conn->prepare("SELECT * FROM admin WHERE adminAdi = ? AND parola = ?");
        $sorgu->bind_param("ss", $txtadminAdi, $txtParola);
        $sorgu->execute();
        $sonuc = $sorgu->get_result()->fetch_assoc();

        if ($sonuc && $txtParola == $sonuc["parola"]) {
            $_SESSION["Oturum"] = "6789";
            $_SESSION["adminAdi"] = $txtadminAdi;

            if (isset($_POST["ckbHatirla"])) {
                setcookie("cerez", md5("aa" . $txtadminAdi . "bb"), time() + (60 * 60 * 24 * 7));
            }

            header("Location: adminpanel.php");
            exit;
        } else {
            $hataMesaji = "Kullanıcı adı veya parola yanlış!";
        }
    } else {
        $hataMesaji = "Lütfen kullanıcı adı ve parolayı doldurunuz!";
    }
}
?>

<form class="form2" method="post" >
    <h3> Admin Girişi </h3>
    <label for="adminAdi">Kullanıcı Adı</label>
    <input style="font-size: 14px;" type="text" name="txtadminAdi" value='<?php echo @$txtadminAdi ?>' id="inputadminAdi"
                               class="form-control" placeholder="Kullanıcı Adı" required autofocus>
                               <label for="inputPassword">Parola</label>
                               <input   style="font-size: 14px;" type="password" id="inputPassword" class="form-control" placeholder="Password" required
                               name="txtParola">
  <?php 
if ($_POST) {
    // Kullanıcı adı ve parolayı post verilerinden alıyoruz
    $txtadminAdi = isset($_POST['adminAdi']) ? $_POST['adminAdi'] : '';
    $txtParola = isset($_POST['adminParola']) ? $_POST['adminParola'] : '';

    // Kullanıcı adının boş olmadığından emin olun
    if (!empty($txtadminAdi)) {
        // Sorguda kullanıcı adını alıp ona karşılık parola var mı diye bakıyoruz
        $sorgu = $baglanti->prepare("SELECT parola FROM admin WHERE adminAdi = :adminAdi");
        $sorgu->execute(['adminAdi' => htmlspecialchars($txtadminAdi)]);
        $sonuc = $sorgu->fetch(); // Sorgu çalıştırılıp veriler alınıyor

        // Sorgunun başarılı olup olmadığını kontrol edin
        if ($sonuc) {
            // Parolaları doğrudan karşılaştırıyoruz
            if ($txtParola == $sonuc["parola"]) {
                $_SESSION["Oturum"] = "6789"; // Oturum oluşturma
                $_SESSION["adminAdi"] = $txtadminAdi;

                // Eğer beni hatırla seçilmiş ise cookie oluşturuyoruz
                if (isset($_POST["ckbHatirla"])) {
                    setcookie("cerez", md5("aa" . $txtadminAdi . "bb"), time() + (60 * 60 * 24 * 7));
                }
                header("Location: adminpanel.php"); // Sayfa yönlendirme
                exit;
            } else {
                // Eğer kullanıcı adı ve parola doğru girilmemiş ise hata mesajı verdiriyoruz
                $hataMesaji = "Kullanıcı adı veya parola yanlış!";
            }
        } else {
            $hataMesaji = "Kullanıcı adı veya parola yanlış!";
        }
    } else {
        $hataMesaji = "Lütfen kullanıcı adınızı giriniz.";
    }
}
?>



   
    <input type="submit" value="Create Account" style="font-size: 14px;">
</form>
</div>
<?php include ('../inc/footer.php'); ?>