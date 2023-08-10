<?php

function koneksi() {
	// Koneksi ke DBMS & Pilih DB
	return mysqli_connect("localhost", "root", "", "phpdasar");
}
	
function query($query) {
	$koneksi = koneksi();

	$hasil = mysqli_query($koneksi, $query);

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

function tambah($data) {
	$koneksi = koneksi();

	// Sanitasi data dari SQLi
	$nama = mysqli_real_escape_string($koneksi, $data["nama"]);
	$nrp = mysqli_real_escape_string($koneksi, $data["nrp"]);
	$jurusan = mysqli_real_escape_string($koneksi, $data["jurusan"]);
	$email = mysqli_real_escape_string($koneksi, $data["email"]);
	$gambar = mysqli_real_escape_string($koneksi, $data["gambar"]);
	
	$query = sprintf("INSERT INTO mahasiswa VALUES(
		NULL, '%s', '%s', '%s', '%s', '%s')",
		$nama, $nrp, $email, $jurusan, $gambar);

	mysqli_query($koneksi, $query);	

	return mysqli_affected_rows($koneksi);
}
