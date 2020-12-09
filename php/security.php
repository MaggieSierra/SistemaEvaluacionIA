<?php
    require("db.php");
    setlocale(LC_TIME, 'spanish');
    date_default_timezone_set("America/Mexico_City");
    session_start();
    error_reporting(0);
    
    
    /**
        * Comprueba que exista una sesion, sino redirige al login
        *
        * @return int estado
    */
    function Seguridad(){
        if (isset($_SESSION['usuario'])){
            return;
        }else{
            echo "<script language='javascript'> document.location.href='./login.php' </script>";
            exit();
        }
        
    }
?>