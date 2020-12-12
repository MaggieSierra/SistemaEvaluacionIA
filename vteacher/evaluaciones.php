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
    $query = $conexion->prepare("SELECT Evaluacion.*, nombre_materia FROM Evaluacion INNER JOIN Materia 
    ON Materia.id_materia = Evaluacion.id_materia INNER JOIN Usuario 
    ON Usuario.id_usuario = Materia.id_usuario WHERE Usuario.usuario = ? AND Materia.id_materia = ?");
    $query->bindParam(1, $_SESSION['usuario']);
    $query->bindParam(2, $_POST["id_materia"]);
    $query->execute();
    $evaluaciones = $query->fetchAll();
}else{
    $query = $conexion->prepare("SELECT Evaluacion.*, nombre_materia FROM Evaluacion INNER JOIN Materia 
    ON Materia.id_materia = Evaluacion.id_materia INNER JOIN Usuario 
    ON Usuario.id_usuario = Materia.id_usuario WHERE Usuario.usuario = ?");
    $query->bindParam(1, $_SESSION['usuario']);
    $query->execute();
    $evaluaciones = $query->fetchAll();
}


foreach ($evaluaciones as $row) { 
    $html .= "<tr><td>".$row['nombre_materia']."</td><td>".$row['tema']."</td><td><a class='btn btn-primary' href='ver_evaluacion.php?id=".$row['id_evaluacion']."'><i class='fas fa-eye'></i></a> <a class='btn btn-warning' href='editar_evaluacion.php?id=".$row['id_evaluacion']."'><i class='fas fa-edit'></i></a></td></tr>";
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
	<title>Evaluaciones</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
	<div class="container">
        <?php include('../menu2.php');?>
		<br>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-5">
                <button class="btn btn-success" id="agregar_materia"><a href="crear_evaluacion.php">Nueva evaluación</a></button>
            </div>
            <div class="col-md-7">
                <form action="evaluaciones.php" method="POST">
                    <span class="col-md-4"><strong>Elegir Materia:</strong></span>
                    <select name="id_materia" id="materia" class="form-control col-md-6" style="display: inline-block;">
                        <option value="0" selected disabled>Selección</option>
                        <?=$list_materias;?>
                    </select>
                    <button type='submit' name='buscar' class='btn btn-primary col-md-2'><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr><th>Materia</th><th>Evaluación</th><th></th></tr>
            </thead>
            <tbody>
                <?=$html;?>
            </tbody>
        </table>
		
    </div>
</body>
</html>