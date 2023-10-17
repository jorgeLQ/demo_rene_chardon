<?php
 // INCLUIMOS INICIALMENTE LA CONEXIÓN A LA BASE DE DATOS
 require "../config/conexion.php";
 
    Class Factura{

        //IMPLEMENTAMOS EL CONSTRUCTOR
        public function __construct(){
        
        }
        
        //MÉTODO PARA INSERTAR REGISTROS
        public function insertar($identificacion,$nombres,$apellidos, 
        $sexo, $correo, $telefono, $total, $cod_articulo,$desc_articulo,
        $cantidad,$precio,$ivap,$subtotal,$id_cabecera) {

            return "";    
        }


        // MÉTODO PARA MOSTRAR UN REGISTRO A EDITAR
        public function mostrar ($idpersona) {
            $sql= "SELECT * FROM persona WHERE idpersona = '$idpersona'";
            return ejecutarConsultaSimpleFila($sql);
        }

        
        // Método que lista las personas con ROL Cliente luego se envia a CARPETA AJAX cliente .php op listar
        public function listar() {
            $sql= "SELECT c.id_cabecera, c.identificacion, CONCAT(c.nombres, ' ' ,c.apellidos) as nombres, c.correo, c.telefono, c.estado
                    FROM `cabecera` c";
            return ejecutarConsulta($sql);
        }

        // METODO PARA DESACTIVAR CLIENTES
        public function desactivar($id_cabecera) {
            $sql= "UPDATE cabecera SET estado = '0' WHERE id_cabecera = '$id_cabecera'";
            return ejecutarConsulta($sql);
        }

        // METODO PARA ACTIVAR CLIENTES
        public function activar($id_cabecera) {
            $sql= "UPDATE cabecera SET estado = '1' WHERE id_cabecera = '$id_cabecera'";
            return ejecutarConsulta($sql);
        }

        public function listaciudad(){
            $sql="SELECT * from ciudad";
            return ejecutarConsulta($sql);
            
        }
               

    } //END CLASS PERSONA
?>