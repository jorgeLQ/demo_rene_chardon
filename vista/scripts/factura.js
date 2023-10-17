var tabla;

function init() {
    mostrarform(false);
    listar();
    $("#formulario").on("submit",function(e){
        guardaryeditar(e);
    });

    $.post("../../controlador/factura.php?op=ciudad", function(r){
        $('#ciudad').html(r);
    })
}


function limpiar() {
    $("#idpersona").val("");
    $("#cedula").val("");
    $("#nombres").val("");
    $("#apellidos").val("");
    $("#email").val("");
    $("#telefono").val("");
    $("#direccion").val("");
    $("#ciudad_residencia").val("");    
    $("#fecha_nacimiento").val("");
    $("#edad").val("");
    $("#genero").val("");
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
    $('#cedula').css("background-color", "#FFFFFF");
}


function mostrarform(flag) {
    limpiar();
    if(flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled",false);
        $("#btnagregar").hide();
        listarProductos();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}



function cancelarform(){
    limpiar();
    mostrarform(false);
}



function listar(){
    tabla=$('#tbllistado').dataTable({
        "aProcessing":true, 
        "aServerSide": true, 
        dom: 'Bfrtip',
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        
        buttons:[
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax":{
            url: '../../controlador/factura.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e){
                console.log(e.responseText);
            }
        },
        "bDestroy":true,
        "iDisplayLength": 5, //PAGINACIÓN --> CADA 5 REGISTROS
        "order": [[0, "desc" ]] //ORDENAR (COLUMNA, ORDEN)
    }).DataTable();
}



function guardaryeditar(e){
    e.preventDefault(); // No se activara la acción predeterminada del evento
    $("#btnGuardar").prop("disabled",true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../../contolador/factura.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos){
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }
    });
    limpiar();
}


//FUNCIÓN MOSTRAR 
function mostrar(id_cabecera){
    $.post(".../../controlador/factura.php?op=mostrar",{id_cabecera : id_cabecera}, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#cedula").val(data.cedula);
        $("#nombres").val(data.nombres);
        $("#apellidos").val(data.apellidos);
        $("#email").val(data.email);
        $("#telefono").val(data.telefono);

    })
}






function listarProductos() {
    tabla=$('#tblproductos').dataTable({
        "aProcessing":true, 
        "aServerSide": true, 
        dom: 'Bfrtip', 
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        buttons:[
        ],
        "ajax":{
            url: '../../controlador/factura.php?op=listarProductos',
            type: "get",
            dataTyoe: "json",
            error: function(e){
                console.log(e,responseText);
            }
        },
        "bDestroy":true,
        "iDisplayLength": 5, 
        "order": [[0, "desc" ]] 
    }).DataTable();
}
// FUNCIÓN AGREGAR 
var cont = 0;
var detalles = 0;

function agregarProductos(id_productos,nombre,codigo,descripcion,precio,iva) 
{
    var cantidad = 1;
    var ivat=0
    var precioprod=0
    var subtotal=0
    ivat= (precio *iva/100);
    precioprod=precio;
    //var precio2= intval(precio);
    subtotal = parseFloat(precioprod)+ivat;
    //var observaciones="";
    if (id_productos != "") {
        var fila = '<tr class="filas" id="fila'+cont+'">'+
        '<td><div class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto('+cont+')" title="Eliminar medicamento">X</button></div></td>'+
        '<td><input type="hidden" name="id_productos[]" value="'+id_productos+'">'+nombre+'</td>'+
        '<td><input type="hidden" name="cod_articulo[]" value="">'+codigo+'</td>'+
        '<td><input type="hidden" name="desc_articulo[]" value="">'+descripcion+'</td>'+
        '<td><input type="number" max="100" min="1" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
        '<td><input type="hidden" name="precio[]" value="">$ '+precio+'</td>'+
        '<td><input type="hidden" name="ivap[]" value="">'+iva+' %</td>'+
        '<td><input type="hidden" name="subtotal[]" value="">'+subtotal+'</td>'
        '</tr>';
        cont++;
        detalles= detalles+1;
        $('#productos').append(fila);
    } else {
        bootbox.alert("Error al ingresar el producto")
    }
}


function eliminarProducto(indice) {
    $("#fila" + indice).remove();
  	detalles=detalles-1;
}


function desactivar(id_cabecera) {
    alertify.confirm("Factura","¿Estas seguro de desactivar la Factura?", function() {
        $.post("../../controlador/factura.php?op=desactivar", {id_cabecera : id_cabecera}, function(e) {
            //alertify.alert(e);
            tabla.ajax.reload();
            alertify.success('Factura desactivada');
        });
        },
        function(){
            alertify.error('Cancelado');
    });
}

function activar(id_cabecera) {
    alertify.confirm("Factura","¿Estas seguro de activar la Factura?", function() {
        $.post("../../controlador/factura.php?op=activar", {id_cabecera : id_cabecera}, function(e) {
            //alertify.alert(e);
            tabla.ajax.reload();
            alertify.success('Factura activada');
        });
    },
        function(){
            alertify.error('Cancelado');
        });
}



init();