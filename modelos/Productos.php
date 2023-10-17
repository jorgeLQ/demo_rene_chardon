<?php
 // INCLUIMOS INICIALMENTE LA CONEXIÓN A LA BASE DE DATOS
 require "../config/conexion.php";
 
    Class Productos{

        //IMPLEMENTAMOS EL CONSTRUCTOR
        public function __construct(){
        
        }
        
        //MÉTODO PARA INSERTAR REGISTROS
        public function insertar($cedula, $nombres, $apellidos, $email, $telefono, $direccion, $ciudad_residencia, $fecha_nacimiento, $genero, $roles) {
            $sql= "INSERT INTO persona (cedula, nombres, apellidos, email, telefono, direccion, ciudad_residencia, fecha_nacimiento, genero, estado) 
            VALUES ('$cedula', '$nombres', '$apellidos', '$email', '$telefono', '$direccion','$ciudad_residencia', '$fecha_nacimiento', '$genero', 1)";

            $idpersonanew = ejecutarConsulta_retornarID($sql);
            $num_elementos=0;
            $sw=true;

            while ($num_elementos < count($roles)) { 
                //INSERTAMOS CADA UNO DE LOS ROLES DEL USUARIO, CON WHILE RECORREMOS TODOS LOS PERMISOS ASIGNADOS
                $sql_detalle = "INSERT INTO persona_has_rol (persona_idpersona, rol_idrol) 
                            VALUES('$idpersonanew','$roles[$num_elementos]')";
                            //ENVIAMOS LA VARIABLE.. TRUE SI ES DE MANERA CORRECTA
                ejecutarConsulta($sql_detalle) or $sw = false;
                $num_elementos = $num_elementos +1;
            }
            return $sw;    
        }

        //MÉTODO PARA EDITAR REGISTROS DEL CLIENTE
        public function editarCliente ($idpersona, $cedula, $nombres, $apellidos, $email, $telefono, $direccion, $ciudad_residencia, $fecha_nacimiento, $edad,$genero, $imagen) {
            $sql= "UPDATE persona SET cedula='$cedula', nombres='$nombres', apellidos='$apellidos', email='$email', telefono='$telefono', direccion='$direccion', ciudad_residencia='$ciudad_residencia', 
            fecha_nacimiento='$fecha_nacimiento', edad='$edad', genero='$genero'
            WHERE idpersona = '$idpersona'";
            return ejecutarConsulta($sql);

        }

        // MÉTODO PARA MOSTRAR UN REGISTRO A EDITAR
        public function mostrar ($idpersona) {
            $sql= "SELECT * FROM persona WHERE idpersona = '$idpersona'";
            return ejecutarConsultaSimpleFila($sql);
        }

        
        // Método que lista las personas con ROL Cliente luego se envia a CARPETA AJAX cliente .php op listar
        public function listarProductos() {
            $sql= "SELECT * FROM `productos`";
            return ejecutarConsulta($sql);
        }

        

    } //END CLASS PERSONA
?>