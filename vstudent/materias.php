<?php 
require("../php/security.php");
Seguridad();
if($_SESSION['rol'] == 1){
    header('Location: index.php');
}

$conexion = obtenerConexion();

if(isset($_POST['clave_materia'])){
    $clave = trim($_POST['clave_materia']);

    $query = $conexion->prepare("SELECT id_materia FROM Materia WHERE clave_materia  = ? ");
    $query->bindParam(1, $clave);
    $query->execute();
    $result = $query->fetchAll();

    if(!empty($result)){
        $query = $conexion->prepare("SELECT * FROM Materia_Alumno WHERE id_materia  = ? AND id_usuario = ?");
        $query->bindParam(1, $result[0]['id_materia']);
        $query->bindParam(2, $_SESSION['id_usuario']);
        $query->execute();
        $result2 = $query->fetchAll();

        if(empty($result2)){
            $query = $conexion->prepare("INSERT INTO Materia_Alumno (id_materia, id_usuario) VALUES (?, ?)");
            $query->bindParam(1, $result[0]['id_materia']);
            $query->bindParam(2, $_SESSION['id_usuario']);
            $query->execute();
        }
    }
}

$query = $conexion->prepare("SELECT Materia.* FROM Materia INNER JOIN Materia_Alumno ON Materia_Alumno.id_materia = Materia.id_materia
INNER JOIN Usuario on Usuario.id_usuario = Materia_Alumno.id_usuario WHERE Usuario.usuario=?");
$query->bindParam(1, $_SESSION['usuario']);
$query->execute();
$materias = $query->fetchAll();

foreach ($materias as $row){
	$html .= "<tr><td>".$row['nombre_materia']."</td><td><a class='btn btn-primary' href='ver_materia.php?id=".$row['id_materia']."'>Ver</a>"; 
}

cerrarConexion($conexion, $query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Materias</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
	<div class="container">
        <?php include('../menu2.php');?>
		<br>
		<div class="col-12" style="text-align: center;">
			<h2></h2>
        </div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-12">
                <button class="btn btn-success" id="unir_materia">Unirte a una materia</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Materias</th><th></th></tr>
                    </thead>
                    <tbody>
                        <?=$html;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" id="modal_unir_materia" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title" id="exampleModalLabel">Unirte</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="post" id="materia" action="materias.php">
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="inputNombre">Clave de la materia</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="clave_materia" name="clave_materia" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#unir_materia').on('click', function() {
                $('#modal_unir_materia').modal('show');
            });
        });
    </script>
</body>
</html>