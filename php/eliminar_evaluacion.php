<?php

require("security.php");

if(isset($_POST['id'])){
    $conexion = obtenerConexion();

    $borrado = 1;
    $query= $conexion->prepare("UPDATE Evaluacion SET borrado = ? WHERE id_evaluacion = ?");
    $query->bindParam(1, $borrado);
    $query->bindParam(2, $id_evaluacion);
    $query->execute();
    
    cerrarConexion($conexion, $query_preguntas);
}

header("Location:../vteacher/evaluaciones.php");
?>