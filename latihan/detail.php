<?php 
require "functions.php";

if (!isset($_GET["id"])) {
	header("Location: index2.php");
}

$id = mysqli_real_escape_string(koneksi(), $_GET["id"]);
$mhs = query("SELECT * FROM mahasiswa WHERE id='$id'");
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Detail Mahasiswa</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		img {
			width: 80px;
			height: 80px;
		}
	</style>
</head>
<body>

	<h1>Detail Mahasiswa</h1>

	<ul>
		<li>
			<img src="img/<?= htmlspecialchars($mhs['gambar']); ?>" alt="<?= htmlspecialchars($mhs['nama']); ?>">
		</li>
		<li>Nama : <?= htmlspecialchars($mhs["nama"]); ?></li>
		<li>Jurusan : <?= htmlspecialchars($mhs["jurusan"]); ?></li>
		<li>NRP : <?= htmlspecialchars($mhs["nrp"]); ?></li>
		<li>Email : <?= htmlspecialchars($mhs["email"]); ?></li>
		<li>
			<a href="#">Ubah</a> | <a href="#">Hapus</a>
		</li>
	</ul>

	<a href="index2.php">Kembali ke Daftar Mahasiswa</a>
	
</body>
</html>
