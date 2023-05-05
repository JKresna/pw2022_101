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

	<h1>Daftar Mahasiswa</h1>

	<table>

	<?php $i = 1; foreach($mahasiswa as $mhs) : ?>
		<tr>
			<td><?= $i++; ?></td>
			<td>
				<img src="img/<?= htmlspecialchars($mhs['gambar']); ?>" alt="<?= htmlspecialchars($mhs['nama']); ?>">
			</td>
			<td><?= htmlspecialchars($mhs['nama']); ?></td>
			<td>
				<a href="detail.php?id=<?= $mhs['id']; ?>">Lihat Detail</a>
			</td>
		</tr>
	<?php endforeach; ?> 

	</table>
	
</body>
</html>
