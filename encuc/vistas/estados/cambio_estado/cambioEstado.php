<?php
session_start();
if((!(isset($_SESSION['username']))) || (!$_SESSION['admin'])){ 
	?><script language="JavaScript">window.open("../../../index.php", "_self")</script><?php
}?>
<!DOCTYPE html>
<html lang="es">
	<head>
  		<?php include_once('../../includes/head.php'); ?>
        
        <link rel="stylesheet" type="text/css" href="../../../librerias/datapicker/css/bootstrap-datetimepicker.min.css" />	
    
    	<title>Bunker 2.0 - Cambiar Estados Masivamente por Estación</title>
  	</head>
    <body>

<?php include_once('../../includes/navbar.php'); ?>
<?php include_once('../../includes/sidebar.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    	<h2 class="sub-header">Cambiar Estados Masivamente por Estación</h2>
        <div class="cargando"><img src="../../img/spinning-circles.svg" /></div>
    
    <div class="form-group">
		<label for="estacionesPosibles" class="sr-only">Estación:</label>
    <div class="col-sm-13">
      <div class="btn-group" data-toggle="buttons" id="estacionesPosibles" data-toggle="buttons">
      
      		<button type="button" class="btn btn-success btn-sm" aria-label="Ver" id="verEst" disabled="disabled">
             	<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                	Estacion:
            </button>
      </div>
    </div>
  </div>
  
    <div class="form-group">
		<label for="estadoOriginal" class="sr-only">Estado a corregir:</label>
    <div class="col-sm-13">
      <div class="btn-group" data-toggle="buttons" id="estadoOriginal" data-toggle="buttons">
      		<button type="button" class="btn btn-warning btn-sm" aria-label="antiguoEstado" id="antiguoEstado" disabled="disabled">
             	<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                	Estado a corregir:
            </button>
      </div>
    </div>
  </div> 
  
   <div class="form-group">
		<label for="estadoNuevo" class="sr-only">Nuevo Estado:</label>
    <div class="col-sm-13">
      <div class="btn-group" data-toggle="buttons" id="estadoNuevo" data-toggle="buttons">
      		<button type="button" class="btn btn-danger btn-sm" aria-label="nuevoEstado" id="nuevoEstado" disabled="disabled">
             	<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                	Nuevo Estado:
            </button>
      </div>
    </div>
  </div> 
  
  <div class="btn-group" role="group">
  <button type="button" class="btn btn-primary btn-sm" aria-label="editEstado" id="editEstado">
        	<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
            Sobre-escribir Estado
        </button> 

  <button type="button" class="btn btn-info btn-sm" aria-label="addEstado" id="addEstado">
        	<span class="glyphicon glyphicon-play" aria-hidden="true"></span>
            Agregar Estado
        </button> 
  </div>
  
  </div>
      
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<div class="alert alert-danger" role="alert" id="operacionError" style="display: none;">No se pudo realizar la operación</div>

<div class="alert alert-info" role="alert" id="listadoRes" style="display: none;">No hay resultados</div>
        <div class="table-responsive" style="display:none;">
        
            <table class="table table-striped listados" id="listarCambiados">
              <thead>
              	<th>ID Caso</th>
                <th>Operación</th>
                <th>Resultado</th>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
</div>
        
<?php include_once('../../includes/footer.php'); ?>   

<script type="text/javascript" src="../../../librerias/moment/moment-with-locales.js"></script>
<script type="text/javascript" src="../../../librerias/datapicker/js/bootstrap-datetimepicker.min.js"></script>

<script language="javascript" src="../../js/cambioEstado.js"></script>     

	</body>
</html>