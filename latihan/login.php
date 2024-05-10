<?php
session_start();

if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

require "functions.php";

if (isset($_POST["login"])) {
  $login = login($_POST);
}
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="css/form.css">
  </head>
  <body>
  
  <div>
    <h2>Login</h2>
    <hr>

    <?php if (isset($login["error"])) : ?>
    <p class="error"><?= $login["pesan_error"]; ?></p>
    <?php endif; ?>

    <form method="post">
      <label for="username">Username :</label>
      <input type="text" name="username" id="username" autocomplete="off" autofocus required>
      
      <label for="password">Password :</label>
      <input type="password" name="password" id="password" required>
      
     <button type="submit" name="login">Login</button>
    </form>
  </div>
    
  </body>
</html>
