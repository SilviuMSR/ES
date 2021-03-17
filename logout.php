<?php 
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

session_start();
session_destroy();
header("Location: http://localhost/home.php");
?>