<?php 
require "function.php";

// Jika parameter id tidak ada
if (!isset($_GET["id"])) {
	header("Location: latihan2.php");
}

$id = mysqli_real_escape_string(koneksi(), $_GET["id"]);
$mahasiswa = query("SELECT * FROM mahasiswa WHERE id='$id'");

?>		
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Detail Mahasiswa</title>
	<style>
		body {font-family: arial, sans-serif;}
		
		img {
			width: 100px;
			height: 100px;
		}
	</style>
</head>
<body>

	<h3>Detail Mahasiswa</h3>

	<ul>
		<li>
			<img src="img/<?= $mahasiswa['gambar']; ?>" alt="Gambar <?= $mahasiswa['nama']; ?>">
		</li>
		<li>Nama : <?= $mahasiswa["nama"]; ?></li>
		<li>NRP : <?= $mahasiswa["nrp"]; ?></li>
		<li>Email : <?= $mahasiswa["email"]; ?></li>
		<li>Jurusan : <?= $mahasiswa["jurusan"]; ?></li>
		<li>
			<a href="#">Ubah</a> | <a href="#">Hapus</a>
		</li>
	</ul>

	<br><br>

	<a href="latihan2.php">Kembali ke Daftar Mahasiswa</a>

</body>
</html>
