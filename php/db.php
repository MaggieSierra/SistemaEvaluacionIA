<?php
    require_once "config.php";
    
    // Conexión a BD y Funciones de consulta
    function obtenerConexion() {
		$con = new PDO(DB_DSN,DB_USERNAME,DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
		return $con; 
    }
    
    function cerrarConexion($con, $query) {
        $query->null;
        $con->null;
    }

?>