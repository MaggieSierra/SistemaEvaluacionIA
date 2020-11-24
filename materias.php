<?php 

$rol = 2;// 1:Rol estudiante, 2:Rol maestro
if($rol == 1){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<title>Materias</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
	<div class="container">
        <?php include('menu.php');?>
		<br>
		<div class="col-12" style="text-align: center;">
			<h2></h2>
        </div>
        
        <table class="table table-bordered">
            <thead>
                <tr><th>Materias</th><th></th></tr>
            </thead>
            <tbody>
                <tr>
                    <td>Base de datos Avanzadas</td>
                    <td> <a class="btn btn-primary" href="ver_materia.php">Ver</a></td>
                </tr>
            </tbody>
        </table>
		
	</div>
</html>