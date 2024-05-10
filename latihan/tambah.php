<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "functions.php";

// Cek apakah tombol sudah ditekan & data sudah diisi
if (isset($_POST["tambah"]) && (
    !empty($_POST["nama"]) &&
    !empty($_POST["nrp"]) &&
    !empty($_POST["email"]) &&
    !empty($_POST["jurusan"]) &&
    !empty($_POST["gambar"])
   )) {

    if (tambah($_POST) > 0) {
	echo "<script>
	  alert('Mahasiswa berhasil ditambahkan!');
	  document.location.href = 'index.php';
	</script>";
    } else {
    	echo "<script>
	  alert('Mahasiswa gagal ditambahkan!');
	</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="css/form.css">
  </head>
  <body>
  
  <div>
    <h2>Tambah Mahasiswa</h2>
    <hr>
    <form method="post">
      <label for="nama">Nama :</label>
      <input type="text" name="nama" id="nama" autocomplete="off" autofocus required>
      
      <label for="nrp">NRP :</label>
      <input type="number" name="nrp" id="nrp" autocomplete="off" required>
      
      <label for="email">Email :</label>
      <input type="email" name="email" id="email" autocomplete="off" required>
      
      <label for="jurusan">Jurusan :</label>
      <input type="text" name="jurusan" id="jurusan" autocomplete="off" required>
      
      <label for="gambar">Gambar :</label>
      <input type="text" name="gambar" id="gambar" autocomplete="off" required>
      
      <button type="submit" name="tambah">Tambah</button>
    </form>
  </div>
    
  </body>
</html>
