<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MONGA</title>
        <link rel="icon" href="../image/android-chrome-192x192.png" type="image/x-icon">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/kısaözellikler.css">
        <link rel="stylesheet" href="../css/webproje.css"> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
<body style="background-color:#ffe6f9; ">
    <header class="header">
        <?php 
            include ("../inc/header.php"); 
        ?>
    </header>
    <form id="GirişYap2" action="../php/islem.php" method="post">
        <h1>Giriş Yap</h1>
        <div>
            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" required class="text3" placeholder="Email">
        </div><br>
        <div>
            <label for="sifre">Şifre:</label>
            <input type="password" id="sifre" name="sifre" required class="password3" placeholder="Şifre">
        </div><br>
        <div>
            <input style="background-color:#66004d ;" type="submit" value="Giriş Yap" class="submit2" name="giris">
            <p>Hesabınız yokmu?<a href="../php/kayitol.php" >Kayıt Oluştur</a></p>
        </div><br>   
    </form>
    <div id="uyarilar"></div>  
    <style>
    /*---------footer----------*/
.footer{
 background-color:#66004d;;
 color:white;
 width:100%;
 margin-top:500px;
 padding: 20px;
 
}
.end{
  text-align:center;
  padding-bottom:10px;
}

.logo1{
width:250px;
height:100px;
padding-left:40px;
padding-top:20px;
}
.linkk{
color:white;
}
.linkk:hover{
color:yellow;
}
.linkUp{
 padding-right:40px;
 padding-top:30px;
 float:right;
 
}
.container {
  display: flex;
  flex-direction: column;
  min-height: 100vh; /* or any other height value */
}


</style>
<div class="footer">
<div> <img src="../image/LOGO2.png" height:5px weight:2px class="logo1"><a href="../php/anasayfa.php"><i class="fa fa-angle-double-up fa-4x linkUp linkk" ></i></a></div>

<div class="row" style="width:100%;padding-left:60px;padding-top:30px;padding-bottom:20px;">

<div class="col-md-4"><b><h5 style="color:white;"><i class="fa fa-paper-plane-o" ></i>&nbsp;Contact Info :</h5></b>
<b style="color:white">
Mobile: +90 5071586962</b><br>
<b style="color:white">
Email: Merve@gmail.com</b>
<br>
<b style="color:white;">HERHANGİ BİR SORU İÇİN</b><br><i class="fa fa-phone"></i>&nbsp;
<b style="color:white;"> 05071586962
</b><br>
</div>
<div class="col-md-4">
    <h5 style="color: white;">
        <b  style="color:white;"><i class="fa fa-clock-o"></i>&nbsp;Office Hours :</b>
    </h5>
<b style="color:white">
7.30Am to 7.00Pm (Mon To Sat)</b><br>
<b style="color:white"> 7.30Am to 5.00Pm (Sunday)</b><br>
<b style="color:white"> Center hours as per Class schedule</b><br>
<br>
</div>
<div class="col-md-4"><b><h5 style="color:white">Social Media</h5></b>
<a href="https://www.facebook.com/" target="_blank" class="linkk" style="font-size:15px;">
<i style="padding-bottom:8px;" class="fa fa-facebook-official linkk" >&nbsp; Facebook</i></a><br>
<a href="https://twitter.com/" target="_blank" class="linkk" style="font-size:15px;">
<i style="padding-bottom:8px;"class="fa fa-twitter linkk" >&nbsp; Twitter</i></a><br> 
<a href="https://www.instagram.com/" target="_blank" class="linkk" style="font-size:15px;">
<i style="padding-bottom:8px;"class="fa fa-instagram linkk"> &nbsp;Instagram</i></a><br>
<a href="https://www.youtube.com/" target="_blank" class="linkk" style="font-size:15px;">
<i style="padding-bottom:8px;"class="fa fa-youtube-play linkk"> &nbsp;YouTube</i></a>
</div>
</div>
<div class="end">
<hr color="white"><p style="color:white">Copyright <i class="fa fa-at" aria-hidden="true"></i> 2024. MONGA All rights reserved</p></div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../script/script.js"></script>
    <script src="../script/Yeni-adres.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/jquery/jquery.min.js"></script>
    <script src="../assets/toastr/toastr.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
