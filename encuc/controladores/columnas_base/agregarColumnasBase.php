<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/columnas_base.class.php");

$columna = $_POST["columna"];
$tipo = $_POST["tipo"];

$Columnas = new ColumnasBase();

$addColumnas = $Columnas->add_columnaBase($columna, $tipo);

if ($addColumnas) {
	echo "ok";
}
else
	echo "error";

?>