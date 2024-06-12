<?php 
if(!isset($_SESSION['kullanici_ID'])){
?>
        <div class="logo-menu">
            <a href="../php/index.php" class="logo">
                <img src="../image/LOGO2.png" alt="logo" style="width: 150px; height:100px;" />
            </a>
            <button id="menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <div id="menu" class="hidden">
                <ul>
                    <li><a href="../php/kitap.php"target="_self">Defter  </a></li>
                    <li> <a href="../php/ajanda.php"target="_self">Ajanda  </a></li>
                    <li><a href="../php/tumurunler.php"target="_self">Tüm Ürünler</a></li>
                 
                </ul>
            </div>
        </div>
        <div class="buttons">
            <button id="search-btn">
                <i class="fas fa-search" title="Arama Butonu"></i>
            </button>
            <div class="search-form hidden ">
                <input type="text" class="search-input"
                id="search-box" placeholder= "search here" />
                <i class="fas fa-search"></i>
            </div>
            <button id="cart-btn">
                <a href="../php/sepet.php">
                    <i class="fas fa-shopping-cart" title="Sepetim"></i>
                </a>
            </button>
            <button id="redirectButton">
                <a href="../php/girisyap.php">
                    <i class="fas fa-heart" title="Favoriler"></i>
                </a>
            </button>
            <button id="user-btn">
                <i class="fas fa-user" title="Hesabım"></i>
            </button>
            <div id="hesabım" class="hidden">
                <ul>
                    <li><a href="../php/girisyap.php">Giriş Yap</a></li>
                    <li><a href="../php/kayitol.php">Kayıt Ol</a></li>
                    <li><a href="../php/admingiris.php">Admin Girişi</a></li>
                </ul>
            </div>   
        </div>
<?php
}
else{
?>
<div class="logo-menu">
    <a href="../php/anasayfa.php" class="logo" >
        <img src="../image/LOGO2.png" alt="logo" style="width: 150px; height:100px;" />
    </a>
    <button id="menu-btn">
        <i class="fas fa-bars"></i>
    </button>
    <div id="menu" class="hidden">
        <ul>
            <li><a href="../php/kitap.php">Defter</a></li>
            <li><a href="../php/ajanda.php">Ajanda</a></li>
            <li><a href="../php/tumurunler.php">Tüm Ürünler</a></li>
        </ul>
    </div>
</div>
<div class="buttons">
    <button id="search-btn">
        <i class="fas fa-search" title="Arama Butonu"></i>
    </button>
    <div class="search-form hidden ">
        <input type="text" class="search-input" id="search-box" placeholder= "search here" />
        <i class="fas fa-search"></i>
    </div>
    <button id="cart-btn">
        <a href="../php/sepet.php">
            <i class="fas fa-shopping-cart" title="Sepetim"></i>
        </a>    
    </button>
    <button id="redirectButton">
        <a href="../php/favoriler.php">
            <i class="fas fa-heart" title="Favoriler"></i>
        </a>
    </button>
    <button id="user-btn">
        <i class="fas fa-user" title="Hesabım"></i>
    </button>
    <div id="hesabım" class="hidden">
        <ul>
            <li><a href="../php/KullanıcıBilgileri.php">Kişisel Bilgiler</a></li>
            <li><a href="../php/AdresBilgileri.php">Adres Bilgileri</a></li>
            <li><a href="../php/cikis.php"> Çıkış Yap  </a></li>
        </ul>
    </div>
</div>
<?php    
}
?>