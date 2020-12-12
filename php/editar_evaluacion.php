<?php

require("security.php");

$id_preguntas = [];
$preguntas = [];
$palabras_clave = [];
$id_evaluacion = trim($_POST['id_evaluacion']);
$id_materia = trim($_POST['id_materia']);
$tema = trim($_POST['tema']);
$count_preguntas = trim($_POST['count']);

for ($i=1; $i < $count_preguntas; $i++) {
    $id_preguntas[] = $_POST["id_pregunta".$i];
    $preguntas[] = $_POST["pregunta_".$i];
    $palabras_clave[] = $_POST["pclaves_".$i];
}

$conexion = obtenerConexion();

$query= $conexion->prepare("UPDATE Evaluacion SET id_materia = ?, tema = ? WHERE id_evaluacion = ?");
$query->bindParam(1, $id_materia);
$query->bindParam(2, $tema);
$query->bindParam(3, $id_evaluacion);
$query->execute();

$query_preguntas = $conexion->prepare("UPDATE Pregunta SET pregunta = ?, palabras_clave = ? WHERE id_evaluacion = ? AND id_pregunta = ?");

for ($i = 0; $i < count($preguntas); $i++) {
    $query_preguntas->bindParam(1, $preguntas[$i]);
    $query_preguntas->bindParam(2, $palabras_clave[$i]);
    $query_preguntas->bindParam(3, $id_evaluacion);
    $query_preguntas->bindParam(4, $id_preguntas[$i]);
    $query_preguntas->execute();
}

cerrarConexion($conexion, $query_preguntas);
header("Location:../vteacher/evaluaciones.php");
?>