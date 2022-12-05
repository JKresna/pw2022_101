<?php

function koneksi() {
	// Koneksi ke DBMS & Pilih DB
	return mysqli_connect("localhost", "root", "", "phpdasar");
}
	
function query($query) {
	$hasil = mysqli_query(koneksi(), $query);

	// Jika data hanya 1 row 
	if (mysqli_num_rows($hasil) == 1) {
		return mysqli_fetch_assoc($hasil);
	}

	// Ubah data ke dalam Array
	$rows = [];

	while($row = mysqli_fetch_assoc($hasil)) {
		$rows[] = $row;
	}

	return $rows;
}
