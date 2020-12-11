<?php 
require("../php/security.php");
Seguridad();
if($_SESSION['rol'] == 1){
    header('Location: index.php');
}

$conexion = obtenerConexion();

$query = $conexion->prepare("SELECT Materia.* FROM Materia INNER JOIN
Materia_Alumno ON Materia_Alumno.id_materia = Materia.id_materia;");
$query->execute();
$materias = $query->fetchAll();

foreach ($materias as $row){
	$html .= "<tr><td>".$row['nombre_materia']."</td><td><a class='btn btn-primary' href='ver_materia.php?id='".$row['id_materia'].">Ver</a></td></tr>";
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
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            
        });
    </script>
</body>
</html>