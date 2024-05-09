<?php
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
} 

// Logout & Hapus Session Login
session_destroy();

header("Location: login.php");
exit;
