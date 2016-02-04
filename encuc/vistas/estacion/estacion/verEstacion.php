<?php session_start();
if(!(isset($_SESSION['username']))){ ?>
	<script language="JavaScript">window.open("../../../index.php", "_self")</script>
<?php
} ?>
<!DOCTYPE html>
<html lang="es">
	<head>
  		<?php include_once('../../includes/head.php'); ?>
        
        <link rel="stylesheet" type="text/css" href="../../../librerias/datapicker/css/bootstrap-datetimepicker.min.css" />	
    
    	<title>Bunker 2.0 - Simular Estación</title>
  	</head>
    <body>
    
    <?php include_once('../../includes/navbarE.php'); ?>

	<div class="col-sm-12 col-md-12 main">
    	<!-- <h2 class="sub-header"><?php //echo $_SESSION['username']; ?></h2> -->
        <div class="cargando"><img src="../../img/spinning-circles.svg" /></div>
    <form class="form-inline" onsubmit="return false">
    <input type="hidden" value="<?php echo $_SESSION['idUsr']; ?>" id="idUsrHidden" />


<h4 class="sub-header">Con Agenda</h4>
<div class="alert alert-info" role="alert" id="agendaRes" style="display: none;">No hay pendientes</div>
        <div class="table-responsive">
        
            <table class="table table-striped listados" id="listarAgenda">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Telefono</th>
                  <th>Nombre</th>
                  <th>Comuna</th>
                  <th>Encuesta</th>
                  <th>Estado</th>
                  <th>Desc</th>
                  <th>Agenda</th>
                  <th>Cambiar Estado</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
</div>
<div class="col-sm-12 col-md-12 main">
<h4 class="sub-header">Normal</h4>
<div class="alert alert-info" role="alert" id="normalRes" style="display: none;">No hay pendientes</div>
        <div class="table-responsive">
        
            <table class="table table-striped listados" id="listarNormal">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Telefono</th>
                  <th>Nombre</th>
                  <th>Comuna</th>
                  <th>Encuesta</th>
                  <th>Estado</th>
                  <th>Desc</th>
                  <th>Cambiar Estado</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>

</div>

<!-- Modal Editar -->
<div class="modal fade" id="editarModal" role="dialog" aria-labelledby="editar" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editar">Editar</h4>
      </div>
      <div class="modal-body">
      
      <?php include_once('cambiarEstado.php'); ?>
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
        
<?php include_once('../../includes/footer.php'); ?>   

<script type="text/javascript" src="../../../librerias/moment/moment-with-locales.js"></script>
<script type="text/javascript" src="../../../librerias/datapicker/js/bootstrap-datetimepicker.min.js"></script>

<script language="javascript" src="../../js/estacion.js"></script>      

	</body>
</html>