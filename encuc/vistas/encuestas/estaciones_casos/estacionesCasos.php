<?php
session_start();
if((!(isset($_SESSION['username']))) || (!$_SESSION['admin'])){ 
	?><script language="JavaScript">window.open("../../../index.php", "_self")</script><?php
}?>
<!DOCTYPE html>
<html lang="es">
	<head>
  		<?php include_once('../../includes/head.php'); ?>
        
        <!-- DataTables CSS -->
		<!-- <link rel="stylesheet" type="text/css" href="../../../librerias/DataTables/media/css/jquery.dataTables.css"> -->
        <link rel="stylesheet" type="text/css" href="../../../librerias/DataTables/dataTables.bootstrap.css" />	
    
    	<title>Bunker 2.0 - Asignar Casos</title>
  	</head>
    <body>

<?php include_once('../../includes/navbar.php'); ?>
<?php include_once('../../includes/sidebar.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="padding-bottom:0px;">
    	<h2 class="sub-header">Asignar casos a estaciones</h2>
        
        <div class="form-group">     
                <button type="button" class="btn btn-danger btn-sm" aria-label="CasosSinEstacion" id="CasosSinEstacion">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    Listar Casos sin estación
                </button>
    		</div>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="padding-top: 0px;">
            <hr style="margin-top: 0px" />
        
        <form class="form-inline" onsubmit="return false">
            <div class="form-group">
                <label for="inicio" class="sr-only">Id caso inicio:</label>
                <input type="input" class="form-control" id="inicio" placeholder="Id caso inicio" required />
            </div>
            <div class="form-group">
                <label for="final" class="sr-only">Id caso final:</label>
                <input type="input" class="form-control" id="final" placeholder="Id caso final" required />
           </div>
           
           <div class="form-group">
                <label for="estacionesPosibles" class="sr-only">Estcion</label>
                <select class="form-control" placeholder="Id estacion (usuario)" id="estacionesPosibles">
                	<option>Estación...</option>
                </select>
           </div>
           
           <div class="form-group">  
                <button type="button" class="btn btn-success btn-sm" aria-label="Agregar Nuevo" id="agregarEC">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                    Agregar Estación a varios casos
                </button>
    		</div>
       </form>
      </div>
      
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style=" padding-top: 0;">
    	<hr style="margin-top: 0;">
        <form class="form-inline" onsubmit="return false">
            <div class="form-group">
                <label for="idCaso" class="sr-only">Id caso:</label>
                <input type="input" class="form-control" id="idCaso" placeholder="Id caso" required />
            </div>
         
           <div class="form-group">
                <label for="estacionesPosibles2" class="sr-only">Estcion</label>
                <select class="form-control" placeholder="Id estacion (usuario)" id="estacionesPosibles2">
                	<option>Estación...</option>
                </select>
           </div>
           
           <div class="form-group">  
          
                <button type="button" class="btn btn-warning btn-sm" aria-label="Agregar Nuevo" id="agregar1EC">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    Agregar una estación a un caso
                </button>
    		</div>
       </form>
      </div>
      
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style=" padding-top: 0;">
      <hr style="margin-top: 0;">
        <form class="form-inline" onsubmit="return false">
           <div class="form-group">
                <label for="estacionesPosiblesVer" class="sr-only">Estcion</label>
                <select class="form-control" placeholder="Id estacion (usuario)" id="estacionesPosiblesVer">
                	<option>Estación...</option>
                </select>
           </div>
           <div class="form-group">     
                <button type="button" class="btn btn-info btn-sm" aria-label="Ver" id="verEC">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    Mostrar Estacion Casos
                </button>
    		</div>
       </form>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style=" padding-top: 0;">
      <hr style="margin-top: 0;">
        <div class="cargando"><img src="../../img/spinning-circles.svg" /></div>
        <div class="table-responsive">
        
            <table class="table table-striped listados" id="listarT" >
             
            </table>
          </div>
         

</div>

<!-- Modal Resultado -->
<div class="modal fade" id="ResultadoModal" role="dialog" aria-labelledby="resultadoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="resultadoModalLabel">Asignaciones</h4>
      </div>
      <div class="modal-body">
       <h5>Resultado de asignaciones:</h5>
       <h6 id="agregadas"><strong></strong> casos fueron asignados</h6>
       <h6 id="editadas"><strong></strong> casos fueron re-asignados</h6>
       <h6 id="errores"><strong></strong> casos no fueron asignados</h6> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Resultado Solo -->
<div class="modal fade" id="ResultadoSoloModal" role="dialog" aria-labelledby="resultadoSoloModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="resultadoSoloModalLabel">Asignaciones</h4>
      </div>
      <div class="modal-body">
       <h5 id="resultadoSolo"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div> 
        
<?php include_once('../../includes/footer.php'); ?> 

<script language="javascript" src="../../js/estacionesCasos.js"></script>   

<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="../../../librerias/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="../../../librerias/DataTables/dataTables.bootstrap.js"></script>      

	</body>
</html>