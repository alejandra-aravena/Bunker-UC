<?php
session_start();
if((!(isset($_SESSION['username']))) || (!$_SESSION['admin'])){ 
	?><script language="JavaScript">window.open("../../../index.php", "_self")</script><?php
}?>
<!DOCTYPE html>
<html lang="es">
	<head>
  		<?php include_once('../../includes/head.php'); ?>
    
    	<title>Bunker 2.0 - Roles de Usuarios</title>
  	</head>
    <body>

<?php include_once('../../includes/navbar.php'); ?>
<?php include_once('../../includes/sidebar.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    	<h2 class="sub-header">Roles de Usuarios</h2>
        
        <div class="cargando"><img src="../../img/spinning-circles.svg" /></div>
        <div class="table-responsive">
        
            <table class="table table-striped listados" id="listarT">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Usuario</th>
                  <th>Agregar</th>
                  <th>Roles</th>
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
          
<!-- Modal Agregar-->
<div class="modal fade" id="agregarModal" role="dialog" aria-labelledby="Agregar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="Agregar">Agregar</h4>
      </div>
      <div class="modal-body">
      
      <?php include_once('agregarRolesUsuario.php'); ?>
      <div class="alert alert-danger" role="alert" id="addMalRelleno" style="display: none;"></div>
      <div class="alert alert-warning" role="alert" id="addError" style="display: none;"></div>
      <div class="alert alert-success" role="alert" id="addOk" style="display: none;"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="agregarBtn">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade" id="eliminarModal" role="dialog" aria-labelledby="editar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="eliminar">Editar</h4>
      </div>
      <div class="modal-body">
      
      <?php include_once('eliminarRolUsuario.php'); ?>
      <div class="alert alert-warning" role="alert" id="delError" style="display: none;"></div>
      <div class="alert alert-success" role="alert" id="delOk" style="display: none;"></div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="eliminarBtn">Eliminar</button>
      </div>
    </div>
  </div>
</div> 


        </div>
        
<?php include_once('../../includes/footer.php'); ?> 

<script language="javascript" src="../../js/rolesUsuarios.js"></script>        

	</body>
</html>