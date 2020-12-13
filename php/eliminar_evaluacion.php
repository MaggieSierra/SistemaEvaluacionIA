<?php

require("security.php");

if(isset($_POST['id_evaluacion_eliminar'])){
    $conexion = obtenerConexion();

    $borrado = 1;
    $query= $conexion->prepare("UPDATE Evaluacion SET borrado = ? WHERE id_evaluacion = ?");
    $query->bindParam(1, $borrado);
    $query->bindParam(2, $_POST['id_evaluacion_eliminar']);
    $query->execute();
    
    cerrarConexion($conexion, $query);
}

header("Location:../vteacher/evaluaciones.php");
?>