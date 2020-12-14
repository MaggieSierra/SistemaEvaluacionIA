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
WHERE Usuario.usuario = ? AND Materia_Alumno.id_materia = ? AND Evaluacion.borrado = 0");
$query->bindParam(1, $_SESSION['usuario']);
$query->bindParam(2, $_GET['id']);
$query->execute();
$evaluaciones = $query->fetchAll();

$query = $conexion->prepare("SELECT * FROM Calificacion WHERE id_usuario = ? AND id_evaluacion = ?");

foreach ($evaluaciones as $row) { 
    $query->bindParam(1, $_SESSION['id_usuario']);
    $query->bindParam(2, $row['id_evaluacion']);
    $query->execute();
    $calificacion = $query->fetchAll();
    $html .= "<tr><td>".$row['tema']."</td>";
    if(empty($calificacion)){
        $html .= "<td><a class='btn btn-primary' href='realizar_evaluacion.php?id=".$row['id_evaluacion']."'>Realizar</a></td></tr>";
    }else{
        $html .= "<td><a class='btn btn-light' href='calificacion.php?id=".$calificacion[0]['id_calificacion']."'>Calificación</a></td></tr>";
    }
}

if(empty($html)){
    $html .= "<tr><td colspan='3'>No se encontraron evaluaciones</td></tr>";
}

cerrarConexion($conexion, $query);
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