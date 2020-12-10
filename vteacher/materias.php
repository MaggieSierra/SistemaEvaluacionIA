<?php 
session_start();
require("../php/security.php");
Seguridad();
if($_SESSION['rol'] == 2){
    header('Location: index.php');
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
        <?php include('../menu.php');?>
		<br>
		<div class="col-12" style="text-align: center;">
			<h2></h2>
        </div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-12">
                <button class="btn btn-success" id="agregar_materia">Nueva materia</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr><th>Materias</th><th></th></tr>
                    </thead>
                    <?php 
                    require_once '../php/db.php';
                    $conexion = obtenerConexion();
                    $query = $conexion->query("SELECT * FROM Materia");
                    while($datos = $query->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $datos['nombre_materia']?></td>
                            <td> <a class="btn btn-primary" href="ver_materia.php">Ver</a></td>
                        </tr>
                    </tbody>
                    <?php } ?>
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
                    <form class="form-horizontal" role="form" method="post" id="materia" action="#">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="inputNombre">Nombre</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputNombre" name="inputNombre" required />
                            </div>
                        </div>
                        <div class="form-group" style="display:none">
                            <label class="col-sm-3 control-label" for="id_usuario">Fraccionamiento</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inputUsuario" name="inputUsuario" value=""/>
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
    </script>
</body>
</html>