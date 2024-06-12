// Modalı açma işlemi için JavaScript
var modal = document.getElementById('myModal');
var btn = document.getElementById("modalBtn");
var closeBtn = document.getElementsByClassName("close1")[0];

// Modalı aç
btn.onclick = function() {
  modal.style.display = "block";
}

// Modalı kapat
closeBtn.onclick = function() {
  modal.style.display = "none";
}

// Modal dışına tıklandığında kapat
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Form gönderildiğinde işlemler
var addressForm = document.getElementById('addressForm');
var addressDetails = document.getElementById('addressDetails');

form.addEventListener('submit', function(event) {
    event.preventDefault(); // Formun sayfa yenilenmeden gönderilmesini engeller
    var name = document.getElementById('name').value;
    var surname = document.getElementById('surname').value;
    var city = document.getElementById('city').value;
    var district = document.getElementById('district').value;
    var neighborhood = document.getElementById('neighborhood').value;
    var addressLine = document.getElementById('addressLine').value;
    var address = document.getElementById('addressName').value;

    // Adres bilgilerini oluştur
    var addressInfo=`
    <div class="display-flex bg-white flex-column addresses-page-content-box">
    <div class="display-flex addreses-page-content-box-header">
      <span class="text color-black font-md font-w-bold">${addressLine}</span>
    </div>
    <div class="display-flex flex-column address-page-content-box-body">
      <span class="text color-black font-sm font-w-bold">${name} ${surname}</span>
      <span class="text color-black font-sm">${neighborhood}</span>
      <span class="text color-black font-sm">${address}</span>
      <span class="text color-black font-sm">${district}/${city}</span>
    </div>
    <div class="display-flex flex-row address-page-content-box-actions">
      <a class="font-sm font-w-semi-bold">
        <div class="display-flex address-page-content-box-actions-delete">
          <i class="fas fa-trash"></i>
          <button type="button" class="font-w-semi-bold button1 input-small bordered transition secondary">Sil</button>
        </div>
      </a>
      <button type="button" class="font-w-semi-bold button bordered transition input-small secondary">Adresi Düzenle</button>
    </div>
  </div>
    `;

    // Adres bilgilerini göster
    addressDetails.innerHTML = addressInfo;

    // Modalı kapat
    var modal = document.getElementById('myModal');
    modal.style.display = "none";

    // Formu sıfırla (opsiyonel)
    addressForm.reset();
});
