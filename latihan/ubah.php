<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "functions.php";

// Cek parameter id
if (!isset($_GET["id"])) {
  header("Location: index.php");
  exit;
}

// Ambil mahasiswa dengan id di url
$id = mysqli_real_escape_string(koneksi(), $_GET["id"]);
$mhs = query("SELECT * FROM mahasiswa WHERE id='$id'");


// Cek apakah tombol sudah ditekan & data sudah diisi
if (isset($_POST["ubah"]) && (
    !empty($_POST["nama"]) &&
    !empty($_POST["nrp"]) &&
    !empty($_POST["email"]) &&
    !empty($_POST["jurusan"]) &&
    !empty($_POST["gambar"]) &&
    !empty($_POST["id"])
   )) {

    if (ubah($_POST) > 0) {
	echo "<script>
	  alert('Mahasiswa berhasil diubah!');
	  document.location.href = 'index.php';
	</script>";
    } else {
    	echo "<script>
	  alert('Mahasiswa tidak diubah!');
	</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Mahasiswa</title>
    <link rel="stylesheet" href="css/form.css">
  </head>
  <body>
  
  <div>
    <h2>Ubah Mahasiswa</h2>
    <hr>
    <form method="post">
      <input type="hidden" name="id" value="<?= $mhs['id']; ?>">

      <label for="nama">Nama :</label>
      <input type="text" name="nama" id="nama" value="<?= $mhs['nama']; ?>" autocomplete="off" autofocus required>
      
      <label for="nrp">NRP :</label>
      <input type="number" name="nrp" id="nrp" value="<?= $mhs['nrp']; ?>" autocomplete="off" required>
      
      <label for="email">Email :</label>
      <input type="email" name="email" id="email" value="<?= $mhs['email']; ?>" autocomplete="off" required>
      
      <label for="jurusan">Jurusan :</label>
      <input type="text" name="jurusan" id="jurusan" value="<?= $mhs['jurusan']; ?>" autocomplete="off" required>
      
      <label for="gambar">Gambar :</label>
      <input type="text" name="gambar" id="gambar" value="<?= $mhs['gambar']; ?>" autocomplete="off" required>
      
      <button type="submit" name="ubah">Ubah</button>
    </form>
  </div>
    
  </body>
</html>
