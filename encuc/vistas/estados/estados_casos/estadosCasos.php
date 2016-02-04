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
    
    	<title>Bunker 2.0 - Historial</title>
  	</head>
    <body>

<?php include_once('../../includes/navbar.php'); ?>
<?php include_once('../../includes/sidebar.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    	<h2 class="sub-header">Historial de estados por casos</h2>
        
        <button type="button" class="btn btn-default btn-sm" aria-label="Ver" id="iniciar">
          <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    Inicializar Estados
        </button>
        <hr />
        
        <div class="cargando"><img src="../../img/spinning-circles.svg" /></div>
        <div class="table-responsive">
        
            <table class="table table-striped listados" id="listarT">
              
            </table>
          </div>

        </div>
        
<?php include_once('../../includes/footer.php'); ?> 

<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="../../../librerias/DataTables/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="../../../librerias/DataTables/dataTables.bootstrap.js"></script>

<script language="javascript" src="../../js/estadosCasos.js"></script>        

	</body>
</html>