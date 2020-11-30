<?php 
session_start();

$rol = 2;// 1:Rol estudiante, 2:Rol maestro
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Inicio</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
	<div class="container">
        <?php include('menu.php');?>
		<br>
		<div class="col-12" style="text-align: center;">
			
			<h2><?php
			// Echo session variables that were set on previous page
			echo "Bienvenido " . $_SESSION['usuario'] . ".";
			?></h2> 
		</div>
	</div>
</html>