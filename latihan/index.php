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

  <a href="tambah.php">Tambah Mahasiswa</a>
  <br><br>

  <table>

  <?php $i = 1; foreach($mahasiswa as $m) : ?>
  <tr>
    <td><?= $i++; ?></td>
    <td class="img">
      <img src="img/<?= htmlspecialchars($m["gambar"]); ?>" alt="Profil">
    </td>
    <td><?= htmlspecialchars($m["nama"]); ?></td>
    <td>
      <a href="detail.php?id=<?= $m["id"]; ?>">Lihat Detail</a>
    </td>
  </tr>
  <?php endforeach; ?>

  </table>

</body>
</html>
