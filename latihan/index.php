<?php 
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "functions.php";

$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

if (isset($_POST["cari"])) {
  $mahasiswa = cari($_POST["keyword"]);
}
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

  <form method="post">
    <input type="text" name="keyword" placeholder="Masukan pencarian.." size="30" autocomplete="off" autofocus>
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
