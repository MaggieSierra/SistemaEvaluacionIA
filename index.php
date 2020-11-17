<?php 

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
        <ul class='nav nav-tabs'>
            <li class='nav-item'><a class='nav-link active' href='#'>Inicio</a></li>
            <?php if($rol == 1){ ?>
                <li class="nav-item"><a class="nav-link" href="#">Evaluaciones</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Calificaciones</a></li>
            <?php } else { ?>
                <li class="nav-item"><a class="nav-link" href="materias.php">Materias</a></li>
            <?php } ?>
            <li class="nav-item"><a class="nav-link" href="#">Cerrar Sesion</a></li>
        </ul>
		<br>
		<div class="col-12" style="text-align: center;">
			<h2>Bienvenido ${nombre}</h2>
		</div>
		
	</div>
</html>