<?php 
session_start();
require("../php/security.php");
Seguridad();
if($_SESSION['rol'] == 2){
    header('Location: index.php');
}

//Comentario para sincronizacion de rama

$conexion = obtenerConexion();

if(isset($_POST['inputNombre'])){
    $nombre = trim($_POST['inputNombre']);

    $query = $conexion->prepare("INSERT INTO Materia (id_usuario, nombre_materia) VALUES (?, ?)");
    $query->bindParam(1, $_SESSION['id_usuario']);
    $query->bindParam(2, $nombre);
    $query->execute();
    $result = $query->fetchAll();
    $_POST['inputNombre']="";
}

if(isset($_POST['idMateria'])){
    
    $nombre = trim($_POST['nombreMateria']);
    $sql = "UPDATE Materia SET nombre_materia='$_POST[nombreMateria]' WHERE id_materia = $_POST[idMateria] ";
    $query = $conexion->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
    $_POST['nombreMateria']="";
    $_POST['idMateria']="";
}


$query = $conexion->prepare("SELECT * FROM Materia INNER JOIN Usuario ON Usuario.id_usuario = Materia.id_usuario WHERE Usuario.usuario = ?");
$query->bindParam(1, $_SESSION['usuario']);
$query->execute();
$materias = $query->fetchAll();

foreach ($materias as $row) { 
    $html .= "<tr><td>$row[clave_materia]</td><td>$row[nombre_materia]</td><td><input type='button' value='editar' onclick='editarMateria(\"$row[id_materia]-$row[nombre_materia]\");'/></td></tr>";
}


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
                <button class="btn btn-success" id="agregar_materia">Nueva materia</button>
            </div>
        </div>
        <div class="row" id="formMaterias"></div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Clave</th><th>Materias</th></tr>
                    </thead>
                    <tbody>
                    <?=$html;?>     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="modal" id="modal_crear_materia" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title" id="exampleModalLabel">Agregar Materia</strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="post" id="materia" action="materias.php">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputNombre">Nombre</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputNombre" name="inputNombre" required />
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
            $('#agregar_materia').on('click', function() {
                $('#modal_crear_materia').modal('show');
            });
        });
        function editarMateria(valor)
        {
            valor = valor.split("-");
            var regreso = "<form class='form-horizontal' role='form' method='post' id='materia' action='materias.php'>&nbsp; Nombre: &nbsp; <input type='text' value='"+valor[1]+"' id='nombreMateria' name='nombreMateria' style='width: 300px;'/> &nbsp;&nbsp; <button type='submit' >Guardar</button> <input type='text' value='"+valor[0]+"' id='idMateria' name='idMateria' style='display:none;'/></form>";
            document.getElementById("formMaterias").innerHTML = regreso;
            document.getElementById("nombreMateria").focus();
        }
    </script>
</body>
</html>