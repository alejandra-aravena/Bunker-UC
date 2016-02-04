<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/columnas_base.class.php");

$columna=$_POST["columna"];
$nuevaColumna=$_POST["nuevaColumna"];
$tipo=$_POST["tipo"];

$Columnas = new ColumnasBase();

$editColumnas = $Columnas->edit_columnaBase($columna, $nuevaColumna, $tipo); 

if ($editColumnas) {
	echo "ok";
}
else
	echo "error";

?>