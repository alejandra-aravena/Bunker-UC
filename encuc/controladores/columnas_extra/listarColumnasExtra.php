<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/columnas_extra.class.php");

$Columnas = new Columnas();

$arrayColumnas = $Columnas->get_allColumnas();

echo json_encode ($arrayColumnas);

?>