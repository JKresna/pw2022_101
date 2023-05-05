<?php

function koneksi() {
	return mysqli_connect("localhost", "root", "", "phpdasar");
}

function query($query) {
	$koneksi = koneksi();
	$hasil = mysqli_query($koneksi, $query);

	// Jika hanya 1 row
	if (mysqli_num_rows($hasil) == 1) {
		return mysqli_fetch_assoc($hasil);
	}

	
	$rows = [];

	while($row = mysqli_fetch_assoc($hasil)) {
		$rows[] = $row;
	}

	return $rows;
}
