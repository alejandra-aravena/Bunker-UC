<?php
session_start();
if((!(isset($_SESSION['username']))) || (!$_SESSION['admin'])){ 
	?><script language="JavaScript">window.open("../../../index.php", "_self")</script><?php
}?>
<!DOCTYPE html>
<html lang="es">
	<head>
  		<?php include_once('../../includes/head.php'); ?>
        
        <link href="../../../librerias/fileTree/css/file-tree.min.css" rel="stylesheet">
        <link href="../../../librerias/fileImput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    
    	<title>Bunker 2.0 - Subidas</title>
  	</head>
    <body>

<?php include_once('../../includes/navbar.php'); ?>
<?php include_once('../../includes/sidebar.php'); ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h2 class="sub-header">Subida de Casos</h2> 
    <div class="cargando"><img src="../../img/spinning-circles.svg" /></div> 

	<h5>Subida de archivos</h5>

    <input type="file" name="subirArchivo" id="subirArchivo"  />
    <p></p>
    <div class="alert" role="alert" style="display:none;" id="respUp"></div>
   
<hr />    
    <div id="archivosSubidas"></div>
    <div class="form-group col-sm-6">
       <label for="UseFile" class="sr-only">Archivo Seleccionado</label>
       <input type="input" class="form-control" id="UseFile" placeholder="Archivo Seleccionado" readonly />
    </div>
     <button type="button" class="btn btn-info btn-sm" aria-label="Utilizar" id="utilizarFile">
        <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
        Utilizar
    </button> 
<button type="button" class="btn btn-danger btn-sm" aria-label="Borrar" id="borrarFile">
	<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
    Eliminar
</button> 
    <p></p>
<div role="alert" class="alert alert-info" id="respDel" style="display:none;"></div>
<hr />
	<div class="form-group col-sm-3">
       <label for="nombreArchivo" class="sr-only">Archivo a Utilizar</label>
       <input type="input" class="form-control" id="nombreArchivo" placeholder="Archivo a utilizar" readonly />
    </div>
   

<button type="button" class="btn btn-success btn-sm" aria-label="Agregar Nuevo" id="agregarColumnas">
	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    Agregar Columnas Base
</button>   
<div class="table-responsive">       
            <table class="table table-striped listados" id="listarC" style="display: none;">
              <thead>
                <tr>
                  <th>Columna</th>
                  <th>Resultado</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
 <hr />

  <div class="form-group col-sm-5">
       <label for="columnaTel" class="sr-only">Nombre de Columna con telefono principal</label>
       <input type="input" class="form-control" id="columnaTel" placeholder="Nombre de Columna con telefono principal" required />
    </div>
   <!-- <div class="form-group col-sm-4">
       <label for="hoja" class="sr-only">Nombre de la hoja con el listado</label>
       <input type="input" class="form-control" id="hoja" placeholder="Nombre de la hoja con el listado" required />
    </div> -->
<button type="button" class="btn btn-success btn-sm" aria-label="Agregar Nuevo" id="agregarFilas">
	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
    Cargar casos
</button> 

<div class="cargando2"><img src="../../img/spinning-circles.svg" /></div> 
<h4 id="correctas" style="margin-top: 20px;"></h4>
<h4 id="incorrectas"></h4>
<div class="table-responsive">       
            <table class="table table-striped listados" id="listarF" style="display: none;">
              <thead>
                <tr>
                  <th>Fila</th>
                  <th>Resultado</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
</div>  
<?php include_once('../../includes/footer.php'); ?> 

<script src="../../../librerias/fileImput/js/fileinput.min.js" type="text/javascript"></script>

<script src="../../../librerias/fileTree/js/file-tree.min.js" type="text/javascript"></script>

<script language="javascript" src="../../js/subidaCasos.js"></script>        

	</body>
</html>