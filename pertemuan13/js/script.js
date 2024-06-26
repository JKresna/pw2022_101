const keyword = document.querySelector(".keyword");
const tombolCari = document.querySelector(".tombol-cari");
const container = document.querySelector(".container");

// Menyembunyikan tombol cari
tombolCari.style.display = "none";

// Event ketika keyword pencarian diketik
keyword.addEventListener("keyup", function() {
  // Ajax

  // 1. XMLHttpRequest
  //const xhr = new XMLHttpRequest();

  //xhr.onreadystatechange = function() {
  //  if (xhr.readyState == 4 && xhr.status == 200) {
  //    container.innerHTML = xhr.responseText;
  //  }
  //}

  //xhr.open("get", "ajax/ajax_cari.php?keyword=" + keyword.value);
  //xhr.send();

  // 2. Fetch
  fetch("ajax/ajax_cari.php?keyword=" + keyword.value) 
    .then((response) => response.text())
    .then((response) => (container.innerHTML = response));
});
