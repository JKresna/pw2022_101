// Ajax Live Search
const keyword = document.querySelector(".keyword");
const tombolCari = document.querySelector(".tombol-cari");
const container = document.querySelector(".container");

tombolCari.style.display = "none";

keyword.addEventListener("keyup", () => {
  // 1. XMLHttpRequest
  /*
  const xhr = new XMLHttpRequest();

  xhr.onreadystatechange = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
	container.innerHTML = xhr.responseText;
    }
  };

  xhr.open("get", "ajax/pencarian.php?keyword=" + keyword.value);
  xhr.send();
  */

  // 2. Fetch
  fetch("ajax/pencarian.php?keyword=" + keyword.value)
    .then((response) => response.text())
    .then((response) => (container.innerHTML = response));
});
