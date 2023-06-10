<?php 
require "functions.php";

// Cek apakah tombol tambah sudah dipencet
// dan semua field sudah di isi
if (isset($_POST["tambah"]) && (
		!empty($_POST["nama"]) &&
		!empty($_POST["nrp"]) &&
		!empty($_POST["email"]) &&
		!empty($_POST["jurusan"]) &&
		!empty($_POST["gambar"])
	)) {
	
	if (tambah($_POST) > 0) {
		echo "<script>
			alert('Data berhasil ditambahkan!');
			document.location.href = 'index2.php';
		</script>";
	} else {
		echo "<script>
			alert('Data gagal ditambahkan!');
		</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, inital-scale=1.0">
	<title>Tambah Mahasiswa</title>
	<link rel="stylesheet" href="css/tambah.css">
</head>
<body>

<div class="form">

	<h3>Tambah Mahasiswa</h3>
	<hr>

	<form method="post">
		<label>Nama :
			<input type="text" name="nama" placeholder="Masukan nama" autocomplete="off" required>
		</label>

		<label>NRP :
			<input type="number" name="nrp" placeholder="Masukan nomor NRP" autocomplete="off" required>
		</label>

		<label>Email :
			<input type="email" name="email" placeholder="Masukan email" autocomplete="off" required>
		</label>

		<label>Jurusan :
			<input type="text" name="jurusan" placeholder="Masukan jurusan" autocomplete="off" required>
		</label>

		<label>Gambar :
			<input type="text" name="gambar" placeholder="Masukan nama gambar" autocomplete="off" required>
		</label>

		<button type="submit" name="tambah">Tambah Data</button>
	</form>
</div>

<a href="index2.php">Kembali</a>

</body>
</html>
