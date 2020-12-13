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
    ON Usuario.id_usuario = Materia.id_usuario WHERE Usuario.usuario = ? AND Materia.id_materia = ? AND borrado = 0");
    $query->bindParam(1, $_SESSION['usuario']);
    $query->bindParam(2, $_POST["id_materia"]);
    $query->execute();
    $evaluaciones = $query->fetchAll();
}else{
    $query = $conexion->prepare("SELECT Evaluacion.*, nombre_materia FROM Evaluacion INNER JOIN Materia 
    ON Materia.id_materia = Evaluacion.id_materia INNER JOIN Usuario 
    ON Usuario.id_usuario = Materia.id_usuario WHERE Usuario.usuario = ? AND borrado = 0");
    $query->bindParam(1, $_SESSION['usuario']);
    $query->execute();
    $evaluaciones = $query->fetchAll();
}


foreach ($evaluaciones as $row) { 
    $html .= "<tr><td>".$row['nombre_materia']."</td><td>".$row['tema']."</td>
    <td><a class='btn btn-primary' href='ver_evaluacion.php?id=".$row['id_evaluacion']."'>
    <i class='fas fa-eye'></i></a> <a class='btn btn-warning' href='editar_evaluacion.php?id=".$row['id_evaluacion']."'>
    <i class='fas fa-edit'></i></a> <a class='btn btn-danger' href='#' onclick='eliminar_evaluacion(".$row['id_evaluacion'].")'>
    <i class='fas fa-trash-alt'></i></a></td></tr>";
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

    <div class="modal" id="modal_eliminar_evaluacion" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="../php/eliminar_evaluacion.php" method="POST">
                    <div class="modal-body">
                        <h4>¿Desea eliminar la evaluaci&oacuten?</h4>
                        <input type="hidden" id="id_evaluacion_eliminar" name="id_evaluacion_eliminar" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function eliminar_evaluacion(id_evaluacion){
            document.getElementById('id_evaluacion_eliminar').value = id_evaluacion;
            $('#modal_eliminar_evaluacion').modal('show');
        }
    </script>
</body>
</html>