<?php 
require "functions.php";

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daftar Mahasiswa</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>Gambar</th>
				<th>Nama</th>
				<th>NRP</th>
				<th>Jurusan</th>
				<th>Email</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>

		<?php $i = 1; foreach($mahasiswa as $mhs) : ?>
			<tr>
				<td><?= $i++; ?></td>
				<td class="img">
					<img src="img/<?= htmlspecialchars($mhs['gambar']); ?>" alt="<?= htmlspecialchars($mhs['nama']); ?>">
				</td>
				<td><?= htmlspecialchars($mhs["nama"]); ?></td>
				<td><?= htmlspecialchars($mhs["nrp"]); ?></td>
				<td><?= htmlspecialchars($mhs["jurusan"]); ?></td>
				<td><?= htmlspecialchars($mhs["email"]); ?></td>
				<td>
					<a href="#">Ubah</a> | <a href="#">Hapus</a>
				</td>
			</tr>
		<?php endforeach; ?>

		</tbody>
	</table>
	
</body>
</html>
