<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/columnas_base.class.php");

$Columnas = new ColumnasBase();

$arrayColumnas = $Columnas->get_allColumnasBase();

echo json_encode ($arrayColumnas);

?>