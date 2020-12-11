<?php 
require("../php/security.php");
Seguridad();
if($_SESSION['rol'] == 2){
    header('Location: index.php');
}

$conexion = obtenerConexion();

$query = $conexion->prepare("SELECT Evaluacion.*, nombre_materia FROM Evaluacion INNER JOIN Materia 
ON Materia.id_materia = Evaluacion.id_materia INNER JOIN Usuario 
ON Usuario.id_usuario = Materia.id_usuario WHERE Usuario.usuario = ? AND Evaluacion.id_evaluacion = ?");
$query->bindParam(1, $_SESSION['usuario']);
$query->bindParam(2, $_GET['id']);
$query->execute();
$evaluacion = $query->fetchAll();

$query = $conexion->prepare("SELECT * FROM Pregunta WHERE id_evaluacion = ?");
$query->bindParam(1, $_GET['id']);
$query->execute();
$preguntas = $query->fetchAll();

foreach ($preguntas as $row) { 
    $html_preguntas .= '<div class="card">'
    .'<div class="card-header"></div>'
    .'<div class="card-body">'
    .'<div class="row" style="margin-bottom: 20px;">'
    .' <div class="col-md-3"><strong>Pregunta</strong></div>'
    .'<div class="col-md-9">'
    . $row['pregunta']
    .' </div>'
    .' </div>'
    .' <div class="row" style="margin-bottom: 20px;">'
    .'    <div class="col-md-3">'
    .'       <strong>Palabras Clave: </strong>'
    .'  </div>'
    .' <div class="col-md-9">'
    .$row['palabras_clave']
    .'   </div>'
    .' </div>'
    .'</div>'
    .'</div>';
}

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
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-4"><strong>Materia</strong></div>
                    <div class="col-md-8">
                        <span><?=$evaluacion[0]['nombre_materia']?></span>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-4"><strong>Tema: </strong></div>
                    <div class="col-md-8">
                        <span><?=$evaluacion[0]['tema']?></span>
                    </div>
                </div>
            </div>
        </div><br>
        <div id="preguntas">
            <?=$html_preguntas?>
        </div>
        
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script type="text/javascript">
        
    </script>
</body>
</html>