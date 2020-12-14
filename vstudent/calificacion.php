<?php 
require("../php/security.php");
Seguridad();
if($_SESSION['rol'] == 1){
    header('Location: index.php');
}

$conexion = obtenerConexion();

$query = $conexion->prepare("SELECT Calificacion.*, CONCAT(nombre, ' ', apellidos) AS nombre_alumno, tema, nombre_materia FROM Calificacion 
INNER JOIN Usuario ON Usuario.id_usuario = Calificacion.id_usuario
INNER JOIN Evaluacion ON Evaluacion.id_evaluacion = Calificacion.id_evaluacion
INNER JOIN Materia ON Materia.id_materia = Evaluacion.id_materia WHERE id_calificacion = ?");
$query->bindParam(1, $_GET['id']);
$query->execute();
$calificacion = $query->fetchAll();

foreach ($calificacion as $row) { 
    $html_calificacion .= '<div class="card">'
    .'<div class="card-header"></div>'
    .'<div class="card-body">'
    .'<div class="row" style="margin-bottom: 10px;">'
    .' <div class="col-md-3"><strong>Nombre:</strong></div>'
    .' <div class="col-md-9">'.$row['nombre_alumno'].' </div>'
    .' </div>'
    .'<div class="row" style="margin-bottom: 10px;">'
    .' <div class="col-md-3"><strong>Materia:</strong></div>'
    .' <div class="col-md-9">'.$row['nombre_materia'].' </div>'
    .' </div>'
    .'<div class="row" style="margin-bottom: 10px;">'
    .' <div class="col-md-3"><strong>Tema de Evaluación:</strong></div>'
    .' <div class="col-md-9">'.$row['tema'].' </div>'
    .' </div>'
    .'<div class="row" style="margin-bottom: 10px;">'
    .' <div class="col-md-3"><strong>Calificación:</strong></div>'
    .' <div class="col-md-9">'.$row['calificacion'].'/60</div>'
    .' </div>'
    .' </div>'
    .'</div>';
}

$query = $conexion->prepare("SELECT Respuesta.*, pregunta, palabras_clave FROM Respuesta 
INNER JOIN Pregunta ON Pregunta.id_pregunta = Respuesta.id_pregunta
INNER JOIN Usuario ON Usuario.id_usuario = Respuesta.id_usuario
INNER JOIN Calificacion ON Calificacion.id_usuario = Respuesta.id_usuario
INNER JOIN Evaluacion ON Evaluacion.id_evaluacion = Calificacion.id_evaluacion
WHERE id_calificacion = ?");
$query->bindParam(1, $_GET['id']);
$query->execute();
$preguntas_respuestas = $query->fetchAll();
$html_resp .= '<div class="card">'
    .'<div class="card-header"></div>'
    .'<div class="card-body">';
foreach ($preguntas_respuestas as $row) { 
    $html_resp .='<div class="row" style="margin-bottom: 5px;">'
    .' <div class="col-md-3"><strong>Pregunta:</strong></div>'
    .' <div class="col-md-9">'.$row['pregunta'].' </div>'
    .' </div>'
    .'<div class="row" style="margin-bottom: 5px;">'
    .' <div class="col-md-3"><strong>Respuesta:</strong></div>'
    .' <div class="col-md-9">'.$row['respuesta'].' </div>'
    .' </div>'
    .'<div class="row" style="margin-bottom: 5px; color:green;">'
    .' <div class="col-md-3"><strong>Palabras claves esperadas:</strong></div>'
    .' <div class="col-md-9">'.$row['palabras_clave'].' </div>'
    .' </div>'
    .'<hr>';
}
$html_resp .= ' </div></div>';

cerrarConexion($conexion, $query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Evaluaciones</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
	<div class="container">
        <?php include('../menu2.php');?>
        <br>
        <div id="response"></div>
        <div class="col-12" style="text-align: center;">
			<h2>Calificación</h2>
        </div><br>
        <div id="calificacion">
            <?=$html_calificacion?>
        </div><br>
        <div class="respuestas">
        <?=$html_resp?>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script type="text/javascript">
        
    </script>
</body>
</html>