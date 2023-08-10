<?php 
require "function.php";

// Jika parameter id tidak ada
if (!isset($_GET["id"])) {
	header("Location: index.php");
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
			<img src="img/<?= htmlspecialchars($mahasiswa['gambar']); ?>" alt="Gambar <?= htmlspecialchars($mahasiswa['nama']); ?>">
		</li>
		<li>Nama : <?= htmlspecialchars($mahasiswa["nama"]); ?></li>
		<li>NRP : <?= htmlspecialchars($mahasiswa["nrp"]); ?></li>
		<li>Email : <?= htmlspecialchars($mahasiswa["email"]); ?></li>
		<li>Jurusan : <?= htmlspecialchars($mahasiswa["jurusan"]); ?></li>
		<li>
			<a href="#">Ubah</a> | <a href="hapus.php?id=<?= $mahasiswa['id']; ?>" onclick="return confirm('Anda Yakin?');">Hapus</a>
		</li>
	</ul>

	<br><br>

	<a href="index.php">Kembali ke Daftar Mahasiswa</a>

</body>
</html>
