<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/columnas_visibilidad.class.php");

$Columnas = new ColumnasVisibilidad();

$arrayColumnas = $Columnas->get_allVisibilidadColumnas();

echo json_encode($arrayColumnas);

?>