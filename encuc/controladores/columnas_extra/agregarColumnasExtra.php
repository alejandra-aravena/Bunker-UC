<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}
 
require_once("../../modelo/columnas_extra.class.php");

$columna = $_POST["columna"];

$Columnas = new Columnas();

$addColumnas = $Columnas->add_columna($columna);

if ($addColumnas) {
	echo "ok";
}
else
	echo "error";

?>