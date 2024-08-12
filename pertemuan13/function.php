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


function upload() {
  $nama_file = $_FILES["gambar"]["name"];
  $type = $_FILES["gambar"]["type"];
  $error = $_FILES["gambar"]["error"];
  $size = $_FILES["gambar"]["size"];
  $tmp_name = $_FILES["gambar"]["tmp_name"];

  // Jika gambar tidak di upload
  if ($error == 4) {
    echo "<script>
	  alert('Anda belum mengupload gambar!');
	</script>";
    return false;
  }

  // Jika ektensi file yang di upload tidak valid
  $ekstensi_valid = ["jpg", "jpeg", "png", "gif"];
  $ekstensi = explode(".", $nama_file);
  $ekstensi = strtolower(end($ekstensi));

  if (!in_array($ekstensi, $ekstensi_valid)) {
    echo "<script>
	  alert('Yang anda upload bukan gambar!');
	</script>";
    return false;  
  }

  // Pengecekan tipe file
  if ($type != "image/jpeg" && $type != "image/png" && $type != "image/gif") {
    echo "<script>
	  alert('Yang anda upload bukan gambar!');
	</script>";
    return false;   
  }

  // Cek ukuran gambar
  // Max 3MB = 3jt byte
  if ($size > 3000000) {
    echo "<script>
	  alert('Gambar tidak boleh lebih besar dari 3mb!');
	</script>";
    return false;   
  }

  
  // Upload file
  $nama_file_baru = uniqid();
  $nama_file_baru .= ".";
  $nama_file_baru .= $ekstensi;

  move_uploaded_file($tmp_name, "img/" . $nama_file_baru);
  return $nama_file_baru;
}


function tambah($data) {
  $koneksi = koneksi();

  // Sanitasi data dari SQLi
  $nama = mysqli_real_escape_string($koneksi, $data["nama"]);
  $nrp = mysqli_real_escape_string($koneksi, $data["nrp"]);
  $jurusan = mysqli_real_escape_string($koneksi, $data["jurusan"]);
  $email = mysqli_real_escape_string($koneksi, $data["email"]);
  //$gambar = mysqli_real_escape_string($koneksi, $data["gambar"]);

  // Upload gambar
  $gambar = upload();

  if (!$gambar) {
    return false;
  }
	
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
