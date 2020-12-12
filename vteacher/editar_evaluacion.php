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

$query = $conexion->prepare("SELECT * FROM Materia INNER JOIN Usuario ON Usuario.id_usuario = Materia.id_usuario WHERE Usuario.usuario = ?");
$query->bindParam(1, $_SESSION['usuario']);
$query->execute();
$materias = $query->fetchAll();

foreach ($materias as $row) { 
    if($row['id_materia'] == $evaluacion['id_materia']){
        $list_materias .= "<option value='".$row['id_materia']."' selected>".$row['nombre_materia']."</option>";
    }else{
        $list_materias .= "<option value='".$row['id_materia']."'>".$row['nombre_materia']."</option>";
    }
    
}

$query = $conexion->prepare("SELECT * FROM Pregunta WHERE id_evaluacion = ?");
$query->bindParam(1, $_GET['id']);
$query->execute();
$preguntas = $query->fetchAll();

$count_preguntas = 1;
foreach ($preguntas as $row) { 
    $html_preguntas .= '<div class="card" id="card_pregunta_'.$count_preguntas.'">'
    .'<div class="card-header"></div>'
    .'<div class="card-body">'
    .'<div class="row" style="margin-bottom: 20px;">'
    .' <div class="col-md-4"><strong>Pregunta</strong></div>'
    .'<div class="col-md-8">'
    .'  <input type="hidden" id="id_pregunta'.$count_preguntas.'" name="id_pregunta'.$count_preguntas.'" class="form-control" value="'.$row['id_pregunta'].'" >'
    .'  <input type="text" id="pregunta_'.$count_preguntas.'" name="pregunta_'.$count_preguntas.'" class="form-control" value="'.$row['pregunta'].'" required>'
    .' </div>'
    .' </div>'
    .' <div class="row" style="margin-bottom: 20px;">'
    .'    <div class="col-md-4">'
    .'       <strong>Palabras Clave: </strong><br>'
    .'       <span class="text-warning">Nota: Separar las palabras clave por comas</span>'
    .'  </div>'
    .' <div class="col-md-8">'
    .'     <input type="text" id="pclaves_'.$count_preguntas.'" name="pclaves_'.$count_preguntas.'" value="'.$row['palabras_clave'].'"  class="form-control" required>'
    .'   </div>'
    .' </div>'
    .'</div>'
    .'</div>';
    $count_preguntas++;
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
        <form action="../php/editar_evaluacion.php" method="POST">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-4"><strong>Materia</strong></div>
                        <div class="col-md-8">
                            <select name="id_materia" id="id_materia" class="form-control" style="display: inline-block;">
                                <?=$list_materias;?>
                            </select>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-4"><strong>Tema: </strong></div>
                        <div class="col-md-8">
                            <input type="text" name="tema" id="tema" value="<?=$evaluacion[0]['tema']?>" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button> <button class="btn btn-danger"><a href="evaluaciones.php">Cancelar</a></button>
                </div>
            </div><br>
            <div id="preguntas">
                <?=$html_preguntas?>
            </div>
            <input type="hidden" name="count" id="count" value="<?=$count_preguntas?>" class="form-control">
            <input type="hidden" id="id_evaluacion" name="id_evaluacion" value="<?=$evaluacion[0]['id_evaluacion']?>">
        </form>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script type="text/javascript">
        
    </script>
</body>
</html>