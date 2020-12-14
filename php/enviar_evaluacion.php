<?php
    require("../php/security.php");
    Seguridad();

    $id_evaluacion = $_POST["id_evaluacion"];
    $id_usuario = $_SESSION["id_usuario"];
    $porcentaje_total = 0;
    $count = 1;

    $conexion = obtenerConexion();

    $query = $conexion->prepare("SELECT * FROM Pregunta WHERE id_evaluacion = ?");
    $query->bindParam(1, $id_evaluacion);
    $query->execute();
    $preguntas = $query->fetchAll();
    
    $query = $conexion->prepare("INSERT INTO Respuesta(id_evaluacion,id_pregunta,id_usuario,respuesta) VALUES(?,?,?,?)");

    foreach($preguntas as $row){
        $respuesta = $_POST["respuesta".$count];

        $query->bindParam(1, $id_evaluacion);
        $query->bindParam(2, $row['id_pregunta']);
        $query->bindParam(3, $id_usuario);
        $query->bindParam(4, $respuesta);
        $query->execute();

        //revisar si tiene las palabras clave
        $palabras_clave = explode(",", $row['palabras_clave']); 
        $count_palabras = sizeof($palabras_clave);
        $palabras_encontradas = 0;

        foreach($palabras_clave as $clave){
            $pos = strpos($respuesta, $clave);
            if($pos === false){
                echo $clave . ": - <br>";
            } else{
                echo $clave . ": encontrada <br>";
                $palabras_encontradas ++;
            }
        }

        $porcentaje = ($palabras_encontradas*60)/$count_palabras;

        $porcentaje_total += $porcentaje;
        echo $porcentaje . "%<br><br>"; 
    }

    $total = $porcentaje_total/count($preguntas);

    echo "Calificación: " . $total; 

    $query = $conexion->prepare("INSERT INTO Calificacion (id_usuario, id_evaluacion, calificacion) VALUES (?,?,?)");
    $query->bindParam(1, $id_usuario);
    $query->bindParam(2, $id_evaluacion);
    $query->bindParam(3, $total);
    $query->execute();
    $id_calificacion = $conexion->lastInsertId();

    cerrarConexion($conexion, $query_preguntas);
    header("Location:../vstudent/calificacion.php?id=".$id_calificacion.".php");
?>