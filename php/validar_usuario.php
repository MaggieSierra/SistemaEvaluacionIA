<?php 
require_once "db.php";

if( isset($_POST['usuario']) && isset($_POST['password'])){
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);

    //Establecer conexion con BD
    $conexion = obtenerConexion();

    //FALTA COMPARAR HASH CON LA CONTRASEÑA INTRODUCCIDA
    $query = $conexion->query("SELECT id_usuario, nombre, id_rol FROM Usuario WHERE usuario = '$usuario' AND password = '$password'");

    if($query->rowCount() == 1):
        $datos = $query->fetch(PDO::FETCH_ASSOC);
        echo json_encode(array('error' => false, 'rol' => $datos['id_rol']));
    else:
        echo json_encode(array('error' => true));
    endif;  

}else{
    echo "Hubo un error";
}
?>