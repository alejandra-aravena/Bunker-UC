<?php
session_start();
if((!(isset($_SESSION['username']))) || (!$_SESSION['admin'])){ 
	?><script language="JavaScript">window.open("../index.php", "_self")</script><?php
}?>
<!DOCTYPE html>
<html lang="es">
	<head>
  		<?php include_once('includes/headH.php'); ?>
    
    	<title>Bunker 2.0</title>
  	</head>
    <body>

<?php include_once('includes/navbarH.php'); ?>
<?php include_once('includes/sidebarH.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    	<h2 class="sub-header">Instrucciones</h2>
        
        <h4>1.- Subida de Casos</h4>
        <p>El archivo a ser usado debe tener en su primera hoja los casos a subir.</p>
        <p>- Seleccione el archivo desde la computadora y cárgelo al servidor<br>
        - Aparecerá en el listado de archivos del servidor, selecciónelo y presione &quot;Utlizar&quot;<br>
        - Agregue las columnas base<br>
        - Indique exactamente el nombre de la columna que corresponde a los teléfonos a utilizar y cargue los casos</p>
        <p>Los casos no agregados se guardarán en la seccion &quot;casos repetidos&quot;. En la eventualidad de que hubieran casos sin número telefónico, el primero del listado serra agregado a la base de datos y los siguientes serán considerados números repetidos</p>
        
        <p>&nbsp;</p>
        <h4>2.- Inicializar los estados</h4>
        <p>En la sección "historial de estados" debe inicializar los casos para que sean considerados como "No llamado"</p>
        
        <p>&nbsp;</p>
        <h4>3.- Encuestas</h4>
        <p>En esa sección debe agregar las encuestas por nombre y su link (número identificativo) de LimeSurvey</p>
        
        <p>&nbsp;</p>
        <h4>4.- Asignaciones</h4>
        <p>Debe asignar las encuestas a los casos y las estaciones a los casos</p>
        
        <p>&nbsp;</p>
        <h4>5.- Simulación de estaciones</h4>
        <p>Para ver exactamente lo mismo que una estación de trabajo. Al cambiar el estado, quedará guardado como si fuese hecho desde la estación seleccionada</p>
        
        <p>&nbsp;</p>
        <h4>6.- Seguimiento de casos</h4>
        <p>En los detalles de la sección "casos" podrá encontrar la información de las columnas del caso, el hisotiral de estados, junto con la posibilidad de alterarlo como administrador y la descarga de audios para ese caso</p>
        
        <p>&nbsp;</p>
        <h4>7.- Audios</h4>
        <p>Pueden ser descargado para un caso desde la sección "caso" o por fecha, estación o telefono desde "descargar audio"</p>
	</div>
        
<?php include_once('includes/footerH.php'); ?>        

	</body>
</html>
