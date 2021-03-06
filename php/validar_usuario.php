<?php 
require_once "db.php";
session_start();

if( isset($_POST['usuario']) && isset($_POST['password'])){
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    $conexion = obtenerConexion();

    $query = $conexion->query("SELECT id_usuario, nombre, id_rol, password FROM Usuario WHERE usuario = '$usuario' LIMIT 1");

    if($query->rowCount() == 1):
        $datos = $query->fetch(PDO::FETCH_ASSOC);
        if (password_verify(trim($password), $datos['password'])):
            echo json_encode(array('error' => false, 'rol' => $datos['id_rol']));
            $_SESSION['usuario'] = $usuario;
            $_SESSION['nombre'] = $datos['nombre'];
            $_SESSION['id_usuario'] = $datos['id_usuario'];
            $_SESSION['rol'] = $datos['id_rol'];
        else: echo json_encode(array('error' => true, 'password' => 'incorrecta'));
        endif;
    else:
        echo json_encode(array('error1' => true));
    endif;  

}else{
    echo "Hubo un error";
}
?>