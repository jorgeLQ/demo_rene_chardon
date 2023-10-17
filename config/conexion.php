<?php
    require_once "global.php";

    $conexion = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
    mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');
    
    //Si tenemos un posible error en la conexión lo mostramos
    if(mysqli_connect_errno()){
        printf("fallo conexion a la base de datos: %s\n", mysqli_connect_errno());
        exit();
    }

    if(!function_exists('ejecutarConsulta')) 
    {
        
        //Función para ejecutar consulta
        function ejecutarConsulta($sql)
        {
            global $conexion;
            $query = $conexion->query($sql);
            return $query;
        }

        //Función para ejecutar una sola fila
        function ejecutarConsultaSimpleFila($sql)
        {
            global $conexion;
            $query = $conexion->query($sql);
            $row = $query->fetch_assoc();
            return $row;
        }

        //Función para ejecutar consulta retornar un Id
        function ejecutarConsulta_retornarID($sql)
        {
            global $conexion;
            $query = $conexion->query($sql);
            return $conexion->insert_id;
        }

        //Función para limpiar las cadenas
        function limpiarCadena($str)
        {
            global $conexion;
            $str = mysqli_real_escape_string($conexion, trim($str));
            return htmlspecialchars($str);
        }
    }
?>