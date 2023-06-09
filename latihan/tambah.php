<?php 

if (isset($_POST["tambah"])) {
	var_dump($_POST);
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

</body>
</html>
