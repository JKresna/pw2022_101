<?php 
require "function.php";

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

// Jika tombol cari di klik
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<title>Daftar Mahasiswa</title>
</head>
<body>

	<h1>Daftar Mahasiswa</h1>

	<a href="tambah.php">Tambah Data Mahasiswa</a>
	<br><br>
	
	<form action="" method="post">
	    <input type="text" name="keyword" placeholder="Masukan keyword pencarian..." autocomplete="off" size="30" autofocus>
	    <button type="submit" name="cari">Cari</button>
	</form>
	<br>

	<table>
	    
	    <tr>
	        <th>#</th>
	        <th>Gambar</th>
	        <th>Nama</th>
	        <th>Aksi</th>
	    </tr>

        <?php if (empty($mahasiswa)) : ?>
        <tr>
            <td colspan="4">
                <p class="error">Mahasiswa tidak ditemukan!</p>
            </td>
        </tr>
        <?php endif; ?>  

		<?php $i = 1;
			foreach($mahasiswa as $m) : ?>
		<tr>
			<td><?= $i++; ?></td>
			<td class="img">
				<img src="img/<?= htmlspecialchars($m['gambar']); ?>" alt="Gambar <?= htmlspecialchars($m['nama']); ?>">
			</td>
			<td><?= htmlspecialchars($m["nama"]); ?></td>
			<td>
				<a href="detail.php?id=<?= $m['id'] ?>">Lihat Detail</a>
			</td>
		</tr>
		<?php endforeach; ?>

	</table>

</body>
</html>
