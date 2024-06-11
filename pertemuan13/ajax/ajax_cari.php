<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}

if (!isset($_GET["keyword"])) {
  header("Location: ../index.php");
  exit;
}

require "../function.php";

$mahasiswa = cari($_GET["keyword"]);
?>
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
