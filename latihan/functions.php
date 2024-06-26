<?php

function koneksi() {
  return mysqli_connect("localhost", "root", "", "phpdasar");
}


function query($query) {
  $koneksi = koneksi();

  $hasil = mysqli_query($koneksi, $query);

  // Jika row hanya 1 maka langsung return array associative
  if (mysqli_num_rows($hasil) == 1) {
    return mysqli_fetch_assoc($hasil);
  }

  $rows = [];

  while ($row = mysqli_fetch_assoc($hasil)) {
    $rows[] = $row;
  }

  return $rows;
}


function tambah($data) {
  $koneksi = koneksi();

  // Escaping data
  $nama = mysqli_real_escape_string($koneksi, $data["nama"]);
  $nrp = mysqli_real_escape_string($koneksi, $data["nrp"]);
  $email = mysqli_real_escape_string($koneksi, $data["email"]);
  $jurusan = mysqli_real_escape_string($koneksi, $data["jurusan"]);
  $gambar = mysqli_real_escape_string($koneksi, $data["gambar"]);

  $query = sprintf("INSERT INTO mahasiswa VALUES(NULL,
	   '%s', '%s', '%s', '%s', '%s')",
	   $nama, $nrp, $email, $jurusan, $gambar);

  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}


function ubah($data) {
  $koneksi = koneksi();

  // Escaping data
  $nama = mysqli_real_escape_string($koneksi, $data["nama"]);
  $nrp = mysqli_real_escape_string($koneksi, $data["nrp"]);
  $email = mysqli_real_escape_string($koneksi, $data["email"]);
  $jurusan = mysqli_real_escape_string($koneksi, $data["jurusan"]);
  $gambar = mysqli_real_escape_string($koneksi, $data["gambar"]);
  $id = mysqli_real_escape_string($koneksi, $data["id"]);

  $query = sprintf("UPDATE mahasiswa SET 
	   nama='%s', nrp='%s', email='%s',
	   jurusan='%s', gambar='%s' WHERE id='%d'",
	   $nama, $nrp, $email, $jurusan, $gambar, $id);

  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}


function hapus($id) {
  $koneksi = koneksi();

  $id = mysqli_real_escape_string($koneksi, $id);
  
  mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");

  return mysqli_affected_rows($koneksi);
}


function cari($keyword) {
  $koneksi = koneksi();

  $keyword = mysqli_real_escape_string($koneksi, $keyword);
  $query = "SELECT * FROM mahasiswa WHERE
	  nama LIKE '%$keyword%' ||
	  jurusan LIKE '%$keyword%' ||
	  nrp LIKE '%$keyword%' ||
	  email LIKE '%$keyword%'";

  $hasil = mysqli_query($koneksi, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($hasil)) {
    $rows[] = $row;
  }

  return $rows;
}


function login($data) {
  $koneksi = koneksi();

  $username = mysqli_real_escape_string($koneksi, $data["username"]);
  $password = mysqli_real_escape_string($koneksi, $data["password"]);

  // Cek apakah Username ada di Tabel users
  if ($user = query("SELECT * FROM users WHERE username='$username'")) {
    // Cek Password, cocokan Password dengan Hash-nya
    if (password_verify($password, $user["password"])) {
      // Buat Session login
      $_SESSION["login"] = true;
      
      header("Location: index.php");
      exit;
    }
  }

  return [
    "error" => true,
    "pesan_error" => "Username/Password Anda Salah!"
  ];
}
