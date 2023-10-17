<?php

session_start();
    require_once "../modelos/Factura.php";
    
    $factura = new Factura();

    $id_cabecera = isset($_POST["id_cabecera"])? limpiarCadena($_POST["id_cabecera"]):"";  
    $identificacion= isset($_POST["identificacion"])? limpiarCadena($_POST["identificacion"]):"";
    $sexo= isset($_POST["sexo"])? limpiarCadena($_POST["sexo"]):"";
    $nombres= isset($_POST["nombres"])? limpiarCadena($_POST["nombres"]):"";
    $apellidos= isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
    $correo = isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
    $telefono= isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";

    switch ($_GET["op"]) {

        case 'guardaryeditar':
            if (empty($id_cabecera)) {
                $rspta = $factura->insertar($identificacion,$nombres,$apellidos, 
                $sexo, $correo, $telefono, $total, $_POST["cod_articulo"],$_POST["desc_articulo"],
                $_POST["cantidad"],$_POST["precio"],$_POST["ivap"],$_POST["subtotal"],$_POST["id_cabecera"]);
                echo $rspta ? "Cita registrada" : "La cita no se pudo registrar";
                
            } else {


            }

            
        break;

        case 'mostrar':
            $rspta=$factura->mostrar($id_cabecera);
            echo json_encode($rspta);
        break;

        case 'listar':
            $rspta=$factura->listar();
            $data = Array();
            while ($reg=$rspta->fetch_object()) {
                $data[]= array(
                    "0"=> ($reg->estado) ?
                        '<div class="text-center"><button class="btn btn-warning btn-sm" onclick="mostrar('.$reg->id_cabecera.')" title="Editar Factura"><li class="fa fa-pencil-alt"></li></button>'.
                        ' <button class="btn btn-danger btn-sm" onclick="desactivar('.$reg->id_cabecera.')" title="Desactivar"><li class="fa fa-times"></li></button></div>':
                        '<div class="text-center"><button class="btn btn-warning btn-sm" onclick="mostrar('.$reg->id_cabecera.')"><li class="fa fa-pencil-alt"></li></button>'.
                        ' <button class="btn btn-primary btn-sm" onclick="activar('.$reg->id_cabecera.')" title="Activar"><li class="fa fa-check"></li></button></div>',
                    "1"=>$reg->identificacion,
                    "2"=>$reg->nombres,
                    "3"=>$reg->correo,
                    "4"=>$reg->telefono
                );
            }

            $results = array(
                "sEcho"=>1,//informacion para el datatable
                "iTotalRecords"=>count($data),//enviamos el total registros al datatable
                "iTotalDisplayRecords"=>count($data),//enviamos el total registros a visualizar
                "aaData"=>$data); 
 
            echo json_encode($results);   
        break;  
        
        case 'listarProductos':
            require_once "../modelos/Productos.php";
            $producto = new Productos();
            $rspta = $producto->listarProductos();
            $data = Array();
            while ($reg=$rspta->fetch_object()) {
                $data[]= array(
                    "0"=>'<div class="text-center">
                            <button class="btn btn-warning btn-sm" onclick="agregarProductos('.$reg->id_productos.',
                                    \''.$reg->nombre.'\',\''.$reg->codigo.'\',\''.$reg->descripcion.'\'
                                    ,\''.$reg->precio.'\',\''.$reg->iva.'\')" title="Agregar Producto">
                            <span class="fa fa-plus"></span></button>
                        </div>',
                    "1"=>$reg->nombre,
                    "2"=>$reg->codigo,
                    "3"=>$reg->descripcion
                );
            }
            $results = array(
                "sEcho"=>1,//informacion para el datatable
                "iTotalRecords"=>count($data),//enviamos el total registros al datatable
                "iTotalDisplayRecords"=>count($data),//enviamos el total registros a visualizar
                "aaData"=>$data);
                //Codificar el resultado utilizando json    
                echo json_encode($results);
        break;
        case 'desactivar':
            $rspta=$factura->desactivar($id_cabecera);
            echo $rspta ? "factura desactivada" : "No se pudo desactivar";
    
        break;

        case 'activar':
            $rspta=$factura->activar($id_cabecera);
            echo $rspta ? "factura activada" : "No se pudo activar";
    
        break;

        case 'ciudad':
            $rspt=$factura->listaciudad();
            while ($reg = $rspt->fetch_object()){
                echo '<option value='.$reg->id_ciudad.'>'.$reg->nombre.'</option>';
            }
    }
    

?>