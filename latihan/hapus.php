<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

require "functions.php";

if (!isset($_GET["id"])) {
  header("Location: index.php");
  exit;
}

if (hapus($_GET["id"]) > 0) {
  echo "<script>
	alert('Mahasiswa berhasil dihapus!');
	document.location.href = 'index.php';
   </script>";
} else {
  echo "<script>
	alert('Mahasiswa gagal dihapus!');
	document.location.href = 'index.php';
  </script>";
}
