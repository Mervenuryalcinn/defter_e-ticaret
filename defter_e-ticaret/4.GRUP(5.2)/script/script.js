const menuBtn = document.getElementById('menu-btn');
const menu = document.getElementById('menu');

menuBtn.addEventListener('click', function() {
    // Menünün görünürlüğünü kontrol et
    if (menu.classList.contains('hidden')) {
      // Menü gizliyse, göster
      menu.classList.remove('hidden');
    } else {
      // Açıksa, gizle
      menu.classList.add('hidden');
    }
});

const searchButton = document.getElementById('search-btn');
const searchForm = document.querySelector('.search-form');

searchButton.addEventListener('click', function() {
    // Arama formunun görünürlüğünü kontrol et
    if (searchForm.classList.contains('hidden')) {
        // Gizliyse, göster
        searchForm.classList.remove('hidden');
    } else {
        // Açıksa, gizle
        searchForm.classList.add('hidden');
    }
});

const userBtn = document.getElementById('user-btn');
const hesabım = document.getElementById('hesabım');

userBtn.addEventListener('click', function() {
    // Hesabın görünürlüğünü kontrol et
    if (hesabım.classList.contains('hidden')) {
      // Hesabım gizliyse, göster
      hesabım.classList.remove('hidden');
    } else {
      // Açıksa, gizle
      hesabım.classList.add('hidden');
    }
  });

document.getElementById("redirectButton").addEventListener("click", function() {
    // Yönlendirme yapılacak olan sayfanın URL'sini aşağıya yazınız
    window.location.href = "favoriler.php";
});

$(document).ready(function() {
  var slider = $('.slider');
  var images = slider.find('img');
  var imageWidth = images.first().width();
  var imageCount = images.length;
  var currentIndex = 0;

  setInterval(function() {
    currentIndex = (currentIndex + 1) % imageCount;
    updateSlider();
  }, 5000);

  function updateSlider() {
    var newPosition = -1 * currentIndex * imageWidth;
    slider.css('transform', 'translateX(' + newPosition + 'px)');
  }
});


function addToFavorites(Urun_ID) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          alert(this.responseText);
      } else if (this.readyState == 4 && this.status != 200) {
        alert("Bir hata oluştu, lütfen tekrar deneyin.");
      }
  };
  xhttp.open("POST", "favoriEkle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Urun_ID=" + Urun_ID);
}

function addToBasket(Urun_ID) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          alert(this.responseText);
      }else if (this.readyState == 4 && this.status != 200) {
        alert("Bir hata oluştu, lütfen tekrar deneyin.");
      }
  };
  xhttp.open("POST", "sepeteEkle.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("Urun_ID=" + Urun_ID);
}

function removeFromFavorites(Urun_ID) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          confirm("Favorilerden silmek istediğinize emin misiniz?");
          location.reload(); // Sayfayı yenile
      }
  };
  xhttp.open("GET", "favoriSil.php?Urun_ID=" + Urun_ID, true);
  xhttp.send();
}
