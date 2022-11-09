<?php 
require "function.php";

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

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
			padding: 3px 5px;
			text-align: center;
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
