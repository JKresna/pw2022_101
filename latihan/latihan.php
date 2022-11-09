<?php 
// Cara mengambil data dari DB & Table


// 1. Koneksi ke DB
$koneksi = mysqli_connect("localhost","root","","phpdasar");

// 2. Lakukan Query ke Table yang kita 
// inginkan di DB
$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa");

// 3. Fetch data dari hasil Query
$mahasiswa = [];

while ($row = mysqli_fetch_assoc($result)) {
	$mahasiswa[] = $row;
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<title>Daftar Mahasiswa</title>
	<style>
		table,th,td {
				border: 2px solid #000;
				border-collapse: collapse;
				text-align: center;
				padding: 3px 5px;
			}

		img {
				width: 50px;
				height: 50px;
		}
	</style>
</head>
<body>

	<h1>Daftar Mahasiswa</h1>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Gambar</th>
				<th>Nama</th>
				<th>NRP</th>
				<th>Jurusan</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>

		<?php $i = 1; foreach($mahasiswa as $mhs) : ?>
			<tr>
				<td><?= $i++; ?></td>
				<td>
					<img src="img/<?= $mhs['gambar']; ?>" alt="<?= $mhs['nama']; ?>">
				</td>
				<td><?= $mhs["nama"]; ?></td>
				<td><?= $mhs["nrp"]; ?></td>
				<td><?= $mhs["jurusan"]; ?></td>
				<td><?= $mhs["email"]; ?></td>
			</tr>
		<?php endforeach; ?>

		</tbody>
	</table>

</body>
</html>
