<?php 
require "function.php";


if (!isset($_GET["id"])) {
	header("Location: index.php");
	exit;
}

// Ambil mahasiswa dengan id di URL
$koneksi = koneksi();
$id = mysqli_real_escape_string($koneksi, $_GET["id"]);
$mahasiswa = query("SELECT * FROM mahasiswa WHERE id='$id'");

if (isset($_POST["ubah"]) && (
		!empty($_POST["nama"]) &&
		!empty($_POST["nrp"]) &&
		!empty($_POST["email"]) &&
		!empty($_POST["jurusan"]) &&
		!empty($_POST["gambar"])
	)) {
	
	if (ubah($_POST) > 0) {
		echo "<script>
				alert('Data berhasil diubah!');
				document.location.href = 'index.php';
		</script>";
	} else {
		echo "Data gagal diubah!";	
	}

}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/tambah.css">
	<title>Ubah Mahasiswa</title>
</head>
<body>

	<div>
		<h2>Ubah Mahasiswa</h2>
		<hr>
		<form method="post">
			<input type="hidden" name="id" value="<?= $mahasiswa['id']; ?>">

			<label for="nama">Nama :</label>
			<input type="text" name="nama" id="nama" value="<?= $mahasiswa['nama']; ?>" placeholder="Masukan nama anda" autocomplete="off" required>

			<label for="nrp">NRP :</label>
			<input type="number" name="nrp" id="nrp" value="<?= $mahasiswa['nrp']; ?>" placeholder="Masukan NRP anda" autocomplete="off" required>

			<label for="email">Email :</label>
			<input type="email" name="email" id="email" value="<?= $mahasiswa['email']; ?>" placeholder="Masukan email anda" autocomplete="off" required>

			<label for="jurusan">Jurusan :</label>
			<input type="text" name="jurusan" id="jurusan" value="<?= $mahasiswa['jurusan']; ?>" placeholder="Masukan jurusan anda" autocomplete="off" required>

			<label for="gambar">Gambar :</label>
			<input type="text" name="gambar" id="gambar" value="<?= $mahasiswa['gambar']; ?>" placeholder="Masukan nama gambar anda" autocomplete="off" required>

			<button type="submit" name="ubah">Ubah</button>
		</form>
	</div>

</body>
</html>
