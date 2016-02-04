<?php
session_start();
if(!(isset($_SESSION['username']))){ 
	?><script language="JavaScript">window.open("../../index.php", "_self")</script><?php
}

require_once("../../modelo/columnas_extra.class.php");

$columna=$_POST["columna"];
$id_columna=$_POST["id_columna"];

$Columnas = new Columnas();

$editColumnas = $Columnas->edit_columna($id_columna, $columna); 

if ($editColumnas) {
	echo "ok";
}
else
	echo "error";

?>