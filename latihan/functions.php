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

function tambah($data) {
	// data : Array Associative $_POST
	$koneksi = koneksi();

	// Escaping data
	$nama = mysqli_real_escape_string($koneksi, $data["nama"]);
	$nrp = mysqli_real_escape_string($koneksi, $data["nrp"]);
	$email = mysqli_real_escape_string($koneksi, $data["email"]);
	$jurusan = mysqli_real_escape_string($koneksi, $data["jurusan"]);
	$gambar = mysqli_real_escape_string($koneksi, $data["gambar"]);

	$query = sprintf("INSERT INTO mahasiswa VALUES(
		NULL, '%s', '%s', '%s', '%s', '%s')", 
		$nama, $nrp, $email, $jurusan, $gambar);

	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}

function hapus($id) {
	$koneksi = koneksi();

	$id = mysqli_real_escape_string($koneksi, $id);
	$query = "DELETE FROM mahasiswa WHERE id='$id'";

	mysqli_query($koneksi, $query);
	return mysqli_affected_rows($koneksi);
}
