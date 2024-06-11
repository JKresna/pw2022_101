<?php
session_start();

if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require "function.php";

if (isset($_POST["login"])) {
  $login = login($_POST);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/form.css">
  <title>Login</title>
  <style>
    .registrasi {
	font-size: .9em;
	text-align: center;
    }
  </style>
</head>
<body>
  
  <div>
    <h2>Login</h2>
    <hr>
    
    <?php if (isset($login["error"])) : ?>
    <p class="error"><?= $login["pesan_error"]; ?></p>
    <?php endif; ?>
    
    <form method="post">
      <label>Username : 
        <input type="text" name="username" autocomplete="off" required autofocus>
      </label>
      <label>Password : 
        <input type="password" name="password" required>
      </label>
      <button type="submit" name="login">Login</button>

      <br>
      <p class="registrasi">Belum punya akun? <a href="registrasi.php">Registrasi</a> dahulu.</p>
    </form>
  </div>
  
</body>
</html>
