<?php 
require_once "db.php";
setlocale(LC_TIME, 'spanish');
date_default_timezone_set("America/Mexico_City");
session_start();
error_reporting(0);

if(isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['usuario']) && isset($_POST['password']) && isset($_POST['rol'])){
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $id_rol = trim($_POST['rol']);

    //Establecer conexión a BD
    $conexion = obtenerConexion();

    $query = $conexion->prepare("SELECT id_usuario FROM Usuario WHERE Usuario = ? LIMIT 1");
    $query->bindParam(1, $usuario);
    $query->execute();
    $result = $query->fetchAll();

    if(empty($result)){
        $fecha = date('Y-m-d H:i:s');
        $password= password_hash($password, PASSWORD_BCRYPT);
        $query = $conexion->prepare("INSERT INTO Usuario(id_rol, nombre, apellidos, usuario, password, fecha_registro)
         VALUES (?, ?, ?, ?, ?, ?)");
        $query->bindParam(1, $id_rol);
        $query->bindParam(2, $nombre);
        $query->bindParam(3, $apellidos);
        $query->bindParam(4, $usuario);
        $query->bindParam(5, $password);
        $query->bindParam(6, $fecha);
        $query->execute();
        $result = $query->fetchAll();
    }else{
        echo "El correo ya existe";
    }
}else{
    echo "Campos vacios";
}

?>
