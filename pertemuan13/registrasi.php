<?php
require "function.php";

if (isset($_POST["registrasi"])) {

  if (registrasi($_POST) > 0) {
    echo "<script>
	alert('User berhasil ditambahkan! Silahkan Login.');
	document.location.href = 'login.php';
    </script>"; 
  } else {
    $error = true;
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/form.css">
  <title>Registrasi</title>
</head>
<body>
  
  <div>
    <h2>Registrasi</h2>
    <hr>

    <?php if (isset($error)) : ?>
    <p class="error">User gagal ditambahkan!</p>
    <?php endif; ?>
       
    <form method="post">
      <label>Username : 
        <input type="text" name="username" autocomplete="off" required autofocus>
      </label>
      <label>Password : 
        <input type="password" name="password1" required>
      </label>
      <label>Konfirmasi Password : 
        <input type="password" name="password2" required>
      </label>
      <button type="submit" name="registrasi">Registrasi</button>
    </form>
  </div>
  
</body>
</html>
