<?php 
require "function.php";

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
				document.location.href = 'latihan2.php';
		</script>";
	} else {
		echo "<script>
				alert('Data gagal ditambahkan!');
				document.location.href = 'latihan2.php';
		</script>";	
	}

}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Mahasiswa</title>
	<link rel="stylesheet" href="css/tambah.css">
</head>
<body>

	<div>
		<h2>Tambah Mahasiswa</h2>
		<hr>
		<form method="post">
			<label for="nama">Nama :</label>
			<input type="text" name="nama" id="nama" placeholder="Masukan nama anda" autocomplete="off" autofocus required>

			<label for="nrp">NRP :</label>
			<input type="number" name="nrp" id="nrp" placeholder="Masukan NRP anda" autocomplete="off" required>

			<label for="email">Email :</label>
			<input type="email" name="email" id="email" placeholder="Masukan email anda" autocomplete="off" required>

			<label for="jurusan">Jurusan :</label>
			<input type="text" name="jurusan" id="jurusan" placeholder="Masukan jurusan anda" autocomplete="off" required>

			<label for="gambar">Gambar :</label>
			<input type="text" name="gambar" id="gambar" placeholder="Masukan nama gambar anda" autocomplete="off" required>

			<button type="submit" name="tambah">Tambah</button>
		</form>
	</div>

</body>
</html>
