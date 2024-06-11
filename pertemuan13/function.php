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

  while ($row = mysqli_fetch_assoc($hasil)) {
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
	
  $query = sprintf("INSERT INTO mahasiswa VALUES(NULL,
	   '%s', '%s', '%s', '%s', '%s')",
	   $nama, $nrp, $email, $jurusan, $gambar);

  mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));	

  return mysqli_affected_rows($koneksi);
}


function ubah($data) {
  $koneksi = koneksi();

  // Sanitasi data dari SQLi
  $nama = mysqli_real_escape_string($koneksi, $data["nama"]);
  $nrp = mysqli_real_escape_string($koneksi, $data["nrp"]);
  $jurusan = mysqli_real_escape_string($koneksi, $data["jurusan"]);
  $email = mysqli_real_escape_string($koneksi, $data["email"]);
  $gambar = mysqli_real_escape_string($koneksi, $data["gambar"]);
  $id = mysqli_real_escape_string($koneksi, $data["id"]);

  $query = sprintf("UPDATE mahasiswa SET
		nama='%s', nrp='%s', email='%s', 
		jurusan='%s', gambar='%s'
		WHERE id='%d'",
	   $nama, $nrp, $email, $jurusan, $gambar, $id);

  mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));	

  return mysqli_affected_rows($koneksi);
}


function hapus($id) {
  $koneksi = koneksi();
  $id = mysqli_real_escape_string($koneksi, $id);
	
  mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));

  return mysqli_affected_rows($koneksi);
}


function cari($keyword) {
  $koneksi = koneksi();
  $keyword = mysqli_real_escape_string($koneksi, $keyword);
    
  $query = "SELECT * FROM mahasiswa WHERE
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' OR
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
  
  // Sanitasi data dari SQLi
  $username = mysqli_real_escape_string($koneksi, $data["username"]);
  $password = mysqli_real_escape_string($koneksi, $data["password"]);
  
  // Cek username
  if ($user = query("SELECT * FROM users WHERE username='$username'")) {

    // Cek password
    if (password_verify($password, $user["password"])) {
      // Set Session Login
      $_SESSION["login"] = true;
      header("Location: index.php");
      exit;
    }
  }
  return [
    "error" => true,
    "pesan_error" => "Username/Password anda salah!"
  ];
}


function registrasi($data) {
  $koneksi = koneksi();

  // Sanitasi data
  $username = mysqli_real_escape_string($koneksi, trim(strtolower($data["username"])));
  $password1 = mysqli_real_escape_string($koneksi, $data["password1"]);
  $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

  // Cek jika Username/Password tidak diisi
  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script>
	alert('Username & Password harus diisi!');
    </script>"; 
    return false;
  }

  // Cek jika Username sudah ada di DB/sudah terdaftar
  if (query("SELECT * FROM users WHERE username='$username'")) {
    echo "<script>
	alert('Username sudah terdaftar!');
    </script>"; 
    return false;
  }
  
  // Jika Password konfirmasi salah
  if ($password1 !== $password2) {
    echo "<script>
	alert('Password konfirmasi tidak sesuai!');
    </script>"; 
    return false;
  }

  // Jika Password < 8 karakter
  if (strlen($password1) < 8) {
    echo "<script>
	alert('Password tidak boleh lebih kecil dari 8 karakter!');
    </script>"; 
    return false;
  }

  // Hash Password
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);
  // Tambahkan User ke table Users di DB
  $query = sprintf("INSERT INTO users VALUES(
  	NULL, '%s', '%s')", $username, $password_baru);
  
  mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
  return mysqli_affected_rows($koneksi);
}
