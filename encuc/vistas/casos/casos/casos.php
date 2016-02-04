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
        <link rel="stylesheet" type="text/css" href="../../../librerias/datapicker/css/bootstrap-datetimepicker.min.css" />	
    
    	<title>Bunker 2.0 - Casos</title>
  	</head>
    <body>

<?php include_once('../../includes/navbar.php'); ?>
<?php include_once('../../includes/sidebar.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    	<h2 class="sub-header">Casos</h2>
        
        <div class="form-group"> 
        <button type="button" class="btn btn-info btn-sm" aria-label="Descargar" id="descargarExcel">
        	<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
            Descargar en Excel
        </button>    
                <button type="button" class="btn btn-danger btn-sm" aria-label="Eliminar" id="Eliminar">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    Eliminar archivos Excel por Caso del directorio
                </button>
    		</div>
        
        <hr />

        <div class="cargando"><img src="../../img/spinning-circles.svg" /></div>
        <div class="table-responsive">
        
            <table class="table table-striped listados" id="listarT">
              
            </table>
          </div>

<!-- Modal Ver detalleCasoModal -->
<div class="modal fade" id="detalleCasoModal" role="dialog" aria-labelledby="detalles" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="eliminar">Detalles Caso</h4>
      </div>
      <div class="modal-body">
      
      <?php include_once('detalleCaso.php'); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>          

<!-- Modal detalleHistModal -->
<div class="modal fade" id="detalleHistModal" role="dialog" aria-labelledby="editar" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editar">Detalle Historial</h4>
      </div>
      <div class="modal-body">
      
      <?php include_once('detalleHist.php'); ?>
            <div class="alert alert-warning" role="alert" id="estError" style="display: none;">Error al cambiar estado</div>
      		<div class="alert alert-success" role="alert" id="estOk" style="display: none;">Estado cambiado correctamente</div>
         
         </div>
      <div class="modal-footer">   
      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardarEstado">Guardar Nuevo Estado</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal detalleLlamadasModal -->
<div class="modal fade" id="detalleLlamadasModal" role="dialog" aria-labelledby="eliminar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="eliminar">Descargar ZIP Llamadas</h4>
      </div>
      <div class="modal-body">
      
      <?php include_once('detalleLlamadas.php'); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-warning" id="descargarAudio">Descargar audio</button>
      </div>
    </div>
  </div>
</div> 

<!-- Modal Link descarga -->
<div class="modal fade" id="DescargarModal" tabindex="-1" role="dialog" aria-labelledby="DescargarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="DescargarModalLabel">Descarga de Informes Excel por Caso</h4>
      </div>
      <div class="modal-body">
        El archivo <strong id="strDescarga2"></strong> esta listo para la descarga
        <input type="hidden" id="strDescarga" value="" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="descargarExcelLink">Descargar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Eliminar-->
<div class="modal fade" id="EliminarModal" tabindex="-1" role="dialog" aria-labelledby="EliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="EliminarModalLabel">Eliminación de Informes Excel por Caso</h4>
      </div>
      <div class="modal-body">
        <p id="resultadoEliminar"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

        </div>
        
<?php include_once('../../includes/footer.php'); ?> 
  
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="../../../librerias/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="../../../librerias/DataTables/dataTables.bootstrap.js"></script>

<script type="text/javascript" src="../../../librerias/moment/moment-with-locales.js"></script>
<script type="text/javascript" src="../../../librerias/datapicker/js/bootstrap-datetimepicker.min.js"></script>

<script language="javascript" src="../../js/casos.js"></script>        

	</body>
</html>