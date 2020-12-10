<?php
session_start();
unset($_SESSION['usuario']);
unset($_SESSION['nombre']);
unset($_SESSION['rol']);
session_destroy();
header("Location:login.php");
?>