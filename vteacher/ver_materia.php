<?php 
require("../php/security.php");
Seguridad();
if($_SESSION['rol'] == 1){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Ver Materia</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
	<div class="container">
        <?php include('../menu.php');?>
		<br>
		<div class="col-12" style="text-align: center;">
			<h2>Base De Datos Avanzadas</h2>
		</div>
		<div class="contenedor">
			<div class="container-opc">
				<div style="max-width: 300px;position: relative; margin: 25px; margin-bottom: 40px;">
					<a class="btn btn-secondary" href="crear_evaluacion.php">Crear evaluación</a>
				</div>
				<div style="max-width: 300px;position: relative;margin: 25px;">
					<a class="btn btn-secondary" href="crear_evaluacion.php">Ver calificaciones</a>
				</div>
			</div>
		</div>
	</div>
</html>