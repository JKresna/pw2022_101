<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "function.php";

if (isset($_POST["tambah"]) && (
    !empty($_POST["nama"]) &&
    !empty($_POST["nrp"]) &&
    !empty($_POST["email"]) &&
    !empty($_POST["jurusan"]) &&
    !empty($_FILES["gambar"])
   )) {
	
    if (tambah($_POST) > 0) {
	echo "<script>
		alert('Data berhasil ditambahkan!');
		document.location.href = 'index.php';
	     </script>";
    } else {
	echo "Data gagal ditambahkan!";	
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/form.css">
  <title>Tambah Mahasiswa</title>
</head>
<body>

<div>
  <h2>Tambah Mahasiswa</h2>
  <hr>
 
  <form method="post" enctype="multipart/form-data">
    <label for="nama">Nama :</label>
    <input type="text" name="nama" id="nama" placeholder="Masukan nama anda" autocomplete="off" autofocus required>

    <label for="nrp">NRP :</label>
    <input type="number" name="nrp" id="nrp" placeholder="Masukan NRP anda" autocomplete="off" required>

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" placeholder="Masukan email anda" autocomplete="off" required>

    <label for="jurusan">Jurusan :</label>
    <input type="text" name="jurusan" id="jurusan" placeholder="Masukan jurusan anda" autocomplete="off" required>

    <label for="gambar">Gambar :</label>
    <input type="file" name="gambar" id="gambar">

    <button type="submit" name="tambah">Tambah</button>
  </form>
</div>

</body>
</html>
