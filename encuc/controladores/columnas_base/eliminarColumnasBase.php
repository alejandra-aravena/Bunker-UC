<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/columnas_base.class.php");

$columna=$_POST["columna"];

$Columnas = new ColumnasBase();

$delColumnas = $Columnas->del_columnaBase($columna);

if ($delColumnas) {
	echo "ok";
}
else
	echo "error";

?>