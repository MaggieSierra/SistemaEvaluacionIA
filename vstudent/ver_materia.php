<?php 
require("../php/security.php");
Seguridad();
if($_SESSION['rol'] == 1){
    header('Location: index.php');
}

$conexion = obtenerConexion();

$query = $conexion->prepare("SELECT Evaluacion.*, nombre_materia FROM Evaluacion INNER JOIN Materia
ON Materia.id_materia = Evaluacion.id_materia
INNER JOIN Materia_Alumno on Materia_Alumno.id_materia = Materia.id_materia
INNER JOIN Usuario ON Usuario.id_usuario = Materia_Alumno.id_usuario 
WHERE Usuario.usuario = ? AND Materia_Alumno.id_materia = ?");
$query->bindParam(1, $_SESSION['usuario']);
$query->bindParam(2, $_GET['id']);
$query->execute();
$evaluaciones = $query->fetchAll();

foreach ($evaluaciones as $row) { 
    $html .= "<tr><td>".$row['tema']."</td><td><a class='btn btn-primary' href='realizar_evaluacion.php?id=".$row['id_evaluacion']."'>Realizar</a> <a class='btn btn-light' href='calificacion.php'>Calificación</a></td></tr>";
}

if(empty($html)){
    $html .= "<tr><td colspan='3'>No se encontraron evaluaciones</td></tr>";
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Ver_materia</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
	<div class="container">
        <?php include('../menu2.php');?>
		<br>
        <div class="col-12" style="text-align: center;">
			<h2><?=$evaluaciones[0]['nombre_materia']?></h2>
		</div>
		</br>
        <table class="table table-bordered">
            <thead>
                <tr><th>Evaluación</th><th></th></tr>
            </thead>
            <tbody>
                <?=$html;?>
            </tbody>
        </table>
		
    </div>
</body>
</html>