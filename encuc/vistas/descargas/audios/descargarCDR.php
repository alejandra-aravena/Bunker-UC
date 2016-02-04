<?php
session_start();
if((!(isset($_SESSION['username']))) || (!$_SESSION['admin'])){ 
	?><script language="JavaScript">window.open("../../../index.php", "_self")</script><?php
}?>
<!DOCTYPE html>
<html lang="es">
	<head>
  		<?php include_once('../../includes/head.php'); ?>
    
    	<title>Bunker 2.0 - Descargar Audios</title>
  	</head>
    <body>

<?php include_once('../../includes/navbar.php'); ?>
<?php include_once('../../includes/sidebar.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h2 class="sub-header">Descargar Audios</h2>

        <div class="cargando"><img src="../../img/spinning-circles.svg" /></div>
        <div class="form-group">     
                <button type="button" class="btn btn-danger btn-sm" aria-label="Eliminar" id="Eliminar">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    Eliminar archivos ZIP del directorio
                </button>
    		</div>
        <hr />
        <h4 style="color:#888;">Si no se indica el día, comprimirá los archivos correspondientes manteniendo las carpetas por dia originales, para todo el mes</h4>
        <hr />

        <form class="form-inline" onsubmit="return false">
            <div class="form-group">
                <label for="ano1" class="sr-only">Año</label>
                <input type="input" class="form-control" id="ano1" placeholder="Año (YYYY)" required />
            </div>
            <div class="form-group">
                <label for="mes1" class="sr-only">Mes</label>
                <input type="input" class="form-control" id="mes1" placeholder="Mes (MM)" required />
           </div>
           <div class="form-group">
                <label for="dia1" class="sr-only">Dia</label>
                <input type="input" class="form-control" id="dia1" placeholder="dia (DD)" required />
           </div>
          
           <div class="form-group">     
                <button type="button" class="btn btn-primary btn-sm" aria-label="Descarga" id="DescargaDia">
                    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                    Descargar Zip x Fecha
                </button>
    		</div>
       </form>
       </div>
       <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"  style=" padding-top: 0;">
       <hr style="margin-top: 0px;" />
        <form class="form-inline" onsubmit="return false">
            <div class="form-group">
                <label for="ano2" class="sr-only">Año</label>
                <input type="input" class="form-control" id="ano2" placeholder="Año (YYYY)" required />
            </div>
            <div class="form-group">
                <label for="mes2" class="sr-only">Mes</label>
                <input type="input" class="form-control" id="mes2" placeholder="Mes (MM)" required />
           </div>
           <div class="form-group">
                <label for="dia2" class="sr-only">Dia</label>
                <input type="input" class="form-control" id="dia2" placeholder="dia (DD)" required />
           </div>
           <div class="form-group">
                <label for="estacion" class="sr-only">Estación</label>
                <input type="input" class="form-control" id="estacion" placeholder="NB (10xx)" required />
           </div>
          
           <div class="form-group">     
                <button type="button" class="btn btn-info btn-sm" aria-label="Descarga" id="DescargaEstacion">
                    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                    Descargar Zip x Fecha y Estacion
                </button>
    		</div>
       </form>

       </div>
       <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main"  style=" padding-top: 0;">
       <hr style="margin-top: 0px;" />
        <form class="form-inline" onsubmit="return false">
            <div class="form-group">
                <label for="ano3" class="sr-only">Año</label>
                <input type="input" class="form-control" id="ano3" placeholder="Año (YYYY)" required />
            </div>
            <div class="form-group">
                <label for="mes3" class="sr-only">Mes</label>
                <input type="input" class="form-control" id="mes3" placeholder="Mes (MM)" required />
           </div>
           <div class="form-group">
                <label for="dia3" class="sr-only">Dia</label>
                <input type="input" class="form-control" id="dia3" placeholder="dia (DD)" required />
           </div>
           <div class="form-group">
                <label for="telefono" class="sr-only">Teléfono</label>
                <input type="input" class="form-control" id="telefono" placeholder="Teléfono Caso" required />
           </div>
          
           <div class="form-group">     
                <button type="button" class="btn btn-success btn-sm" aria-label="Descarga" id="DescargaTelefono">
                    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                    Descargar Zip x Fecha y Telefono
                </button>
    		</div>
       </form>
       </div>
       
<!-- Modal -->
<div class="modal fade" id="DescargarModal" tabindex="-1" role="dialog" aria-labelledby="DescargarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="DescargarModalLabel">Descarga de ZIP</h4>
      </div>
      <div class="modal-body">
        El archivo <strong id="strDescarga2"></strong> esta listo para la descarga
        <input type="hidden" id="strDescarga" value="" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="descargarZIP">Descargar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="EliminarModal" tabindex="-1" role="dialog" aria-labelledby="EliminarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="EliminarModalLabel">Eliminación de ZIPs</h4>
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



<?php include_once('../../includes/footer.php'); ?> 

<script language="javascript" src="../../js/descargarCDR.js"></script>     

	</body>
</html>