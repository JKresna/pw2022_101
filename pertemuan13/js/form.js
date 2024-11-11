function previewImage() {
  const gambar = document.querySelector(".gambar");
  const imgPreview = document.querySelector(".img-preview");

  // Buat object dari FileReader untuk read file gambar
  const oFReader = new FileReader();
  // readDataAsURL akan meng-encoding file menjadi 
  // Base64 agar menjadi data URL
  oFReader.readAsDataURL(gambar.files[0]);

  // Ubah atribut src imgPreview dgn gambar yang diupload
  oFReader.onload = function(oFREvent) {
    // Ubah atribut src dgn data yang sudah di-encoding
    imgPreview.src = oFREvent.target.result;
  }
}
