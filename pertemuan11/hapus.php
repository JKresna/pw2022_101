<?php
require "function.php";


if (!isset($_GET["id"])) {
	header("Location: index.php");
	exit;
}

if (hapus($_GET["id"]) > 0) {
	echo "<script>
		    alert('Data berhasil dihapus!');
			document.location.href = 'index.php';
	    </script>";
} else {
	echo "Data gagal dihapus!";
}
