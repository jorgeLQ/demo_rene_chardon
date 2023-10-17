<?php
  require 'header.php';
?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
            

        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-sm-6">
          <h1 class="box-title">factura <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Nueva Factura</button></h1> 
        </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card">
            <div class="card-body">                 
              <div class="panel-body table-responsive" id="listadoregistros">
                <table id="tbllistado" class="table table-striped table-bordered table-hover dt-responsive DT nowrap">
                  <thead>
                    <th>Acciones</th>
                    <th>Cédula</th>
                    <th>Nombres</th>
                    <th>Email</th>
                    <th>teléfono</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table> <!-- .tbllistado -->
              </div><!-- /.panel-body table -->

              <!-- FORMULARIO PARA REGISTRAR UN CLIENTE EN LÍNEA Y DESDE EL PERFIL DE ADMINISTRADOR-->
              <div class="panel-body" id="formularioregistros">
                <form name="formulario" id="formulario" method="POST">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="">Cédula(*)</label>
                      <input type="hidden" name="idpersona" id="idpersona">
                      <input type="text" name="cedula" id="cedula" class="form-control" maxlength="13" minlength="13" onkeypress="return /[0-9]/i.test(event.key)"  placeholder="Cédula" required>
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="">Nombres(*)</label>
                      <input type="text" name="nombres" id="nombres" class="form-control" onkeypress="return /^[a-z ñáéíóú]$/i.test(event.key)"  maxlength="45" placeholder="Nombres" required>
                    </div>

                    <div class="form-group col-md-6">
                      <label for="">Apellidos(*)</label>
                      <input type="text" name="apellidos" id="apellidos" class="form-control" onkeypress="return /^[a-z ñáéíóú]$/i.test(event.key)" maxlength="45" placeholder="Apellidos"required>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="">Email(*)</label>
                      <input type="text" name="email" id="email" maxlength="45" class="form-control"  placeholder="email@address.com" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" >
                    </div>

                    <div class="form-group col-md-6">
                      <label for="">Teléfono(*)</label>
                      <input type="text" name="telefono" id="telefono" maxlength="10" minlength="10" class="form-control" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Teléfono">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Género(*)</label>
                        <br>
                        <select class="form-control input-lg" name="genero" id="genero">
                            <option value="" disabled selected hidden>Selecciona una opción</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="">Ciudad(*)</label>
                      <br>
                        <select class="form-control input-lg" name="ciudad" id="ciudad">
                            <!--<option value="" disabled selected hidden>Selecciona una opción</option>
                            <option value=""></option>
                            <option value=""></option>-->
                        </select>
                     </div>
                    
                </div><!-- /.form-row -->
                    
                <div class="form-row">
                    <a data-toggle="modal" href="#myModal">
                        <button id="btnAgregarMedi" type="button" class="btn btn-primary">
                        <span class="fa fa-plus"></span> Agregar Productos </button>
                      </a>

                </div>

                <div class="panel-body table-responsive">
                      <div class="form-group col-md-6 col-md-12" >
                        <table id="productos" class="table table-striped table-bordered table-hover dt-responsive DT">
                          <thead style="background-color:#A9D0F5">
                            <th>Acción</th>
                            <th>Nombre</th>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>precio</th>
                            <th>iva</th>
                            <th>subtotal</th>
                          </thead>
                          <tbody>
                                      
                          </tbody>
                        </table> <!-- .table-->
                        <h3>Subtotal</h3>
                        <h3>IVA 12%</h3>
                        <h3>Total</h3>
                      </div> <!-- .form-group-->
                </div>


                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"> Guardar</i></button>
                    <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"> Cancelar</i></button>
                  </div>
                </form><!-- /.formulario -->
              </div> <!-- /.panel-body formulario-->

            </div> <!-- /.card-body -->
          </div> <!-- /.card -->
                
            </div>

        </div>
    </div>
</div>
        <!-- /page content -->

<!--Modal Seleccionar -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <div class="modal-header">
          <h4 class="modal-title">Seleccione un producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>

        <div class="modal-body table-responsive">
          <table id="tblproductos" class="table table-striped table-bordered table-hover dt-responsive DT">
            <thead>
              <th>Acción</th>
              <th>Nombre</th>
              <th>Codigo</th>
              <th>Descripción</th>
            </thead>
            <tbody>
              
            </tbody>
          </table> <!-- .tblproductos-->
        </div> <!-- .modal-body-->

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div> <!-- .modal-content-->
    </div> <!-- .modal-dialog-->
  </div> <!-- .modal .fade-->
<!--Fin Modal productos-->


<?php
  require 'footer.php';
?>
<script type="text/javascript" src="../scripts/factura.js"></script>