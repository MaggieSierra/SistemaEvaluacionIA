<?php

require("security.php");

$id_materia = trim($_POST['id_materia']);
$tema = trim($_POST['tema']);
$preguntas = json_decode($_POST['preguntas']);

$conexion = obtenerConexion();

$query= $conexion->prepare("INSERT INTO Evaluacion(id_materia, tema) VALUES (?,?)");
$query->bindParam(1, $id_materia);
$query->bindParam(2, $tema);
$query->execute();
$id_evaluacion = $conexion->lastInsertId();

$query_preguntas = $conexion->prepare("INSERT INTO Pregunta(id_evaluacion, pregunta, palabras_clave) VALUES(?,?,?)");

for ($i = 0; $i < count($preguntas); $i++) {
    $query_preguntas->bindParam(1, $id_evaluacion);
    $query_preguntas->bindParam(2, $preguntas[$i][0]);
    $query_preguntas->bindParam(3, $preguntas[$i][1]);
    $query_preguntas->execute();
}

echo $id_evaluacion;

cerrarConexion($conexion, $query_preguntas);
?>