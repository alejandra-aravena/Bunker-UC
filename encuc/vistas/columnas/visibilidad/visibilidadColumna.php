<?php
session_start();
if((!(isset($_SESSION['username']))) || (!$_SESSION['admin'])){ 
	?><script language="JavaScript">window.open("../../../index.php", "_self")</script><?php
}?>
<!DOCTYPE html>
<html lang="es">
	<head>
  		<?php include_once('../../includes/head.php'); ?>
    
    	<title>Bunker 2.0 - Columnas Base</title>
  	</head>
    <body>

<?php include_once('../../includes/navbar.php'); ?>
<?php include_once('../../includes/sidebar.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    	<h2 class="sub-header">Visibilidad Columna</h2>
        <button type="button" class="btn btn-default btn-sm" aria-label="Agregar Nuevo" id="sincro">
        	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Sincronizar Columnas
        </button>
        <div class="cargando"><img src="../../img/spinning-circles.svg" /></div>
        <div class="table-responsive">
        
            <table class="table table-striped listados" id="listarT">
              <thead>
                <tr>
                  <th>Columna</th>
                  <th>Visibilidad</th>
                  <th>Administrar</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>

<!-- Modal Editar -->
<div class="modal fade" id="editarModal" role="dialog" aria-labelledby="editar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editar">Editar</h4>
      </div>
      <div class="modal-body">
      
      <?php include_once('editarVisibilidadColumna.php'); ?>
      <div class="alert alert-danger" role="alert" id="editMalRelleno" style="display: none;"></div>
      <div class="alert alert-warning" role="alert" id="editError" style="display: none;"></div>
      <div class="alert alert-success" role="alert" id="editOk" style="display: none;"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="editarBtn">Guardar</button>
      </div>
    </div>
  </div>
</div> 
        </div>
        
<?php include_once('../../includes/footer.php'); ?> 

<script language="javascript" src="../../js/visibilidadColumna.js"></script>        

	</body>
</html>