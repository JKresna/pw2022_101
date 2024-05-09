<?php 
require "functions.php";

if (!isset($_GET["id"])) {
  header("Location: index.php");
  exit;
}

// Ambil mahasiswa dengan id yang ada di URL
$id = mysqli_real_escape_string(koneksi(), $_GET["id"]);
$mhs = query("SELECT * FROM mahasiswa WHERE id='$id'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Mahasiswa</title>
  <style>
    img {
	width: 100px;
	height: 100px;
    }

    ul li a {
	text-decoration: none;
    }
  </style>
</head>
<body>

  <h3>Detail Mahasiswa</h3>

  <ul>
    <li>
      <img src="img/<?= htmlspecialchars($mhs['gambar']); ?>" alt="Profil">
    </li>
    <li>Nama : <?= htmlspecialchars($mhs['nama']); ?></li>
    <li>NRP : <?= htmlspecialchars($mhs['nrp']); ?></li>
    <li>Jurusan : <?= htmlspecialchars($mhs['jurusan']); ?></li>
    <li>Email : <?= htmlspecialchars($mhs['email']); ?></li>
    <li>
      <a href="ubah.php?id=<?= $mhs['id'];?>">Ubah</a> | <a href="hapus.php?id=<?= $mhs['id'];?>" onclick="return confirm('Anda Yakin?');">Hapus</a>
    </li>
  </ul>

  <br><br>
  <a href="index.php">Kembali ke daftar mahasiswa</a>

</body>
</html>
