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
        <div class="row col-md-12" align="center" style="justify-content: center;">
            <h3>Nueva Evaluación</h3>
        </div>
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-4"><strong>Materia</strong></div>
                    <div class="col-md-8">
                        <select name="id_materia" id="materia" class="form-control" style="display: inline-block;">
                            <option value="0" selected disabled>Selección</option>
                            <?=$list_materias;?>
                        </select>
                    </div>
                </div>
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-4"><strong>Tema: </strong></div>
                    <div class="col-md-8">
                        <input type="text" name="tema" class="form-control" required>
                    </div>
                </div>
                <button class="btn btn-success" onclick="add_pregunta();">+</button>
                <button class="btn btn-success">Guardar</button>
            </div>
        </div><br>
        <div id="preguntas"></div>
        
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script type="text/javascript">
        agregar_preguntas = 0;
        count_preguntas = 0;

        function add_pregunta() {
            agregar_preguntas++;

            html_preguntas = '<div class="card" id="card_pregunta_'+agregar_preguntas+'">'
                                +'<div class="card-header"><button class="btn btn-quitar-preg" onclick="quitar_pregunta('+agregar_preguntas+');">x</button></div>'
                                +'<div class="card-body">'
                                +'<div class="row" style="margin-bottom: 20px;">'
                                +' <div class="col-md-4"><strong>Pregunta</strong></div>'
                                +'<div class="col-md-8">'
                                +'  <input type="text" id="pregunta_'+agregar_preguntas+'" name="pregunta_'+agregar_preguntas+'" class="form-control" required>'
                                +' </div>'
                                +' </div>'
                                +' <div class="row" style="margin-bottom: 20px;">'
                                +'    <div class="col-md-4">'
                                +'       <strong>Palabras Clave: </strong><br>'
                                +'       <span class="text-warning">Nota: Separar las palabras clave por comas</span>'
                                +'  </div>'
                                +' <div class="col-md-8">'
                                +'     <input type="text" id="pclaves_'+agregar_preguntas+'" name="pclaves_'+agregar_preguntas+'" class="form-control" required>'
                                +'   </div>'
                                +' </div>'
                                +'</div>'
                                +'</div>';
            $('#preguntas').append(html_preguntas);
        }

        function quitar_pregunta(pregunta){
            $('#card_pregunta_'+pregunta).remove();
            
        }
    </script>
</body>
</html>