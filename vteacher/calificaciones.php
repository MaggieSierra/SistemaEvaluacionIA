<?php 
require("../php/security.php");
Seguridad();
if($_SESSION['rol'] == 2){
    header('Location: index.php');
}

$conexion = obtenerConexion();

$query = $conexion->prepare("SELECT * FROM Materia INNER JOIN Usuario ON Usuario.id_usuario = Materia.id_usuario WHERE Usuario.usuario = ?");
$query->bindParam(1, $_SESSION['usuario']);
$query->execute();
$materias = $query->fetchAll();

foreach ($materias as $row) { 
    $list_materias .= "<option value='".$row['id_materia']."'>".$row['nombre_materia']."</option>";
}

if(isset($_POST["id_materia"])){
    $query = $conexion->prepare("SELECT Calificacion.*, tema, nombre_materia, CONCAT(nombre, ' ', apellidos) AS nombre_alumno FROM Calificacion 
    INNER JOIN Evaluacion ON Evaluacion.id_evaluacion = Calificacion.id_evaluacion
    INNER JOIN Materia ON Materia.id_materia = Evaluacion.id_materia 
    INNER JOIN Usuario ON Usuario.id_usuario = Calificacion.id_usuario 
    WHERE  Materia.id_materia = ?");
    $query->bindParam(1, $_POST["id_materia"]);
    $query->execute();
    $evaluaciones = $query->fetchAll();
}

foreach ($evaluaciones as $row) { 
    $html .= "<tr><td>".$row['nombre_materia']."</td><td>".$row['tema']."</td><td>".$row['nombre_alumno']."</td><td>".$row['calificacion']."/60</td>
    </tr>";
}

if(empty($html)){
    $html .= "<tr><td colspan='5'>No se encontraron calificaciones</td></tr>";
}

cerrarConexion($conexion, $query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Calificaciones</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
	<div class="container">
        <?php include('../menu2.php');?>
		<br>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-7">
                <form action="calificaciones.php" method="POST">
                    <span class="col-md-4"><strong>Elegir Materia:</strong></span>
                    <select name="id_materia" id="materia" class="form-control col-md-6" style="display: inline-block;">
                        <option value="0" selected disabled>Selección</option>
                        <?=$list_materias;?>
                    </select>
                    <button type='submit' name='buscar' class='btn btn-primary col-md-2'><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <?php if($_POST["id_materia"]){?>
        <table class="table table-bordered">
            <thead>
                <tr><th>Materia</th><th>Evaluación</th><th>Estudiante</th><th>Calificación</th></tr>
            </thead>
            <tbody>
                <?=$html;?>
            </tbody>
        </table>
        <?php }else{?>
            <h6 class="txt-warning">Elija la materia de la que desea ver las calificaciones</h6>
        <?php }?>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>