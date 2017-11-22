<?php 
session_start();
unset($_SESSION['session_username']);
session_destroy();
header("http://localhost/Plataforma/index.php");
?>