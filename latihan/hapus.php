<?php
require "functions.php";

if (isset($_GET["id"])) {
	if (hapus($_GET["id"]) > 0 ) {
		echo "<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'index2.php';
		</script>";
	} else {
		echo "<script>
			alert('Data gagal dihapus!');
			document.location.href = 'index2.php';
		</script>";
	}
}
