<?php 
require("../php/security.php");
Seguridad();
if($_SESSION['rol'] == 2){
    header('Location: index.php');
}

$conexion = obtenerConexion();

if(isset($_POST['inputNombre'])){
    $nombre = trim($_POST['inputNombre']);

    $query = $conexion->prepare("INSERT INTO Materia (id_usuario, nombre_materia) VALUES (?, ?)");
    $query->bindParam(1, $_SESSION['id_usuario']);
    $query->bindParam(2, $nombre);
    $query->execute();
    $result = $query->fetchAll();
}

cerrarConexion($conexion, $query);
header("Location:../vteacher/materias.php");
?>