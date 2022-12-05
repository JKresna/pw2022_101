<?php 
require "function.php";

$mahasiswa = query("SELECT * FROM mahasiswa");

?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daftar Mahasiswa</title>
	<style>
		table,th,td {
			border-collapse: collapse;
			border: 1px solid #000;		
			padding: 10px;
		}

		img {
			width: 50px;
			height: 50px;
		}

		.img {
			text-align: center;
		}
	</style>
</head>
<body>

	<h1>Daftar Mahasiswa</h1>

	<table>
		<?php $i = 1;
			foreach($mahasiswa as $m) : ?>
		<tr>
			<td><?= $i++; ?></td>
			<td class="img">
				<img src="img/<?= $m['gambar']; ?>" alt="Gambar <?= $m['nama']; ?>">
			</td>
			<td><?= $m["nama"]; ?></td>
			<td>
				<a href="detail.php?id=<?= $m['id'] ?>">Lihat Detail</a>
			</td>
		</tr>
		<?php endforeach; ?>

	</table>

</body>
</html>
